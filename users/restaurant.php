<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

require_once('../database/db.php');

// Retrieve the filter values
$name = $_GET['name'] ?? '';
// $email = $_GET['email'] ?? '';
// $type = $_GET['type'] ?? '';

// Prepare the WHERE clause for the SQL query based on the filter values
$whereClause = '';
if (!empty($name)) {
    $whereClause .= "AND name LIKE '%$name%'";
}
// if (!empty($email)) {
//     $whereClause .= "AND email LIKE '%$email%'";
// }
// if (!empty($type)) {
//     $whereClause .= "AND type = '$type'";
// }

// Pagination configuration
$recordsPerPage = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Retrieve the total number of records
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM restaurant WHERE 1 $whereClause";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

// Calculate the total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Retrieve the filtered list of users from the database with pagination
$sql = "SELECT * FROM restaurant WHERE 1 $whereClause LIMIT $offset, $recordsPerPage";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Add the Font Awesome CDN link below -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
        .table-container {
    max-width: 1200px;
    margin: 0 auto;
}

.custom-table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
}

.custom-table th, .custom-table td {
    padding: 15px;
    text-align: left;
}

.custom-table th {
    background-color: #f8f9fa;
    font-weight: bold;
    color: #333;
    border-bottom: 2px solid #dee2e6;
}

.custom-table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.custom-table tbody tr:hover {
    background-color: #e2e6ea;
}

.action-buttons {
    display: flex;
    gap: 5px;
}

.edit-button, .delete-button {
    padding: 8px 16px;
    text-decoration: none;
    color: #fff;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.edit-button {
    background-color: #007bff;
}

.delete-button {
    background-color: #dc3545;
}

.edit-button:hover, .delete-button:hover {
    background-color: #0056b3;
}


.action-buttons a {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
}

.action-buttons a i {
    margin-right: 5px; /* Add some space between the icon and text */
}


        
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Sidebar -->
        <?php include('../sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content py-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="add_restaurant.php" class="btn btn-success">Add New Restaurant</a>
                                </div>
                                <div class="card-body">
                                    <form class="mb-3" method="GET">
                                        <div class="row align-items-end">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="<?php echo $name; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="table-container">
    <table class="custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['restaurant_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td>
                    <div class="action-buttons">
    <a href="edit_restaurant.php?id=<?php echo $row['restaurant_id']; ?>" class="edit-button"><i class="fas fa-edit"></i><span>Edit</span></a>
    <a href="#" onclick="confirmDelete(<?php echo $row['restaurant_id']; ?>)" class="delete-button"><i class="fas fa-trash"></i><span>Delete</span></a>
</div>


                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>



                                    <!-- Pagination -->
                                    <nav aria-label="Pagination">
                                        <ul class="pagination justify-content-center">
                                            <?php if ($page > 1) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>"
                                                        aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                </li>
                                            <?php } ?>

                                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                                    <a class="page-link" href="?page=<?php echo $i; ?>">
                                                        <?php echo $i; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>

                                            <?php if ($page < $totalPages) { ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>"
                                                        aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
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
    <script>
function confirmDelete(restaurantId) {
    if (confirm("Are you sure you want to delete this restaurant?")) {
        // If user confirms, redirect to delete_restaurant.php with restaurant_id
        window.location.href = "delete_restaurant.php?id=" + restaurantId;
    } else {
        // If user cancels, do nothing
        return false;
    }
}
</script>
</body>

</html>
