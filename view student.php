<?php
session_start();
include('db_connect.php');
$query = "SELECT * FROM student";
$result = $conn->query($query);

if (!$result) {
    die("Error in SQL query");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
    /* Body Styles */
    body {
        display: flex;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    /* Sidebar Styles */
    .sidebar {
        width: 250px;
        background-color: #ffffff;
        padding: 20px;
        border-right: 1px solid #ddd;
        display: flex;
        flex-direction: column;
        position: fixed;
        height: 100%;
        overflow-y: auto;
        top: 0;
        left: 0;
    }

    .sidebar a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 4px;
        display: block;
        transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #f0f0f0;
    }

    .sidebar a.active {
        background-color: #4CAF50;
        color: white;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #ffffff;
        min-width: 250px;
        box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
        z-index: 1;
        top: 100%;
        left: 0;
    }

    .dropdown-content a {
        padding: 10px;
        text-decoration: none;
        display: block;
        color: #333;
    }

    .dropdown-content a:hover {
        background-color: #f0f0f0;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Main Content Styles */
    .main-content {
        margin-left: 300px; /* Account for sidebar width */
        padding: 20px;
        flex: 1; /* Allow the main content to grow and fill remaining space */
        background-color: #ffffff;
        border-radius: 8px;
        height: calc(100vh - 40px); /* Full height minus padding */
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }

    .main-content h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .main-content table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .main-content table th, .main-content table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .main-content table th {
        background-color: #f4f4f4;
    }

    .main-content table td a {
        color: #2196F3;
        text-decoration: none;
        font-weight: bold;
    }

    .main-content table td a:hover {
        text-decoration: underline;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            border-right: none;
            border-bottom: 1px solid #ddd;
        }

        .main-content {
            margin-left: 0;
            margin-top: 60px; /* Adjusted margin for header or top content */
        }
    }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="admin_dashboard.php" class="active">Dashboard</a>
        <a href="desk-staff.php">Desk Staff</a>
        <div class="dropdown">
            <a href="" class="dropdown-toggle">Manage users</a>
            <div class="dropdown-content">
                <a href="view deskstaff.php">View Desk Staff</a>
                <a href=" view student.php">View Students</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">Manage Complaints</a>
            <div class="dropdown-content">
                <a href="users_student.php">View Students' Complaints</a>
            </div>
        </div>
        
        <a href="logout.php">logout</a>
    </div>
    <div class="main-content">
        <h1>STUDENTS</h1>
        <table>
            <thead>
                <tr>
                    <th>FIRST NAME</th>
                    <th>SECOND NAME</th>
                    <th>REGISTRATION NO</th>
                    <th>EMAIL</th>
                  
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['first_name']}</td>";
                echo "<td>{$row['last_name']}</td>";
                echo "<td>{$row['registration']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>";
              
               
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
