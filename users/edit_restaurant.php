<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

require_once('../database/db.php');

// Check if the user ID is provided
if (!isset($_GET['id'])) {
    header("Location: ../dashboard.php");
    exit();
}

// Retrieve the user ID from the query parameter
$id = $_GET['id'];

// Retrieve the user details from the database
$sql = "SELECT * FROM restaurant WHERE restaurant_id = '$id'";
$result = $conn->query($sql);
$restaurant = $result->fetch_assoc();

// Check if the user exists
if (!$restaurant) {
    header("Location: ../dashboard.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated user details from the form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    // Update the user record in the database
    $sql = "UPDATE restaurant SET name = '$name', description = '$description', address = '$address', phone_number = '$phone_number' WHERE restaurant_id = '$id'";
    $conn->query($sql);

    // Redirect to the dashboard page
    header("Location: restaurant.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Add the Font Awesome CDN link below -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Sidebar -->
        <?php include('../sidebar.php'); ?>

        <!-- Header -->
        <?php include('../header.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content py-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="add.php" class="btn btn-success">Add New</a>
                                </div>
                                <div class="card-body">

                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="<?php echo $restaurant['name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Description</label>
                                            <input type="text" class="form-control" id="description" name="description"
                                                value="<?php echo $restaurant['description']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="<?php echo $restaurant['address']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                                value="<?php echo $restaurant['phone_number']; ?>" required>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
</body>

</html>