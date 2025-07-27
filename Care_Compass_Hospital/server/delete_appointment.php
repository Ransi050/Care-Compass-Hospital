<?php
include ('./DB_Connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];

    $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>
