<?php
// Start session
session_start();

// Unset session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: index.html");
exit();
?>
