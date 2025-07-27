<?php
include('./DB_Connect.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $date = trim($_POST["date"]);
    $branch = trim($_POST["branch"]);
    $service = trim($_POST["service"]);

    // Server-side validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($date) || empty($branch) || empty($service)) {
        echo "error";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "error";
        exit();
    }

    if (!preg_match('/^\d{10}$/', $phone)) {
        echo "error";
        exit();
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO appointments (first_name, last_name, date, service, email, phone_number, branch ) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $firstName, $lastName, $date, $service, $email, $phone,  $branch);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>