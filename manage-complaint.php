<?php
session_start();
include('db_connect.php');
if(!isset($_SESSION['desk_staff_department'])){
    header('location: login.php');
}

$department = $_SESSION['desk_staff_department'];
// Prepare an SQL statement to select data from the complain table
$stmt = $conn->prepare("SELECT complain_id, registration_number, category, complaint_detail, Time, complaint_related_document, id,
complain.status FROM complain WHERE category = ? and complain.status = 'pending'");
$stmt->bind_param("s", $department);
$stmt->execute();
$result = $stmt->get_result();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <style>
body {
    display: flex;
    height: 100vh;
    margin: 0;
    font-family: Arial, sans-serif;
}

.sidebar {
    width: 250px; /* Fixed width for better consistency */
    background-color: #f4f4f4;
    padding: 20px;
    border-right: 2px solid #ddd;
    display: flex;
    flex-direction: column;
}




.sidebar nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar nav ul li {
    margin: 15px 0;
}

.sidebar nav ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    padding: 10px 20px;
    display: block;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.sidebar nav ul li a:hover {
    background-color: #4CAF50;
    color: white;
}

.sidebar nav ul li a.active {
    background-color: #4CAF50;
    color: white;
}

.main-content {
    flex: 1;
    padding: 20px;
    overflow-y: auto; /* Adds scrollbar if content exceeds view height */
}

table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

.not-process-yet {
    color: red;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}
</style>

    <div class="sidebar">
    
        <nav>
            <ul>
                <li><a href="desk-dashboard.php" class="active">Dashboard</a></li>
                <li><a href="manage-complaint.php">Manage Complaints</a></li>
                 <li><a href="feedback.php">Send feedback</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <h1>COMPLAINT TABLE</h1>
        <table>
            <thead>
                <tr>
                    <th>COMPLAIN ID</th>
                    <th>REGISTRATION NO</th>
                    <th>CATEGORY</th>
                    <th>COMPLAINT DETAILS</th>
                    <th>TIME</th>
                    <th>DOCUMENT</th>
                    <th>ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are results
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['complain_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['registration_number']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['complaint_detail']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Time']) . "</td>";

                        // Display the document as a link if it exists
                        if ($row['complaint_related_document']) {
                            echo "<td><a href='data:application/octet-stream;base64," . base64_encode($row['complaint_related_document']) . "' download='document'>Download Document</a></td>";
                        } else {
                            echo "<td>No Document</td>";
                        }

                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No complaints found for this category.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
