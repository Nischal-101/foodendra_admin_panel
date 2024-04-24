<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Add the Font Awesome CDN link below -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Custom CSS for the dashboard */
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

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 0;
        }

        .card-body {
            padding: 30px;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .count-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .count-card-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Sidebar -->
        <?php include('sidebar.php'); ?>

        <!-- Header -->
        <?php include('header.php'); ?>

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
                        <div class="col-md-3">
                            <div class="card count-card">
                                <div class="card-body">
                                    <i class="fas fa-store count-card-icon"></i>
                                    <h3>Restaurant Count</h3>
                                    <p>5</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card count-card">
                                <div class="card-body">
                                    <i class="fas fa-utensils count-card-icon"></i>
                                    <h3>User Count</h3>
                                    <p>65</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Order Statistics</h3>
                                </div>
                                <div class="card-body">
                                    <p>Total Orders: 1000</p>
                                    <p>Pending Orders: 50</p>
                                    <p>Completed Orders: 950</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Revenue Summary</h3>
                                </div>
                                <div class="card-body">
                                    <p>Total Revenue: $50,000</p>
                                    <p>Revenue This Month: $10,000</p>
                                    <p>Revenue Last Month: $12,000</p>
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
                        <p>&copy; 2024 Foodendra. All Rights Reserved.</p>
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
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                data: [1000, 1500, 1200, 1800, 2000, 1700]
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