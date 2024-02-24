<?php
// Replace with your database credentials
include '../design/databaseConnection.php';

// Get selected city from user input
$selected_city = $_POST['mySelectCity'];

// Prepare SQL query
$sql = "SELECT c.Registration_No, c.Name, COUNT(b.Booking_Id) AS total_bookings
        FROM car c
        LEFT JOIN booking b ON c.Registration_No = b.Registration_No
        WHERE c.City_Id = '$selected_city'
        GROUP BY c.Registration_No";

// Execute SQL query
$result = $conn->query($sql);

// Check if query returned any results
if ($result->num_rows > 0) {
    // Output table header
    ?>
    <table class='table' >
        <tr>
            <th scope="col">Car ID</th>
            <th scope="col">Car Name</th>
            <th scope="col">Total Bookings</th>
        </tr>

        <?php
        // Output table rows for each car
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['Registration_No'] . "</td><td>" . $row['Name'] . "</td><td>" . $row['total_bookings'] . "</td></tr>";
        }
        ?>

    </table>
    <?php
} else {
    echo '<div class="alert alert-success" role="alert" style="margin-top:1rem; ">No records found!</div>';
}

// Close database connection
$conn->close();
?>
