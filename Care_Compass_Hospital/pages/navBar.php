<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nav Bar</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../js/login.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Poppins", serif;
        }

        .hamMenu {
            display: none;
            margin-right: 20px;
            margin-top: 15px;
        }

        .hamMenu img {
            width: 30px;
            height: 30px;
        }

        .contactBar {
            width: 100%;
            background-color: rgba(10, 97, 201, 1);
            color: white;
            z-index: 1000;
            padding: 15px;
        }

        .contactBar p {
            margin-left: 15px;
        }

        .contactBar a {
            text-decoration: none;
            color: white;
        }

        .navbar {
            display: flex;
            width: 100%;
            justify-content: space-between;
            padding: 15px 10px;
            background-color: whitesmoke;
            z-index: 1000;
        }

        .logo img {
            width: 150px;
            margin-left: 10px;
        }

        .nav-links {
            display: flex;
            list-style: none
        }

        .nav-links li {
            display: inline-block;
            position: relative;
            padding: 15px;
        }

        .nav-link {
            margin-right: 25px;
            margin-top: 15px;
        }

        .log button {
            background-color: transparent;
            border: 0px;
            cursor: pointer;
            color: white
        }

        .nav-links a {
            text-decoration: none;
            font-family: "Poppins", serif;
            font-weight: 500;
            color: black;
            transition: .5s;
            padding: 10px 10px;
        }

        .log a {
            background-color: rgba(10, 97, 201, 1);
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
        }

        .nav-links a:hover {
            background-color: rgba(10, 97, 201, 1);
            color: white;
            border-radius: 20px;
        }

        .aboutLink {
            border-radius: 10px 10px 0px 0px;
        }

        .nav-link .drop-down {
            list-style: none;
            display: none;
        }

        .aUs:hover .drop-down {
            display: block;
        }

        .aUs {
            position: relative;
        }

        .drop-down:hover {
            display: block;
        }

        .drop-down {
            position: absolute;
            display: none;
            width: 400px;
            margin-top: 23px;
            padding: 15px;
            top: 28px;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 1000;
        }

        .drop-down-grid a {
            color: black;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 3px;
        }

        .nav-link aUs:hover .drop-down {
            display: block;
        }


        .logInback {
            position: fixed;
            background-color: rgba(0, 0, 0, 0.41);
            z-index: 1999;
            width: 100vw;
            height: 100vh;
            top: 0px;
            display: none;
        }

        .reg {
            display: none;
        }

        .logIn {
            display: block;
        }

        .logIn,
        .reg {
            height: fit-content;
            width: 40%;
            background: white;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2000;
            padding: 20px;
            border-radius: 20px;
            position: relative;
        }

        .logInback h2 {
            margin-bottom: 15px;
            color: #0a61c9;
        }

        .logInback input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .logInback p {
            text-align: center;
            margin-top: 20px;
        }

        .logInback p a {
            color: #0a61c9;
            cursor: pointer;
        }

        .logInback button {
            width: 100%;
            padding: 10px;
            background: #0a61c9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .logInback button:hover {
            background: #084b9a;
        }

        #error-msgL,
        #error-msgR {
            color: red;
            margin-top: 0px;
            margin-bottom: 10px;
        }

        #close1,
        #close2 {
            position: absolute;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            background-color: red;
            right: 30px;
        }


        @media only screen and (max-width: 1050px) {
            .hamMenu {
                display: flex;
            }

            .links {
                display: none;
            }

        }
    </style>
</head>

