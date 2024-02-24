<?php
include "../databaseConnection.php";

$City = $_SESSION['City'];
$sdate = $_SESSION['Start_Date'];
$edate = $_SESSION['End_Date'];

$kms = $_POST['button_value'];
$_SESSION['kms'] = $kms;

$sql = $conn->prepare("SELECT * FROM car WHERE City_Id = ? AND Registration_No NOT IN (SELECT Registration_No FROM booking WHERE City_Id =? AND start_date <= ? AND end_date >= ?);");
$sql->bind_param("ssss", $City, $City, $sdate, $edate);
$sql->execute();
$resultCar = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

if (count($resultCar) > 0) {
    foreach ($resultCar as $row) {
        $Status = $row['Status'];
        if ($Status == 'Deactive') {

        } else {
            $Registration_no = $row['Registration_No'];
            $Car_name = $row['Name'];
            $Brand = $row['Brand'];
            $Image = $row['Image'];
            $Car_hire_cost = $row['Hire_Cost'];
            $TotalBooked = $row['Total_Booked'];
            $Category_id = $row['Category_Id'];
            $Category = $conn->prepare("SELECT * FROM car_category WHERE Category_Id =? ");
            $Category->bind_param("s", $Category_id);
            $Category->execute();
            $resultCategory = $Category->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($resultCategory) > 0) {
                foreach ($resultCategory as $row) {
                    $Category_name = $row['Category_Name'];
                    $Seats = $row['Seats'];
                    $Fuel = $row['Fuel'];
                    $Transmission = $row['Transmission'];
                }
            } else {
                echo "<script>alert('Error : Not a Category');</script>";
            }
            ?>


            <div class="col-4 col-md-6 col-xl-4">
                <div class="car">
                    <div class="splide splide--card car__slider splide--loop splide--ltr splide--draggable is-active is-initialized"
                         id="splide02">
                        <div class="splide__track" id="splide02-track" style="padding-left: 0px; padding-right: 0px;">
                            <img src="images/carimg/<?php echo $Image; ?>" style="height: 200px;" alt="Refresh">
                        </div>
                    </div>
                    <div class="car__title">
                        <h3 class="car__name">
                            <?php echo $Car_name; ?>
                        </h3>
                        <span class="car__year"><?php echo $Brand; ?></span>
                    </div>
                    <ul class="car__list">
                        <li>
                            <i class="fa-solid fa-user-group" style="color: #189cf4;"></i>&nbsp;&nbsp;
                            <span><?php echo $Seats; ?> Seats</span>
                        </li>

                        <li>
                            <i class="fa-solid fa-car-side" style="color: #189cf4;"></i>&nbsp;&nbsp;
                            <span><?php echo $Category_name; ?></span>
                        </li>
                        <li>
                            <i class="fa-solid fa-gas-pump" style="color: #189cf4;"></i>&nbsp;&nbsp;
                            <span><?php echo $Fuel; ?></span>
                        </li>
                        <li>
                            <i class="fa-solid fa-gears" style="color: #189cf4;"></i>&nbsp;&nbsp;
                            <span><?php echo $Transmission; ?></span>
                        </li>

                    </ul>
                    <div class="car__footer">
                        <span class="car__price">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            <?php
                            $price = $Car_hire_cost * $kms;
                            echo $price;
                            ?>
                        </span>

                        <?php
                        if ($_SESSION['loggedin'] == true) {
                            ?>
                            <a href="booking.php?id=<?= base64_encode($Registration_no); ?>&P=<?= base64_encode($price); ?>&city=<?= base64_encode($City); ?>" class="car__more">
                                <span>Rent now</span>
                            </a>
                            <?php
                        } else {
                            ?>
                            <a href="login.php?id=<?= base64_encode($Registration_no); ?>&P=<?= base64_encode($price); ?>&city=<?= base64_encode($City); ?>" class="car__more">
                                <span>Rent now</span>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
} else {
    echo "<script>alert('Not available car in this City');</script>";
    echo "<script>window.location.href='./index.php'</script>";
}
?>