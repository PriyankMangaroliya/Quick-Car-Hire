<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard</title>

        <?php
        include './headerLinks.php';
        include './sessionWithoutLogin.php';
        include './databaseConnection.php';
        ?>
    </head>
    <body id="page-top">
        <div id="wrapper">
            <?php
            include './sidebar.php';
            ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <?php
                include './header.php';
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!--                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">-->
                        <!--                            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php
                                            $sql = "SELECT * FROM customer";
                                            $customer_result = mysqli_query($conn, $sql);
                                            $customer = mysqli_num_rows($customer_result);
                                            ?>
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Happy Customers
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $customer; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php
                                            $sql = "SELECT * FROM city";
                                            $city_result = mysqli_query($conn, $sql);
                                            $city = mysqli_num_rows($city_result);
                                            ?>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Cities</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $city; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-map-marked fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php
                                            $sql = "SELECT * FROM car";
                                            $result = $conn->query($sql);
                                            $Deactive = 0;
                                            $active = 0;
                                            $count = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                                $count++;
                                                $curr_status = $row['Status'];
                                                if ($curr_status == 'Deactive') {
                                                    $Deactive++;
                                                } else {
                                                    $active++;
                                                }
                                            }
                                            ?>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Cars</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-car fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <?php
                                            $booking = "SELECT * FROM booking";
                                            $booking1 = $conn->query($booking);
                                            $counto = 0;
                                            $Current = 0;
                                            $Completed = 0;
                                            $Pending = 0;
                                            while ($row1 = mysqli_fetch_array($booking1)) {
                                                $counto++;
                                                $Status = $row1['Status'];
                                                if ($Status == 'Current') {
                                                    $Current++;
                                                } elseif ($Status == 'Completed') {
                                                    $Completed++;
                                                } elseif ($Status == 'Pending') {
                                                    $Pending++;
                                                }
                                            }
                                            ?>
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Bookings</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $counto; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-car fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--                         Earnings (Monthly) Card Example-->
                    <!--                        <div class="col-xl-3 col-md-6 mb-4">-->
                    <!--                            <div class="card border-left-info shadow h-100 py-2">-->
                    <!--                                <div class="card-body">-->
                    <!--                                    <div class="row no-gutters align-items-center">-->
                    <!--                                        <div class="col mr-2">-->
                    <!--                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks-->
                    <!--                                            </div>-->
                    <!--                                            <div class="row no-gutters align-items-center">-->
                    <!--                                                <div class="col-auto">-->
                    <!--                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>-->
                    <!--                                                </div>-->
                    <!--                                                <div class="col">-->
                    <!--                                                    <div class="progress progress-sm mr-2">-->
                    <!--                                                        <div class="progress-bar bg-info" role="progressbar"-->
                    <!--                                                             style="width: 50%" aria-valuenow="50" aria-valuemin="0"-->
                    <!--                                                             aria-valuemax="100"></div>-->
                    <!--                                                    </div>-->
                    <!--                                                </div>-->
                    <!--                                            </div>-->
                    <!--                                        </div>-->
                    <!--                                        <div class="col-auto">-->
                    <!--                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>-->
                    <!--                                        </div>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!---->
                    <!--                         Pending Requests Card Example-->
                    <!--                        <div class="col-xl-3 col-md-6 mb-4">-->
                    <!--                            <div class="card border-left-warning shadow h-100 py-2">-->
                    <!--                                <div class="card-body">-->
                    <!--                                    <div class="row no-gutters align-items-center">-->
                    <!--                                        <div class="col mr-2">-->
                    <!--                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">-->
                    <!--                                                Pending Requests</div>-->
                    <!--                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>-->
                    <!--                                        </div>-->
                    <!--                                        <div class="col-auto">-->
                    <!--                                            <i class="fas fa-comments fa-2x text-gray-300"></i>-->
                    <!--                                        </div>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                             aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Select Year:</div>
                                            <!--                                            <a class="dropdown-item" href="#" data-year="2021">2021</a>-->
                                            <!--                                            <a class="dropdown-item" href="#" data-year="2022">2022</a>-->
                                            <a class="dropdown-item" href="#" data-year="2023">2023</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Booking Status</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                             aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="booking.php">View Booking</a>
                                            <!--                                            <a class="dropdown-item" href="#">Another action</a>-->
                                            <!--                                            <div class="dropdown-divider"></div>-->
                                            <!--                                            <a class="dropdown-item" href="#">Something else here</a>-->
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Pending
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Current
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Completed
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>