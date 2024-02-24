<?php

include '../databaseConnection.php';

// Query to fetch revenue data from the booking table
//$sql = "SELECT Status, SUM(Total_Amount) AS Revenue FROM booking GROUP BY Status";
$sql = "SELECT Status, COUNT(*) AS Revenue FROM booking GROUP BY Status";
$result = $conn->query($sql);

// Prepare data for the chart
$labels = [];
$revenue = [];
$backgroundColor = ['#4e73df', '#1cc88a', '#36b9cc']; // Predefined colors
$hoverBackgroundColor = ['#2e59d9', '#17a673', '#2c9faf']; // Predefined colors
// Fetch data and populate arrays
while ($row = $result->fetch_assoc()) {
    $labels[] = $row['Status'];
    $revenue[] = $row['Revenue'];
}

// Close the database connection
$conn->close();

// Create an array with the data
$data = [
    'labels' => $labels,
    'revenue' => $revenue,
    'backgroundColor' => $backgroundColor,
    'hoverBackgroundColor' => $hoverBackgroundColor,
];

// Send data as JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
