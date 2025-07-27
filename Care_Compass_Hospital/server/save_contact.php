<?php

include ('./DB_Connect.php');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];


$sql = "INSERT INTO contact_messages (first_name, last_name, email, phone, message) 
        VALUES ('$first_name', '$last_name', '$email', '$phone', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message Sent!";
} else {
    echo "Error: " . $con->error;
}

$conn->close();
?>
