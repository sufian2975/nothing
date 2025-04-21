<?php
$host = "localhost";     // or 127.0.0.1
$username = "root";      // default username for XAMPP
$password = "";          // default password is empty
$database = "wanderlust";  // replace with your actual DB name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
