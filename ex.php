<?php 
include 'conn.php';
?>
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
            <header class="site-header d-flex flex-column justify-content-center align-items-center">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-5 col-12">
                            <!-- <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Verification Results</li>
                                </ol>
                            </nav> -->

                            <h2 class="text-white">Verification Results</h2>
                        </div>

                    </div>
                </div>
            </header>
            <section class="section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center">
                            <h3 class="mb-4">Verification Results</h3>
                        </div>
                        <div class="col-lg-8 mx-auto">
                            <div class="custom-block custom-block-topics-listing bg-white shadow-lg mb-5">
                                        <form>
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <h5 class="mb-2">Credentials Code </h5>
                                                                <span class="mb-2"> 5433454</span>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <!-- <h5 class="mb-2">Status</h5> -->
                                                                <h6 class="mb-2"> Verified</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12"><br> </div>
                                                    <div class="col-lg-12"><br> </div>
                                                    <div class="col-lg-12">
                                                        <i class="bi bi-person"></i>
                                                        <label>Student Information</label>
                                                        <div class="row">
                                                            <div class="col-lg-12"><br> </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Full Name </h6>
                                                                </label><br>
                                                                <span>John Michael Bajao</span>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Graduation Date </h6>
                                                                </label><br>
                                                                <span>May 15, 2023</span>
                                                            </div>
                                                            <div class="col-lg-12"><br> </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Birthdate </h6>
                                                                </label><br>
                                                                <span>June 13, 2001</span>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Department </h6>
                                                                </label><br>
                                                                <span>College of Computer Studies</span>
                                                            </div>
                                                            <div class="col-lg-12"><br> </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Age </h6>
                                                                </label><br>
                                                                <span>23</span>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Course </h6>
                                                                </label><br>
                                                                <span>Bachelor of Science in Infortmation Technology</span>
                                                            </div>
                                                            <div class="col-lg-12"><br> </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Gender </h6>
                                                                </label><br>
                                                                <span>Male</span>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Honors </h6>
                                                                </label><br>
                                                                <span>Cum Laude</span>
                                                            </div>
                                                            <div class="col-lg-12"><br> </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Civil Status </h6>
                                                                </label><br>
                                                                <span>Single</span>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Address </h6>
                                                                </label><br>
                                                                <span>Zamboanga Sibugay, Olutanga, Fama, Purok 1</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12"><br> </div>
                                                        <div class="col-lg-12"><br> </div>
                                                        <i class="bi bi-building"></i>
                                                        <label>Institution Information</label>
                                                        <div class="row">
                                                            <div class="col-lg-12"><br></div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Institution Name</h6>
                                                                </label><br>
                                                                <span>Sibugay Technical Institute Incorporated</span>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>
                                                                    <h6 class="mb-2">Institution Location</h6>
                                                                </label><br>
                                                                <span>Lower Taway, Ipil, Zamboanga Sibugay</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12"><br> </div>
                                                        <div class="col-lg-12"><br> </div>
                                                        <i class="bi bi-calendar"></i>
                                                        <label>Issued Date :</label>
                                                        <span>May 20, 2026</span>
                                                        <div class="col-lg-12"><br></div>
                                                        <div class="col-lg-12"><br></div>
                                                        <div class="col-lg-12"><br></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            


            <section class="contact-section section-padding section-bg" id="section_5">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-5">Get in touch</h2>
                        </div>

                        <div class="col-lg-5 col-12 mb-4 mb-lg-0">
                            <iframe class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2595.065641062665!2d-122.4230416990949!3d37.80335401520422!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858127459fabad%3A0x808ba520e5e9edb7!2sFrancisco%20Park!5e1!3m2!1sen!2sth!4v1684340239744!5m2!1sen!2sth" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mb-3 mb-lg- mb-md-0 ms-auto">
                            <h4 class="mb-3">Head office</h4>

                            <p>Bay St &amp;, Larkin St, San Francisco, CA 94109, United States</p>

                            <hr>

                            <p class="d-flex align-items-center mb-1">
                                <span class="me-2">Phone</span>

                                <a href="tel: 305-240-9671" class="site-footer-link">
                                    305-240-9671
                                </a>
                            </p>

                            <p class="d-flex align-items-center">
                                <span class="me-2">Email</span>

                                <a href="mailto:info@company.com" class="site-footer-link">
                                    info@company.com
                                </a>
                            </p>
                        </div>

                        <div class="col-lg-3 col-md-6 col-12 mx-auto">
                            <h4 class="mb-3">Dubai office</h4>

                            <p>Burj Park, Downtown Dubai, United Arab Emirates</p>

                            <hr>

                            <p class="d-flex align-items-center mb-1">
                                <span class="me-2">Phone</span>

                                <a href="tel: 110-220-3400" class="site-footer-link">
                                    110-220-3400
                                </a>
                            </p>

                            <p class="d-flex align-items-center">
                                <span class="me-2">Email</span>

                                <a href="mailto:info@company.com" class="site-footer-link">
                                    info@company.com
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </section>
        </main>

<footer class="site-footer section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-12 mb-4 pb-2">
                        <a class="navbar-brand mb-2" href="index.html">
                            <i class="bi-back"></i>
                            <span>Topic</span>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6">
                        <h6 class="site-footer-title mb-3">Resources</h6>

                        <ul class="site-footer-links">
                            <li class="site-footer-link-item">
                                <a href="#" class="site-footer-link">Home</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#" class="site-footer-link">How it works</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#" class="site-footer-link">FAQs</a>
                            </li>

                            <li class="site-footer-link-item">
                                <a href="#" class="site-footer-link">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                        <h6 class="site-footer-title mb-3">Information</h6>

                        <p class="text-white d-flex mb-1">
                            <a href="tel: 305-240-9671" class="site-footer-link">
                                305-240-9671
                            </a>
                        </p>

                        <p class="text-white d-flex">
                            <a href="mailto:info@company.com" class="site-footer-link">
                                info@company.com
                            </a>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            English</button>

                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="button">Thai</button></li>

                                <li><button class="dropdown-item" type="button">Myanmar</button></li>

                                <li><button class="dropdown-item" type="button">Arabic</button></li>
                            </ul>
                        </div>

                        <p class="copyright-text mt-lg-5 mt-4">Copyright © 2048 Topic Listing Center. All rights reserved.
                        <br><br>Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a> Distribution <a href="https://themewagon.com">ThemeWagon</a></p>
                        
                    </div>

                </div>
            </div>
        </footer>


        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
