<?php

include '../databaseConnection.php';

// Get the selected year from the query parameters
$selectedYear = $_GET['year'];

// Query to fetch monthly earnings data for the selected year
$sql = "SELECT MONTH(Booking_Date) AS Month, SUM(Total_Amount) AS Earnings FROM booking WHERE YEAR(Booking_Date) = $selectedYear GROUP BY MONTH(Booking_Date)";
$result = $conn->query($sql);

// Prepare data for the chart
$labels = [];
$earnings = [];

// Fetch data and populate arrays
while ($row = $result->fetch_assoc()) {
    $month = date('M', mktime(0, 0, 0, $row['Month'], 1));
    $labels[] = $month;
    $earnings[] = $row['Earnings'];
}

// Close the database connection
$conn->close();

// Create an array with the data
$data = [
    'labels' => $labels,
    'earnings' => $earnings,
];

// Send data as JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
