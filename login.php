<?php
include "./databaseConnection.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login/form.css">
    </head>
    <body>
        <div class="registration-form">
            <form method="post" enctype="multipart/form-data" style="width: 120%">
                <h5 class="title">Login</h5>
                <div class="form-group">
                    <input type="email" class="form-control item" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control item" id="password" name="password" placeholder="Password"
                           required>
                    <a href="forgetPassword.php" class="align-end">Forget Password?</a>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-block create-account">Login</button>
                </div>

                <hr/>
                <div class="form-group">
                    <p class="subtitle">New User? <a href="registration.php">Registration</a></p>
                    <!--            <button type="submit" name="submit" class="btn btn-block create-account social-media">Sign in with Google</button>-->
                </div>

                <?php
                if (isset($_POST['submit'])) {
//                if (!isset($_SESSION['login_attempts'])) {
//                    $_SESSION['login_attempts'] = 0;
//                }
//
//                if (isset($_SESSION['last_login_attempt_time']) && ($_SESSION['remaining_attempts'] == 0)) {
//                    $current_time = time();
//                    $last_login_attempt_time = $_SESSION['last_login_attempt_time'];
//                    if ($current_time - $last_login_attempt_time < 60) { // 10 minutes = 600 seconds
//                        $remaining_time = 60 - ($current_time - $last_login_attempt_time);
//                        $timemessage = 'Too many wrong attempts. Please try again after ' . $remaining_time . ' seconds.';
//                        echo "<div class='alert alert-danger' role='alert'>$timemessage</div>";
//                        exit;
//                    }
//                }

                    $CustomerEmail = $_POST['email'];
                    $Customerpassword = $_POST['password'];

                    $sql = $conn->prepare("SELECT * FROM customer WHERE Email = ? &&  Password = ?");
                    $sql->bind_param("ss", $CustomerEmail, $Customerpassword);
                    $sql->execute();
                    $result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

                    if (count($result) == 1) {
                        foreach ($result as $row) {
                            $user_email = $row['Name'];
                            $curr_status = $row['Customer_Status'];
                        }
                        if ($curr_status == 'Deactive') {
                            echo '<div class="alert alert-danger" role="alert">Your account is Deactive, Please contact the Administrator.</div>';
                        } else {
//                        unset($_SESSION['login_attempts']);
                            $_SESSION['loggedin'] = true;
                            $_SESSION['Email'] = $CustomerEmail;

                            if (isset($_SESSION['City'], $_SESSION['Start_Date'], $_SESSION['End_Date'], $_SESSION['Start_Time'], $_SESSION['End_Time'])) {
                                $Registration_no = base64_decode(strval($_GET['id']));
                                $price = base64_decode(strval($_GET['P']));
                                $City = base64_decode(strval($_GET['city']));
                                ?>
                                <script>window.location.href = "booking.php?id=<?= base64_encode($Registration_no); ?>&P=<?= base64_encode($price); ?>&city=<?= base64_encode($City); ?>"</script>
                                <?php
                            } else {
                                echo "<script>window.location.href='index.php'</script>";
                            }
                        }
                    } else {
                        // $_SESSION['login_attempts']++; // Increment login attempts
                        // $_SESSION['last_login_attempt_time'] = time(); // Store current time as last login attempt time
                        // $_SESSION['remaining_attempts'] = 3 - $_SESSION['login_attempts'];
                        // . $_SESSION['remaining_attempts'] . ' attempt(s) remaining.';
                        echo "<div class='alert alert-danger' role='alert'>Invalid Email id or Password.</div>";
                    }
                }
                ?>
            </form>
        </div>
    </body>
</html>
