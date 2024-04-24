<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}
require_once('../database/db.php');

// Check if the item ID is provided
if (!isset($_GET['id'])) {
    header("Location: Food.php");
    exit();
}

// Retrieve the item ID from the query parameter
$id = $_GET['id'];

// Delete the item record from the database
// $sql = "DELETE FROM menuitem WHERE item_id = '$id'";
// if ($conn->query($sql) === TRUE) {
//     // Redirect to the appropriate page after successful deletion
//     header("Location: Food.php");
//     exit();
// } else {
//     echo "Error deleting record: " . $conn->error;
// }

// Delete associated records from order_items table
$sql_delete_order_items = "DELETE FROM order_items WHERE item_id = '$id'";
if ($conn->query($sql_delete_order_items) === TRUE) {
    // Now it's safe to delete the item record from the menuitem table
    $sql_delete_menuitem = "DELETE FROM menuitem WHERE item_id = '$id'";
    if ($conn->query($sql_delete_menuitem) === TRUE) {
        // Redirect to the appropriate page after successful deletion
        header("Location: Food.php");
        exit();
    } else {
        echo "Error deleting record from menuitem table: " . $conn->error;
    }
} else {
    echo "Error deleting associated records from order_items table: " . $conn->error;
}


$conn->close();
?>
