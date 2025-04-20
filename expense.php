<?php
include('db.php');

// Add expense
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount'])) {
    $trip_id = $_POST['trip_id'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    $sql = "INSERT INTO expenses (trip_id, category, amount, date, description) VALUES ('$trip_id', '$category', '$amount', '$date', '$description')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Expense added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Display expenses
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $trip_id = $_GET['trip_id'];

    $sql = "SELECT * FROM expenses WHERE trip_id = '$trip_id'";
    $result = $conn->query($sql);

    $expenses = [];
    while ($row = $result->fetch_assoc()) {
        $expenses[] = $row;
    }

    echo json_encode($expenses);
}

$conn->close();
?>
