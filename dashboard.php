<?php
include('db_connect.php');
session_start();
if(!isset($_SESSION['student_id'])){
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Management Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
        }

        .sidebar {
            width: 20%;
            background-color: #f4f4f4;
            padding: 20px;
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
        }
        .side nav ul li{
            margin: 10px 0;
            height: 100px;
            display: flex;
            align-items: center;
        }

        .sidebar nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 10px 0;
            width: 100%;
            display: block;
            height: 100px;
        }

        .main-content {
            width: 80%;
            padding: 20px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
        }

        .card {
            width: 30%;
            border-radius: 8px;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin: 10px 0;
        }

        .blue {
            background-color: #007bff;
        }

        .orange {
            background-color: #fd7e14;
        }

        .green {
            background-color: #28a745;
        }

        .card-content .number {
            font-size: 2rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="profile">

            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li> <a href="lodge-complaint.php">Lodge Complaint</a></li>
                    <li> <a href="complaint-history.php">Complaint History</a></li>
                    <li> <a href="receive.php">Receive feedback</a></li>
                    <li><a href="logout.php">logout</a></li>

                </ul>
            </nav>
        </aside>
        <main class="main-content">
            <div class="card blue">
                <div class="card-content">
                    <span class="number">2</span>
                    <p>Complaints not Process yet</p>
                </div>
            </div>
            <div class="card orange">
                <div class="card-content">
                    <span class="number">2</span>
                    <p>Complaints Status in process</p>
                </div>
            </div>
            <div class="card green">
                <div class="card-content">
                    <span class="number">3</span>
                    <p>Complaint has been closed</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>