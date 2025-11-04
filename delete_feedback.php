<?php
// Include database connection file
include_once "includes/db.php";

// SQL query to delete all feedback
$sql = "DELETE FROM feedback";
$sql2 = "ALTER TABLE feedback AUTO_INCREMENT = 1";

// Execute the query
if ($conn->query($sql) === TRUE) {
    $success_message1 = "All feedback deleted successfully :)";
} else {
    $error1 = "Error deleting feedback: ";
}

if ($conn->query($sql2) === TRUE) {
    $success_message2 = "All feedback deleted successfully :)";
    $success_message3 = "feedback id increament set  as 1";
    $success_message1 = "";
} else {
    $error2 = "Error setting feedback id increament as 1";
}

// Close database connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Feedback</title>
    <link rel="stylesheet" href="css/viewstyle.css">
</head>
<body>
    <div>
        <?php if (!empty($success_message1)): ?>
            <div class="container">
    
                    <table>
                    <thead>
                        <tr>
                            <th><?php echo $success_message1 ?></th>
                        </tr>
                    </thead>
                </table>
                <a href="admin_dashboard.html" class="btn">Back to Dashboard</a>
            </div>
            <?php elseif (!empty($success_message2)): ?>
            <div class="container">

                    <table>
                    <thead>
                        <tr>
                            <th><?php echo $success_message2 ?></th>
                        </tr>
                        <tr>
                            <th><?php echo $success_message3 ?></th>
                        </tr>
                    </thead>
                </table>
                <a href="admin_dashboard.html" class="btn">Back to Dashboard</a>
            </div>
        <?php elseif (!empty($error1)): ?>
            <div class="container">

                    <table>
                    <thead>
                        <tr>
                            <th>Error :(</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><?php echo $error1 ?></td>
                            </tr>
                    </tbody>
                </table>
                <a href="admin_dashboard.html" class="btn">Back to Student Dashboard</a>
                </div>
        <?php endif; ?>
        <?php if (!empty($error2)): ?>
            <div class="container">

                    <table>
                    <thead>
                        <tr>
                            <th>Error :(</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><?php echo $error2 ?></td>
                            </tr>
                    </tbody>
                </table>
                <a href="admin_dashboard.html" class="btn">Back to Student Dashboard</a>
                </div>
        <?php endif; ?>
    </div>
</body>
</html>
