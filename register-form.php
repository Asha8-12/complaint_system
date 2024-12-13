<?php
include ('db_connect.php');

// Retrieve POST data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$registration = $_POST['registration'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if passwords match
if ($password !== $confirm_password) {
    echo "Passwords do not match.";
    exit; // Stop further execution if passwords do not match
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare an SQL statement
$stmt = $conn->prepare("INSERT INTO student (first_name, last_name, registration, email, password) VALUES (?, ?, ?, ?, ?)");

// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Statement preparation failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sssss", $first_name, $last_name, $registration, $email, $hashed_password);

// Execute the statement
$execval = $stmt->execute();

// Check if the insertion was successful
if ($execval) {
    echo "Registration successful...";
    header('Location: login.php');
    exit(); // Ensure no further code is executed after redirect
} else {
    echo "Registration failed: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
