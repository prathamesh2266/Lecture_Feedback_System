<?php
session_start();

// Check if student is logged in
if (!isset($_SESSION['student_logged_in'])) {
    header("Location: student_login.php");
    exit();
}

// Include database connection file
include 'includes/db.php';

// Get the student ID from the session
$student_id = $_SESSION['student_logged_in'];

// Query to retrieve the username based on student ID
$sql = "SELECT username FROM students WHERE id = $student_id";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the username
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
} else {
    // Handle error
    $username = "Student"; // Set a default value
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/dashstyle.css">
</head>
<body>
    <div class="container">
        <h2>Welcome <?php echo $username; ?></h2>
        <p>Submit Your Feedback :)</p>
        
            <a href="feedback_form.html" class="btn">Provide Feedback</a></li>
        
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
