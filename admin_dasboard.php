<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
    <style>
      
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

       
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
            padding: 15px;
            border-radius: 4px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-toggle:hover {
            background-color: #f0f0f0;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #ffffff;
            min-width: 250px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 4;
            top: 100%;
            left: 0;
            border-radius: 4px;
            padding: 0;
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

      
        .content {
            margin-left: 250px; 
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            height: calc(100vh - 40px);
            overflow-y: auto;
        }

        .card {
            flex: 1 1 calc(33.33% - 20px); 
            border-radius: 8px;
            color: #fff;
            padding: 20px;
            text-align: center;
            box-sizing: border-box; 
            display: flex;
            flex-direction: column; 
            justify-content: center; 
            height: 150px; 
            margin: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .card h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .card p {
            font-size: 2rem;
            font-weight: bold;
            margin: 10px 0 0;
        }

        .total {
            background-color: #007bff; 
        }

        .not-processed {
            background-color: #fd7e14; 
        }

        .in-process {
            background-color: #28a745; 
        }

        .closed {
            background-color: #dc3545; 
        }

       
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }

            .card {
                flex: 1 1 calc(50% - 20px); 
            }
        }

        @media (max-width: 400px) {
            .card {
                flex: 1 1 calc(100% - 20px); 
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="admin_dashboard.php" class="active">Dashboard</a>
        <a href="desk-staff.php">Desk Staff</a>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">Manage Users</a>
            <div class="dropdown-content">
                <a href="view deskstaff.php">View Desk Staff</a>
                <a href="view student.php">View Students</a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">Manage Complaints</a>
            <div class="dropdown-content">
                <a href="users_student.php">View Students' Complaints</a>
            </div>
        </div>
        
        <a href="report.php" target="_blank">Report</a>
        <a href="logout.php">Logout</a>
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
