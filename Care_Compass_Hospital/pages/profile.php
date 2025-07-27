<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ./home.php");
    exit();
}


include('../server/DB_Connect.php');


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

   
    $sql_user = "SELECT name, email, phone FROM users WHERE id = '$user_id'";
    $result_user = $conn->query($sql_user);

    if ($result_user->num_rows > 0) {
        $user_data = $result_user->fetch_assoc();
        $firstName = $user_data['name'];
        $email = $user_data['email'];
        $phone = $user_data['phone'];
    } else {
        
        echo "User not found.";
        exit();
    }

    
    $sql_medical = "SELECT disease, date, document FROM medical_records WHERE email = '$email'";
    $result_medical = $conn->query($sql_medical);
    $medical_records = [];

    if ($result_medical->num_rows > 0) {
        while ($row = $result_medical->fetch_assoc()) {
            $medical_records[] = $row;
        }
    } else {
        $medical_records = [];
    }

} else {
   
    echo "You need to log in first.";
    exit();
}

$conn->close();



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../Css/profile.css">
</head>

<body>

    <div class="container">

      
        <div class="sidebar">
            <h2>Dashboard</h2>
            <button onclick="showPanel('profile')">Profile</button>
            <button onclick="showPanel('medical')">Medical History</button>
            <button onclick="showPanel('lab')">Lab Reports</button>
            <a href="./home.php"> <button>Home</button></a>
            <button class="logout-btn" onclick="logout()" id="logOut">Log Out</button>

        </div>

       
        <div class="content">
            <div id="profile" class="panel active">
                <h2>Profile</h2>
                <div class="profile-pic">
                    <img src="../images/profile.png" alt="Profile Picture">
                </div>
                <p><strong>Name:</strong> <?php echo $firstName ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone:</strong> <?php echo $phone; ?></p>
            </div>

            <div id="medical" class="panel">
                <h2>Medical History</h2>
                <ul>
                    <?php
                    if (!empty($medical_records)) {
                        foreach ($medical_records as $record) {
                            echo "<li>" . $record['disease'] . " - " . $record['date'] . "</li>";
                        }
                    } else {
                        echo "<li>No medical records available.</li>";
                    }
                    ?>
                </ul>
            </div>

            <div id="lab" class="panel">
                <h2>Lab Reports</h2>
                <?php
                if (!empty($medical_records)) {
                    foreach ($medical_records as $record) {
                        if (!empty($record['document'])) {
                            $documentLink = "../reports/" . basename($record['document']);
                            echo "<a href='$documentLink' class='report-link'>" . basename($record['document']) . "</a><br>";
                        }
                    }
                } else {
                    echo "<p>No lab reports available.</p>";
                }
                ?>
            </div>
        </div>


    </div>

    <script src="../js/profile.js"></script>
</body>

</html>