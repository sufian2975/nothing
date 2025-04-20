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
