<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

require_once('../database/db.php');

// Retrieve the filter values
$order_id = $_GET['order_id'] ?? '';

// Prepare the WHERE clause for the SQL query based on the filter value
$whereClause = '';
if (!empty($order_id)) {
    $whereClause = "AND o.order_id = $order_id";
}

// Retrieve order data from the database for the logged-in restaurant along with food items
$restaurant_id = 4; // Assuming this is the restaurant ID
$sql = "SELECT o.order_id, o.user_id, o.total_amount, o.order_date, o.delivery_address, o.status, u.username AS user_name, GROUP_CONCAT(i.name SEPARATOR ', ') AS food_items
        FROM orders o
        INNER JOIN user u ON o.user_id = u.user_id
        INNER JOIN order_items oi ON o.order_id = oi.order_id
        INNER JOIN menuitem i ON oi.item_id = i.item_id
        WHERE o.restaurant_id = $restaurant_id
        $whereClause
        GROUP BY o.order_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .content-wrapper {
            flex: 1;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Sidebar -->
        <?php include('../sidebar.php'); ?>

        <!-- Header -->
        <?php include('../header.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content py-3">
                <div class="container">
                    <h2 class="mb-4">Orders</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Name</th>
                                    <th>Food Items</th> <!-- Updated column heading -->
                                    <th>Total Amount</th>
                                    <th>Order Date</th>
                                    <th>Delivery Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['order_id']; ?></td>
                                        <td><?php echo $row['user_name']; ?></td>
                                        <td><?php echo $row['food_items']; ?></td> <!-- Display food items -->
                                        <td>Rs <?php echo number_format($row['total_amount'], 2); ?></td>
                                        <td><?php echo $row['order_date']; ?></td>
                                        <td><?php echo $row['delivery_address']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td>
                                        <?php if ($row['status'] != 'Complete' && $row['status'] != 'Cancel') { ?>
    <div class="btn-group" role="group">
        <button class="btn btn-success btn-sm" onclick="completeOrder(<?php echo $row['order_id']; ?>)">Complete</button>
        <button class="btn btn-danger btn-sm ms-2" onclick="cancelOrder(<?php echo $row['order_id']; ?>)">Cancel</button>
    </div>
<?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer mt-auto">
            <div class="container">
                <div class="float-end d-none d-sm-block">
                    <b>Version</b> 1.0.0
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

    <script>
        function completeOrder(orderId) {
            if (confirm('Are you sure you want to complete this order?')) {
                $.ajax({
                    url: 'complete_order.php',
                    type: 'POST',
                    data: { order_id: orderId },
                    success: function(response) {
                        if (response == 'success') {
                            // Reload the page after successful completion
                            location.reload();
                        } else {
                            alert('Failed to complete order');
                        }
                    }
                });
            }
        }

        function cancelOrder(orderId) {
            if (confirm('Are you sure you want to cancel this order?')) {
                $.ajax({
                    url: 'cancel_order.php',
                    type: 'POST',
                    data: { order_id: orderId },
                    success: function(response) {
                        if (response == 'success') {
                            // Reload the page after successful cancellation
                            location.reload();
                        } else {
                            alert('Failed to cancel order');
                        }
                    }
                });
            }
        }
    </script>
</body>
</html>

