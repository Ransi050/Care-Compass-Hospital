<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback and Reviews</title>
    <link rel="stylesheet" href="../Css/contact.css">
    <link rel="stylesheet" href="../Css/appoinment.css">
</head>

<body>
    <?php include 'navBar.php'; ?>

    <div class="msg">
        <p id="msgT"></p>
    </div>

    <div class="box">
        <div class="boxIn">
            <h1>Bookings</h1>
            <p>Make it easier and make it faster</p>
        </div>
    </div>

    <div class="checkout">
        <div class="checkoutIn">
            <img src="../images/Care.png" alt="Company Logo" class="logo"> 
            <h2>Payment</h2>
            <label for="service">Service:</label>

            <p id="serviceName"></p>

            <div class="price">
                <span>Total Price:</span>
                <strong id="price">$0</strong>
            </div>

            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </div>


    <div class="contactForm">
        <div class="contactIn">
            <h1>Book your appoinment</h1>
            <div class="name">
                <div>
                    <label for="firstName">First Name</label> <br>
                    <input type="text" id="firstName">
                    <span class="error" id="error-firstName"></span>
                </div>
                <div>
                    <label for="lastName">Last Name</label> <br>
                    <input type="text" id="lastName">
                    <span class="error" id="error-lastName"></span>
                </div>
            </div>
            <label for="email">Email Address</label> <br>
            <input type="email" id="email">
            <span class="error" id="error-email"></span> <br>

            <label for="phone">Phone Number</label> <br>
            <input type="text" id="phone">
            <span class="error" id="error-phone"></span> <br>

            <label for="date">Date</label> <br>
            <input type="date" id="date">
            <span class="error" id="error-date"></span> <br>

            <label for="branch">Branch:</label><br>
            <select id="branch">
                <option value="">Select a branch</option>
                <option value="Colombo">Colombo</option>
                <option value="Kandy">Kandy</option>
                <option value="Jaffna">Kurunegla</option>
            </select>
            <span class="error" id="error-branch"></span> <br>


            <label for="service">Service:</label><br>
            <select id="service">
                <option value="">Choose a service</option>
                <option value="Outpatient Services (OPD)">Outpatient Services (OPD)</option>
                <option value="Specialist Consultation & Channeling">Specialist Consultation & Channeling</option>
                <option value="Laboratory & Diagnostic Services">Laboratory & Diagnostic Services</option>
                <option value="Emergency & Ambulance Services">Emergency & Ambulance Services</option>
                <option value="Surgical Services">Surgical Services</option>
                <option value="Maternity & Women’s Health Services">Maternity & Women’s Health Services</option>
                <option value="Inpatient Services (IPD)">Inpatient Services (IPD)</option>
                <option value="Pediatric & Neonatal Care">Pediatric & Neonatal Care</option>
                <option value="Mental Health & Counseling">Mental Health & Counseling</option>
            </select>
            <span class="error" id="error-service"></span> <br>

            <button id="bookBtn">Book</button>
            <p id="success-msg" style="color: green;"></p>
            <p id="error-msg" style="color: green;"></p>

        </div>
    </div>

    <script>
        $(document).ready(function () {

            $('#service').on('change', function () {
                let selectedService = $(this).val(); 

                console.log(selectedService)

                if (selectedService) {
                    $.ajax({
                        url: "../server/get_service_price.php",
                        type: "GET",
                        data: { service: selectedService },
                        dataType: "json",
                        success: function (response) {
                            if (response.price) {
                                $('#price').text("$" + response.price); 
                            } else {
                                $('#price').text("$0"); 
                            }
                        },
                        error: function () {
                            $('#price').text("Error fetching price");
                        }
                    });
                } else {
                    $('#price').text("$0");
                }
            });


            $("#bookBtn").click(function () {
                let firstName = $("#firstName").val().trim();
                let lastName = $("#lastName").val().trim();
                let email = $("#email").val().trim();
                let phone = $("#phone").val().trim();
                let date = $("#date").val().trim();
                let branch = $("#branch").val().trim();
                let service = $("#service").val().trim();


                let isValid = true;

               
                $(".error").text("");

                
                if (firstName === "") {
                    $("#error-firstName").text("First name is required.");
                    isValid = false;
                }
                if (lastName === "") {
                    $("#error-lastName").text("Last name is required.");
                    isValid = false;
                }
                if (email === "" || !email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                    $("#error-email").text("Enter a valid email.");
                    isValid = false;
                }
                if (phone === "" || !phone.match(/^\d{10}$/)) {
                    $("#error-phone").text("Enter a valid 10-digit phone number.");
                    isValid = false;
                }
                if (date === "") {
                    $("#error-date").text("Date is required.");
                    isValid = false;
                }
                if (service === "") {
                    $("#error-service").text("Please select a service.");
                    isValid = false;
                }
                if (branch === "") {
                    $("#error-branch").text("Please select a branch."); 
                    isValid = false;
                }


                if (!isValid) return;

               
                $.ajax({
                    url: "../server/book_appointment.php",
                    type: "POST",
                    data: {
                        firstName: firstName,
                        lastName: lastName,
                        email: email,
                        phone: phone,
                        date: date,
                        branch: branch,
                        service: service
                    },
                    success: function (response) {
                        if (response.trim() === "success") {

                            $('.checkout').css('display', 'flex')
                            $('#serviceName').text(service)

                        } else {
                            $("#error-msg").text("Error booking appointment. Try again.");
                        }
                    },
                    error: function () {
                        $("#error-msg").text("Server error. Please try again.");
                    }
                });
            });
        });


        $('.checkout-btn').click(function () {
            $('.checkout').fadeOut()
            $('.checkout').css('display', 'none')
            success();
        })



        function success() {
            $('#msgT').text('Appointment booked successfully!');
            $('.msg').css('display', 'flex');
            setTimeout(() => {
                $('.msg').css('opacity', '0');
                setTimeout(() => {
                    $('.msg').css('display', 'none');
                    $('.msg').css('opacity', '1');
                }, 600);
            }, 3000);
            $("#firstName, #lastName, #email, #phone, #date, #service, #branch").val(""); 
        }

    </script>


    <?php include 'footer.php'; ?>

</body>

</html>