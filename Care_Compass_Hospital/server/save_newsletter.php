<?php

include ('./DB_Connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email = trim($_POST['email']);


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit;
}


$check = $conn->prepare("SELECT id FROM newsletters WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo "You are already subscribed!";
} else {
   
    $stmt = $conn->prepare("INSERT INTO newsletters (email, subscribed_at) VALUES (?, NOW())");
    $stmt->bind_param("s", $email);
    if ($stmt->execute()) {
        echo "Subscription successful!";
    } else {
        echo "Error subscribing.";
    }
    $stmt->close();
}

$check->close();
$conn->close();
?>
