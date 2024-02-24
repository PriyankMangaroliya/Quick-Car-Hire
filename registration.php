<?php
include "./databaseConnection.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registration</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login/form.css">
    </head>
    <body>
        <div class="registration-form">
            <form method="post" enctype="multipart/form-data" style="width: 110%">
                <h5 class="title">Registration Form</h5>
                <!--                <div class="form-icon">
                                    <span><i class="icon icon-user"></i></span>
                                </div>-->

                <div class="form-group">
                    <input type="email" class="form-control item" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control item" id="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control item" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                </div>

                <div class="form-group">
                    <i id="error"></i>
                    <button type="submit" name="submit" id="submit" class="btn btn-block create-account">Registration</button>
                </div>

                <hr/>
                <p class="subtitle">Already Registration? <a href="login.php">Login</a></p>

                <!--                <div class="form-group">-->
                <!--                    <button type="submit" class="btn btn-block create-account social-media">Sign up with Google</button>-->
                <!--                </div>-->
                <?php
                if (isset($_POST['submit'])) {

                    $Emailid = $_POST['email'];
                    $Password = $_POST['password'];
                    $cpassword = $_POST['cpassword'];

                    $uppercase = preg_match('@[A-Z]@', $Password);
                    $lowercase = preg_match('@[a-z]@', $Password);
                    $number = preg_match('@[0-9]@', $Password);
                    $specialChars = preg_match('@[^\w]@', $Password);

                    $CheckP = $conn->prepare("SELECT * FROM customer WHERE Email = ?");
                    $CheckP->bind_param("s", $Emailid);
                    $result = $CheckP->execute();
                    $result = $CheckP->get_result()->fetch_all(MYSQLI_ASSOC);

                    if (!count($result) > 0) {

                        if (!$number || !$specialChars || strlen($Password) <= 8) {
                            echo '<div class="alert alert-danger" role="alert">Password must be at least 8 characters long and include at least one digit and one special symbol.</div>';
                        } else {
                            if ($Password != $cpassword) {
                                echo '<div class="alert alert-danger" role="alert">Passwords do not match.</div>';
                            } else {
                                $_SESSION['Email'] = $Emailid;
                                $_SESSION['Password'] = $Password;
                                $_SESSION['Login'] = true;

                                $otp = rand(1000000, 9999999);

                                $sql1 = "INSERT INTO register(Email, Password,OTP,Verify) VALUES ('$Emailid','$Password','$otp','0')";
                                try {
                                    $resultCustomer = $conn->query($sql1);
                                } catch (mysqli_sql_exception $e) {
                                    echo $e->getMessage();
                                }

                                include 'otpMail.php';
                                sendMail($Emailid, $otp);
                                echo "<script>window.location.href='./otp.php'</script>";
                            }
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">This Email id is Exits.</div>';
                    }
                }
                ?>
            </form>

            <!--    <div class="social-media">
                    <h5>Sign up with social media</h5>
                    <div class="social-icons">
                        <a href="#"><i class="icon-social-facebook" title="Facebook"></i></a>
                        <a href="#"><i class="icon-social-google" title="Google"></i></a>
                        <a href="#"><i class="icon-social-twitter" title="Twitter"></i></a>
                    </div>
                </div>-->
        </div>
    </body>
</html>
