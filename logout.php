<?php
require_once 'includes/config.php';

// Log the activity if logged in
if (is_logged_in()) {
    // log_activity($_SESSION['user_id'], 'logout', 'user', $_SESSION['user_id'], 'User logged out');
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: auth.php");
exit;
?>