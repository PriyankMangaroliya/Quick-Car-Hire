<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reports</title>
    <?php
    include './headerLinks.php';
    include './sessionWithoutLogin.php';
    include './databaseConnection.php';
    ?>
    <style>
        #box {
            background-color: whitesmoke;
            text-align: center;
            width: 300px;
            border: 1px solid;
            padding: 20px;
            /*margin: 20px;*/
        }

        #box:hover {
            box-shadow: 0 0 11px red;
        }
    </style>
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
            <main>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div>
                                <h4 class="m-0 font-weight-bold text-primary">Reports</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="card-body">
                                <h3>Booking Reports</h3>
                                <div class="row">
                                    <div class="col">
                                        <a href="rTotalBookings.php">
                                            <div id="box">Total Bookings</div>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="rRentalHistoryReport.php">
                                            <div id="box">Car Wise Booking</div>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="rBookingStatus.php">
                                            <div id="box">Booking Status Report</div>
                                        </a>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col">
                                        <a href="rCancellationReport.php">
                                            <div id="box">Cancellation Report</div>
                                        </a>
                                    </div>
                                </div>
                                <br/><br/>


                                <h3>Car Reports</h3>
                                <div class="row">
                                    <div class="col">
                                        <a href="rTotalCars.php">
                                            <div id="box">Total Brand Wise Car</div>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="RevenueGeneratedCars.php">
                                            <div id="box">Top Revenue Generated Cars</div>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <!--                                                <div id="box"></div>-->
                                    </div>
                                </div>
                                <br/>

                                <h3>Payment Reports</h3>
                                <div class="row">
                                    <div class="col">
                                        <a href="RevenueGeneratedCities.php">
                                            <div id="box">Top Revenue Generated Cities</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<?PHP include './footerLinks.php'; ?>
</body>
</html>