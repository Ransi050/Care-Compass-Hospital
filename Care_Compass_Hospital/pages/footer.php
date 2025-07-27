<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Css/footer.css">
    <script src="https://kit.fontawesome.com/8fe8067efd.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="footer">
        <div class="outf">
            <div class="fIn">
                <div class="footerIn">
                    <div class="c1">
                        <div>
                            <img src="../images/care.png" alt="">
                        </div>
                    </div>
                    <div class="c2">
                        <div>
                            <h3>Explore</h3>
                            <a href="https://labetalk.com/client/pages/about.php">
                                <li>Book Now</li>
                            </a>
                            <a href="https://labetalk.com/client/pages/about.php">
                                <li>Home</li>
                            </a>
                            <a href="https://labetalk.com/client/pages/contact.php">
                                <li>Packages</li>
                            </a>
                            <a href="https://labetalk.com/client/pages/addAd.php">
                                <li>Contact</li>
                            </a>
                        </div>
                    </div>
                    <div class="c3 socials">
                        <div>
                            <h3>Social</h3>
                            <ul>
                                <a href>
                                    <li><i class="fa-brands fa-facebook" style="color: #ffffff;"></i></li>
                                </a>
                                <a href>
                                    <li><i class="fa-brands fa-tiktok" style="color: #ffffff;"></i></li>
                                </a>
                                <a href>
                                    <li><i class="fa-brands fa-youtube" style="color: #ffffff;"></i></li>
                                </a>
                            </ul>
                        </div>
                    </div>
                    <div class="c4 newsletter">
                        <div>
                            <h3>Newsletter</h3>
                            <p>Subscribe for our newsletter for new ads</p>
                            <input type="email" name="mail" id="mail"> <br>
                            <button id="subscribeBtn">Subscribe</button>
                            <p id="newsletterMessage"></p>
                        </div>
                    </div>
                </div>
            </div>
            <p>© 2024 Care Compass. Made with <3 </p>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#subscribeBtn").click(function () {
                let email = $("#mail").val().trim();
                let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                if (!email) {
                    $("#newsletterMessage").text("Please enter your email.").css("color", "red");
                    return;
                }

                if (!emailPattern.test(email)) {
                    $("#newsletterMessage").text("Invalid email format.").css("color", "red");
                    return;
                }

                $.ajax({
                    url: "../server/save_newsletter.php",
                    type: "POST",
                    data: { email: email },
                    success: function (response) {
                        $("#newsletterMessage").text(response).css("color", "green");
                        $("#mail").val(""); 
                        setTimeout(() => {
                            $("#newsletterMessage").text("");
                        }, 3000);
                    },
                    error: function () {
                        $("#newsletterMessage").text("Error subscribing. Please try again.").css("color", "red");
                    }
                });
            });
        });
    </script>


</body>

</html>