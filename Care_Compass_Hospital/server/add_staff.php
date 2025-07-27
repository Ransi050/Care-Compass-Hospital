<?php
session_start();
include ('./DB_Connect.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $number = trim($_POST["number"]);
    $email = trim($_POST["email"]);
    $position = trim($_POST["position"]);
    $password = trim($_POST["password"]);

    if (empty($name) || empty($number) || empty($email) || empty($position) || empty($password)) {
        echo "All fields are required!";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit();
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO staff (name, number, email, position, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $number, $email, $position, $hashedPassword);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error adding staff!";
    }

    $stmt->close();
    $conn->close();
}
?>
