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
        $city_id = $_SESSION['city_id'];
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
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
                                    $sql = "SELECT * FROM car where City_Id= '$city_id'";
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
                                        Total Cars
                                    </div>
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
                                    $booking = "SELECT * FROM booking where City_Id= '$city_id'";
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
                                        Total Bookings
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $counto; ?></div>
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
                                    $sql = "SELECT * FROM offer where City_Id= '$city_id'";
                                    $city_result = mysqli_query($conn, $sql);
                                    $city = mysqli_num_rows($city_result);
                                    ?>
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Offers
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $city; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-percentage fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br/>

            <div class="row">
                <div class="col-sm-5">
                    <script>
                        $(document).ready(function () {
                            $('[data-toggle="tooltip"]').tooltip({
                                html: true // Enable HTML content in the tooltip
                            });
                        });
                    </script>
                    <h3 style="text-align: center">Pick up Cars Today</h3>
                    <br/>
                    <table class="table table-bordered" style="background-color: white">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Booking Id</th>
                            <th scope="col">Car Number</th>
                            <th scope="col">Start Meter</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $date = date('Y-m-d');
                        $sql = "SELECT booking.*, car.Name AS CarName, car.Brand AS CarBrand, car.Image AS CarImage
                            FROM booking JOIN car ON booking.Registration_No = car.Registration_No WHERE booking.Start_Date = '$date'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $total = 0;
                            $i = 0;
                            $b_id = $row["Booking_Id"];
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td>
                                                    <span data-toggle="tooltip" data-placement="top"
                                                          title="<strong>Email : </strong><?= $row["Email"] ?>">
                                                              <?= $row["Booking_Id"] ?>
                                                    </span>
                                    </td>
                                    <td>
                                                    <span data-toggle="tooltip" data-placement="top"
                                                          title="<strong>Name : </strong><?= $row['CarName'] ?><br>
                                                          <strong>Brand : </strong> <?= $row['CarBrand'] ?>">
                                                              <?= $row["Registration_No"] ?>
                                                    </span>
                                    </td>
                                    <td>
                                        <?php
                                        $sql5 = $conn->prepare("SELECT Start_Meter , End_Meter FROM penalty where Booking_Id = ?;");
                                        $sql5->bind_param("s", $row["Booking_Id"]);
                                        $sql5->execute();
                                        $book = $sql5->get_result()->fetch_all(MYSQLI_ASSOC);
                                        if (count($book) > 0) {
                                            foreach ($book as $row) {
                                                echo $row['Start_Meter'];
//                                                echo $row['End_Meter'];
                                            }
                                        } else {
                                            ?>
                                            <a href="" data-toggle="modal" data-target="#exampleModal1"
                                               onclick="sendData(<?= $row["Booking_Id"] ?>)">Enter Start Meter</a>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td style="text-align: center" colspan="4">No Pickup Car Today</td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>

                        <!--  Modal Start Meter-->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pickup Car</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <script>
                                                function sendData(data) {
                                                    var inputField = document.getElementById('bookingid1');
                                                    inputField.value = data;

                                                    var inputField = document.getElementById('bookingid');
                                                    inputField.value = data;
                                                }
                                            </script>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Booking Id :</label>
                                                <input type="hidden" id="bookingid1" name="bookingid1">
                                                <input type="text" class="form-control" id="bookingid" name="bookingid"
                                                       value="" disabled="disabled">
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Start Meter:</label>
                                                <input type="text" class="form-control" id="startmeter"
                                                       name="startmeter">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <input type="submit" class="btn btn-primary" value="Submit" name="submit"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php
                        if (isset($_POST['submit'])) {
                            $booking_id = $_POST['bookingid1'];
                            $start_meter = $_POST['startmeter'];
                            $end_meter = 0;

                            $sql1 = $conn->prepare("INSERT INTO penalty(Booking_Id,Start_Meter,End_Meter) VALUES (?, ?, ?);");
                            $sql1->bind_param("sss", $booking_id, $start_meter, $end_meter);
                            $sql11 = $sql1->execute();

                            if ($sql11 > 0) {
                                echo "<script>window.location.href='./mDashborad.php'</script>";
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>Not Submit</div>";
                            }
                        }
                        ?>

                    </table>
                </div>


                <div class="col-sm-7">
                    <h3 style="text-align: center">Drop off Cars Today</h3><br/>
                    <table class="table table-bordered" style="background-color: white">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Booking Id</th>
                            <th scope="col">Car Number</th>
                            <th scope="col">End Meter</th>
                            <th scope="col">Kms</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Refund</th>
<!--                            <th scope="col">Payment Status</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $date = date('Y-m-d');
                        $sql = "SELECT booking.*, car.Name AS CarName, car.Brand AS CarBrand, car.Image AS CarImage
                        FROM booking
                        JOIN car ON booking.Registration_No = car.Registration_No
                        WHERE booking.End_Date = '$date'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $total = 0;
                            $i = 0;
                            while ($row = $result->fetch_assoc()) {
                                $i++;
                                ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td>
                                                    <span data-toggle="tooltip" data-placement="top"
                                                          title="<strong>Email : </strong><?= $row["Email"] ?>">
                                                              <?= $row["Booking_Id"] ?>
                                                    </span>
                                    </td>
                                    <td>
                                                    <span data-toggle="tooltip" data-placement="top"
                                                          title="<strong>Name : </strong><?= $row['CarName'] ?><br>
                                                          <strong>Brand : </strong> <?= $row['CarBrand'] ?>">
                                                              <?= $row["Registration_No"] ?>
                                                    </span>
                                    </td>


                                    <td>
                                        <?php
                                        $sql5 = $conn->prepare("SELECT End_Meter FROM penalty where Booking_Id = ?;");
                                        $sql5->bind_param("s", $row["Booking_Id"]);
                                        $sql5->execute();
                                        $book = $sql5->get_result()->fetch_all(MYSQLI_ASSOC);
                                        if (count($book) > 0) {
                                            foreach ($book as $row123) {
                                                if ($row123['End_Meter'] == 0) {
                                                    echo $row123["Booking_Id"];
                                                    ?>

                                                    <a href="" data-toggle="modal" data-target="#exampleModal2"
                                                       onclick="sendData2(<?= $row["Booking_Id"] ?>)">Enter End
                                                        Meter</a>
                                                    <?php
                                                } else {
                                                    echo $row123['End_Meter'];
                                                }
                                            }
                                        } else {
                                            echo "Not Entered Start Meter";
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    if (isset($_POST['submit1'])) {
                                        $booking_id = $_POST['bookingid2'];
                                        $end_meter = $_POST['endmeter'];

                                        $sql = $conn->prepare("SELECT p.Start_Meter AS Start_Meter, 
                                  b.Selected_Kms AS Selected_Kms, 
                                  b.Security_Deposit AS Security_Deposit, 
                                  c.Registration_No AS Registration_No, 
                                  c.Charge_Cost AS Charge_Cost
                            FROM penalty p
                            INNER JOIN booking b ON p.Booking_Id = b.Booking_Id
                            INNER JOIN car c ON b.Registration_No = c.Registration_No
                            WHERE p.Booking_Id = ?;");
                                        $sql->bind_param("s", $booking_id);
                                        $sql->execute();
                                        $result = $sql->get_result()->fetch_assoc();

                                        if ($result) {
                                            $StartMeter = $result['Start_Meter'];
                                            $SelectedKMs = $result['Selected_Kms'];
                                            $secutiry = $result['Security_Deposit'];
                                            $car = $result['Registration_No'];
                                            $charge = $result['Charge_Cost'];

                                            $km0 = $end_meter - $StartMeter;
                                            $km00 = $km0 / 1000;
                                            $km = round($km00);
                                            $diffkms = $SelectedKMs - $km;

                                            if ($diffkms < 0) {
                                                $charge_amount = $charge * $diffkms;
                                            } else {
                                                $charge_amount = 0;
                                            }
                                            $refund = $secutiry - $charge_amount;
                                            $status = "Completed";

//                                            echo "<td>$diffkms</td><td>$charge_amount</td><td>$refund</td>";

                                            $sql_update = $conn->prepare("UPDATE penalty 
                                      SET End_Meter=?, D_Kms=?, Charge_Amount=?, Refund_Amount=?, Payment_Status=? 
                                      WHERE Booking_Id = ?;");
                                            $sql_update->bind_param("ssssss", $end_meter, $diffkms, $charge_amount, $refund, $status, $booking_id);
                                            $sql_update->execute();

                                            if ($sql_update->affected_rows > 0) {
                                                echo "<script>window.location.href='./mDashborad.php'</script>";
                                            } else {
                                                echo "<div class='alert alert-danger' role='alert'>No Data Update.</div>";
                                            }
                                        } else {
                                            echo '<script>alert("Not Enter Start Meter.")</script>';
                                        }
                                    }
                                    ?>

                                    <?php
                                    $sql51 = $conn->prepare("SELECT * FROM penalty where Booking_Id = ?;");
                                    $sql51->bind_param("s", $row["Booking_Id"]);
                                    $sql51->execute();
                                    $book1 = $sql51->get_result()->fetch_all(MYSQLI_ASSOC);
                                    if (count($book1) > 0) {
                                        foreach ($book1 as $row12345) {
                                            $dkm = $row12345['D_Kms'];
                                            $dca = $row12345['Charge_Amount'];
                                            $dra = $row12345['Refund_Amount'];

                                            echo "<td>$dkm</td>";
                                            echo "<td>$dca</td>";
                                            echo "<td>$dra</td>";
                                        }
                                    } else {
                                        echo "Not Data Available.";
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td style="text-align: center" colspan="4">No Drop off Car Today</td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>


                    <!--  Modal End Meter-->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <form method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Drop off Car</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <script>
                                            function sendData2(data1) {
                                                var inputField = document.getElementById('bookingid2');
                                                inputField.value = data1;

                                                var inputField = document.getElementById('bookingid3');
                                                inputField.value = data1;
                                            }
                                        </script>

                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Booking Id :</label>
                                            <input type="hidden" id="bookingid2" name="bookingid2">
                                            <input type="text" class="form-control" id="bookingid3" name="bookingid3"
                                                   value="" disabled="disabled">
                                        </div>

                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">End Meter:</label>
                                            <input type="text" class="form-control" id="endmeter" name="endmeter">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Submit" name="submit1"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<?PHP include './footerLinks.php'; ?>
</body>
</html>