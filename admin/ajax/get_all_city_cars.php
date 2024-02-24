<?php

// Replace with your database credentials
include '../databaseConnection.php';

// Query to fetch car data for all cities
$sql = "SELECT city.City AS city_name, COUNT(car.Registration_No) AS total_cars
        FROM city
        LEFT JOIN car ON city.City_Id = car.City_Id
        GROUP BY city.City";

$result = $conn->query($sql);

// Prepare the data to be sent as JSON
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cityName = $row['city_name'];
        $totalCars = $row['total_cars'];

        // Group car data by city name
        $data[] = array(
            'cityName' => $cityName,
            'totalCars' => $totalCars,
        );
    }
}

header('Content-Type: application/json');
echo json_encode($data);
?>
