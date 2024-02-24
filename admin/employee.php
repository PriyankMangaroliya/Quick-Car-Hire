<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Employee</title>
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
                        <div class="card shadow mb-4">
                            <form method="post" enctype="multipart/form-data">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <h2 class="m-0 font-weight-bold text-primary">Employee</h2>
                                        </div>
                                        <div class="col-lg-2">
                                            <a href="addEmployee.php" class="btn btn-primary">Add</a>
                                            <input type="submit" class="btn btn-primary" name="Admin_delete" id="but_delete" value="Delete">
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($_GET["Status"]) && $_GET["Status"] == 'Deactive') {
                                    $id = $_GET["id"];
                                    // Activate user
                                    $sql = "UPDATE employee SET Status='active' WHERE Email = '$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<script>window.location.href='employee.php'</script>";
                                    } else {
                                        echo "Error activating user: " . mysqli_error($conn);
                                    }
                                }

                                if (isset($_GET["Status"]) && $_GET["Status"] == 'active') {
                                    $id = $_GET["id"];
                                    // Activate user
                                    $sql = "UPDATE employee SET Status='Deactive' WHERE Email = '$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<script>window.location.href='employee.php'</script>";
                                    } else {
                                        echo "Error activating user: " . mysqli_error($conn);
                                    }
                                }
                                ?>

                                <!--                            <form method="post" enctype="multipart/form-data">-->
                                <div class="card-body">
                                    <div class="table">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr style=" position: sticky;">
                                                    <th scope="col"></th>
                                                    <th scope="col">Employee Name</th>
                                                    <th scope="col">Email Id</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM employee";
                                                $result = $conn->query($query);
                                                $id = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $Admin_name = $row['Name'];
                                                    $Admin_email_id = $row['Email'];
                                                    $Status = $row['Status'];
                                                    $role_id = $row['Role_Id'];
                                                    $city_id = $row['City_Id'];
                                                    ?>
                                                    <tr id='tr_<?= $id ?>'>
                                                        <td><input type='checkbox' name='delete[]' value='<?= $Admin_email_id; ?>'>
                                                        </td>
                                                        <td><?= $Admin_name ?></td>
                                                        <td><?= $Admin_email_id ?></td>
                                                        <td>
                                                            <?php
                                                            $query6 = "SELECT * FROM role_menu where Role_Id = $role_id";
                                                            $result6 = $conn->query($query6);
                                                            while ($row = mysqli_fetch_array($result6)) {
                                                                $Role = $row['Name'];
                                                                echo $Role;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $query7 = "SELECT * FROM city where City_Id = '$city_id'";
                                                            $result7 = $conn->query($query7);
                                                            while ($row = mysqli_fetch_array($result7)) {
                                                                $City = $row['City'];
                                                                echo $City;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($Status == 'Deactive') {
                                                                echo "<a href='employee.php?id=$Admin_email_id&Status=Deactive'><span class='badge badge-danger'>$Status</span>";
                                                            } else {
                                                                echo "<a href='employee.php?id=$Admin_email_id&Status=active'><span class='badge badge-success'>$Status</span>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="editEmployee.php?id=<?= base64_encode($Admin_email_id); ?>"><i class="fa fa-edit"></i></a>
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
                                        $deleteAdmin = $conn->prepare("DELETE from employee WHERE Email=?");
                                        $deleteAdmin->bind_param("s", $deleteid);
                                        try {
                                            $deleteAdmin->execute();
                                        } catch (mysqli_sql_exception $e) {
                                            $errorMessage = $e->getMessage();
                                            echo "<script>alert('$errorMessage');</script>";
                                        }
                                    }
                                    echo "<script>window.location.href='employee.php'</script>";
                                } else {
                                    echo '<script>Checkboxseleted();</script>';
                                }
                            }
                            ?>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>