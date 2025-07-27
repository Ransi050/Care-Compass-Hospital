<?php
include ('./DB_Connect.php');

header("Content-Type: application/json");

$sql = "SELECT id, first_name, last_name, email, phone_number, date, service, branch FROM appointments ORDER BY date DESC";
$result = $conn->query($sql);

$appointments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

echo json_encode($appointments);
$conn->close();
?>
