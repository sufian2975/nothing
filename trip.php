<?php
$conn = new mysqli("localhost", "root", "", "wanderlust");

$name = $_POST['name'];
$start = $_POST['start_date'];
$end = $_POST['end_date'];
$duration = $_POST['duration'];
$people = $_POST['people'];

$stmt = $conn->prepare("INSERT INTO trips (name, start_date, end_date, duration, people) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $name, $start, $end, $duration, $people);

if ($stmt->execute()) {
    echo "added";
} else {
    echo "error";
}
?>



<?php
session_start(); // Required to access session variables

$conn = new mysqli("localhost", "root", "", "wanderlust");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming user is logged in and user_id is stored in session
$user_id = $_SESSION['user_id'];

$name = $_POST['name'];
$start = $_POST['start_date'];
$end = $_POST['end_date'];
$duration = $_POST['duration'];
$people = $_POST['people'];

$stmt = $conn->prepare("INSERT INTO trips (name, start_date, end_date, duration, people, user_id) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssii", $name, $start, $end, $duration, $people, $user_id);

if ($stmt->execute()) {
    echo "added";
} else {
    echo "error";
}

$stmt->close();
$conn->close();
?>
