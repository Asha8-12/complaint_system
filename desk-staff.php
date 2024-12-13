<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    /* Body Styles */
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


.main-content {
    margin-left: 200px;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    height: calc(100vh - 40px);
    overflow-y: auto;
    display: flex;
    justify-content: center
    align-items: center; 
}


.container {
    max-width: 800px;
    width: 100%;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin: 0 auto;
    
}



.container h2 {
    margin-top: 0;
    text-align: center; 
}

.form-row {
    display: flex;
    gap: 20px; 
    
    flex-wrap: wrap;
}

.form-group {
    flex: 1;
    min-width: 250px; 
    
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.submit-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 15px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    display: block;
    margin: 20px auto 0;
    
}

.submit-btn:hover {
    background-color: #45a049;
}


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
        margin-top: 10px; 
        
    }
}
</style>
</head>
<body>
    <div class="sidebar">
        <a href="admin_dashboard.php" class="active">Dashboard</a>
        <a href="desk-staff.php">Desk Staff</a>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle">Manage users</a>
            <div class="dropdown-content">
                <a href="view deskstaff.php">View Desk Staff</a>
                <a href="users_student.php">View Students</a>
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
        <div class="container">
            <h2>Add Desk-Staff</h2>
            <form action="desk-staff-form.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="desk-staff-name">Desk-Staff Name</label>
                        <input type="text" id="desk-staff-name" name="desk_staff_name" required>
                    </div>
                    <div class="form-group">
                        <label for="desk-staff-department">Desk-Staff Department</label>
                        <select id="desk-staff-department" name="desk_staff_department" required>
                            <option value="">Select Department</option>
                            <option value="academic">Academic Issues</option>
                            <option value="administrative">Administrative Issues</option>
                            <option value="facilities">Facilities Issues</option>
                            <option value="harassment">Harassment or Discrimination</option>
                            <option value="financial">Financial Issues</option>
                            <option value="technical">IT/Technical Issues</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input type="tel" id="contact-number" name="contact_number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
