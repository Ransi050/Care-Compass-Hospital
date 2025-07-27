<?php

include ('./DB_Connect.php');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT first_name, last_name, email, phone, message, submitted_at FROM contact_messages ORDER BY submitted_at DESC";
$result = $conn->query($sql);

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}


echo json_encode($messages);
?>
