<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <title>Edit City</title>-->
<!--    --><?php
//    include './headerLinks.php';
//    include './sessionWithoutLogin.php';
//    include './databaseConnection.php';
//
?>
<!--</head>-->
<!--<body id="page-top">-->
<!--<div id="wrapper">-->
<!--    --><?php
//    include './sidebar.php';
//
?>
<!--    <div id="content-wrapper" class="d-flex flex-column">-->
<!--        --><?php
//        include './header.php';
//
//
//        $Categoryid = base64_decode(strval($_GET['id']));
//        $query = $conn->prepare("SELECT * FROM car_category where Category_Id=?");
//        $query->bind_param("s", $Categoryid);
//        $result = $query->execute();
//        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
//        foreach ($result as $row) {
//            $id = $row['Category_Id'];
//            $name = $row['Category_Name'];
//            $categorySeats = $row['Seats'];
//            $categoryFuel = $row['Fuel'];
//            $categoryTransmission = $row['Transmission'];
//        }
//
?>
<!---->
<!--        <!-- Begin Page Content -->-->
<!--        <div class="container-fluid">-->
<!--            <main>-->
<!--                <div class="card shadow mb-4">-->
<!--                    <div class="card-header py-3">-->
<!--                        <div class="row">-->
<!--                            <div>-->
<!--                                <h4 class="m-0 font-weight-bold text-primary"> Edit City</h4>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <form method="post">-->
<!--                        <div class="card-body">-->
<!--                            <div class="table-responsive">-->
<!--                                <div class="card-body">-->
<!--                                    <form method="post">-->
<!--                                        <div class="form-floating mb-3">-->
<!--                                            <input class="form-control" id="Category_id" name="Category_id" type="text"-->
<!--                                                   placeholder="Category Id"-->
<!--                                                   onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 47 && event.charCode < 58)"-->
<!--                                                   MAXLENGTH="10" value="--><?php //echo $id;   ?><!--" disabled="disabled" required/>-->
<!--                                            <label for="Category_id">Category Id</label>-->
<!--                                        </div>-->
<!--                                        <div class="form-floating mb-3">-->
<!--                                            <select class="form-select" name="Category_name" required>-->
<!--                                                --><?php
//                                                if ($name == 'Sedan') {
//                                                    echo "<option selected>Sedan</option><option>SUV</option><option>MUV</option><option>Hatchback</option>";
//                                                } elseif ($name == 'SUV') {
//                                                    echo "<option>Sedan</option><option selected>SUV</option><option>MUV</option><option>Hatchback</option>";
//                                                } elseif ($name == 'CUV') {
//                                                    echo "<option>Sedan</option><option>SUV</option><option selected>MUV</option><option>Hatchback</option>";
//                                                } else {
//                                                    echo "<option>Sedan</option><option>SUV</option><option>MUV</option><option selected>Hatchback</option>";
//                                                }
//
?>
<!--                                            </select>-->
<!--                                            <label for="Category_name">Category Name</label>-->
<!--                                        </div>-->
<!--                                        <div class="form-floating mb-3">-->
<!--                                            <select class="form-select" name="Seats" required>-->
<!--                                                --><?php
//                                                if ($categorySeats == '4') {
//                                                    echo "<option selected>4</option><option>5</option><option>6</option><option>7</option><option>8</option>";
//                                                } elseif ($categorySeats == '5') {
//                                                    echo "<option>4</option><option selected>5</option><option>6</option><option>7</option><option>8</option>";
//                                                } elseif ($categorySeats == '6') {
//                                                    echo "<option>4</option><option>5</option><option selected>6</option><option>7</option><option>8</option>";
//                                                } elseif ($categorySeats == '7') {
//                                                    echo "<option>4</option><option>5</option><option>6</option><option selected>7</option><option>8</option>";
//                                                } else {
//                                                    echo "<option>4</option><option>5</option><option>6</option><option>7</option><option selected>8</option>";
//                                                }
//
?>
<!--                                            </select>-->
<!--                                            <label for="Seats">Seats</label>-->
<!--                                        </div>-->
<!--                                        <div class="form-floating mb-3">-->
<!--                                            <select class="form-select" name="Fuel" required>-->
<!--                                                --><?php
//                                                if ($categoryFuel == 'Petrol') {
//                                                    echo "<option selected>Petrol</option><option>CNG</option><option>Diesel</option><option>Electric</option>";
//                                                } elseif ($categoryFuel == 'CNG') {
//                                                    echo "<option>Petrol</option><option selected>CNG</option><option>Diesel</option><option>Electric</option>";
//                                                } elseif ($categoryFuel == 'Diesel') {
//                                                    echo "<option>Petrol</option><option>CNG</option><option selected>Diesel</option><option>Electric</option>";
//                                                } else {
//                                                    echo "<option>Petrol</option><option>CNG</option><option>Diesel</option><option selected>Electric</option>";
//                                                }
//
?>
<!--                                            </select>-->
<!--                                            <label for="Fuel">Fuel</label>-->
<!--                                        </div>-->
<!---->
<!--                                        <div class="form-floating mb-3">-->
<!--                                            <select class="form-select" name="Transmission" required>-->
<!--                                                --><?php
//                                                if ($categoryTransmission == 'Manual') {
//                                                    echo "<option selected>Manual</option><option>Automatic</option>";
//                                                } else {
//                                                    echo "<option>Manual</option><option selected>Automatic</option>";
//                                                }
//
?>
<!--                                            </select>-->
<!--                                            <label for="Transmission">Transmission</label>-->
<!--                                        </div>-->
<!--                                        <div class="d-grid gap-2">-->
<!--                                            <input type="submit" name="UpdateCategory" id="UpdateCategory" class="btn btn-primary btn-lg"-->
<!--                                                   value="Update Category">-->
<!--                                        </div>-->
<!--                                    </form>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--                --><?php
//                if (isset($_POST['UpdateCategory'])) {
//                    $Category_name = $_POST['Category_name'];
//                    $Seats = $_POST['Seats'];
//                    $Fuel = $_POST['Fuel'];
//                    $Transmission = $_POST['Transmission'];
//
//
//                    $UpdateCategory = $conn->prepare("UPDATE car_category SET Category_name=?,Seats=?,Fuel=?,Transmission=? WHERE Category_id=?");
//                    $UpdateCategory->bind_param("sssss", $Category_name, $Seats, $Fuel, $Transmission, $Categoryid);
//                    $Update = $UpdateCategory->execute();
//                    if ($Update > 0) {
//                        echo "<script>window.location.href='carCategory.php'</script>";
//                    } else {
//                        echo "<script> alert('$conn->error');</script>";
//                    }
//                }
//
?>
<!--            </main>-->
<!--        </div>-->
<!--        <!-- End admin -->-->
<!--    </div>-->
<!--</div>-->
<!--<!-- End of Main Content -->-->
<?PHP //include './footerLinks.php';  ?>
<!--</body>-->
<!--</html>-->