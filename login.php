<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables if login is successful
            session_start();
            $_SESSION['user_id'] = $user['id'];
            echo "success";
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with this email.";
    }

    $conn->close();
}
?>
