<?php
include "./databaseConnection.php";
$Email = $_SESSION['Email'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login/form.css">
    </head>
    <body>
        <div class="registration-form">
            <form method="post" enctype="multipart/form-data" style="width: 110%">
                <h5 class="title">Profile</h5>

                <div class="form-group">
                    <input type="text" class="form-control item" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control item" id="contact" name="contact" placeholder="Contact Number" required>
                </div>
                <div class="form-group">
                    <input type="date" class="form-control item" id="DOB" name="DOB" placeholder="Date of Birth" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control item" id="acnumber" name="acnumber"  placeholder="Aadharcard Number" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control item" id="dlnumber" name="dlnumber" placeholder="Driving Licence Number" required>
                </div>

                <div class="form-group">
                    Profile Picture<input type="file" class="form-control item" id="photo" name="photo">
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-block create-account">Save</button>
                </div>

                <?php
                if (isset($_POST['submit'])) {

                    $name = $_POST['name'];
                    $contact = $_POST['contact'];
                    $DOB = $_POST['DOB'];
                    $Aadharcard = $_POST['acnumber'];
                    $licence_number = $_POST['dlnumber'];

                    $file_name = $_FILES["photo"]["name"];
                    $extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
                    $imgname = $name . "." . $extension;
                    $Registration_Date = date('Y-m-d');
                    $Status = "Active";

                    $customer = $conn->prepare("UPDATE customer SET Name=?,Mobile=?,Date_Of_Birth=?,Driving_Licence=?,AadharCard=?,Image=?,Registration_Date=?,Customer_Status=? WHERE Email=?");
                    $customer->bind_param("sssssssss", $name, $contact, $DOB, $licence_number, $Aadharcard, $imgname, $Registration_Date, $Status, $Email);
                    try {
                        $Addcustomer = $customer->execute();
                        if ($Addcustomer > 0) {
                            move_uploaded_file($_FILES["photo"]["tmp_name"], "images/Customer/customerP/" . $imgname);
                            echo "<script>window.location.href='login.php'</script>";
                        } else {
                            echo "Error: " . $customer . "<br>" . $conn->error;
                        }
                    } catch (mysqli_sql_exception $e) {
                        echo "<script> alert('$e');  </script>";
                    }
                }
                ?>

            </form>
        </div>
    </body>
</html>
