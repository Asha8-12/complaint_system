<?php
include('db_connect.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT id, password FROM desk_staff WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if email exists
    if ($stmt->num_rows > 0) 
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        ini_set('display_errors', 1);

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start session and redirect
            session_start();
            $_SESSION['desk_staff_id'] = $id;
            header('Location: desk-dashboard.php');
            exit();
     

    // Close statement
    $stmt->close();
        }
}

// Close connection
$conn->close();
?>
