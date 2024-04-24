<?php
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if order_id is set and not empty
    if (isset($_POST['order_id']) && !empty($_POST['order_id'])) {
        // Include database connection
        require_once('../database/db.php');

        // Sanitize the order_id
        $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);

        // Update the order status to "Complete" in the database
        $sql = "UPDATE orders SET status = 'Complete' WHERE order_id = '$order_id'";
        if (mysqli_query($conn, $sql)) {
            // Order completion successful
            echo 'success';
        } else {
            // Order completion failed
            echo 'error';
        }
    } else {
        // If order_id is not set or empty
        echo 'error';
    }
} else {
    // If the request method is not POST
    echo 'error';
}
?>
