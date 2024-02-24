<?php
include "./databaseConnection.php";
$Email = $_POST['email'];
$FPOTP = $_POST['otp'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OTP Verification</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login/form.css">
    </head>
    <body>
        <div class="registration-form">
            <form method="post" enctype="multipart/form-data" style="width: 110%">
                <h5 class="title">Verify OTP</h5>
                <p class="subtitle">OTP Sent on "<?= $Email ?>"</p>

                <div class="form-group">
                    <input type="text" class="form-control item" id="otp" name="otp" placeholder="Enter OTP">
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-block create-account">Verify</button>
                </div>
                <hr/>
                <div class="form-group">
                    <button type="submit" name="resend" class="btn btn-block create-account social-media">Resend OTP</button>
                </div>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $OTP = $_POST['otp'];

                $query = "SELECT * FROM customer WHERE Email = '$Email'";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $Pass = $row['Password'];

                    include 'otpMail.php';
                    sendMail($Email, $Pass);

                    echo "<script>window.location.href='./profile.php'</script>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Invalid OTP.</div>";
                }
            }

            if (isset($_POST['resend'])) {
                $otp = rand(1000000, 9999999);
                include 'otpMail.php';
                sendMail($Email, $otp);

                $sql = "UPDATE register SET OTP = '$otp' WHERE Email ='$Email'";
                mysqli_query($conn, $sql);
            }
            ?>
        </div>
    </body>
</html>
