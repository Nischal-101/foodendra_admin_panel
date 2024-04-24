<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}
require_once('../database/db.php');

// Check if the restaurant ID is provided
if (!isset($_GET['id'])) {
    header("Location: restaurant.php");
    exit();
}

// Retrieve the restaurant ID from the query parameter
$id = $_GET['id'];

// Delete the restaurant record from the database
$sql = "DELETE FROM restaurant WHERE restaurant_id = '$id'";
if ($conn->query($sql) === TRUE) {
    // Redirect to the appropriate page after successful deletion
    header("Location: restaurant.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
