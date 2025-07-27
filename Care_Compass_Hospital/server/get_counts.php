<?php
include ('./DB_Connect.php');

$response = [];

$tables = ["appointments", "contact_messages", "staff", "newsletters", "users"];

foreach ($tables as $table) {
    $sql = "SELECT COUNT(*) AS total FROM $table";
    $result = $conn->query($sql);
    
    if ($result) {
        $row = $result->fetch_assoc();
        $response[$table] = $row['total'];
    } else {
        $response[$table] = 0; 
    }
}

$conn->close();

echo json_encode($response); 
?>
