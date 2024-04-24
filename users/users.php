<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

require_once('../database/db.php');

// Retrieve the filter values
$user_id = $_GET['user_id'] ?? '';

// Prepare the WHERE clause for the SQL query based on the filter value
$whereClause = '';
if (!empty($user_id)) {
    $whereClause = "WHERE user_id = $user_id";
}

// Retrieve user data from the database
$sql = "SELECT * FROM user $whereClause";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
<title>User details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Add the Font Awesome CDN link below -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .table tbody tr:hover {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
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
        <div class="container">
            <h2>User Data</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <!-- <th>Password</th> -->
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Type</th>
                        <!-- <th>Action</th>  -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <!-- <td><?php echo $row['password']; ?></td> -->
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['phone_number']; ?></td>
                            <td><?php echo $row['type']; ?></td>
                            <td>
                                <!-- <a href="edit_user.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a> -->
                            </td> <!-- Action button to edit user details -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
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

