<?php
include ('./DB_Connect.php');

$hashed_password = password_hash("admin123", PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);
$username = "admin@gmail.com";
$stmt->execute();
echo "Admin added successfully!";
?>
