<?php
session_start();
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Prepare the SQL statement to delete the record
    $stmt = $conn->prepare("DELETE FROM desk_staff WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
       
        header('Location: view deskstaff.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "No ID provided.";
}
?>

