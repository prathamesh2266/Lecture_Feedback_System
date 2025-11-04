<?php
// Include database connection file
include 'includes/db.php';

// Initialize error variable
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $lecture = $_POST['lecture'];
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating']; // Retrieve the rating

    // Check if student is logged in
    session_start();
    if (!isset($_SESSION['student_logged_in'])) {
        $error = "You must be logged in to submit feedback.";
    } else {
        try {
            // Retrieve student ID from session
            $student_id = $_SESSION['student_logged_in'];

            // Insert feedback and rating into the database with student ID
            $sql = "INSERT INTO feedback (lecture, feedback, rating, student_id) VALUES ('$lecture', '$feedback', '$rating', '$student_id')";
            if (mysqli_query($conn, $sql)) {
                $success_message = "Feedback submitted successfully";
            } else {
                $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } catch (mysqli_sql_exception $e) {
            $error = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Feedback</title>
    <link rel="stylesheet" href="css/viewstyle.css">
</head>
<body>
    <div>
        <?php if (!empty($success_message)): ?>
            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th><?php echo $success_message ?></th>
                        </tr>
                    </thead>
                </table>
                <a href="student_dashboard.php" class="btn">Back to Dashboard</a>
            </div>
        <?php elseif (!empty($error)): ?>
            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>Error :(</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $error ?></td>
                        </tr>
                    </tbody>
                </table>
                <a href="student_dashboard.php" class="btn">Back to Student Dashboard</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