<body>


    <div class="contactBar">
        <p>Ambulance <a href="tel: +9411 1236 000">+9411 1236 000</a></p>
    </div>

    <nav class="navbar">
        <div class="logo">
            <a href=""><img src="../images/care.png" alt="Care Compass"></a>
        </div>
        <div class="links">
            <ul class="nav-links">
                <li class="nav-link">
                    <a href="./home.php">Home</a>
                </li>
                <li class="nav-link aUs">
                    <a href="./services.php" class="aboutLink">Services</a>
                    <div class="drop-down">
                        <ul class="drop-down-grid">
                            <li><a href="./opd.php"> Outpatient Services (OPD)</a></li>
                            <li><a href="./chanelling.php"> Specialist Consultation & Channeling</a></li>
                            <li><a href="./lab.php"> Laboratory & Diagnostic Services</a></li>
                            <li><a href="./emergency.php"> Emergency & Ambulance Services</a></li>
                            <li><a href="./surg.php"> Surgical Services</a></li>
                            <li><a href="./maternity.php"> Maternity & Women’s Health Services</a></li>
                            <li><a href="./ipd.php"> Inpatient Services (IPD)</a></li>
                            <li><a href="./pnc.php"> Pediatric & Neonatal Care</a></li>
                            <li><a href="./mhc.php"> Mental Health & Counseling</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-link">
                    <a href="./about.php">About us</a>
                </li>
                <li class="nav-link">
                    <a href="./staff.php">Doctors & Staff</a>
                </li>
                <li class="nav-link">
                    <a href="./contactUs.php">Contact Us</a>
                </li>
                <li class="nav-link">
                    <a href="./appointment.php">Book an appointment</a>
                </li>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo " <li class='nav-link log'>
                    <a href='./profile.php'><button>Profile</button></a>
                </li>";
                } else {
                    echo " <li class='nav-link log'>
                    <a href='#' onclick='openP()'><button>Log In</button></a>
                </li>";
                }

                ?>

            </ul>
        </div>
        <div class="hamMenu">
            <img src="../images/menu.png" alt="">
        </div>
    </nav>

    <div class="logInback">

        <div class="logIn">
            <button id="close1" onclick="closeP()">X</button>
            <h2> Login</h2>
            <input type="email" id="lmail" placeholder="E-mail">
            <input type="password" id="lpassword" placeholder="Password">
            <p id="error-msgL"></p>
            <button id="loginBtn">Login</button>
            <p>Don't have an account? <a onclick="reg()">Register</a></p>

        </div>
        <div class="reg">
            <button id="close2" onclick="closeP()">X</button>
            <h2>Register</h2>
            <input type="text" id="name" placeholder="Name">
            <input type="text" id="phoneNum" placeholder="Phone number">
            <input type="email" id="rmail" placeholder="E-mail">
            <input type="password" id="rpassword" placeholder="Password">
            <input type="password" id="conpassword" placeholder=" Confirm Password">
            <p id="error-msgR"></p>
            <button id="regBtn">Register</button>
            <p>Already registeared? <a onclick="logIn()">Log In</a></p>

        </div>
    </div>

    <script>
        $(document).ready(function () {
            function isValidEmail(email) {
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            
            $("#loginBtn").click(function () {
                let email = $("#lmail").val().trim();
                let password = $("#lpassword").val().trim();

                if (!email || !password) {
                    $("#error-msgL").text("Please enter email and password.").css("color", "red");
                    return;
                }

                if (!isValidEmail(email)) {
                    $("#error-msgL").text("Invalid email format!").css("color", "red");
                    return;
                }

                $.ajax({
                    url: "../server/login.php",
                    type: "POST",
                    data: { email: email, password: password },
                    success: function (response) {
                        if (response.trim() === "success") {
                            window.location.href = "../pages/home.php"; 
                        } else {
                            $("#error-msgL").text("Invalid credentials!").css("color", "red");
                        }
                    },
                    error: function () {
                        $("#error-msgL").text("Error logging in. Please try again.").css("color", "red");
                    }
                });
            });

           
            $("#regBtn").click(function () {
                let name = $("#name").val().trim();
                let phone = $("#phoneNum").val().trim();
                let email = $("#rmail").val().trim();
                let password = $("#rpassword").val().trim();
                let confirmPassword = $("#conpassword").val().trim();

                if (!name || !phone || !email || !password || !confirmPassword) {
                    $("#error-msgR").text("All fields are required!").css("color", "red");
                    return;
                }

                if (!isValidEmail(email)) {
                    $("#error-msgR").text("Invalid email format!").css("color", "red");
                    return;
                }

                if (password !== confirmPassword) {
                    $("#error-msgR").text("Passwords do not match!").css("color", "red");
                    return;
                }

                $.ajax({
                    url: "../server/register.php",
                    type: "POST",
                    data: { name: name, phone: phone, email: email, password: password },
                    success: function (response) {
                        if (response.trim() === "success") {
                            logIn();
                        } else {
                            $("#error-msgR").text(response).css("color", "red");
                        }
                    },
                    error: function () {
                        $("#error-msgR").text("Error registering. Please try again.").css("color", "red");
                    }
                });
            });
        });

    </script>

</body>

</html>