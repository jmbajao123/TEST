<?php ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Credentials Verifications</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="shortcut icon" href="images/cv.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/templatemo-topic-listing.css" rel="stylesheet">      
<!--

TemplateMo 590 topic listing

https://templatemo.com/tm-590-topic-listing

-->
    </head>
    
    <body id="top">

        <main>
        	<?php include 'Include/header.php'; ?>
            <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 mx-auto">
                            <h1 class="text-white text-center">Sign In Now</h1>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-3"><!-- empty space --></div>
                                    <div class="col-lg-6">
                                        <form action="sign_in_functions.php" method="post" class="p-4 border rounded shadow bg-white">
    <div class="row mb-3">
        <div class="col-lg-12 mb-3">
            <label for="s_gmail" class="form-label fw-bold h5">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope-fill"></i>
                </span>
                <input type="text" id="s_gmail" name="s_gmail" class="form-control" placeholder="Enter your email" required>
            </div>
        </div>

        <div class="col-lg-12 mb-3">
            <label for="password" class="form-label fw-bold h5">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
        </div>

        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-primary px-4">Sign In</button>
        </div>
    </div>
</form>

                                    </div>
                                    <div class="col-lg-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12"><br> </div>
                        <div class="col-lg-12"><br> </div>
                        <div class="col-lg-12"><br> </div>
                        <div class="col-lg-12"><br> </div>
                        <div class="col-lg-12"><br> </div>
                        <div class="col-lg-12"><br> </div>
                    </div>
                </div>
            </section>

            <section class="contact-section section-padding section-bg" id="section_5">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-5">Contact US</h2>
                        </div>

                        <div class="col-lg-5 col-12 mb-4 mb-lg-0">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.039254569972!2d122.58375407481856!3d7.785662992234166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3253d8f4002b2f89%3A0xf6c5683fa8d4e090!2sSibugay%20Technical%20Institute%20Incorporated!5e0!3m2!1sen!2sph!4v1744704239427!5m2!1sen!2sph" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12 mb-3 mb-lg- mb-md-0 ms-auto">
                            <h4 class="mb-3">Head office Location</h4>

                            <p>Philippines, Mindanao, Zamboanga Sibugay, Ipil, Lower Taway</p>

                            <hr>

                            <p class="d-flex align-items-center mb-1">
                                <span class="me-2">Phone</span>

                                <a href="tel: 305-240-9671" class="site-footer-link">
                                    305-240-9671
                                </a>
                            </p>

                            <p class="d-flex align-items-center">
                                <span class="me-2">Email</span>

                                <a href="#" class="site-footer-link">
                                    sibugaytech.edu.ph
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>


        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
