<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit();
}

require_once('../database/db.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the restaurant details from the form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $res_phone_number = $_POST['phone_number'];
    echo $res_phone_number;

    // Insert the new restaurant into the database
    $sql = "INSERT INTO restaurant (name, description, address, phone_number) VALUES ('$name', '$description', '$address', '$res_phone_number')";
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
                                    <a href="add_restaurant.php" class="btn btn-success">Add New</a>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label for="name">Restaurant Name</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Add Restaurant</button>
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
   
