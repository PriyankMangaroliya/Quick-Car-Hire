<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin</title>
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
                        <script>
                            function Checkboxseleted() {
                                alert('please Select any one check box!');
                            }
                        </script>
                        <!--                        echo '<div class="alert border-bottom-danger" role="alert">Please enter valid login data!.</div>';-->
                        <div class="card shadow mb-4">
                            <form method="post" enctype="multipart/form-data">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <h2 class="m-0 font-weight-bold text-primary">Admin</h2>
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="addAdmin.php" class="btn btn-primary">Add</a>
                                            <input type="submit" class="btn btn-primary" name="Admin_delete" id="but_delete" value="Delete">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (isset($_GET["Status"]) && $_GET["Status"] == 'Deactive') {
                                    $id = $_GET["id"];
                                    // Activate user
                                    $sql = "UPDATE administrator SET Status='active' WHERE Email = '$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<script>window.location.href='admin.php'</script>";
                                    } else {
                                        echo "Error activating user: " . mysqli_error($conn);
                                    }
                                }


                                if (isset($_GET["Status"]) && $_GET["Status"] == 'active') {
                                    $id = $_GET["id"];
                                    // Activate user
                                    $sql = "UPDATE administrator SET Status='Deactive' WHERE Email = '$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<script>window.location.href='admin.php'</script>";
                                    } else {
                                        echo "Error activating user: " . mysqli_error($conn);
                                    }
                                }
                                ?>

                                <!--                            <form method="post" enctype="multipart/form-data">-->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr style=" position: sticky;">
                                                    <th scope="col"></th>
                                                    <th scope="col">Admin Name</th>
                                                    <th scope="col">Admin Email Id</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM administrator";
                                                $result = $conn->query($query);
                                                $id = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $Admin_name = $row['Name'];
                                                    $Admin_email_id = $row['Email'];
                                                    $Status = $row['Status'];
                                                    ?>
                                                    <tr id='tr_<?= $id ?>'>
                                                        <td><input type='checkbox' name='delete[]' value='<?= $Admin_email_id; ?>'>
                                                        </td>
                                                        <td><?= $Admin_name ?></td>
                                                        <td><?= $Admin_email_id ?></td>
                                                        <td>
                                                            <?php
                                                            if ($Status == 'Deactive') {
                                                                echo "<a href='admin.php?id=$Admin_email_id&Status=Deactive'><span class='badge badge-danger'>$Status</span>";
                                                            } else {
                                                                echo "<a href='admin.php?id=$Admin_email_id&Status=active'><span class='badge badge-success'>$Status</span>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="editAdmin.php?id=<?= base64_encode($Admin_email_id); ?>"><i class="fa fa-edit"></i></a>
    <!--                                                                <i class="fa fa-trash-alt text-danger" ></i>-->
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $id++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['Admin_delete'])) {

                                if (isset($_POST['delete'])) {
                                    foreach ($_POST['delete'] as $deleteid) {
                                        $deleteAdmin = $conn->prepare("DELETE from administrator WHERE Email=?");
                                        $deleteAdmin->bind_param("s", $deleteid);
                                        try {
                                            $deleteAdmin->execute();
                                        } catch (mysqli_sql_exception $e) {
                                            $errorMessage = $e->getMessage();
                                            echo "<script>alert('$errorMessage');</script>";
                                        }
                                    }
                                    echo "<script>window.location.href='admin.php'</script>";
                                } else {
                                    echo '<script>Checkboxseleted();</script>';
//                                            echo '<div class="alert border-bottom-danger" role="alert">Please enter valid login data!.</div>';
                                }
                            }
                            ?>
                        </div>
                    </main>
                </div>
                <!-- End admin -->
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>