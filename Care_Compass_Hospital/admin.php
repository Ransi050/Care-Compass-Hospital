<!-- admin-login.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin and Staff Login</title>
    <link rel="stylesheet" href="./Css/admin.css">
</head>

<body>
    <div class="login-container">
        <h2> Login</h2>
        <input type="text" id="username" placeholder="E-mail">
        <input type="password" id="password" placeholder="Password">
        <button id="loginBtn">Login</button>
        <p id="error-msg"></p>
    </div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#loginBtn").click(function () {
                let username = $("#username").val().trim();
                let password = $("#password").val().trim();

                if (!username || !password) {
                    $("#error-msg").text("Please enter username and password.").css("color", "red");
                    return;
                }

                $.ajax({
                    url: "./server/admin_login.php",
                    type: "POST",
                    data: { username: username, password: password },
                    success: function (response) {
                        if (response.trim() === "success") {
                            window.location.href = "./pages/pannel.php"; // Redirect
                        } else {
                            $("#error-msg").text("Invalid credentials!").css("color", "red");
                        }
                    },
                    error: function () {
                        $("#error-msg").text("Error logging in. Please try again.").css("color", "red");
                    }
                });
            });
        });
    </script>
</body>

</html>