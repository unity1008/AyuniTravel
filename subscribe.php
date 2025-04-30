<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "email_subscriptions";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<div class='alert alert-danger'>Database Connection Failed!</div>");
}

// Get email from AJAX request
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<div class='alert alert-danger'>Invalid email format!</div>";
} else {
    $stmt = $conn->prepare("INSERT INTO subscribers (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>You have successfully subscribed!</div>";
    } else {
        echo "<div class='alert alert-warning'>Email already subscribed!</div>";
    }

    $stmt->close();
}

$conn->close();
?>
