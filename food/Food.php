<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

require_once('../database/db.php');

// Retrieve the filter values
$food_name = $_GET['name'] ?? '';
$food_category = $_GET['category'] ?? '';

// Prepare the WHERE clause for the SQL query based on the filter values
$whereClause = '';
if (!empty($food_name)) {
    $whereClause .= "AND m.name LIKE '%$food_name%'"; // Specify the table alias for the name column
}
if (!empty($food_category)) {
    $whereClause .= "AND m.category LIKE '%$food_category%'"; // Specify the table alias for the category column
}

// Pagination configuration
$recordsPerPage = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Retrieve the total number of records
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM menuitem m WHERE 1 $whereClause";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

// Calculate the total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Retrieve the filtered list of food items from the database with pagination
$sql = "SELECT m.item_id, m.restaurant_id, r.name AS restaurant_name, m.name, m.description, m.price, m.category
        FROM menuitem m
        JOIN restaurant r ON m.restaurant_id = r.restaurant_id
        WHERE 1 $whereClause
        LIMIT $offset, $recordsPerPage";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .content-wrapper {
            padding: 20px;
        }

        .btn-light {
            background-color: #f8f9fa;
            color: #000;
            border: 1px solid #ced4da;
        }

        .btn-light:hover {
            background-color: #e2e6ea;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
        }

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .btn-container {
            display: flex;
            align-items: center;
        }

        .btn-container .btn {
            margin-right: 5px;
        }

        /* Adjustments for search bar */
        .search-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .search-container .form-control {
            margin-right: 10px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Sidebar -->
        <?php include('../sidebar.php'); ?>

        <!-- Header -->
        <!-- <?php include('../header.php'); ?> -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content py-3">
                <div class="container-fluid">
                    <h3 class="mb-3">Manage Food Items</h3>
                    <div class="search-container">
                        <form method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" placeholder="Search by name" value="<?php echo $food_name; ?>">
                                <input type="text" class="form-control" name="category" placeholder="Search by category" value="<?php echo $food_category; ?>">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                        <a href="add_food.php" class="btn btn-light">
                            <i class="fas fa-plus"></i> Add New Food
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <!-- <th>ID</th> -->
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <!-- <td><?php echo $row['item_id']; ?></td> -->
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['description']; ?></td>
                                        <td>Rs <?php echo number_format($row['price'], 2); ?></td>
                                        <td><?php echo $row['category']; ?></td>
                                        <td>
                                            <div class="btn-container">
                                                <a href="edit_food.php?id=<?php echo $row['item_id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                                <!-- <a href="delete_food.php?id=<?php echo $row['item_id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a> -->
                                                <a href="#" class="btn btn-danger delete-food" data-id="<?php echo $row['item_id']; ?>"><i class="fas fa-trash"></i> Delete</a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Pagination">
                        <ul class="pagination">
                            <?php if ($page > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>&name=<?php echo $food_name; ?>&category=<?php echo $food_category; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>&name=<?php echo $food_name; ?>&category=<?php echo $food_category; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $totalPages) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>&name=<?php echo $food_name; ?>&category=<?php echo $food_category; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
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
    $(document).ready(function() {
        $('.delete-food').click(function(e) {
            e.preventDefault();
            var itemId = $(this).data('id');
            var confirmation = confirm("Are you sure you want to delete this food item?");
            if (confirmation) {
                // Proceed with deletion
                window.location.href = 'delete_food.php?id=' + itemId;
            }
        });
    });
</script>
</body>

</html>



