<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quickcarhire1";
error_reporting(0);
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
