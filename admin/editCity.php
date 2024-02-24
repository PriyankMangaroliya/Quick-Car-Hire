<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit City</title>
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

                $id = strval($_GET['cityid']);
                $query = $conn->prepare("SELECT * FROM city where City_Id=?");
                $query->bind_param("s", $id);
                $result = $query->execute();
                $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

                foreach ($result as $row) {
                    $City_Code = $row['City_Id'];
                    $City = $row['City'];
                    $Address = $row['Address'];
                    $Mobile = $row['Mobile'];
                    $Email = $row['Email'];
                    ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <main>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div>
                                            <h4 class="m-0 font-weight-bold text-primary"> Edit City</h4>
                                        </div>
                                    </div>
                                </div>

                                <form method="post">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <div class="card-body">


                                                <form method="post" enctype="multipart/form-data">

                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="City_Code" name="City_Code" type="text" placeholder="City Code" value="<?= $City_Code; ?>"   disabled="disabled" >
                                                        <label for="City_Code">City Code</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="City_Name" name="City_Name" type="text" placeholder="City Name"
                                                               onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"
                                                               value="<?= $City; ?>"    required>
                                                        <label for="City_Name">City Name</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="City_Mobile" name="City_Mobile" type="text" placeholder="City Mobile No" value="<?= $Mobile; ?>" required>
                                                        <label for="City_Mobile">Mobile No</label>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function () {
                                                            $('#City_Mobile').on('keypress', function (e) {
                                                                var $this = $(this);
                                                                var regex = new RegExp("^[0-9\b]+$");
                                                                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                                                                // for 10 digit number only
                                                                if ($this.val().length > 9) {
                                                                    e.preventDefault();
                                                                    return false;
                                                                }
                                                                if (e.charCode < 54 && e.charCode > 47) {
                                                                    if ($this.val().length == 0) {
                                                                        e.preventDefault();
                                                                        return false;
                                                                    } else {
                                                                        return true;
                                                                    }
                                                                }
                                                                if (regex.test(str)) {
                                                                    return true;
                                                                }
                                                                e.preventDefault();
                                                                return false;
                                                            });
                                                        });
                                                    </script>
                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="City_Email" name="City_Email" type="text" placeholder="City Email" value="<?= $Email ?>" required>
                                                        <label for="City_Email">City Email</label>
                                                    </div>

                                                    <div class="form-floating mb-3">
                                                        <input class="form-control" id="City_Address" name="City_Address" type="text" placeholder="City Address" value="<?= $Address ?>" required>
                                                        <label for="City_Address">City Address</label>
                                                    </div>


                                                    <div class="d-grid gap-2">
                                                        <input type="submit" name="Cityupdate" id="Cityupdate" class="btn btn-primary btn-lg"
                                                               value="Update City">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                        }
                        if (isset($_POST['Cityupdate'])) {
                            $City_Name = $_POST['City_Name'];
                            $City_Mobile = $_POST['City_Mobile'];
                            $City_Email = $_POST['City_Email'];
                            $City_Address = $_POST['City_Address'];

//
//                    $city = $conn->prepare("CALL UpdateCity(?,?,?,?,?)");
//                    $city->bind_param("sssss", $id,$City_Name,$City_Mobile,$City_Email, $City_Address);
//                    $Addcity = $city->execute();
                            $city = $conn->prepare(" UPDATE city SET `City` = ?, `Mobile` = ?, `Email` = ?, `Address` = ? WHERE `City_Id` = ?");
                            $city->bind_param("sssss", $City_Name, $City_Mobile, $City_Email, $City_Address, $id);
                            $Addcity = $city->execute();
                            if ($Addcity == 1) {
                                echo "<script>window.location.href='city.php'</script>";
                            } else {
                                echo '<div class="alert alert-danger" role="alert">This City Details Not Update.</div>';
//                        echo "<script> alert('$conn->error');</script>";
                            }
                        }
                        $conn->close();
                        ?>
                    </main>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>