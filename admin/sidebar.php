<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark
    accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="../images/iconbg.png" alt="Quick Car Hire" width="100px" height="100px">
<!--            <i class="fas fa-car"></i>-->
        </div>
        <div class="sidebar-brand-text mx-1"></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <?php
    include './databaseConnection.php';

    $role = $_SESSION['role_id'];
    $sql = "SELECT * FROM role_menu WHERE Role_Id = $role ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row["A_Dashboard"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php
        }

        if ($row["M_Dashboard"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="mDashborad.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <?php
        }

        if ($row["Admin"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa fa-regular fa-user"></i>
                    <span>Admin</span></a>
            </li>
            <?php
        }

        if ($row["Employee"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="employee.php">
                    <i class="fas fa-fw fa fa-solid fa-users"></i>
                    <span>Employee</span></a>
            </li>
            <?php
        }

        if ($row["Customer"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="customer.php">
                    <i class="fas fa-fw fa fa-solid fa-users"></i>
                    <span>Customer</span></a>
            </li>
            <?php
        }
        if ($row["Booking"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="booking.php">
                    <i class="fas fa-fw fa fa-solid fa-car"></i>
                    <span>Booking</span></a>
            </li>
            <?php
        }
        if ($row["Payment"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="payment.php">
                    <i class="fas fa-fw fa fa-solid fa-money-bill-alt"></i>
                    <span>Payment</span></a>
            </li>
            <?php
        }
        if ($row["Cancel"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="cancelBooking.php">
                    <i class="fas fa-fw fa fa-solid fa-car-alt"></i>
                    <span>Cancel Booking</span></a>
            </li>
            <?php
        }
        if ($row["City"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="city.php">
                    <i class="fas fa-fw fa fa-regular fa-map-marker-alt"></i>
                    <span>City</span></a>
            </li>
            <?php
        }
        if ($row["Car"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="car.php">
                    <i class="fas fa-fw fa fa-solid fa-car"></i>
                    <span>Car</span></a>
            </li>
            <?php
        }
        if ($row["Category"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="carCategory.php">
                    <i class="fas fa-fw fa fa-solid fa-car"></i>
                    <span>Car Category</span></a>
            </li>
            <?php
        }
        if ($row["Offer"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="offer.php">
                    <i class="fas fa-fw fa fa-solid fa-percentage"></i>
                    <span>Offers</span></a>
            </li>
            <?php
        }

        if ($row["Contact"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="contact.php">
                    <i class="fas fa-fw fa fa-regular fa-comments"></i>
                    <span>Contact</span></a>
            </li>
            <?php
        }

        if ($row["Feedback"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="feedback.php">
                    <i class="fas fa-fw fa fa-regular fa-comment-alt"></i>
                    <span>Feedback</span></a>
            </li>
            <?php
        }

        if ($row["Report"]) {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="reports.php">
                    <i class="fas fa-fw fa fa-solid fa-book"></i>
                    <span>Reports</span></a>
            </li>
            <?php
        }
    } else {
        echo "No menu items.";
    }
    ?>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
