<?php
error_reporting(0);
session_start();
include('db_connect.php');

if (!isset($_SESSION['desk_staff_department'])) {
    header('Location: login.php');
    exit();
}

$department = $_SESSION['desk_staff_department'];

// Fetch students based on the department and their complaints
$query_students = "SELECT student.id, student.first_name, complain.complaint_detail, complain.complain_id
                   FROM student
                   INNER JOIN complain ON student.id = complain.id 
                   WHERE complain.category = ? AND complain.status = 'pending'";
$stmt_students = $conn->prepare($query_students);
if (!$stmt_students) {
    die('Prepare failed: ' . $conn->error);
}
$stmt_students->bind_param("s", $department);
$stmt_students->execute();
$result_students = $stmt_students->get_result();

$students = [];
while ($row = $result_students->fetch_assoc()) {
    $students[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedback = $_POST['feedback'];
    $student_id = $_POST['student_id'];
    $complain_id = $_POST['complain_id'];

    // Debug output
    // echo "Feedback: " . htmlspecialchars($feedback) . "<br>";
    // echo "Student ID: " . htmlspecialchars($student_id) . "<br>";
    // echo "Complaint ID: " . htmlspecialchars($complain_id) . "<br>";

    if (!empty($feedback) && !empty($student_id) && !empty($complain_id)) {
        // Insert feedback into the database
        $query_feedback = "INSERT INTO feedback (id, feedback_description) VALUES (?, ?)";
        $stmt_feedback = $conn->prepare($query_feedback);
        if (!$stmt_feedback) {
            die('Prepare failed: ' . $conn->error);
        }
        $stmt_feedback->bind_param("is", $student_id, $feedback);

        if ($stmt_feedback->execute()) {
            // Update the status of the complaint to 'replied'
            $query_update_complain = "UPDATE complain SET status = 'replied' WHERE complain_id = ?";
            $stmt_update_complain = $conn->prepare($query_update_complain);
            if (!$stmt_update_complain) {
                die('Prepare failed: ' . $conn->error);
            }
            $stmt_update_complain->bind_param("i", $complain_id);

            if ($stmt_update_complain->execute()) {
                $message = "Feedback submitted successfully.";
                header('location: feedback.php');
            } else {
                $message = "Error updating complaint status: " . $stmt_update_complain->error;
            }
        } else {
            $message = "Error inserting feedback: " . $stmt_feedback->error;
        }
    } else {
        $message = "Please select a student, a complaint, and provide feedback.";
    }
}

// Fetch complaints based on the selected student
$complaints = [];
if (isset($_POST['student_id'])) {
    $selected_student_id = $_POST['student_id'];
    $query_complaints = "SELECT complain_id, complaint_detail FROM complain WHERE id = ? AND status = 'pending'";
    $stmt_complaints = $conn->prepare($query_complaints);
    if (!$stmt_complaints) {
        die('Prepare failed: ' . $conn->error);
    }
    $stmt_complaints->bind_param("i", $selected_student_id);
    $stmt_complaints->execute();
    $result_complaints = $stmt_complaints->get_result();

    while ($row = $result_complaints->fetch_assoc()) {
        $complaints[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Same styles as before */
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
            width: 80%;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-group input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #008CBA;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #006980;
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="desk-dashboard.php">Dashboard</a>
        <a href="manage-complaint.php">Manage Complaint</a>
        <a href="feedback.php" class="active">Send Feedback</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h1>Send Your Feedback</h1>
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
        <form method="post">
            <div class="form-group">
                <label for="student-id">STUDENT NAME:</label>
                <select id="student-id" name="student_id" onchange="this.form.submit()" required>
                    <option value="">Select student</option>
                    <?php foreach($students as $student): ?>
                        <option value="<?php echo htmlspecialchars($student['id']); ?>" <?php echo isset($selected_student_id) && $selected_student_id == $student['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($student['first_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php if (isset($selected_student_id)): ?>
            <div class="form-group">
                <label for="complain-id">COMPLAINT DETAIL:</label>
                <select id="complain-id" name="complain_id" required>
                    <option value="">Select complaint</option>
                    <?php foreach($complaints as $complaint): ?>
                        <option value="<?php echo htmlspecialchars($complaint['complain_id']); ?>">
                            <?php echo htmlspecialchars($complaint['complaint_detail']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="feedback">Feedback:</label>
                <textarea id="feedback" name="feedback" placeholder="Enter your feedback here..." required></textarea>
            </div>
            <input type="submit" value="Submit Feedback">
        </form>
    </div>
</body>
</html>
