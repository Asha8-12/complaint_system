<?php
session_start();
include('db_connect.php');
if(!isset($_SESSION['desk_staff_department'])){
    header('location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            display: flex;
            flex-direction: column;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 40px;
            display: block;
            border-radius: 4px;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

        .sidebar a.active {
            background-color: #4CAF50;
            color: white;
        }

        .content {
            flex: 1;
            padding: 60px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 2fr));
            grid-gap: 20px;
        }

        .card {
            background-color: #f1f1f1;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 60px;
            /* Adjusted padding */
            text-align: center;
            height: 40px;
        }

        .card h2 {
            margin-top: 0;
            font-size: 1.5rem;
            /* Adjusted heading font size */
        }

        .card p {
            font-size: 18px;
            /* Adjusted paragraph font size */
            font-weight: bold;
            margin: 0;
        }

        .total {
            background-color: #663399;
            color: #fff;
        }

        .not-processed {
            background-color: #ff9800;
            color: #fff;
        }

        .in-process {
            background-color: #4caf50;
            color: #fff;
        }

        .closed {
            background-color: #f44336;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="desk-dashboard.php">Dashboard</a>
        <a href="manage-complaint.php">Manage Complaint</a>
        <a href="feedback.php">Send feedback</a>
        <a href="logout.php">logout</a>


    </div>
    <div class="content">
        <div class="card total">
            <h2>Total</h2>
            <p>7</p>
        </div>
        <div class="card not-processed">
            <h2>Not Processed Yet</h2>
            <p>2</p>
        </div>
        <div class="card in-process">
            <h2>In Process</h2>
            <p>0</p>
        </div>
        <div class="card closed">
            <h2>Closed</h2>
            <p>5</p>
        </div>
    </div>
</body>

</html>