<?php
session_start();
include ('./DB_Connect.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);


if (empty($username) || empty($password)) {
    echo "Please fill in all fields.";
    exit;
}


$stmt = $conn->prepare("SELECT id, email, password FROM staff WHERE email = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($staff_id, $email, $hashed_password);
$stmt->fetch();

if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
    $_SESSION['staff_id'] = $staff_id;
    $_SESSION['email'] = $email;  
    echo "success";
} else {
    echo "Invalid credentials!";
}

$stmt->close();
$conn->close();
?>
