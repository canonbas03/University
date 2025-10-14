<?php
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Delete the "remember me" cookie if it exists
if (isset($_COOKIE['remember_user'])) {
    setcookie('remember_user', '', time() - 3600, '/'); // past time to delete
}

// Redirect to login page
header("Location: login.php");
exit;
