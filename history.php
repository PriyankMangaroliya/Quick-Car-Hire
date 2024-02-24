<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QuickCarHire | Booking History</title>
        <?php
        include "./headLink.php";
        include "./databaseConnection.php";
        include "./header.php";
        include "./sessionwithoutlogin.php";
        ?>
        <!--        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .alert {
                padding: 15px;
                border: 1px solid transparent;
                border-radius: 4px;
            }

            .alert-success {
                background-color: #d4edda;
                color: #155724;
                border-color: #c3e6cb;
            }

            /* Button used to open the contact form - fixed at the bottom of the page */
            /*.open-button {*/
            /*    background-color: #555;*/
            /*    color: white;*/
            /*    padding: 16px 20px;*/
            /*    border: none;*/
            /*    cursor: pointer;*/
            /*    opacity: 0.8;*/
            /*    position: fixed;*/
            /*    bottom: 23px;*/
            /*    right: 28px;*/
            /*    width: 280px;*/
            /*}*/

            /* The popup form - hidden by default */
            .form-popup {
                display: none;
                position: fixed;
                /*bottom: 0;*/
                /*right: 0;*/
                left: 35%;
                top: 25%;
                /*border: 3px solid #f1f1f1;*/
                z-index: 9;
            }

            /* Add styles to the form container */
            .form-container {
                max-width: 50%;
                padding: 20px;
                background-color: whitesmoke;
            }

            /* Full-width input fields */
            .form-container input[type=text], .form-container input[type=password] {
                width: 100%;
                padding: 15px;
                margin: 5px 0 22px 0;
                border: none;
                background: #f1f1f1;
            }

            /* When the inputs get focus, do something */
            .form-container input[type=text]:focus, .form-container input[type=password]:focus {
                background-color: #ddd;
                outline: none;
            }

            /* Set a style for the submit/login button */
            .form-container .btn {
                background-color: #04AA6D;
                color: white;
                padding: 16px 20px;
                border: none;
                cursor: pointer;
                width: 100%;
                margin-bottom: 10px;
                opacity: 0.8;
            }

            /* Add a red background color to the cancel button */
            .form-container .cancel {
                background-color: red;
            }

            /* Add some hover effects to buttons */
            .form-container .btn:hover, .open-button:hover {
                opacity: 1;
            }
        </style>
    </head>
    <body>
        <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bgimg/car-10.jpg');background-position: center;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                    <div class="col-md-9 ftco-animate pb-5">
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home
                                    <i class="ion-ios-arrow-forward"></i></a></span> <span>My Booking<i
                                    class="ion-ios-arrow-forward"></i></span></p>
                        <h1 class="mb-3 bread">My Booking</h1>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container" style="max-width: 1300px;margin-top: 2rem;margin-bottom: 2rem;text-align: center;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">R. No/Name</th>
<!--                            <th scope="col">Name</th>-->
                            <th scope="col">Image</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Address</th>
