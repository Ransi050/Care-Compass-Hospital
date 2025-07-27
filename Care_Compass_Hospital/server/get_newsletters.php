<?php

include ('./DB_Connect.php');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT email, subscribed_at FROM newsletters ORDER BY subscribed_at DESC";
$result = $conn->query($sql);

$newsletters = [];
while ($row = $result->fetch_assoc()) {
    $newsletters[] = $row;
}


echo json_encode($newsletters);
?>
