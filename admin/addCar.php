<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Car</title>
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
                                        <h4 class="m-0 font-weight-bold text-primary">Add Car</h4>
                                    </div>
                                </div>
                            </div>
                            <form method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="card-body">

                                            <form method="post" enctype="multipart/form-data">

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="R_No" name="R_No" type="text" placeholder="MH03AH6414" maxlength="10" minlength="10" required/>
                                                    <label for="R_No">Registration No</label>
                                                    <span id="RegistrationNo"> </span>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="Car_Name" name="Car_Name" type="text"
                                                           onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 31 && event.charCode < 33) || (event.charCode > 47 && event.charCode < 58)"
                                                           placeholder="Car Name" required>
                                                    <label for="Car_Name">Car Name</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="Car_Brand" name="Car_Brand" type="text"
                                                           onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"
                                                           placeholder="Car Brand" required>
                                                    <label for="Car_Brand">Car Brand</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="file" name="Image" id="Image" accept="image/*" class="form-control">
                                                    <label for="Image">Image</label>
                                                </div>

                                                <div class="form-floating mb-3" id="Mimg" style="display: none;">
                                                    <input type="text" name="Image1" placeholder="only enter 1 to 3" id="Image1" class="form-control"
                                                           onkeypress="return (event.charCode > 48 && event.charCode < 52)" maxlength="1" onclick="showmul();">
                                                    <label for="Image1">Image</label>
                                                </div>

                                                <script>
                                                    function Addimg() {
                                                        var Mimg = document.getElementById("Mimg");
                                                        var val = document.getElementById("Multipalimg").checked;

                                                        if (val) {
                                                            Mimg.style.display = "block";

                                                        } else {
                                                            Mimg.style.display = "none";
                                                        }
                                                    }
                                                </script>
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
                                                           required>
                                                    <label for="Car_Hire_Cost">Car Hire Cost</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="Charge_Cost" name="Charge_Cost" type="text" placeholder="Car Charge Cost" REQUIRED>
                                                    <label for="Charge_Cost">Car Charge Cost</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="Car_Status" name="Car_Status">
                                                        <option selected>Active</option>
                                                        <option>Deactive</option>
                                                    </select>
                                                    <label for="Car_Status">Car Status</label>
                                                </div>

                                                <div class="d-grid gap-2">
                                                    <input type="submit" name="Carsubmit" id="Carsubmit" class="btn btn-primary btn-lg"
                                                           value="Add Car">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script type="text/javascript">function alreadyexistRegistrationNo() {
                                $("#RegistrationNo").append("This Car Registration No is already exist!");
                                $("#RegistrationNo").css("color", "red");
                            }

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
                        if (isset($_POST['Carsubmit'])) {
                            $R_No = $_POST['R_No'];
                            $Car_Name = $_POST['Car_Name'];
                            $Car_Brand = $_POST['Car_Brand'];
                            $City = $_POST['City'];
                            $Car_Status = $_POST['Car_Status'];
                            $Car_Hire_Cost = $_POST['Car_Hire_Cost'];
                            $Category_Id = $_POST['Category_Id'];
                            $Charge_Cost = $_POST['Charge_Cost'];

                            $Img = $_FILES['Image']['name'];
                            $CheckP = $conn->prepare("SELECT * FROM car WHERE Registration_No = ?");
                            $CheckP->bind_param("s", $R_No);
                            $result = $CheckP->execute();
                            $result = $CheckP->get_result()->fetch_all(MYSQLI_ASSOC);

                            if (!count($result) > 0) {

                                $extension = pathinfo($_FILES["Image"]["name"], PATHINFO_EXTENSION);
                                $imgname = $R_No . "." . $extension;

//                        $car = $conn->prepare("CALL InsertCar(?, ?, ?, ?, ?, ?, ?, ?, ?)");
//                        $car->bind_param("sssssssii", $R_No, $Car_Name, $Car_Brand, $imgname, $City, $Category_Id, $Car_Status, $Car_Hire_Cost, $Charge_Cost);
//                        $Addcar = $car->execute();


                                $car = $conn->prepare("INSERT INTO `car`(`Registration_No`, `Name`, `Brand`, `Image`, `City_Id`, `Category_Id`, `Status`, `Hire_Cost`, `Charge_Cost`) VALUES (?,?,?,?,?,?,?,?,?)");
                                $car->bind_param("sssssssii", $R_No, $Car_Name, $Car_Brand, $imgname, $City, $Category_Id, $Car_Status, $Car_Hire_Cost, $Charge_Cost);
                                $Addcar = $car->execute();
                                if ($Addcar > 0) {
                                    move_uploaded_file($_FILES["Image"]["tmp_name"], "/images/carimg/" . $imgname);
                                    echo "<script>window.location.href='car.php'</script>";
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">This Car Not Add.</div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert">This Car Already Register.</div>';
                            }
//                    } else {
//                        echo "<script>alert('invalid car number');</script>";
//                    }
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