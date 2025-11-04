<?php
session_start();

// Include database connection file
include 'includes/db.php';

// Define an empty error message variable
$error = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the username exists and retrieve admin ID and password
    $sql = "SELECT id, username, password FROM admins WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Username exists, retrieve admin data
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];
        
        // Compare entered password with stored password
        if ($password === $stored_password) {
            // Password is correct, set session variables
            $_SESSION['admin_logged_in'] = $row['id'];
            $_SESSION['admin_username'] = $row['username'];

            // Redirect to admin dashboard
            header("Location: admin_dashboard.html");
            exit();
        } else {
            // Password is incorrect
            $error = "Incorrect password";
        }
    } else {
        // Username does not exist
        $error = "Username not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <label><input type="checkbox" onclick="showPassword()">Show Password</label>
            <button type="submit" name="login">Login</button>
            <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </div>
    <script>
        function showPassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>
</html>
