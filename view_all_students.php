<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Include database connection file
include 'includes/db.php';

// Delete selected students
if (isset($_POST['delete_students'])) {
    if (!empty($_POST['student_ids'])) {
        foreach ($_POST['student_ids'] as $student_id) {
            // Delete student from database
            $delete_query = "DELETE FROM students WHERE id = $student_id";
            mysqli_query($conn, $delete_query);
        }
        // Redirect to same page after deletion
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}

// Fetch all student data from the database
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);

?>

<?php if (mysqli_num_rows($result) > 0){
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Students</title>
    <link rel="stylesheet" href="css/viewstyle.css">
</head>
<body>
    <div class="container">
        <h2>All Students</h2>
        <form method="POST">
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Student To Delete</th>
                        <th>Student ID</th>
                        <th>Username</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each feedback entry and display it in a table row
                    while ($row = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                        <td class="s_to_d"><input type="checkbox" name="student_ids[]" value="<?php echo $row['id']; ?>"></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" name="delete_students" class="btn" >Delete Selected Students</button>
            <?php } else { ?>
                <p>No Students Found :(</p>
                <?php } ?>
            </form>
            <a href="admin_dashboard.html">Back to Dashboard</a>
    </div>
    </body>
    </html>


    <?php
} else {
    // No Students found
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View All Students</title>
        <link rel="stylesheet" href="css/viewstyle.css">
    </head>
    <body>
            <div class="container">

                <table>
                <thead>
                    <tr>
                        <th>No Students Found :(</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>There are currently no Students registered.</td>
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