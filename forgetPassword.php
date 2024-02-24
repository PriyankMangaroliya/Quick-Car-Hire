<?php
include "./databaseConnection.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forget Password</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login/form.css">
    </head>
    <body>
        <div class="registration-form">
            <form method="post" enctype="multipart/form-data" style="width: 110%">
                <h5 class="title">Forget Password</h5>

                <div class="form-group">
                    <input type="email" class="form-control item" id="email" name="email" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-block create-account">Send OTP</button>
                </div>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $Email = $_POST['email'];

                $otp = rand(1000000, 9999999);

                include 'otpMail.php';
                sendMail($Email, $otp);
                echo "<input type='hidden' name='otp' value='$otp'>";
                echo "<script>window.location.href='./forgetPasswordOTP.php'</script>";
            }
            ?>
        </div>
    </body>
</html>