<!--                            <th scope="col">Offer Amount</th>-->
                            <th scope="col">Total Amount</th>
                            <th scope="col">Download Invoice</th>
                            <th scope="col">Booking Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $CustomerEmail = $_SESSION['Email'];
                        $currentDate = date('Y-m-d');
                        $sql1 = $conn->prepare("SELECT * FROM booking WHERE Email = ? ORDER BY Start_Date DESC");
                        $sql1->bind_param("s", $CustomerEmail);
                        $sql1->execute();
                        $history = $sql1->get_result()->fetch_all(MYSQLI_ASSOC);

                        if (count($history) > 0) {
                            $i = 0;
                            foreach ($history as $row) {
                                $booking_id = $row['Booking_Id'];
                                $car = $row['Registration_No'];
                                $sql = $conn->prepare("SELECT * FROM car WHERE Registration_No = ?");
                                $sql->bind_param("s", $car);
                                $sql->execute();
                                $carimg = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
                                foreach ($carimg as $row1) {
                                    $name = $row1['Name'];
                                    $img = $row1['Image'];
                                }
                                $i++;
                                ?>
                                <tr id='tr_<?= $i; ?>'>
                                    <td><b><?= $i; ?></b></td>
                                    <td><?= $row['Registration_No']; ?><br/>
                                        <?= $name; ?><br/>
                                    </td>
                                    <td>
                                        <img src="images/carimg/<?= $img; ?>" width="100px" height="100px" alt="hy">
                                    </td>
                                    <td><?= date("d-m-Y", strtotime($row['Start_Date'])); ?></td>
                                    <td><?= date("d-m-Y", strtotime($row['End_Date'])); ?></td>
                                    <td width="300">
                                        <?php
                                        $sql2 = $conn->prepare("SELECT Address FROM city JOIN booking ON city.City_Id = booking.City_Id WHERE booking.Booking_Id = ?");
                                        $sql2->bind_param("s", $row['Booking_Id']);
                                        $sql2->execute();
                                        $address = $sql2->get_result()->fetch_assoc()['Address'];
                                        echo $address;
                                        ?>
                                    </td>
        <!--                                    <td><b>--><?php //= $row['Offer'];         ?><!--</b></td>-->
                                    <td><b><?= $row['Total_Amount']; ?></b></td>
                                    <td><a class="btn btn-info" href="generate_invoice.php?Bid=<?= base64_encode($booking_id); ?>" onclick="window.open('generate_invoice.php?Bid='.<?= base64_encode($booking_id); ?>" ,'_blank'); return false;">Download<br/>Invoice</a></td>
                                    <?php
                                    if (strtotime(date('Y-m-d')) < strtotime($row['Start_Date'])) {

                                        $sql51 = $conn->prepare("SELECT * FROM cancel_booking where Booking_Id = ?;");
                                        $sql51->bind_param("s", $booking_id);
                                        $sql51->execute();
                                        $cancel = $sql51->get_result()->fetch_all(MYSQLI_ASSOC);
                                        if (count($cancel) > 0) {
                                            foreach ($cancel as $row) {
                                                echo '<td>This booking<br/>you Canceled.<br/>Status : ' . $row['Cancellation_Status'] . '</td>';
                                            }
                                        } else {
                                            ?>
                                            <td>
<!--                                                <form id="bookingForm" method="post">-->
<!--                                                    <input type="hidden" name="booking_id" value="--><?php //echo $booking_id; ?><!--">-->
                                                    <a href="cancelBooking.php?Bid=<?= base64_encode($booking_id); ?>" class="btn btn-primary" onclick="return confirm('Do you really want to Cancel Booking.')">Cancel<br/>Booking</a>
<!--                                                </form>-->
                                            </td>
                                            <?php
                                        }
                                    } else if (strtotime(date('Y-m-d')) > strtotime($row['End_Date'])) {
                                        $sql5 = $conn->prepare("SELECT Ratting FROM feedback where Booking_Id = ?;");
                                        $sql5->bind_param("s", $booking_id);
                                        $sql5->execute();
                                        $feedback = $sql5->get_result()->fetch_all(MYSQLI_ASSOC);
                                        if (count($feedback) > 0) {
                                            foreach ($feedback as $row) {
                                                echo "<td>";
                                                echo $row['Ratting'];
                                                echo " Star</td>";
                                            }
                                        } else {
                                            ?>

                                            <td><a class="btn btn-success" href="feedback.php?id=<?= base64_encode($booking_id); ?>">Give<br/>Feedback</a>
                                            </td>

                                            <?php
                                        }
                                    } else {
                                        echo '<td>Current<br/>Booking</td>';
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<div class="alert alert-success" role="alert" style="margin-top:1rem; ">No Any Bookings</div>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <script>
                                // document.getElementById('cancelLink').addEventListener('click', function (event) {
                                //     event.preventDefault(); // Prevent the default link behavior
                                //
                                //     // Show an alert box
                                //     var confirmation = confirm('Are you sure you want to cancel the booking?');
                                //
                                //     // If user clicks OK, submit the form
                                //     if (confirmation) {
                                //         document.getElementById('bookingForm').submit();
                                //     } else {
                                //         // If user clicks Cancel, close the alert box
                                //         // (Optional: No action needed in this case)
                                //     }
                                // });
        </script>
        <?php
        include 'footerLink.php';
        ?>
    </body>
</html>