<?php
include('db_connect.php');
session_start();

// Retrieve POST data from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// Create a database connection
$conn = new mysqli('localhost', 'root', '', 'complaint');

// Check the connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Function to authenticate and redirect
function authenticateUser($conn, $email, $password) {
    // Check if email exists in admin table
    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE admin_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['desk_staff_id'] = $id;
            $stmt->close();
            header('Location: admin_dasboard.php');
            exit();
        } else {
            $stmt->close();
            return 'invalid_password';
        }
    }
    $stmt->close();
    
    // Check if email exists in desk_staff table
    $stmt = $conn->prepare("SELECT id, desk_staff_department, password FROM desk_staff WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $desk_staff_department, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            $_SESSION['desk_staff_id'] = $id;
            $_SESSION['desk_staff_department'] = $desk_staff_department;
            $stmt->close();
            header('Location: desk-dashboard.php');
            exit();
        } else {
            $stmt->close();
            return 'invalid_password';
        }
    }
    $stmt->close();
    
    // Check if email exists in student table
    $stmt = $conn->prepare("SELECT id, first_name, password FROM student WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['student_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $stmt->close();
            header('Location: dashboard.php');
            exit();
        } else {
            $stmt->close();
            return 'invalid_password';
        }
    }
    $stmt->close();
    
    return 'no_user_found';
}

// Authenticate user and handle errors
$error = authenticateUser($conn, $email, $password);
if ($error) {
    header('Location: login.php?error=' . $error);
    exit();
}

// Close the connection
$conn->close();
?>
