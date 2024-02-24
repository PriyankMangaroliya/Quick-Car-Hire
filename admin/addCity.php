<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add City</title>
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
                                        <h4 class="m-0 font-weight-bold text-primary">Add City</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="card-body">

                                        <form method="post" enctype="multipart/form-data">

                                            <div class="form-floating mb-3">
                                                <input class="form-control" autocomplete="off" id="City_Code" name="City_Code" type="text" placeholder="City Code" maxlength="4" required>
                                                <label for="City_Code">City Code</label>
                                                <span id="CityError" style="color: red;"></span>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="City_Name" name="City_Name" type="text" placeholder="City Name"
                                                       onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"
                                                       required>
                                                <label for="City_Name">City Name</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="City_Mobile" name="City_Mobile" type="text" placeholder="City Mobile No" required>
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
                                                <input class="form-control" id="City_Email" name="City_Email" type="text" placeholder="City Email" required>
                                                <label for="City_Email">City Email</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="City_Address" name="City_Address" type="text" placeholder="City Address" required>
                                                <label for="City_Address">City Address</label>
                                            </div>


                                            <div class="d-grid gap-2">
                                                <input type="submit" name="Citysubmit" id="Citysubmit" class="btn btn-primary btn-lg"
                                                       value="Add City">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <script type="text/javascript">

                            $("#City_Code").keyup(function (e) {
                                $("#City_Code").html('');

                                var validstr = '';
                                var dInput = $(this).val();
                                var numpattern = /^\d+$/;
                                var alphapattern = /^[A-Z]+$/;

                                for (var i = 0; i < dInput.length; i++) {

                                    if ((i == 2 || i == 3)) {
                                        if (numpattern.test(dInput[i])) {
                                            // console.log('validnum' + dInput[i]);
                                            validstr += dInput[i];
                                        } else {
                                            $("#CityError").html("Only Digits").show();
                                        }
                                    }

                                    if ((i == 0 || i == 1)) {
                                        if (alphapattern.test(dInput[i])) {
                                            validstr += dInput  [i];
                                        } else {
                                            $("#CityError").html("Only Capital Alpahbets").show();
                                        }
                                    }

                                }
                                $(this).val(validstr);
                                return false;
                            });
                        </script>
                        <?php
                        if (isset($_POST['Citysubmit'])) {
                            $City_Code = $_POST['City_Code'];
                            $City_Name = $_POST['City_Name'];
                            $City_Mobile = $_POST['City_Mobile'];
                            $City_Email = $_POST['City_Email'];
                            $City_Address = $_POST['City_Address'];

                            $CheckP = $conn->prepare("SELECT * FROM city WHERE City_Id = ?");
                            $CheckP->bind_param("s", $City_Code);
                            $result = $CheckP->execute();
                            $result = $CheckP->get_result()->fetch_all(MYSQLI_ASSOC);

                            if (!count($result) > 0) {

//                      INSERT INTO city(City,Address) VALUES (?,?)
//                      $city = $conn->prepare("CALL InsertCity(?,?,?,?,?)");
//                      $city->bind_param("sssss", $City_Code,$City_Name,$City_Mobile,$City_Email, $City_Address);
//                      $Addcity = $city->execute();
                                $city = $conn->prepare(" INSERT INTO city (City_Id, City, Mobile, Email, Address) VALUES (?, ?, ?, ?, ?)");
                                $city->bind_param("sssss", $City_Code, $City_Name, $City_Mobile, $City_Email, $City_Address);
                                $Addcity = $city->execute();

                                if ($Addcity == 1) {
                                    echo "<script>window.location.href='city.php'</script>";
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">This City Not Add.</div>';
//                            echo "<script> alert('$conn->error');</script>";
                                }
                            } else {
                                echo '<div class="alert alert-danger" role="alert">This City already exists.</div>';
                            }
                        }
                        $conn->close();
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