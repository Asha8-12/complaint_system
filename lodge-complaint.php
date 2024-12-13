<?php

session_start();
include ('db_connect.php');
if(!isset($_SESSION['student_id'])){
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Complaint</title>
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

        .main-content {
            width: 80%;
            padding: 20px;
        }

        .complaint-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, select, textarea {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px;
            width: 100%;
        }

        .submit-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            cursor: pointer;
            padding: 10px 20px;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="profile">
            <!-- Optional Profile Section -->
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="lodge-complaint.php">Lodge Complaint</a></li>
                <li><a href="complaint-history.php">Complaint History</a></li>
                <li> <a href="receive.php">Receive feedback</a></li>
                 <li><a href="logout.php">logout</a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <h2>Register Complaint</h2>
        <form class="complaint-form" action="submit-lodge-complaint.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="reg">Registration Number</label>
                <input type="text" id="reg" name="registration" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="academic">Academic Issues</option>
                    <option value="administrative">Administrative Issues</option>
                    <option value="facilities">Facilities Issues</option>
                    <option value="harassment">Harassment or Discrimination</option>
                    <option value="financial">Financial Issues</option>
                    <option value="technical">IT/Technical Issues</option>
                </select>
            </div>
            <div class="form-group">
                <label for="complaint-details">Complaint Details</label>
                <textarea id="complaint-details" name="complaint-details" maxlength="2000" required></textarea>
            </div>
            <div class="form-group">
                <label for="complaint-doc">Complaint Related Doc (if any)</label>
                <input type="file" id="complaint-doc" name="complaint-doc">
            </div>
            <button type="submit" name="submit" class="submit-btn">Submit</button>
        </form>
    </div>
</body>
</html>
