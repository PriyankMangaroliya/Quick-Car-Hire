<?php

include '../databaseConnection.php';

// Get the selected city from the form
$city_id = $_POST['city'];

$sql = "SELECT Registration_No, Name, Brand FROM car WHERE City_Id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $city_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Build the car options dynamically
echo "<option value=''>Select car</option>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['Registration_No'] . "'>" . $row['Name'] . "</option>";
}
?>
