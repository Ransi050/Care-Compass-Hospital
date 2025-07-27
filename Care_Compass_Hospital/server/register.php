<?php
include "./DB_Connect.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = 'user';
    $image = '../images/profile.png';

    if (empty($name) || empty($phone) || empty($email) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo "Email already registered!";
        exit;
    }
    $stmt->close();

  
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password, role, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $phone, $email, $hashed_password, $role, $image);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Registration failed!";
    }
    $stmt->close();
    $conn->close();
}
?>
