<?php
include ('./DB_Connect.php');

if (isset($_GET['service'])) {
    $service = $_GET['service'];

    
    $stmt = $conn->prepare("SELECT price FROM services WHERE name = ?");
    $stmt->bind_param("s", $service);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(["price" => $price]);
}
?>
