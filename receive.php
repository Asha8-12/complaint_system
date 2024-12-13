<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit();
}

$student_id = $_SESSION['student_id'];

$query = "SELECT complain.category, complain.Time, complain.complaint_detail, complain.complaint_related_document,
                 student.first_name, student.registration, student.email, feedback.feedback_description, complain.status 
          FROM complain
          INNER JOIN student ON complain.id = student.id
          INNER JOIN feedback ON feedback.id = student.id
          WHERE student.id = ? and complain.status = 'replied'";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error in SQL query: " . $conn->error);
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

        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="lodge-complaint.php">Lodge Complaint</a></li>
                <li> <a href="receive.php">Receive feedback</a></li>
                <li><a href="complaint-history.php">Complaint History</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <h1>Feedback</h1>
        <table>
            <thead>
                <tr>
                    <th>Reg Number</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Complain</th>
                    <th>Feedback</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
              <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['registration']}</td>";
                        echo "<td>{$row['Time']}</td>";
                        echo "<td>{$row['category']}</td>";
                        echo "<td>{$row['complaint_detail']}</td>";
                        echo "<td>{$row['feedback_description']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found for the student.</td></tr>";
                }
              ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
