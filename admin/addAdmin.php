<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Admin</title>
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
                            <div class="card-header py-3">
                                <div class="row">
                                    <div>
                                        <h4 class="m-0 font-weight-bold text-primary">Add Admin</h4>
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
                                                       onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 31 && event.charCode < 33)"
                                                       required/>
                                                <label for="Admin_Name">Admin Name</label>
                                                <span id="name"></span>

                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="Admin_Email_Id" name="Admin_Email_Id"
                                                       type="email" placeholder="Admin Email Id" required/>
                                                <label for="Admin_Email_Id">Admin Email Id</label>
                                                <span id="Email"></span>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="Admin_Password" name="Admin_Password"
                                                       type="password" placeholder="Admin Password"
                                                       title="Password must be at least 8 characters and contain at least one number and one special symbol."
                                                       required/>
                                                <label for="Admin_Password">Admin Password</label>
                                                <span id="pass"></span>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="Status" required>
                                                    <option selected>Active</option>
                                                    <option>Deactive</option>
                                                </select>
                                                <label for="Status">Status</label>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <input type="submit" name="Adminsubmit" id="Adminsubmit"
                                                       class="btn btn-primary btn-lg"
                                                       value="Add Admin">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_POST['Adminsubmit'])) {
                            $Admin_Name = $_POST['Admin_Name'];
                            $Admin_Email_Id = $_POST['Admin_Email_Id'];
                            $Admin_Password = $_POST['Admin_Password'];
                            $Status = $_POST['Status'];

                            // Check password strength
                            $uppercase = preg_match('@[A-Z]@', $Admin_Password);
                            $lowercase = preg_match('@[a-z]@', $Admin_Password);
                            $number = preg_match('@[0-9]@', $Admin_Password);
                            $specialChars = preg_match('@[^\w]@', $Admin_Password);

                            if (!$number || !$specialChars || strlen($Admin_Password) < 8) {
//                        echo "<script>alert('Password does not meet requirements.');</script>";
                                echo '<div class="alert alert-danger" role="alert">Password must be long 8 char and contain one Digit and one Symbol.</div>';
                            } else {
                                require_once "./databaseConnection.php"; // Adjust this line
                                // Check if email already exists
                                $checkStmt = $conn->prepare("SELECT * FROM administrator WHERE Email = ?");
                                $checkStmt->bind_param("s", $Admin_Email_Id);
                                $checkStmt->execute();
                                $result = $checkStmt->get_result()->fetch_all(MYSQLI_ASSOC);

                                if (count($result) > 0) {
                                    echo '<div class="alert alert-danger" role="alert">This Email already exists.</div>';
                                } else {
                                    // Insert admin record
                                    $insertStmt = $conn->prepare("INSERT INTO administrator (Name, Email, Password, Status) VALUES (?, ?, ?, ?)");
                                    $insertStmt->bind_param("ssss", $Admin_Name, $Admin_Email_Id, $Admin_Password, $Status);
                                    $AddAdmin = $insertStmt->execute();

//                            $insertProcedure = "CALL InsertAdmin(?, ?, ?, ?)";
//                            $insertStmt = $conn->prepare($insertProcedure);
//                            $insertStmt->bind_param("ssss", $Admin_Name, $Admin_Email_Id, $Admin_Password, $Status);
//                            $AddAdmin = $insertStmt->execute();
                                    if ($AddAdmin) {
                                        echo "<script>window.location.href='admin.php';</script>";
                                    } else {
                                        echo '<div class="alert alert-danger" role="alert">Admin Not Add.</div>';
                                    }
                                }
                                $conn->close();
                            }
                        }
                        ?>

                    </main>
                </div>
                <!-- End admin -->
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>