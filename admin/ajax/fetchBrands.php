<?php

// Your database connection code here
include '../databaseConnection.php';

// Get the selected city from the form
$city_id = $_POST['city'];

// Fetch car brands from the selected city
$sql = "SELECT DISTINCT Brand FROM car WHERE City_Id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $city_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Create and populate options for the brand dropdown
echo "<option value=''>Select Brand</option>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['Brand'] . "'>" . $row['Brand'] . "</option>";
}
?>
