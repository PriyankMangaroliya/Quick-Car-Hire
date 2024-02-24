<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Offer</title>
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
                    <main>
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Add Offer</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                         aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Help</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="Offer_Code" name="Offer_Code" type="text"
                                               onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 47 && event.charCode < 58)"
                                               placeholder="Offer Code" maxlength="10" required/>
                                        <label for="Offer_Code">Offer Code</label>
                                        <span id="OfferCode"></span>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="Offer_Name" name="Offer_Name" type="text" placeholder="Offer Name"
                                               onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 31 && event.charCode < 33)"
                                               required/>
                                        <label for="Offer_Name">Offer Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="file" name="OfferImage" id="OfferImage" accept="image/*" class="form-control">
                                        <label for="Image">Offer Image</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="Offer_Amount" name="Offer_Amount" type="text"
                                               placeholder="Offer Amount" onkeypress="return (event.charCode > 47 && event.charCode < 58)"
                                               required/>
                                        <label for="Offer_Amount">Offer Percentage</label>
                                    </div>
                                    <!--                                    <div class="form-floating mb-3">-->
                                    <!--                                        <select class="form-select" name="Registration_No" >-->
                                    <!--                                            --><?php
//                                            $query = "SELECT Registration_No FROM car";
//                                            $result = $conn->query($query);
//                                             echo '<option value="Null">
//                                                    Not any Car Selected
//                                            </option>';
//                                            while ($row = mysqli_fetch_array($result)) {
//                                                $Registration_No = $row['Registration_No'];
//
                                    ?>
                                    <!--                                                <option value="--><?php //= $Registration_No          ?><!--">-->
                                    <!--                                                    --><?php //= $Registration_No          ?>
                                    <!--                                                </option>-->
                                    <!--                                                --><?php
//                                            }
//
                                    ?>
                                    <!--                                        </select>-->
                                    <!--                                        <label for="Offer_Amount">Registration No</label>-->
                                    <!--                                    </div>-->
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="Offer_Start_Date" name="Offer_Start_Date" type="text"
                                               placeholder="Offer Start Date" autocomplete="off" required/>
                                        <label for="Offer_Start_Date">Offer Start Date</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="Offer_End_Date" name="Offer_End_Date" type="text"
                                               placeholder="Offer End Date" autocomplete="off" required/>
                                        <label for="Offer_End_Date">Offer End Date</label>
                                    </div>
                                    <!--                                    <div class="form-floating mb-3" >-->
                                    <!--                                        <select class="form-select" name="Offer_City" required>-->
                                    <!--                                            --><?php
//                                            $query = "SELECT City_Id, City FROM city";
//                                            $result = $conn->query($query);
//                                            while ($row = mysqli_fetch_array($result)) {
//                                                $cityId = $row['City_Id'];
//                                                $cityName = $row['City'];
//
                                    ?>
                                    <!--                                                <option value="--><?php //= $cityId          ?><!--">-->
                                    <!--                                                    --><?php //= $cityName         ?>
                                    <!--                                                </option>-->
                                    <!--                                                --><?php
//                                            }
//
                                    ?>
                                    <!--                                        </select>-->
                                    <!--                                        <label for="Offer_City">Offer City</label>-->
                                    <!--                                    </div>-->
                                    <div class="d-grid gap-2">
                                        <input type="submit" name="Offersubmit" id="Offersubmit" class="btn btn-primary btn-lg"
                                               value="Add Offer">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <script type="text/javascript">
                            function alreadyexistOffer() {
                                $("#OfferCode").append("This Offer Code is already exist!");
                                $("#OfferCode").css("color", "red");
                            }

                            $(function () {
                                var dateToday = new Date();
                                $("#Offer_Start_Date").datepicker({
                                    numberOfMonths: 1,
                                    dateFormat: "yy-mm-dd",
                                    minDate: dateToday,
                                    onSelect: function (selected) {
                                        var dt = new Date(selected);
                                        dt.setDate(dt.getDate() + 1);
                                        $("#Offer_End_Date").datepicker("option", "minDate", dt);
                                    }
                                });
                                $("#Offer_End_Date").datepicker({
                                    numberOfMonths: 1,
                                    dateFormat: "yy-mm-dd",
                                    minDate: dateToday,
                                    onSelect: function (selected) {
                                        var dt = new Date(selected);
                                        dt.setDate(dt.getDate() - 1);
                                        $("#Offer_Start_Date").datepicker("option", "maxDate", dt);
                                    }
                                });
                            });
                        </script>
                        <?php
                        if (isset($_POST['Offersubmit'])) {
                            $offercode = $_POST['Offer_Code'];
                            $OfferName = $_POST['Offer_Name'];
                            $OfferAmount = $_POST['Offer_Amount'];
                            $startdate = $_POST['Offer_Start_Date'];
                            $enddate = $_POST['Offer_End_Date'];
//                            $Offer_City =$_POST['Offer_City'];
//                            $Registration_No1 = $_POST['Registration_No'];

                            $OfferImage = $_FILES['OfferImage']['name'];

                            $CheckP = $conn->prepare("SELECT * FROM offer WHERE Code = ?");
                            $CheckP->bind_param("s", $offercode);
                            $result = $CheckP->execute();
                            $result = $CheckP->get_result()->fetch_all(MYSQLI_ASSOC);

                            if (!count($result) > 0) {

                                $extensionOffer = pathinfo($OfferImage, PATHINFO_EXTENSION);
                                $OfferImg = $offercode . "." . $extensionOffer;

                                $today_date = date("yy-mm-dd");
                                $last_date = $enddate;

                                $current_date = date("Y-m-d");

                                if (strtotime($startdate) == strtotime($current_date)) {
                                    $Status = 'Current';
                                }

                                if (strtotime($current_date) >= strtotime($enddate)) {
                                    $Status = 'Completed';
                                }

                                if (strtotime($startdate) >= strtotime($current_date)) {
                                    $Status = 'Completed';
                                }

//                                $offer = $conn->prepare("CALL InsertOffer(?,?,?,?,?,?,?,?)");
//                                $offer->bind_param("sssissss", $offercode, $OfferName, $OfferImg, $OfferAmount, $startdate, $enddate, $Offer_City,$Status);
//                                $AddOffer = $offer->execute();

                                $offer = $conn->prepare("INSERT INTO `offer`(`Code`, `Name`, `Image`, `Percentage`, `Start_Date`, `End_Date`, `Status`) VALUES (?,?,?,?,?,?,?)");
                                $offer->bind_param("sssisss", $offercode, $OfferName, $OfferImg, $OfferAmount, $startdate, $enddate, $Status);
                                $AddOffer = $offer->execute();

                                if ($AddOffer > 0) {
                                    move_uploaded_file($_FILES["OfferImage"]["tmp_name"], "/images/offerimg/" . $OfferImg);
                                    echo "<script>window.location.href='offer.php'</script>";
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">This Offer Not Add.</div>';
//                                    echo "<script> alert('$conn->error');</script>";
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert">This Offer Code Already Exits.</div>';
//                                echo "<script>alreadyexistOffer();</script>";
                            }
                        }
                        ?>
                    </main>
                </div>
                <!-- End Content -->
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="Stylesheet" type="text/css"/>
    </body>
</html>