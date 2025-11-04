<?php
// Include database connection file
include 'includes/db.php';

// Initialize error variable
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_id = $_POST['student_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Insert new student into database
        $sql = "INSERT INTO students (id, username, password) VALUES ('$student_id', '$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            $success_message = "Student added successfully";
        } else {
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } catch (mysqli_sql_exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="css/viewstyle.css">
</head>
<body>
    <div>
        <?php if (!empty($success_message)): ?>
            <div class="container">
    
                    <table>
                    <thead>
                        <tr>
                            <th>Student Added Successfully</th>
                        </tr>
                    </thead>
                </table>
                <a href="admin_dashboard.html" class="btn">Back to Admin Dashboard</a>
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
                <a href="add_student.html" class="btn">Back to Add Student Page</a>
                </div>
        <?php endif; ?>
    </div>
</body>
</html>
