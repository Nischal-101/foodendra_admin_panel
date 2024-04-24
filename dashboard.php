<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Check the user's session ID to determine the type of dashboard to display
if ($_SESSION['id'] == 1) {
    // Admin Dashboard
    include('admin_dashboard.php');
} else {
    // Restaurant Dashboard
    include('restaurant_dashboard.php');
}
?>
