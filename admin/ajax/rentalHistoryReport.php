<?php
include '../databaseConnection.php';

$carId = $_POST['carSelect'];

$sql = "SELECT * FROM booking WHERE Registration_No = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $carId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {

    $report = "<table class='table table-bordered'>";

    $report .= "<tr><th>Booking ID</th><th>Email</th><th>Start Date</th><th>End Date</th><th>Total Cost</th></tr>";
    $total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $totalCost = $row['Total_Amount'];
        $report .= "<tr><td>{$row['Booking_Id']}</td><td>{$row['Email']}</td><td>{$row['Start_Date']}</td><td>{$row['End_Date']}</td><td>{$totalCost}</td></tr>";
    }

    $report .= "

<tr>
</table>";

// Return the report to the AJAX call
    echo $report;
} else {
    echo '<div class="alert alert-success" role="alert" style="margin-top:1rem; ">No records found!</div>';
}
?>

<td><?php
    echo $row["Total_Amount"];
    $total = $row["Total_Amount"] + $total;
    ?></td>