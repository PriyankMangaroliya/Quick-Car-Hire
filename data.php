<!DOCTYPE html>
<?php
include "./headLink.php";
include "./databaseConnection.php";
include "./header.php";
include "./sessionwithoutlogin.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>QuickCarHire | My Profile</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" type="text/css" href="css/customerprofile.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
        $Email = $_SESSION['Email'];
        $query = $conn->prepare("SELECT * FROM customer where Email=?");
        $query->bind_param("s", $Email);
        $result = $query->execute();
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($result as $row) {
            $Name = $row['Name'];
            $Email = $row['Email'];
            $mobile = $row['Mobile'];
            $DOB = $row['Date_Of_Birth'];
            $DL = $row['Driving_Licence'];
            $AN = $row['AadharCard'];
            $Ph = $row['Image'];
        }
        ?>
        <div class=" emp-profile">
            <form method="post">
                <div class="row">
                    <!--                    <div class="col-md-4">-->
                    <!--                        <div class="profile-img">-->
                    <!--                            <img src="Customer/customerP/--><?php //= $Ph;   ?><!--" alt="Your Image"/>-->
                    <!--<                            <img src="Customer/customerP/Priyank.jpg" alt=""/>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <div class="col-md-12">
                        <div class="profile-head">

                            <h5>
                                <?= $Email; ?>
                            </h5>
                        </div>
                    </div>
                    <!--                    <div class="col-md-2">-->
                    <!--                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>-->
                    <!--                    </div>-->
                </div>
                <br/><br/>
                <div class="row">
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $Name; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>DOB</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $DOB; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>AadharCard No</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $AN; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Driving licence</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $DL; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Mobile No</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?= $mobile; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Experience</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Hourly Rate</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>10$/hr</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Total Projects</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>230</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>English Level</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Expert</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Availability</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>6 months</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label><br/>
                                        <p>Your detail description</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php include 'footerLink.php' ?>
    </body>
</html>
