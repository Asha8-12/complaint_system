<?php
session_start();
include ('db_connect.php');
if(!isset($_SESSION['student_id'])){
    header('location: login.php');
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data

    $registration_number = $_POST['registration'];
    $category = $_POST['category'];
    $complaint_detail = $_POST['complaint-details'];
    $student_id = $_SESSION['student_id'];
    $status = "pending";


    // Handling the file upload
    if (isset($_FILES['complaint-doc']) && $_FILES['complaint-doc']['error'] == 0) {
        $file = $_FILES['complaint-doc']['tmp_name'];
        $fileContent = addslashes(file_get_contents($file));
    } else {
        $fileContent = null; // No file uploaded
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO complain (registration_number, category, complaint_detail, complaint_related_document, id, status) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $registration_number, $category, $complaint_detail, $fileContent, $student_id, $status);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New complaint registered successfully!";
        header('Location: lodge-complaint.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
