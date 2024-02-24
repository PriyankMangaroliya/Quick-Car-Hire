<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Admin</title>
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

                $id = base64_decode(strval($_GET['id']));
                $query = $conn->prepare("SELECT * FROM administrator where Email=?");
                $query->bind_param("s", $id);
                $result = $query->execute();
                $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
                foreach ($result as $row) {
                    $Admin_name = $row['Name'];
                    $Admin_email_id = $row['Email'];
                    $Admin_password = $row['Password'];
                    $Status = $row['Status'];
                }
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div>
                                    <h4 class="m-0 font-weight-bold text-primary">Edit Admin</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="card-body">

                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Admin_Name" name="Admin_Name" type="text"
                                                   placeholder="Admin Name"
                                                   value="<?= $Admin_name ?>"
                                                   onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 31 && event.charCode < 33)"
                                                   required/>
                                            <label for="Admin_Name">Admin Name</label>
                                            <span id="name"></span>

                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Admin_Email_Id" name="Admin_Email_Id"
                                                   disabled="disabled" type="email" placeholder="Admin Email Id"
                                                   value="<?= $Admin_email_id ?>" autocomplete="off" required/>
                                            <label for="Admin_Email_Id">Admin Email Id</label>
                                            <span id="Email"></span>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Admin_Password" name="Admin_Password" type="text"
                                                   placeholder="Admin Password" value="<?= $Admin_password ?>"
                                                   autocomplete="off" required/>
                                            <label for="Admin_Email_Id">Admin Password</label>
                                            <span id="Password"></span>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="Status" required>
                                                <?php
                                                if ($Status == 'Deactive') {
                                                    echo "<option>Active</option><option selected>Deactive</option>";
                                                } else {
                                                    echo "<option selected>Active</option><option>Deactive</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="Status">Status</label>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <input type="submit" name="Adminupdate" id="Adminupdate"
                                                   class="btn btn-primary btn-lg"
                                                   value="Update Admin">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['Adminupdate'])) {
                            $Admin_Name1 = $_POST['Admin_Name'];
                            $Admin_password1 = $_POST['Admin_Password'];
                            $Status1 = $_POST['Status'];

//                        $admin = $conn->prepare("CALL UpdateAdmin(?,?,?)");
//                        $admin->bind_param("sss", $Admin_Name,$Status1, $Admin_email_id);
//                        $Addadmin = $admin->execute();

                            $admin = $conn->prepare("UPDATE administrator SET Name = ?, Password = ?, Status = ? WHERE Email = ?;");
                            $admin->bind_param("ssss", $Admin_Name1, $Admin_password1, $Status1, $Admin_email_id);
                            $Addadmin = $admin->execute();
                            if ($Addadmin == 1) {
                                echo "<script>window.location.href='admin.php'</script>";
                            } else {
                                echo '<div class="alert alert-danger" role="alert">This Admin Details Not Update.</div>';
//                        echo "<script> alert('$conn->error');</script>";
                            }
                        }
                        $conn->close();
                        ?>
                    </div>

                    </main>
                </div>
                <!-- End admin -->
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="Stylesheet" type="text/css"/>
    </body>
</html>