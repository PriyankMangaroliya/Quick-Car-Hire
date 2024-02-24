<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Car Category</title>
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
                                        <h4 class="m-0 font-weight-bold text-primary">Add Category</h4>
                                    </div>
                                </div>
                            </div>
                            <form method="post">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="card-body">
                                            <div id="alertContainer">
                                            </div>
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="form-floating mb-3" >
                                                    <select class="form-select" name="Category_Name" required>
                                                        <option selected>Sedan</option>
                                                        <option>SUV</option>
                                                        <option>MUV</option>
                                                        <option>Hatchback</option>
                                                    </select>
                                                    <label for="Category_Name">Category Name</label>
                                                </div>

                                                <div class="form-floating mb-3" >
                                                    <select class="form-select" name="Seats" required>
                                                        <option selected>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                    </select>
                                                    <label for="Seats">Seats</label>
                                                </div>

                                                <div class="form-floating mb-3" >
                                                    <select class="form-select" name="Fuel" required>
                                                        <option selected>Petrol</option>
                                                        <option>CNG</option>
                                                        <option>Diesel</option>
                                                        <option>Electric</option>
                                                    </select>
                                                    <label for="Fuel">Fuel</label>
                                                </div>

                                                <div class="form-floating mb-3" >
                                                    <select class="form-select" name="Transmission" required>
                                                        <option selected>Manual</option>
                                                        <option>Automatic</option>
                                                    </select>
                                                    <label for="Transmission">Transmission</label>
                                                </div>
                                                <div class="d-grid gap-2">
                                                    <input type="submit" name="Categorysubmit" id="Categorysubmit" class="btn btn-primary btn-lg"
                                                           value="Add Category">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script>
                            function showMessage(id) {
                                var message = "This is Category ID:  " + id + "  is already exist!";
                                var alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + message + '</div>';

                                document.getElementById("alertContainer").innerHTML = alert;
                            }
                        </script>
                        <?php
                        if (isset($_POST['Categorysubmit'])) {

                            $Category_Name = $_POST['Category_Name'];
                            $Seats = $_POST['Seats'];
                            $Fuel = $_POST['Fuel'];
                            $Transmission = $_POST['Transmission'];

                            $FuelCharacter = substr($Fuel, 0, 1);
                            $TransmissionCharacter = substr($Transmission, 0, 1);
                            $Category_Id = $Category_Name . $Seats . $FuelCharacter . $TransmissionCharacter;

                            $CheckP = $conn->prepare("SELECT * FROM car_category WHERE Category_Id = ?");
                            $CheckP->bind_param("s", $Category_Id);
                            $result = $CheckP->execute();
                            $result = $CheckP->get_result()->fetch_all(MYSQLI_ASSOC);

                            if (!count($result) > 0) {
                                $category = $conn->prepare("INSERT INTO car_category VALUES (?,?,?,?,?)");
                                $category->bind_param("sssss", $Category_Id, $Category_Name, $Seats, $Fuel, $Transmission);
                                $Addcategory = $category->execute();
                                if ($Addcategory > 0) {
                                    echo "<script>window.location.href='carCategory.php'</script>";
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">This Category Not Add.</div>';
//                            echo "<script> alert('$conn->error');</script>";
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert">This Category already exists.</div>';
//                        echo "<script>showMessage('$Category_Id');</script>";
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