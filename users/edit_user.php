<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

require_once('../database/db.php');

// Check if user_id is set in the URL
if (isset($_GET['user_id'])) {
    // Sanitize the user_id
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

    // Retrieve user data based on user_id
    $sql = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        // If no user found with the specified user_id, redirect back to user list
        header("Location: users.php");
        exit();
    }
} else {
    // If user_id is not set in the URL, redirect back to user list
    header("Location: users.php");
    exit();
}

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $type = $_POST['type'];

    // Update user data in the database
    $update_sql = "UPDATE user SET username = '$username', email = '$email', address = '$address', phone_number = '$phone_number', type = '$type' WHERE user_id = '$user_id'";
    if ($conn->query($update_sql) === TRUE) {
        // If update successful, redirect back to user list
        header("Location: users.php");
        exit();
    } else {
        // If update failed, display an error message
        echo "Error updating user: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>
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
<section class="content py-3">
<div class="container">
    <h2>Edit User</h2>
    <form method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $user['phone_number']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" id="type" name="type" required>
                <option value="user" <?php if($user['type'] == 'user') echo 'selected'; ?>>User</option>
                <option value="admin" <?php if($user['type'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="restaurant" <?php if($user['type'] == 'restaurant') echo 'selected'; ?>>Restaurant</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
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
