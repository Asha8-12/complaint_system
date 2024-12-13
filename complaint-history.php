<?php
session_start();
include ('db_connect.php');
if(!isset($_SESSION['student_id'])){
    header('location: login.php');
}
$student_id = $_SESSION['student_id'];
$query = "SELECT complain.category, complain.Time, complain.complaint_detail, complain.complaint_related_document,
student.first_name, student.registration, student.email, complain.status FROM complain 
INNER JOIN student ON complain.id = student.id WHERE student.id = '$student_id'";
$result = $conn->query($query);

if (!$result) {
    die("Error in sql query");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint History</title>
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 20%;
            background-color: #f4f4f4;
            padding: 20px;
            border-right: 1px solid #080000;
        }

        .sidebar .profile {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .profile img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
        }

        .sidebar nav ul li {
            margin: 10px 0;
            height: 50px;
            display: flex;
            align-items: center;
        }

        .sidebar nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 10px 0;
            display: block;
            width: 100%;
        }

        .sidebar nav ul li a.active {
            background-color: #4CAF50;
            color: white;
        }

        .main-content {
            width: 80%;
            padding: 20px;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            margin: 0 auto;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 3px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .not-process-yet {
            color: red;
        }

        h1 {
            text-align: center;
        }

        .view-details {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="profile">
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li> <a href="lodge-complaint.php">Lodge Complaint</a></li>
                <li><a href="complaint-history.php">Complaint History</a></li>
                <li> <a href="receive.php">Receive feedback</a></li>
                <li><a href="logout.php">Logout</a></li>
            
                
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <h1>YOURS COMPLAINT HISTORY</h1>
        <table>
            <thead>
                <tr>
                    <th>Reg Number</th>
                    <th>Date</th>
                    <th>category</th>
                    <th>Details</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
              <?php
                while ($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>{$row['registration']}</td>";
                    echo "<td>{$row['Time']}</td>";
                    echo "<td>{$row['category']}</td>";
                    echo "<td>{$row['complaint_detail']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<tr>";
                }
              ?>
            </tbody>
        </table>
    </div>
</body>
</html>