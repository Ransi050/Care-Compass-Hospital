<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors and Staff</title>
    <link rel="stylesheet" href="../Css/staff.css">
    <link rel="stylesheet" href="../Css/about.css">
    
</head>

<body>
    <?php include './navBar.php' ?>

    <div class="banner">
        <h1>Meet Our Staff</h1>
        <button id="scrollButton">EXPLORE <i class="fa-solid fa-arrow-down"></i></button>
    </div>

    <div class="staff">
        <div class="description">
            <h1>Our Staff</h1>
            <p>At Care Compass Hospitals, our team of experts is the heart of everything we do.
                 Each department is led by highly skilled professionals who are dedicated to
                  providing top-notch medical care.</p>
        </div>

       
        <div class="members">

        <div class="card">
                <div class="cardIn">
                <div class="imgOut">
                        <div class="img">
                            <img src="../images/doctor1.avif" alt="">
                        </div>
                    </div>
                    <h2 class="card-name">Dr. John Doe</h2>
                            <div class="card-overlay">
                                <h2>Dr. John Doe</h2> 
                                <p>Cardiologist</p>
                                <p>MBBS, MD (Cardiology)</p>
                                <p>15+ Years</p>
                                <p>john@gmail.com</p>
                            </div>  
                </div>
            </div>
            <div class="card">
                <div class="cardIn">
                <div class="imgOut">
                        <div class="img">
                            <img src="../images/doctor3.jpg" alt="">
                        </div>
                    </div>
                    <h2 class="card-name">Dr. Sarah Lee</h2>
                            <div class="card-overlay">
                                <h2>Dr. Sarah Lee</h2> 
                                <p>Neurologist</p>
                                <p>MBBS, MD (Neurology)</p>
                                <p>12+ Years</p>
                                <p>sarah@gmail.com</p>
                            </div>  
                </div>
            </div>
            <div class="card">
                <div class="cardIn">
                <div class="imgOut">
                        <div class="img">
                            <img src="../images/doctor4.jpg" alt="">
                        </div>
                    </div>
                    <h2 class="card-name">Dr. Emily Carter</h2>
                            <div class="card-overlay">
                                <h2>Dr. Emily Carter</h2> 
                                <p>Pediatrician</p>
                                <p>MBBS, MD (Pediatrics)</p>
                                <p>5+ Years</p>
                                <p>emily@gmail.com</p>
                            </div>  
                </div>
            </div>
            <div class="card">
                <div class="cardIn">
                <div class="imgOut">
                        <div class="img">
                            <img src="../images/doctor2.jpg" alt="">
                        </div>
                    </div>
                    <h2 class="card-name">Dr. Michael Brown</h2>
                            <div class="card-overlay">
                                <h2>Dr. Michael Brown</h2> 
                                <p>Orthopedic Surgeon</p>
                                <p>MBBS, MS (Ortho)</p>
                                <p>10+ Years</p>
                                <p>michael@gmail.com</p>
                            </div>  
                </div>
            </div>
            <div class="card">
                <div class="cardIn">
                <div class="imgOut">
                        <div class="img">
                            <img src="../images/nurse2.jpg" alt="">
                        </div>
                    </div>
                    <h2 class="card-name">Ms. Anna Wilson</h2>
                            <div class="card-overlay">
                                <h2>Ms. Anna Wilson</h2> 
                                <p>Senior Nurse – ICU</p>
                                <p>MBBS, MD (Cardiology)</p>
                                <p>1+ Years</p>
                                <p>anna@gmail.com</p>
                            </div>  
                </div>
            </div>
            <div class="card">
                <div class="cardIn">
                <div class="imgOut">
                        <div class="img">
                            <img src="../images/nurse1.jpg" alt="">
                        </div>
                    </div>
                    <h2 class="card-name">Ms. Olivia Martinez</h2>
                            <div class="card-overlay">
                                <h2>Ms. Olivia Martinez</h2>
                                <p>Head of Nursing</p>
                                <p>12+ Years</p>
                                <p>Liam@gmail.com</p>
                            </div>  
                </div>
            </div>
        </div>
    </div>





    <script>
        $(document).ready(function () {
            $('#scrollButton').click(function () {
                $('html, body').animate({
                    scrollTop: $('.contactIn').offset().top
                }, 500); 
            });
        });

    </script>
    <?php include './footer.php' ?>

</body>

</html>