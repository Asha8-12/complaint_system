<?php
// db_connect.php
$host = 'localhost';  // Database host
$username = 'root';  // Database username
$password = '';  // Database password
$database = 'complaint';  // Database name

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch department-wise complaint counts for the past week
$weekStart = date('Y-m-d', strtotime('-7 days'));
$weekEnd = date('Y-m-d');

$query = "SELECT category, COUNT(*) as total_complaints 
          FROM complain 
          WHERE DATE(created_at) BETWEEN '$weekStart' AND '$weekEnd'
          GROUP BY category";
$result = mysqli_query($conn, $query);

$reportData = [];
while($row = mysqli_fetch_assoc($result)) {
    $reportData[] = $row;
}
mysqli_close($conn);  // Close the connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Departmental Report</title>
    <style>
        /* Styling for the table and print button */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .print-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }

        .print-btn:hover {
            background-color: #45a049;
        }

        /* Print Styles */
        @media print {
            .print-btn {
                display: none;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid #ddd;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <h1>Weekly Departmental Complaint Report</h1>
    <table>
        <thead>
            <tr>
                <th>Department</th>
                <th>Total Complaints</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($reportData as $data): ?>
                <tr>
                    <td><?php echo htmlspecialchars($data['category']); ?></td>
                    <td><?php echo htmlspecialchars($data['total_complaints']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button class="print-btn" onclick="window.print()">Print Weekly Report</button>
</body>
</html>
