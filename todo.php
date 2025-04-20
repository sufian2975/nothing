<?php
include('db.php');

// Add a new to-do task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $trip_id = $_POST['trip_id'];

    $sql = "INSERT INTO todos (task, description, deadline, trip_id) VALUES ('$task', '$description', '$deadline', '$trip_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Display tasks
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_GET['user_id'];  // User ID, passed to get the user’s tasks

    $sql = "SELECT * FROM todos WHERE user_id = '$user_id' ORDER BY deadline ASC";
    $result = $conn->query($sql);

    $tasks = [];
    while ($row = $result->fetch_assoc()) {
        $tasks[] = $row;
    }

    // Check for upcoming deadlines and send notifications
    foreach ($tasks as $task) {
        $deadline = new DateTime($task['deadline']);
        $current_time = new DateTime();
        $interval = $current_time->diff($deadline);
        $hours_left = $interval->h + ($interval->days * 24);

        if ($hours_left <= 6) {
            // Send notification to user (or store it in the notifications table)
            $message = "Reminder: Task '{$task['task']}' is due in less than 6 hours!";
            // You can either display this message on the page or store it in a database for later use.
            echo "<div class='notification'>{$message}</div>";
        }
    }
}

$conn->close();
?>
