<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QuickCarHire | Offer</title>
        <?php
        include "./headLink.php";
        include "./databaseConnection.php";
        include "./header.php";
        ?>
    </head>
    <body>
        <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bgimg/car-7.jpg');background-position: center;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                    <div class="col-md-9 ftco-animate pb-5">
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
                            <span>Offers <i class="ion-ios-arrow-forward"></i></span></p>
                        <h1 class="mb-3 bread">Offers</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-light">
            <div class="container">
                <section class="row row--grid">
                    <div class="wrapper">
                        <section id="products">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="main__title" id="cars">
                                            <?php
                                            $currentDate = date("Y-m-d");

                                            $sql = $conn->prepare("SELECT * FROM offer WHERE Start_Date <= ? AND End_Date >= ?;");
                                            $sql->bind_param("ss", $currentDate, $currentDate);
                                            $sql->execute();
                                            $resultoffer = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

                                            if (count($resultoffer) > 0) {
                                                foreach ($resultoffer as $row) {
                                                    $Code = $row['Code'];
                                                    $Name = $row['Name'];
                                                    $Image = $row['Image'];
                                                    $Percentage = $row['Percentage'];
                                                    $Start_Date = $row['Start_Date'];
                                                    $End_Date = $row['End_Date'];
                                                    ?>

                                                    <div class="col-4 col-md-4 col-xl-4">
                                                        <div class="car">
                                                            <div class="splide splide--card car__slider splide--loop splide--ltr splide--draggable is-active is-initialized"
                                                                 id="splide02">
                                                                <div class="splide__track" id="splide02-track"
                                                                     style="padding-left: 0px; padding-right: 0px;">
                                                                    <img src="images/offerimg/<?php echo $Image; ?>"
                                                                         style="height: 200px; width: 300px;" alt="Refresh">
                                                                </div>
                                                            </div>
                                                            <div class="car__title">
                                                                <h3 class="car__name">
                                                                    <?php echo $Name; ?>
                                                                </h3>
                                                                <span class="car__year">
                                                                    <?php echo $Percentage; ?>
                                                                    &nbsp;<i class="fa-solid fa-percentage"
                                                                             style="color: #189cf4;"></i>&nbsp;&nbsp;
                                                                </span>
                                                            </div>
        <!--                                                            <p></p>-->
                                                            <!--                                                            <ul class="offer_list">-->
                                                            <!--                                                                <li><h5>Offer Code : <span style="color: #189cf4;">--><?php //echo $Code;   ?><!--</span>-->
                                                            <!--                                                                    </h5>-->
                                                            <!--                                                                </li>-->
                                                            <!--                                                                <li><h5>Start Date : --><?php //echo $Start_Date;   ?><!--</h5></li>-->
                                                            <!--                                                                <li><h5>End Date : --><?php //echo $End_Date;   ?><!--</h5></li>-->
                                                            <ul class="car__list">
                                                                <li>
                                                                    <i class="fa-solid fa-calendar-check"
                                                                       style="color: #189cf4;"></i>&nbsp;&nbsp;
                                                                    <span><?php echo $Start_Date; ?></span>
                                                                </li>
                                                                <li>
                                                                    <i class="fa-solid fa-calendar-times"
                                                                       style="color: #189cf4;"></i>&nbsp;&nbsp;
                                                                    <span><?php echo $End_Date; ?></span>
                                                                </li>
                                                                <!--                                                                </ul>-->

                                                            </ul>
                                                            <div class="car__footer" style="color: black; font-size: 20px;">
                                                                <span>Code : <?php echo $Code; ?></span>
                                                                <input type="submit" class="btn btn-primary" onclick="copyText('<?php echo $Code; ?>')" value="Copy Code" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                echo "<div><h1>Not Available Offers</h1></div>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section><br/>
            </div>
        </section>

        <script>
            function copyText(code) {
                // Access the value passed as the 'code' parameter
                var codeToCopy = code;

                // Perform the copying action (example using clipboard API)
                // This requires the browser to support the Clipboard API
                navigator.clipboard.writeText(codeToCopy)
                        .then(function () {
                            console.log('Code copied successfully: ' + codeToCopy);
                            // Optionally, you can provide user feedback here
                            alert('Code copied: ' + codeToCopy);
                        })
                        .catch(function (err) {
                            console.error('Unable to copy code: ', err);
                            // Handle errors, if any, related to copying
                            alert('Unable to copy code. Please try again.');
                        });
            }
        </script>
        <?php include "./footerLink.php"; ?>
    </body>
</html>