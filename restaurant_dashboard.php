<!DOCTYPE html>
<html>

<head>
    <title>Restaurant Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            flex: 1;
        }

        .count-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .count-card .card-header {
            border-radius: 10px 10px 0 0;
            background-color: #28a745;
            color: #fff;
        }

        .count-card .count-item {
            text-align: center;
            padding: 20px;
        }

        .count-card .count-card-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .count-card .count-label {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .count-card .count-value {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include('sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content py-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Sales Data</h3>
                                </div>
                                <div class="card-body">
                                    <canvas id="salesChart" style="height: 300px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card count-card">
                                <div class="card-header">
                                    <h3 class="card-title text-white">Order & Customer Count</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="count-item">
                                                <i class="fas fa-store count-card-icon"></i>
                                                <p class="count-label">Order Count</p>
                                                <p class="count-value">32</p>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="count-item">
                                                <i class="fas fa-users count-card-icon"></i>
                                                <p class="count-label">Customer Count</p>
                                                <p class="count-value">18</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Order Statistics</h3>
                                </div>
                                <div class="card-body">
                                    <p>Total Orders: 32</p>
                                    <p>Pending Orders: 20</p>
                                    <p>Completed Orders: 12</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue Summary</h3>
                                </div>
                                <div class="card-body">
                                    <p>Total Revenue: Rs 19,500</p>
                                    <p>Revenue This Month: Rs 6,000</p>
                                    <p>Revenue Last Month: Rs 5,500</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Main Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>&copy; 2024 . All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

    <script>
        // Sample data for the sales chart
        var salesData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Sales',
                backgroundColor: 'rgba(40, 167, 69, 0.2)',
                borderColor: 'rgba(40, 167, 69, 1)',
                borderWidth: 1,
                data: [500, 600, 700, 800, 900, 1000]
            }]
        };

        // Configuration for the sales chart
        var salesConfig = {
            type: 'bar',
            data: salesData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        };

        // Initialize the sales chart
        var salesChart = new Chart(document.getElementById('salesChart'), salesConfig);
    </script>
</body>

</html>
