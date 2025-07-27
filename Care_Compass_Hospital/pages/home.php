<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../Css/home.css">
</head>

<body>
    <?php include 'navBar.php'; ?>


    <div class="container">
        <div class="carousel">

        </div>
        <div class="overlay">
            <div class="text">
                <h1>WELCOME TO CARE COMPASS HOSPITAL</h1>
                <p>Your Health is Our Priority!</p>

                <div class="searchOut">

                    <div class="searchbar">
                        <input type="text" id="serviceSearch" placeholder="Search for a service...">
                        <button id="searchButton"> <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg></button>
                        <div id="suggestions"></div>
                    </div>

                </div>

            </div>

        </div>
    </div>


    <div class="homeOut">
        <div class="title">Our Services</div>
        <div class="services">
            <div class="box">
                <h2>Outpatient Services (OPD)</h2>
                <p>Care Compass Hospitals provide Outpatient Department (OPD) services for
                    patients who need consultations with general physicians or specialists without hospitalization.</p>
                <a href="./odp.php">Explore>></a>
            </div>
            <div class="box">
                <h2>Specialist Consultation & Channeling</h2>
                <p>Patients can schedule appointments with specialist doctors, including
                    cardiologists, neurologists, dermatologists, and pediatricians, through an easy channeling system.
                </p>
                <a href="./chanelling.php">Explore>></a>
            </div>
            <div class="box">
                <h2>Laboratory & Diagnostic Services</h2>
                <p>The hospital provides a modern laboratory equipped with advanced technology
                    for blood tests, urine tests, and microbiology screenings.</p>
                <a href="./lab.php">Explore>></a>
            </div>
            <div class="box">
                <h2>Emergency & Ambulance Services</h2>
                <p>A 24/7 Emergency Department is available for critical medical situations
                    such as heart attacks, strokes, accidents, and trauma care.</p>
                <a href="./emergency.php">Explore>></a>
            </div>
            <div class="box">
                <h2>Surgical Services</h2>
                <p>Care Compass Hospitals offer general and specialized surgeries,
                    including orthopedic, ENT, cardiothoracic, laparoscopic, and cosmetic procedures.</p>
                <a href="./surg.php">Explore>></a>
            </div>
            <div class="box">
                <h2>Maternity & Women’s Health Services</h2>
                <p>The hospital provides comprehensive maternity care, including prenatal and
                    postnatal services, natural and C-section deliveries, and neonatal care.</p>
                <a href="./maternity.php">Explore>></a>
            </div>
        </div>


    </div>

    <div class="aboutsec">
        <div class="left">
            <div class="leftIn">
                <h1>National Reputation</h1>
                <p>Since 1892, we’ve been proud to play a part in Pasadena’s growth, health and vitality. For 131
                    years,
                    we’ve grown from a small 16-bed hospital to a nationally recognized health care provider. You
                    can
                    get the trusted care you need, when you need it with Huntington Health, an affiliate of
                    Cedars-Sinai.</p>
            </div>
        </div>
        <div class="right">
            <div class="rightIn">
                <div class="img">
                    <img src="../images/c.jpg" alt="">
                </div>
                <div class="img">
                    <img src="../images/cc.jpg" alt="">
                </div>
                <div class="img">
                    <img src="../images/bbb.jpg" alt="">
                </div>
                <div class="img">
                    <img src="../images/bb.webp" alt="">
                </div>
            </div>
        </div>
    </div>


    <?php include 'footer.php'; ?>


    <script>
        $(document).ready(function () {
            $("#serviceSearch").on("input", function () {
                let query = $(this).val();
                if (query.length > 1) { 
                    $.ajax({
                        url: "../server/search_service.php",
                        type: "GET",
                        data: { search: query },
                        success: function (data) {
                            $("#suggestions").html(data).fadeIn();
                        }
                    });
                } else {
                    $("#suggestions").fadeOut();
                }
            });

            
            $(document).on("click", function (e) {
                if (!$(e.target).closest("#serviceSearch, #suggestions").length) {
                    $("#suggestions").fadeOut();
                }
            });

           
            $("#searchButton").on("click", function () {
                let searchValue = $("#serviceSearch").val();
                if (searchValue.trim() !== "") {
                    window.location.href = `./services.php?query=${encodeURIComponent(searchValue)}`;
                }
            });
        });

        function selectService(service) {
            $("#serviceSearch").val(service);
            $("#suggestions").fadeOut();
        }
    </script>

</body>

</html>