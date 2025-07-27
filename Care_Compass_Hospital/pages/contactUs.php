<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact US</title>
    <link rel="stylesheet" href="../Css/contact.css">
</head>

<body>


    <?php include 'navBar.php'; ?>

    <div class="msg">
        <p id="msgT"></p>
    </div>


    <div class="banner">
        <h1>Leave us a message</h1>
        <button id="scrollButton">EXPLORE <i class="fa-solid fa-arrow-down"></i></button>
    </div>
    <div class="branches">
        <h1>Our Branches</h1>
        <div class="bIn">
        <div class="box">
                <div class="content"><h1>Colombo</h1><p>0118 656 734</p></div>
            </div>
            <div class="box">
                <div class="content"><h1>Kandy</h1><p>0118 776 634</p></div>
            </div>
            <div class="box">
                <div class="content"><h1>Kurunegala</h1><p>0118 976 534</p></div>
            </div>
        </div>
    </div>
    <div class="contactForm">
        <div class="contactIn">
            <h1>Contact Us</h1>
            <div class="name">
                <div>
                    <label for="">First Name</label> <br>
                    <input type="text" name="" id="firstName">
                </div>
                <div>
                    <label for="">Last Name</label> <br>
                    <input type="text" name="" id="lastName">
                </div>
            </div>
            <label for="">Email Address</label> <br>
            <input type="email" name="" id="email"> <br>
            <label for="">Phone Number</label> <br>
            <input type="text" name="" id="phone"> <br>
            <label for="">Message</label> <br>
            <textarea name="" id="message"></textarea> <br>
            <label for="" id='error'></label>
            <button id="sendMessage">Send</button>

        </div>
    </div>
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.1439616854977!2d81.04935477588592!3d6.873348618997109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae4655a482cb9ef%3A0x5fcb6602f67d4ea3!2sTaxi%20service%20(Explore%20wagon)!5e0!3m2!1sen!2slk!4v1739332910094!5m2!1sen!2slk"
            width="100%" height="450px" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>



    <?php include 'footer.php'; ?>

    <script>

        $(document).ready(function () {
            $("#sendMessage").click(function () {

                $('#error').empty();

               
                var errors = [];

                let firstName = $("#firstName").val().trim();
                let lastName = $("#lastName").val().trim();
                let email = $("#email").val().trim();
                let phone = $("#phone").val().trim();
                let message = $("#message").val().trim();

               
                let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                let phonePattern = /^[0-9]+$/;

            
                if (!firstName || !lastName || !email || !phone || !message) {

                    errors.push('All fields are required!');
                }

                
                if (!emailPattern.test(email)) {
                    errors.push('Please enter a valid email address.');
                }

                
                if (!phonePattern.test(phone)) {
                    errors.push('Phone number should contain only numbers.');
                }

                if (errors.length > 0) {
                    errors.forEach(function (error) {
                        $('#error').append('<p>' + error + '</p>');
                    });
                } else {
                    
                    $.ajax({
                        url: "../server/save_contact.php",
                        type: "POST",
                        data: {
                            first_name: firstName,
                            last_name: lastName,
                            email: email,
                            phone: phone,
                            message: message
                        },
                        success: function (response) {
                            

                            $('#msgT').text('Successfully Sent!');
                            $('.msg').css('display', 'flex');
                            setTimeout(() => {
                                $('.msg').css('opacity', '0');
                                setTimeout(() => {
                                    $('.msg').css('display', 'none');
                                    $('.msg').css('opacity', '1');
                                }, 600);
                            }, 3000);

                            $("input, textarea").val("");
                        },
                        error: function () {
                            if (response == 'error') {
                                alert('Error')

                                $('#msgT').text('Something went wrong!');
                                $('.msg').css('background-color', 'rgb(255, 75, 75)');
                                $('.msg').css('display', 'flex');
                                setTimeout(() => {
                                    $('.msg').css('opacity', '0');
                                    setTimeout(() => {
                                        $('.msg').css('display', 'none');
                                    }, 600);
                                }, 3000);
                            }
                        }
                    });
                }
            });
        });


        $(document).ready(function () {
            $('#scrollButton').click(function () {
                $('html, body').animate({
                    scrollTop: $('.contactIn').offset().top
                }, 500); 
            });
        });

    </script>



</body>

</html>