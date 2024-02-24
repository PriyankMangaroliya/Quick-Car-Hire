<?php

include "./databaseConnection.php";

$booking_id = base64_decode($_GET['Bid']);

//$cid = $_POST['booking_id'];

$sql9 = $conn->prepare("SELECT Total_Amount FROM booking WHERE Booking_Id = ?");
$sql9->bind_param("s", $booking_id);
$sql9->execute();
$totalamount1 = $sql9->get_result()->fetch_all(MYSQLI_ASSOC);
if (count($totalamount1) > 0) {
    foreach ($totalamount1 as $row) {
        $totalamount = $row['Total_Amount'];
    }
}

$charge = 500;
$refund = $totalamount - $charge;
$currentDate = date('Y-m-d');

$sql6 = $conn->prepare("INSERT INTO cancel_booking(Booking_Id, Cancellation_Date, Charge_Amount, Refund_Amount) VALUES (?,?,?,?)");
$sql6->bind_param("ssdd", $booking_id, $currentDate, $charge, $refund);
$sql6->execute();

if ($sql6 > 0) {
//    echo "<div class='alert alert-danger' role='alert'>Not Cancel Booking.</div>";
    echo "<script>window.location.href='./history.php'</script>";
} else {
    echo "<div class='alert alert-danger' role='alert'>Not Cancel Booking.</div>";
}
