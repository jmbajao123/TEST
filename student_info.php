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
                        <div class="col-lg-7">
                            <center>
                                <img src="images/new.png" height="180" width="180">
                            </center>
                        </div>
                    </div>
                </div>
            </header>
            <section class="section-padding">
                <div class="container">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
                    <a href="index.php"><i class="fa fa-arrow-left"></i>
Back to Verification</a>
<div class="col-lg-12">
    <br>
</div>
                    <div class="row">
                        <div class="col-lg-12 col-12 text-center">

                            <h3 class="mb-4"><i class="bi bi-person"></i> Student Credentials</h3>
                        </div>
                        <div class="col-lg-8 mx-auto">
                            <div class="custom-block custom-block-topics-listing bg-white shadow-lg mb-5">
                               <?php
include 'conn.php';

if (isset($_GET['student_vcode'])) {
    $student_vcode = mysqli_real_escape_string($conn, $_GET['student_vcode']);

    // Fetch student information
    $query = "SELECT students.*, departments.department_name, course.course_name, 
                     students.province, students.municipality, students.barangay, students.street, students.date
              FROM students 
              LEFT JOIN departments ON students.d_id = departments.d_id 
              LEFT JOIN course ON students.c_id = course.c_id 
              WHERE students.student_vcode = '$student_vcode'";
    $result = mysqli_query($conn, $query);

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">';
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>';

    if (mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);

        $suffix_display = (!empty($student['suffix_name']) && strtolower($student['suffix_name']) !== "none") 
            ? " " . $student['suffix_name'] 
            : "";

        // Generate new student_vcode
        function generateCode($length = 8) {
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            return substr(str_shuffle($chars), 0, $length);
        }
        $new_code = generateCode();

        // Update student_vcode and reset sc_is_read to default (0)
        $update = "UPDATE students 
                   SET student_vcode = '$new_code', sc_is_read = 0, a_is_read = 0
                   WHERE student_vcode = '$student_vcode'";
        mysqli_query($conn, $update);

        // Display SweetAlert + Toastr notifications
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Student Found",
                text: "Student information retrieved successfully!",
                timer: 2000,
                showConfirmButton: false
            });

            let countdown = 10;
            let $toast = toastr.info("Redirecting to homepage in " + countdown + " seconds...", "Please wait", {
                timeOut: 0,
                extendedTimeOut: 0,
                tapToDismiss: false,
                closeButton: false,
                positionClass: "toast-top-right"
            });

            let interval = setInterval(() => {
                countdown--;
                if (countdown > 0) {
                    $toast.find(".toast-message").text("Redirecting to homepage in " + countdown + " seconds...");
                } else {
                    clearInterval(interval);
                    toastr.clear();

                    Swal.fire({
                        icon: "info",
                        title: "View Again",
                        text: "Please input the new Credentials Code to view the Student Credentials.",
                        timer: 3000,
                        showConfirmButton: false,
                        willClose: () => {
                            window.location.href = "index.php";
                        }
                    });
                }
            }, 1000);
        </script>';
        ?>

        <!-- Student Information -->
        <form class="p-3">
            <div class="col-lg-12">
                <div class="row">
                    <!-- <div class="col-lg-6">
                        <h5 class="mb-2">Credential Code</h5>
                        <span><?php echo htmlspecialchars($new_code); ?></span>
                    </div> -->
                    <div class="col-lg-6">
                        <h6></h6>
                    </div>
                    <div class="col-lg-6">
                        <h6 class="mb-2 text-success" style="float: right;">
                            <i class="fa fa-check text-success me-2"></i> 
                            <?php echo htmlspecialchars($student['student_status']); ?>
                        </h6>
                    </div>

                    <div class="col-lg-12 text-center mt-3">
                        <img src="uploads/<?php echo htmlspecialchars($student['profile']); ?>" 
                             alt="Profile" class="img-thumbnail" width="250" height="300" style="border-radius:10px;">
                    </div>

                    <div class="col-lg-12 mt-3">
                        <h5 class="mb-2">Student Information</h5>
                        <p><strong>Name:</strong> 
                            <?php echo htmlspecialchars($student['first_name'].' '.$student['middle_name'].' '.$student['last_name'].$suffix_display); ?>
                        </p>
                        <p><strong>Department:</strong> <?php echo htmlspecialchars($student['department_name']); ?></p>
                        <p><strong>Course:</strong> <?php echo htmlspecialchars($student['course_name']); ?></p>
                        <p><strong>Graduated:</strong> <?php echo htmlspecialchars($student['year_graduated']); ?></p>
                        <p><strong>Date of Graduation:</strong> 
                            <?php echo !empty($student['date_graduation']) ? date("F j, Y", strtotime($student['date_graduation'])) : 'N/A'; ?>
                        </p>
                        <div class="col-lg-12">
                            <i class="bi bi-calendar"></i>
                            <label>Issued Date :</label>
                            <span><?php echo !empty($student['date']) ? date("F j, Y", strtotime($student['date'])) : 'N/A'; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php
    } else {
        // No student found
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "No Data Found",
                text: "No student exists with the provided credentials code.",
                showConfirmButton: false,
                timer: 3000
            });

            let countdown = 10;
            let $toast = toastr.error("Redirecting to homepage in " + countdown + " seconds...", "Error", {
                timeOut: 0,
                extendedTimeOut: 0,
                tapToDismiss: false,
                closeButton: false,
                positionClass: "toast-top-right"
            });

            let interval = setInterval(() => {
                countdown--;
                if (countdown > 0) {
                    $toast.find(".toast-message").text("Redirecting to homepage in " + countdown + " seconds...");
                } else {
                    clearInterval(interval);
                    toastr.clear();
                    window.location.href = "index.php";
                }
            }, 1000);
        </script>';
    }
}

mysqli_close($conn);
?>




                            </div>
                        </div>
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

        <!-- <footer class="site-footer section-padding">
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
        </footer> -->


        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
