<?php
session_start();
include './databaseConnection.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Login</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    </head>

    <body class="bg-gradient-primary">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center align-items-center align-self-center align-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg mt-10" style="margin-top: 25%">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-7 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-5">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h1 text-gray-900 mb-4">Quick Car Hire</h1>
                                        </div>
                                        <form class="user" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="email" name="email" id="email" required
                                                       class="form-control form-control-user" placeholder="Email id">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" id="password" required
                                                       class="form-control form-control-user" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="login" id="login" value="Login"
                                                       class="btn btn-primary btn-user btn-block">
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['login'])) {

                                            $Admin_email_id = $_POST['email'];
                                            $Admin_password = $_POST['password'];

                                            $sql = $conn->prepare("SELECT * FROM administrator WHERE Email =? && Password = ?");
                                            $sql->bind_param("ss", $Admin_email_id, $Admin_password);
                                            $sql->execute();
                                            $adminResult = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

                                            $sql = $conn->prepare("SELECT * FROM employee WHERE Email =? && Password = ?   ");
                                            $sql->bind_param("ss", $Admin_email_id, $Admin_password);
                                            $sql->execute();
                                            $employeeResult = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

                                            if ($adminResult) {
                                                foreach ($adminResult as $row) {
                                                    $user_email = $row['Name'];
                                                    $curr_status = $row['Status'];
                                                }
                                                if ($curr_status == 'Deactive') {
                                                    echo '<div class="alert border-bottom-danger" role="alert">Sorry, your account is temporarily deactivated by the admin.</div>';
                                                } else {
                                                    $_SESSION['Admin_name'] = $adminResult[0]['Name'];
                                                    $_SESSION['islogin'] = true;
                                                    $_SESSION['role_id'] = 1;
                                                    echo "<script>window.location.href='./dashboard.php'</script>";
                                                }
                                            } elseif ($employeeResult) {
                                                foreach ($employeeResult as $row) {
                                                    $user_email = $row['Name'];
                                                    $curr_status = $row['Status'];
                                                    $role_id = $row['Role_Id'];
                                                    $city_id = $row['City_Id'];
                                                }
                                                if ($curr_status == 'Deactive') {
                                                    echo '<div class="alert border-bottom-danger" role="alert">Sorry, your account is temporarily deactivated by the admin.</div>';
                                                } else {
                                                    $_SESSION['Admin_name'] = $employeeResult[0]['Name'];
                                                    $_SESSION['islogin'] = true;
                                                    $_SESSION['role_id'] = $role_id;
                                                    $_SESSION['city_id'] = $city_id;
                                                    echo "<script>window.location.href='./mDashborad.php'</script>";
                                                }
                                            } else {
//                                        echo 'Please enter valid login data!.';
                                                echo '<div class="alert border-bottom-danger" role="alert">Please enter valid login data!.</div>';
                                            }
                                        }
                                        ?>

                                <!--        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
                                <!--        <script>-->
                                        <!--            $(function () {-->
                                        <!--                $('#login-form').submit(function (event) {-->
                                        <!--                    event.preventDefault();-->
                                        <!--                    var Email = $('#Email').val();-->
                                        <!--                    var Password = $('#Password').val();-->
                                        <!--                    $.ajax({-->
                                        <!--                        url: 'ajaxLogin.php',-->
                                        <!--                        type: 'POST',-->
                                        <!--                        data: {Email: Email, password: Password},-->
                                        <!--                        success: function (response) {-->
                                        <!--                            $('#login-result').html(response);-->
                                        <!--                        }-->
                                        <!--                    });-->
                                        <!--                });-->
                                        <!--            });-->
                                        <!--        </script>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
    </body>
</html>