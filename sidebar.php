<?php
require_once 'global.php';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <!-- <img src="logo.png" alt="Foodendra Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">Foodendra</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo $base; ?>/dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <?php if ($_SESSION['id'] == 1){ ?>
                    <!-- Display Users and Restaurants links for session ID 11 -->
                    <li class="nav-item">
                        <a href="<?php echo $base; ?>/users/restaurant.php" class="nav-link">
                            <i class="nav-icon fas fa-store-alt"></i>
                            <p>
                                Restaurant
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $base; ?>/users/users.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                <?php }else{ ?>
                    <!-- Show other links for session IDs other than 11 -->
                    <li class="nav-item">
                        <a href="<?php echo $base; ?>/food/Food.php" class="nav-link">
                            <i class="nav-icon fas fa-utensils"></i>
                            <p>
                                Food
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo $base; ?>/users/order.php" class="nav-link">
                            <i class="nav-icon fas fa-shopping-basket"></i>
                            <p>
                                Order
                            </p>
                        </a>
                    </li>
                <?php } ?>

                <!-- Always display the Logout link -->
                <li class="nav-item">
                    <a href="<?php echo $base?>/functions/logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Log Out
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
