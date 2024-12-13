<?php
session_start();
include('db_connect.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $department = $_POST['department'];
        $contact = $_POST['contact'];

        $query = "UPDATE desk_staff SET desk_staff_name=?, desk_staff_department=?, contact_number=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $name, $department, $contact, $id);

        if ($stmt->execute()) {
            header("Location: view deskstaff.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $query = "SELECT * FROM desk_staff WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $staff = $result->fetch_assoc();
} else {
    echo "Invalid ID.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Desk Staff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"], select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input, .form-group select {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Desk Staff</h1>
        <form method="post" action="edit_desk_staff.php?id=<?php echo htmlspecialchars($id); ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($staff['desk_staff_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="department">Desk-Staff Department:</label>
                <select id="department" name="department" required>
                    <option value="">Select Department</option>
                    <option value="academic" <?php if ($staff['desk_staff_department'] == 'academic') echo 'selected'; ?>>Academic Issues</option>
                    <option value="administrative" <?php if ($staff['desk_staff_department'] == 'administrative') echo 'selected'; ?>>Administrative Issues</option>
                    <option value="facilities" <?php if ($staff['desk_staff_department'] == 'facilities') echo 'selected'; ?>>Facilities Issues</option>
                    <option value="harassment" <?php if ($staff['desk_staff_department'] == 'harassment') echo 'selected'; ?>>Harassment or Discrimination</option>
                    <option value="financial" <?php if ($staff['desk_staff_department'] == 'financial') echo 'selected'; ?>>Financial Issues</option>
                    <option value="technical" <?php if ($staff['desk_staff_department'] == 'technical') echo 'selected'; ?>>IT/Technical Issues</option>
                </select>
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($staff['contact_number']); ?>" required>
            </div>
            <input type="submit" value="Update Staff">
        </form>
    </div>
</body>
</html>
