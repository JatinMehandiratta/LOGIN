<?php
$host = "localhost";
$userName = "root";
$password = "java@123";
$dbName = "users";
// Create database connection
$conn = new mysqli($host, $userName, $password, $dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
