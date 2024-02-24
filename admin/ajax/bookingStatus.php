<?php

include '../databaseConnection.php';

// Define the booking status values
$bookingStatuses = array('Pending', 'Current');

foreach ($bookingStatuses as $status) {
    $sql = "SELECT * FROM `booking` WHERE `Status` = '$status'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>$status Bookings</h2>";
        echo "<table border='1' class='table table-bordered'>
                <tr>
                    <th>Booking ID</th>
                    <th>Email</th>
                    <th>Registration No</th>
                    <th>City ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Booking_Id']}</td>
                    <td>{$row['Email']}</td>
                    <td>{$row['Registration_No']}</td>
                    <td>{$row['City_Id']}</td>
                    <td>{$row['Start_Date']}</td>
                    <td>{$row['End_Date']}</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<h2>No $status booking data available.</h2>";
    }
}

$conn->close();
?>
