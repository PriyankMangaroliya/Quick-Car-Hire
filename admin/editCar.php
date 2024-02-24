<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Car</title>
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

                $car = base64_decode(strval($_GET['Rid']));
                $query = $conn->prepare("SELECT * FROM car where Registration_No=?");
                $query->bind_param("s", $car);
                $result = $query->execute();
                $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
                foreach ($result as $row) {
                    $R_no = $row['Registration_No'];
                    $Car_name = $row['Name'];
                    $Car_brand = $row['Brand'];
                    $Image = $row['Image'];
                    $City = $row['City_Id'];
                    $Category_id = $row['Category_Id'];
                    $Car_Status = $row['Status'];
                    $Car_hire_cost = $row['Hire_Cost'];
                    $Charge_Cost = $row['Charge_Cost'];
                }
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div>
                                        <h4 class="m-0 font-weight-bold text-primary">Edit Car</h4>
                                    </div>
                                </div>
                            </div>
                            <form method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="card-body">

                                            <form method="post" enctype="multipart/form-data">

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="R_No" name="R_No" type="text" placeholder="MH03AH6414" maxlength="10" minlength="10" value="<?= $R_no; ?>" disabled="disabled" required/>
                                                    <label for="R_No">Registration No</label>
                                                    <span id="RegistrationNo"> </span>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="Car_Name" name="Car_Name" type="text"
                                                           onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 31 && event.charCode < 33) || (event.charCode > 47 && event.charCode < 58)"
                                                           placeholder="Car Name" value="<?= $Car_name; ?>" required>
                                                    <label for="Car_Name">Car Name</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="Car_Brand" name="Car_Brand" type="text"
                                                           onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"
                                                           placeholder="Car Brand" value="<?= $Car_brand; ?>"  required>
                                                    <label for="Car_Brand">Car Brand</label>
                                                </div>

                                                <div class="form-floating mb-3">
        <!--                                            <input type="file" name="Image" id="Image" accept="image/*" class="form-control">-->
                                                    <img src="/images/carimg/<?= $Image; ?>" width="100px" height="100px">
                                                    <!--                                            <label for="Image">Image</label>-->
                                                </div>

                                                <div class="form-floating mb-3" >
                                                    <select class="form-select" id="City" aria-label="Default select example" name="City" required>
                                                        <?php
                                                        $query = "SELECT * FROM city";
                                                        $result = $conn->query($query);
                                                        $id = 1;
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            $city = $row['City'];
                                                            $City_Id = $row['City_Id'];
                                                            ?>
                                                            <option value="<?= $City_Id ?>">
                                                                <?= $city; ?>
                                                            </option>
                                                            <?php
                                                            $id++;
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="City">City</label>
                                                </div>

                                                <div class="form-floating mb-3" >
                                                    <select class="form-select" name="Category_Id">
                                                        <?php
                                                        $query = "SELECT * FROM car_category";
                                                        $result = $conn->query($query);
                                                        $id = 1;
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            $Category_Id = $row['Category_Id'];
                                                            ?>
                                                            <option id='tr_<?= $id ?>'>
                                                                <?= $Category_Id ?>
                                                            </option>
                                                            <?php
                                                            $id++;
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="Category_Id">Category Id</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="Car_Hire_Cost" name="Car_Hire_Cost" type="text"
                                                           onkeypress="return (event.charCode > 47 && event.charCode < 58)" placeholder="Car Hire Cost"
                                                           value="<?= $Car_hire_cost; ?>"  required>
                                                    <label for="Car_Hire_Cost">Car Hire Cost</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="Charge_Cost" name="Charge_Cost" type="text" placeholder="Car Charge Cost" value="<?= $Charge_Cost; ?>" >
                                                    <label for="Car_Speed">Car Charge Cost</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="Car_Status" name="Car_Status">
                                                        <?php
                                                        if ($Car_Status == 'Deactive') {
                                                            echo "<option>Active</option><option selected>Deactive</option>";
                                                        } else {
                                                            echo "<option selected>Active</option><option>Deactive</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="Car_Status">Car Status</label>
                                                </div>

                                                <div class="d-grid gap-2">
                                                    <input type="submit" name="Carupdate" id="Carupdate" class="btn btn-primary btn-lg" value="Update Car">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script type="text/javascript">

                            $("#R_No").keyup(function (e) {
                                $("#R_No").html('');

                                var validstr = '';
                                var dInput = $(this).val();
                                var numpattern = /^\d+$/;
                                var alphapattern = /^[A-Z]+$/;

                                for (var i = 0; i < dInput.length; i++) {

                                    if ((i == 2 || i == 3 || i == 6 || i == 7 || i == 8 || i == 9)) {
                                        if (numpattern.test(dInput[i])) {
                                            // console.log('validnum' + dInput[i]);
                                            validstr += dInput[i];
                                        } else {
                                            $("#R_No").html("Only Digits").show();

                                        }
                                    }

                                    if ((i == 0 || i == 1 || i == 4 || i == 5)) {
                                        if (alphapattern.test(dInput[i])) {
                                            // console.log('validword' + dInput[i]);
                                            validstr += dInput  [i];
                                        } else {
                                            $("#R_No").html("Only Capital Alpahbets").show();

                                        }
                                    }

                                }

                                $(this).val(validstr);
                                return false;
                            });
                        </script>
                        <?php
                        if (isset($_POST['Carupdate'])) {
                            $Car_name = $_POST['Car_Name'];
                            $Car_brand = $_POST['Car_Name'];
                            $City = $_POST['City'];
                            $Category_id = $_POST['Category_Id'];
                            $Car_Status = $_POST['Car_Status'];
                            $Car_hire_cost = $_POST['Car_Hire_Cost'];
                            $Charge_Cost = $_POST['Charge_Cost'];

//                    $UpdateCar = $conn->prepare("CALL UpdateCar(?, ?, ?, ?, ?, ?, ?, ?)");
//                    $UpdateCar->bind_param("sssssiss", $Car_name, $Car_brand,$City, $Category_Id, $Car_Status, $Car_hire_cost, $Charge_Cost,$R_no);
//                    $Update = $UpdateCar->execute();

                            $UpdateCar = $conn->prepare(" UPDATE car SET Name = ?, Brand = ?, City_Id = ?, Category_Id = ?, Status = ?, Hire_Cost = ?, Charge_Cost = ? WHERE `Registration_No` = ?");
                            $UpdateCar->bind_param("sssssiss", $Car_name, $Car_brand, $City, $Category_Id, $Car_Status, $Car_hire_cost, $Charge_Cost, $R_no);
                            $Update = $UpdateCar->execute();

                            if ($Update > 0) {
//                        $msg = "Your Password succesfully changed";
                                echo "<script>window.location.href='Car.php'</script>";
                            } else {
//                        $error = "Your current password is wrong";
                                echo '<div class="alert alert-danger" role="alert">This Car Details Not Update.</div>';
//                        echo "<script> alert('$conn->error');</script>";
                            }
                        }
                        ?>
                    </main>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './footerLinks.php'; ?>
    </body>
</html>