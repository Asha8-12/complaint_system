<?php
include ('db_connect.php');


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// to check form is submitted IN THE DATabase
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
        // Get form data and sanitize
        $desk_staff_name = trim($_POST['desk_staff_name']);
        $desk_staff_department = trim($_POST['desk_staff_department']);
        $contact_number = trim($_POST['contact_number']);
        $email = $_POST['email'];
         // Set a default password and hash it
    $default_password = '12345678'; 
    $password = password_hash($default_password, PASSWORD_DEFAULT);
        
        // Validate that none of the fields are empty
        if (!empty($desk_staff_name) && !empty($desk_staff_department) && !empty($contact_number) && !empty($password)) {

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO desk_staff (desk_staff_name, desk_staff_department, contact_number,email, password) VALUES (?, ?,?, ?, ?)");
            $stmt->bind_param("sssss", $desk_staff_name, $desk_staff_department, $contact_number, $email, $password);

            // Execute the statement
            if ($stmt->execute()) {
                echo "New desk staff added successfully!";
                // Redirect or perform another action if necessary
                header('Location: desk-staff.php');
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
       }

// Close the connection
$conn->close();
?>