<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QuickCarHire | Book</title>
        <style>
            input[type="text"],
            select.form-control {
                background: transparent;
                border: none;
                border-bottom: 1px solid #000000;
                -webkit-box-shadow: none;
                box-shadow: none;
                border-radius: 0;
            }

            input[type="text"]:focus,
            select.form-control:focus {
                -webkit-box-shadow: none;
                box-shadow: none;
            }

            /*offer button*/
            .float-child {
                float: left;
            }
        </style>
        <?php
        include "./headLink.php";
        include "./databaseConnection.php";
        include "./header.php";
        include "./sessionwithoutlogin.php";
        ?>
    </head>
    <body>
        <?php
        $id = base64_decode(strval($_GET['id']));
        $price = base64_decode(strval($_GET['P']));
        $city = base64_decode(strval($_GET['city']));

        $sql = $conn->prepare("SELECT * FROM car WHERE Registration_No =? ");
        $sql->bind_param("s", $id);
        $sql->execute();
        $resultCar = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        if (count($resultCar) > 0) {
            foreach ($resultCar as $row) {
                $Status = $row['Status'];
                if ($Status == 'Deactive') {

                } else {
                    $Registration_no = $row['Registration_No'];
                    $Car_brand = $row['Brand'];
                    $Car_name = $row['Name'];
                    $Image = $row['Image'];
                    $TotalBooked = $row['Total_Booked'];
                    $Car_hire_cost = $row['Hire_Cost'];
                    $Car_charge_cost = $row['Charge_Cost'];
                    $Category_id = $row['Category_Id'];
                    $Category = $conn->prepare("SELECT * FROM car_category WHERE Category_Id =? ");
                    $Category->bind_param("s", $Category_id);
                    $Category->execute();
                    $resultCategory = $Category->get_result()->fetch_all(MYSQLI_ASSOC);
                    if (count($resultCategory) > 0) {
                        foreach ($resultCategory as $row) {
                            $Category_name = $row['Category_Name'];
                            $Seats = $row['Seats'];
                            $Fuel = $row['Fuel'];
                            $Transmission = $row['Transmission'];
                        }
                    } else {
                        echo "<script>alert('Error : Not a Category_id');</script>";
                    }
                    if ($Car_hire_cost > 20) {
                        $securityD = 3000;
                    } else {
                        $securityD = 2000;
                    }
                }
            }
        }
        ?>
        <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bgimg/bg_2.jpg');"
                 data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                    <div class="col-md-9 ftco-animate pb-5">
                        <p class="breadcrumbs">
                            <span class="mr-2">
                                <a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a>
                            </span> <span>Car details <i class="ion-ios-arrow-forward"></i></span></p>
                        <h1 class="mb-3 bread">Car Details</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-4 py-4">
            <!--    <section class="ftco-section car-list">-->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <img class="rounded" src="images/carimg/<?= $Image; ?>" width="84%" alt="Not Image View"/>
                        </div>

                        <hr/>
                        <?php
                        $cityAddress = $conn->prepare("SELECT * FROM city WHERE City_Id = ? ");
                        $cityAddress->bind_param("s", $city);
                        $cityAddress->execute();
                        $resultcity = $cityAddress->get_result()->fetch_all(MYSQLI_ASSOC);

                        foreach ($resultcity as $row) {
                            $City_Id = $row['City_Id'];
                            $PICKUP = $row['Address'];
                        }
                        ?>

                        <div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-5">
                                        <h6>PICK-UP &<br/> DROP-OFF Address :</h6>
                                    </div>
                                    <div class="col-7">
                                        <h6 style="color: #0a58ca"><?= $PICKUP; ?></h6>
                                    </div>
                                </div>
                                <p></p>
                                <div class="row">
                                    <div class="col-5">
                                        <h6>KMs Limit :</h6>
                                    </div>
                                    <div class="col-7">
                                        <h6 style="color: #0a58ca"><?= $_SESSION['kms']; ?> KMs</h6>
                                    </div>
                                </div>
                                <p></p>
                                <div class="row">
                                    <div class="col-5">
                                        <h6>Fuel :</h6>
                                    </div>
                                    <div class="col-7">
                                        <h6 style="color: #0a58ca">Full Tank</h6>
                                    </div>
                                </div>
                                <p></p>
                                <div class="row">
                                    <div class="col-5">
                                        <h6>Extra kms charge :</h6>
                                    </div>
                                    <div class="col-7">
                                        <h6 style="color: #0a58ca"><i
                                                class="fa-solid fa-indian-rupee-sign"></i> <?= $Car_charge_cost; ?> (per KM)
                                        </h6>
                                    </div>
                                </div>
                                <p></p>
                                <div class="row">
                                    <div class="col-5">
                                        <h6>Tolls, Parking & Inter-state taxes :</h6>
                                    </div>
                                    <div class="col-7">
                                        <h6 style="color: #0a58ca">To be paid by you</h6>
                                    </div>
                                </div>
                                <p></p>
                                <div class="row">
                                    <div class="col-5">
                                        <h6>Cancellation Charges :</h6>
                                    </div>
                                    <div class="col-7">
                                        <h6 style="color: #0a58ca"><i class="fa-solid fa-indian-rupee-sign"></i> 500</h6>
                                    </div>
                                </div>
                                <p></p>
                                <!--                        <div class="row">-->
                                <!--                            <div class="col-5">-->
                                <!--                                <h6>Term & Conditions :</h6>-->
                                <!--                            </div>-->
                                <!--                            <div class="col-7">-->
                                <!--                                <h6 style="color: #0a58ca"><a>View</a></h6>-->
                                <!--                            </div>-->
                                <!--                        </div>-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-2">
                        <div>
                            <div class="text text-center">
                                <span class="subheading"><?= $Car_brand ?></span>
                                <h2><?= $Car_name ?></h2>
                            </div>

                            <div class="row">
                                <div class="col-md d-flex align-self-stretch ftco-animate">
                                    <div class="media block-6 services">
                                        <div class="media-body">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="step1__icon step1__icon--blue"
                                                          class="flaticon-car-seat">
                                                        &nbsp;<span class="flaticon-car-seat"></span>
                                                    </span>
                                                </div>
                                                <div class="text align-items-center justify-content-center">
                                                    <p class="pl-3" style="color: grey; font-size: 20px;">
                                                        Seats :<br/><span style="color: #0a58ca"><?= $Seats ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md d-flex align-self-stretch ftco-animate">
                                    <div class="media block-6 services">
                                        <div class="media-body">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="step1__icon step1__icon--blue"
                                                          class="flaticon-car-seat">
                                                        <span class="flaticon-pistons"></span>
                                                    </span>
                                                </div>
                                                <div class="text align-items-center justify-content-center">
                                                    <p class="pl-3" style="color: grey; font-size: 20px;">
                                                        Transmission :<br/><span
                                                            style="color: #0a58ca"><?= $Transmission ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md d-flex align-self-stretch ftco-animate">
                                    <div class="media block-6 services">
                                        <div class="media-body">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="step1__icon step1__icon--blue"
                                                          class="flaticon-car-seat">
                                                        &nbsp;<span class="flaticon-diesel"></span>
                                                    </span>
                                                </div>
                                                <div class="text align-items-center justify-content-center">
                                                    <p class="pl-3" style="color: grey; font-size: 20px;">
                                                        Fuel :<br/><span style="color: #0a58ca"><?= $Fuel ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md d-flex align-self-stretch ftco-animate">
                                    <div class="media block-6 services">
                                        <div class="media-body">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <span class="step1__icon step1__icon--blue"
                                                          class="flaticon-car-seat">
                                                        <span class="flaticon-car"></span>
                                                    </span>
                                                </div>
                                                <div class="text align-items-center justify-content-center">
                                                    <p class="pl-3" style="color: grey; font-size: 20px;">
                                                        Category :<br/><span style="color: #0a58ca"><?= $Category_name ?></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr/>

                            <div class="row">
                                <div class="col-8 d-flex align-self-stretch ftco-animate">
                                    <p class="pl-3" style="color: grey; font-size: 18px;">Booking Amount :</p>
                                </div>
                                <div class="col-3 d-flex align-self-stretch ftco-animate">
                                    <p class="pl-3" style="color: grey; font-size: 18px;">
                                        <span style="color: #0a58ca"><i class="fa-solid fa-indian-rupee-sign"></i> <?= $price ?></span>
                                    </p>
                                </div>

                                <div class="col-8 d-flex align-self-stretch ftco-animate">
                                    <p class="pl-3" style="color: grey; font-size: 18px;">Refundable security deposit :</p>
                                </div>
                                <div class="col-3 d-flex align-self-stretch ftco-animate">
                                    <p class="pl-3" style="color: grey; font-size: 18px;">
                                        <span style="color: #0a58ca"><i
                                                class="fa-solid fa-indian-rupee-sign"></i> <?= $securityD ?></span>
                                    </p>
                                </div>

                                <div class="col-8 d-flex align-self-stretch ftco-animate">
                                    <p class="pl-3" style="color: grey; font-size: 18px;">Insurance & GST :</p>
                                </div>
                                <div class="col-3 d-flex align-self-stretch ftco-animate">
                                    <p class="pl-3" style="color: #0a58ca; font-size: 18px;">Included</p>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-8 d-flex align-self-stretch ftco-animate">
                                    <p class="pl-3" style="color: grey; font-size: 18px;">Offer : </p>&nbsp;
                                    <form method="post" id="offerForm">

                                        <div class="float-container">
                                            <div class="float-child">
                                                <div class="green"><input type="text" class="form-group" name="offerCode"
                                                                          placeholder="Offer Code" autocomplete="off" size="12"
                                                                          required>&nbsp;
                                                </div>
                                            </div>
                                            <div class="float-child">
                                                <div class="blue"><input type="submit" name="offerbtn" id="applyBtn"
                                                                         value="Apply Offer"
                                                                         class="btn btn-outline-success"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-3 d-flex align-self-stretch ftco-animate">
                                    <p class="pl-3" style="color: grey; font-size: 20px;">
                                        <span style="color: #0a58ca">
                                            <i class="fa-solid fa-indian-rupee-sign"></i>
                                            <?php
                                            if (isset($_POST['offerbtn'])) {
                                                $offercode = $_POST['offerCode'];
                                                $currentDate = date('Y-m-d');
                                                $sql = "SELECT * FROM offer where Code = '$offercode' AND Start_Date <= '$currentDate' AND End_Date >= '$currentDate'";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $Percentage = $row['Percentage'];
                                                    }
                                                    $discount11 = $price * ($Percentage / 100);
                                                    $discount1 = round($discount11);
                                                    echo $discount1;
                                                } else {
                                                    echo "<script>alert('Sorry, this offer code is not valid.');</script>";
                                                    echo "0";
                                                }
                                            } else {
                                                echo "0";
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-8 d-flex align-self-stretch ftco-animate">
                                    <p class="pl-3" style="color: #0a58ca; font-size: 20px;">Total Amount :</p>
                                </div>
                                <div class="col-3 d-flex align-self-stretch ftco-animate">
                                    <form method="post" enctype="multipart/form-data" name="form1">
                                        <p class="pl-3" style="color: grey; font-size: 20px;">
                                            <span style="color: #0a58ca">
                                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                                <?php
                                                if ($discount1 == 0) {
                                                    $discount0 = 0;
                                                    $total0 = $price + $securityD;
                                                    echo $total0;
                                                    $_SESSION['dic0'] = $discount0;
                                                    $_SESSION['to0'] = $total0;
                                                    $total = $total0;
                                                } else {
                                                    $total1 = $price + $securityD - $discount1;
                                                    echo $total1;
                                                    $_SESSION['dic1'] = $discount1;
                                                    $_SESSION['to1'] = $total1;
                                                    $total = $total1;
                                                }
                                                ?>
                                            </span>
                                        </p>
                                    </form>
                                </div>
                            </div>

                            <div>
                                <form method="post" enctype="multipart/form-data" name="submitForm2">
                                    <div class="col-md-12" align="center">
                                        <input type="submit" id="BOOKCARNOW" name="bookcar" value="Payment"
                                               class="btn btn-primary py-2 px-4">
                                    </div>
                                </form>

                                <?php
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <b>
            <hr style="height: 1px;">
        </b>

        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            var options = {
                "key": "rzp_test_JWwpr1USWodaq9", // Enter the Key ID generated from the Dashboard
                "amount": "<?= $total * 100 ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "Quick Car Hire",
                "description": "Booking Payment",
                "image": "image/1logo.png",
                //                "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "handler": function (response) {
                    console.log(response);

                    if (response.razorpay_payment_id) {
                        var pid = response.razorpay_payment_id;

                        // Create a hidden form element
                        var form = document.createElement("form");
                        form.method = "POST";
                        // form.action = "ajaxbooking.php";

                        // Create an input element to hold the payment ID
                        var pidInput = document.createElement("input");
                        pidInput.type = "hidden";
                        pidInput.name = "pid";
                        pidInput.value = pid;

                        // Append the input to the form
                        form.appendChild(pidInput);

                        // Append the form to the document and submit it
                        document.body.appendChild(form);
                        form.submit();
                    }
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response) {
                alert(response.error.code);
                // alert(response.error.description);
                // alert(response.error.source);
                // alert(response.error.step);
                alert(response.error.reason);
            });

            document.getElementById('BOOKCARNOW').onclick = function (e) {
                rzp1.open();
                e.preventDefault();
            }
        </script>
        <?php
        if (isset($_POST['pid'])) {
            $pid = $_POST['pid'];

            if (isset($_SESSION['dic1']) && isset($_SESSION['to1'])) {
                $discount1234 = $_SESSION['dic1'];
                $total1234 = $_SESSION['to1'];
            } else {
                $discount1234 = $_SESSION['dic0'];
                $total1234 = $_SESSION['to0'];
            }

            $R_no = $id;
            $email = $_SESSION['Email'];

            $Start_Date = $_SESSION['Start_Date'];
            $End_Date = $_SESSION['End_Date'];
            $formatted_Start_Date = date('Y-m-d', strtotime($Start_Date));
            $formatted_End_Date = date('Y-m-d', strtotime($End_Date));

            $Selected_Kms = $_SESSION['kms'];

            $Start_Time_hm = $_SESSION['Start_Time'];
            $End_Time_hm = $_SESSION['End_Time'];
            $Start_Time = date("H:i:s", strtotime($Start_Time_hm));
            $End_Time = date("H:i:s", strtotime($End_Time_hm));

            $current_date = date('Y-m-d');

            $booking12 = $conn->prepare("INSERT INTO booking(Email,Registration_No,City_Id,Start_Date,End_Date,Start_Time,End_Time,Security_Deposit,Selected_Kms,Booking_Amount,Offer,Total_Amount,Booking_Date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);");
            $booking12->bind_param("sssssssssssss", $email, $R_no, $city, $formatted_Start_Date, $formatted_End_Date, $Start_Time, $End_Time, $securityD, $Selected_Kms, $price, $discount1234, $total1234, $current_date);
            $booking1 = $booking12->execute();

            $booking_id = $conn->insert_id;

            $payment = $conn->prepare("INSERT INTO payment(Booking_Id, Transaction_Id, Payment_Amount, Payment_Date) VALUES (?,?,?,?);");
            $payment->bind_param("ssds", $booking_id, $pid, $total1234, $current_date);
            $payment1 = $payment->execute();

            if ($payment1 > 0) {
//        echo "<script>alert('$discount1234');</script>";
//        echo "<script>alert('$total1234');</script>";
                unset($_SESSION['dic0']);
                unset($_SESSION['dic1']);
                unset($_SESSION['to0']);
                unset($_SESSION['to1']);
                echo "<script>window.location.href = 'history.php';</script>";
            } else {
                echo "<script>alert('Not Booking');</script>";
            }
        }
        ?>

        <section class="row row--grid" id="howtowork">
            <div class="container">
                <section class="row row--grid">
                    <div class="wrapper">
                        <section id="products">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12 heading-section text-center ftco-animate">
                                        <h2 class="">Available Cars</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="carousel-car owl-carousel">
                                            <?php
                                            $sql = $conn->prepare("SELECT * FROM car WHERE Hire_Cost > 22");
                                            $sql->execute();
                                            $resultCar = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

                                            if (count($resultCar) > 0) {
                                                foreach ($resultCar as $row) {
                                                    $Status = $row['Status'];
                                                    if ($Status == 'Deactive') {

                                                    } else {
                                                        $Registration_no = $row['Registration_No'];
                                                        $Car_name = $row['Name'];
                                                        $Brand = $row['Brand'];
                                                        $Image = $row['Image'];
                                                        $Car_hire_cost = $row['Hire_Cost'];
                                                        $TotalBooked = $row['Total_Booked'];
                                                        $Category_id = $row['Category_Id'];
                                                        $Category = $conn->prepare("SELECT * FROM car_category WHERE Category_Id =? ");
                                                        $Category->bind_param("s", $Category_id);
                                                        $Category->execute();
                                                        $resultCategory = $Category->get_result()->fetch_all(MYSQLI_ASSOC);
                                                        if (count($resultCategory) > 0) {
                                                            foreach ($resultCategory as $row) {
                                                                $Category_name = $row['Category_Name'];
                                                                $Seats = $row['Seats'];
                                                                $Fuel = $row['Fuel'];
                                                                $Transmission = $row['Transmission'];
                                                            }
                                                        } else {
                                                            echo "<script>alert('Error : Not a Category');</script>";
                                                        }
                                                        ?>

                                                        <div class="col-12 col-md-12 col-xl-12">
                                                            <div class="car">
                                                                <div class="splide splide--card car__slider splide--loop splide--ltr splide--draggable is-active is-initialized"
                                                                     id="splide02">
                                                                    <div class="splide__track" id="splide02-track"
                                                                         style="padding-left: 0px; padding-right: 0px;">
                                                                        <img src="images/carimg/<?php echo $Image; ?>"
                                                                             style="height: 200px;" alt="Refresh">
                                                                    </div>
                                                                </div>
                                                                <div class="car__title">
                                                                    <h3 class="car__name">
                                                                        <?php echo $Car_name; ?>
                                                                    </h3>
                                                                    <span class="car__year"><?php echo $Brand; ?></span>
                                                                </div>
                                                                <ul class="car__list">
                                                                    <li>
                                                                        <i class="fa-solid fa-user-group"
                                                                           style="color: #189cf4;"></i>&nbsp;&nbsp;
                                                                        <span><?php echo $Seats; ?> Seats</span>
                                                                    </li>

                                                                    <li>
                                                                        <i class="fa-solid fa-car-side"
                                                                           style="color: #189cf4;"></i>&nbsp;&nbsp;
                                                                        <span><?php echo $Category_name; ?></span>
                                                                    </li>
                                                                    <li>
                                                                        <i class="fa-solid fa-gas-pump"
                                                                           style="color: #189cf4;"></i>&nbsp;&nbsp;
                                                                        <span><?php echo $Fuel; ?></span>
                                                                    </li>
                                                                    <li>
                                                                        <i class="fa-solid fa-gears"
                                                                           style="color: #189cf4;"></i>&nbsp;&nbsp;
                                                                        <span><?php echo $Transmission; ?></span>
                                                                    </li>

                                                                </ul>
                                                                <!--                                                        <div class="car__footer">-->
                                                                <!---->
                                                                <!--                                                        </div>-->
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </div>
        </section>
        <br/>
        <?php
        include "./footerLink.php";
        ?>
    </body>
</html>