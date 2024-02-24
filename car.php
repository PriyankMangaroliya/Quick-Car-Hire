<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QuickCarHire | Car</title>
        <?php
        include "./headLink.php";
        include "./databaseConnection.php";
        include "./header.php";
        ?>
    </head>
    <body>
        <?php
        $City = $_POST['City'];
        $query = "SELECT City FROM city where City_Id = '$City'";
        $result = $conn->query($query);

        while ($row = mysqli_fetch_array($result)) {
            $cityName = $row['City'];
        }

        $sdate = $_POST['Start_Date'];
        $edate = $_POST['End_Date'];
        $stime = $_POST['Start_Time'];
        $etime = $_POST['End_Time'];

        $totalhrs = $_POST['totalhrs'];

        $_SESSION['City'] = $City;
        $_SESSION['Start_Date'] = $sdate;
        $_SESSION['End_Date'] = $edate;
        $_SESSION['Start_Time'] = $stime;
        $_SESSION['End_Time'] = $etime;

        $totalkm8 = $totalhrs * 8;
        $totalkm15 = $totalhrs * 11;
        $totalkm20 = $totalhrs * 15;
        ?>
        <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bgimg/bg_2.jpg');"
                 data-stellar-background-ratio="0.5">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start"
                 style="align-self: center">
                <div class="col-12 ftco-animate pb-2" align="center">
                    <form method="post" class="home__search">
                        <div class="home__group">
                            <label for="search1">City</label>
                            <input type="text" class="form-control" id="Start_Date" name="Start_Date" placeholder="Date"
                                   disabled="disabled" value="<?= $cityName ?>">
                        </div>
                        <div class="home__group">
                            <label for="search1">Pick-up date</label>
                            <input type="text" class="form-control" id="Start_Date" name="Start_Date" placeholder="Date"
                                   disabled="disabled" value="<?= $sdate ?>">
                        </div>
                        <div class="home__group">
                            <label for="search2">Drop-off date</label>
                            <input type="text" class="form-control" id="End_Date" name="End_Date" placeholder="Date"
                                   disabled="disabled" value="<?= $edate ?>">
                        </div>
                        <div class="home__group">
                            <label for="search3">Pick-up time</label>
                            <input type="time" class="form-control" name="Start_Time" placeholder="Time" disabled="disabled"
                                   value="<?= $stime ?>">
                        </div>
                        <div class="home__group">
                            <label for="search1">Drop-off time</label>
                            <input type="time" class="form-control" name="End_Time" placeholder="Time" disabled="disabled"
                                   value="<?= $etime ?>">
                        </div>
                    </form>
                </div>

            </div>
        </section>

        <script>
            $(document).ready(function () {
                $.ajax({
                    url: 'ajax/ajaxcar.php',
                    type: 'POST',
                    data: {button_value: <?= $totalkm8 ?>},
                    success: function (response) {
                        $("#cars").html(response);
                    },
                    error: function () {
                        alert("error");
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $("button").click(function () {
                    var buttonId = $(this).attr('id');
                    var buttonValue = $(this).val();
                    $.ajax({
                        url: 'ajax/ajaxcar.php',
                        type: 'post',
                        data: {button_value: buttonValue},
                        success: function (response) {
                            $("#cars").html(response);
                            // Handle the response from server
                        },
                        error: function () {
                            alert("error");
                        }
                    });
                });
            });
        </script>
        <section class="bg-light">
            <div class="container">
                <section class="row row--grid">
                    <div class="wrapper">
                        <section id="products">
                            <div class="container"><br/>
                                <div class="row">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h1>Available Cars</h1>
                                    <div class="col-md-auto ftco-animate" style="margin-left: 20rem">
                                        <div class="container"
                                             style="background-color: rgb(238, 243, 249);border-radius: 10px;margin-left: 1rem;text-align: center">
                                            <ul class="nav nav-tabs justify-content-center pt-3 py-2" role="tablist"
                                                style="padding: 5px;">
                                                <li class="nav-item align-self-center">
                                                    <label class="" style="color: #0a58ca; font-size: 20px;">KM Plan</label>
                                                </li>&nbsp;&nbsp;
                                                <li class="nav-item">
                                                    <button class="btn btn-outline-primary btn-lg active" data-toggle="tab"
                                                            href="#home" role="tab"
                                                            value="<?= $totalkm8 ?>">
                                                        <?= $totalkm8 ?> KMS
                                                    </button>
                                                </li>&nbsp;
                                                <li class="nav-item">
                                                    <button class="btn btn-outline-primary btn-lg" data-toggle="tab"
                                                            href="#profile" role="tab"
                                                            value="<?= $totalkm15 ?>">
                                                        <?= $totalkm15 ?> KMS
                                                    </button>
                                                </li>&nbsp;
                                                <li class="nav-item">
                                                    <button class="btn btn-outline-primary btn-lg" data-toggle="tab"
                                                            href="#messages" role="tab"
                                                            value="<?= $totalkm20 ?>">
                                                        <?= $totalkm20 ?> KMS
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="main__title" id="cars"></div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
                <br/>
            </div>
        </section>
        <?php
        include "./footerLink.php";
        ?>
    </body>
</html>