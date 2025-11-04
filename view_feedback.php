<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Include database connection file
include 'includes/db.php';

// Delete selected feedback
if (isset($_POST['delete_feedbacks'])) {
    if (!empty($_POST['feedback_ids'])) {
        foreach ($_POST['feedback_ids'] as $feedback_id) {
            // Delete feedback from database
            $delete_query = "DELETE FROM feedback WHERE id = $feedback_id";
            mysqli_query($conn, $delete_query);
        }
        // Redirect to same page after deletion
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}

// Fetch all feedback data from the database
$query = "SELECT * FROM feedback";
$result = mysqli_query($conn, $query);

// Check if any feedback entries exist
if (mysqli_num_rows($result) > 0) {
    // Feedback entries exist, display them
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Feedback</title>
        <link rel="stylesheet" href="css/viewstyle.css">
    </head>
    <body>
        <div class="container">
            <h2>All Feedback</h2>
            <form method="POST">
            <?php if (mysqli_num_rows($result) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Feedback To Delete</th>
                        <th>Feedback ID</th>
                        <th>Student ID</th>
                        <th>Lecture</th>
                        <th>Feedback</th>
                        <th>Rating</th> <!-- New column for rating -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each feedback entry and display it in a table row
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td class="s_to_d"><input type="checkbox" name="feedback_ids[]" value="<?php echo $row['id']; ?>"></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['student_id']; ?></td>
                            <td><?php echo $row['lecture']; ?></td>
                            <td><?php echo $row['feedback']; ?></td>
                            <td><?php echo $row['rating']; ?> / 5</td> <!-- Display rating -->
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" name="delete_feedbacks" class="btn">Delete Selected Feedbacks</button>
            <?php } else { ?>
                <p>No Feedback Found :(</p>
            <?php } ?>
            </form>
            <a href="admin_dashboard.html" class="btn">Back to Dashboard</a>
        </div>
    </body>
    </html>

    <?php
} else {
    // No feedback entries found
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Feedback</title>
        <link rel="stylesheet" href="css/viewstyle.css">
    </head>
    <body>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>No Feedback Found :(</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>There are currently no feedback entries.</td>
                    </tr>
                </tbody>
            </table>
            <a href="admin_dashboard.html" class="btn">Back to Dashboard</a>
        </div>
    </body>
    </html>

    <?php
}
?>
