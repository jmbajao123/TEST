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
                               <?php
include 'conn.php';

// Retrieve student verification code from GET request
$student_vcode = $_GET['student_vcode'] ?? '';

// Default values
$default_values = [
    'student_status' => 'Unverified', 'full_name' => 'N/A', 'date_graduation' => 'N/A',
    'date_birth' => 'N/A', 'age' => 'N/A', 'gender' => 'N/A', 'honors' => 'N/A',
    'civil_status' => 'N/A', 'd_id' => '', 'c_id' => '', 'department_name' => 'N/A',
    'course_name' => 'N/A', 'address' => 'N/A', 'date' => 'N/A', 'profile' => 'default.png', 'diploma' => 'default.png', 'graduation' => 'default.png', 'tor' => 'default.png'
];

extract($default_values);

if (!empty(trim($student_vcode))) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_vcode = ?");
    $stmt->bind_param("s", $student_vcode);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        foreach ($default_values as $key => $default) {
            $$key = htmlspecialchars($row[$key] ?? $default);
        }

        // Construct full name
        $full_name = trim(
            htmlspecialchars($row['first_name'] ?? '') . ' ' .
            htmlspecialchars($row['middle_name'] ?? '') . ' ' .
            htmlspecialchars($row['last_name'] ?? '') .
            (!empty($row['suffix_name']) && $row['suffix_name'] !== 'None' ? ' ' . htmlspecialchars($row['suffix_name']) : '')
        );

        // Construct address
        $address = implode(', ', array_filter([
            htmlspecialchars($row['street'] ?? ''),
            htmlspecialchars($row['barangay'] ?? ''),
            htmlspecialchars($row['municipality'] ?? ''),
            htmlspecialchars($row['province'] ?? '')
        ]));

        // Profile image handling
        $profile = !empty($row['profile']) ? 'uploads/' . htmlspecialchars($row['profile']) : 'uploads/default.png';
        $diploma = !empty($row['diploma']) ? 'diploma/' . htmlspecialchars($row['diploma']) : 'diploma/default.png';
        $tor = !empty($row['tor']) ? 'TOR/' . htmlspecialchars($row['tor']) : 'TOR/default.png';
        $graduation = !empty($row['graduation']) ? 'Credentials/' . htmlspecialchars($row['graduation']) : 'Credentials/default.png';
    }
    $stmt->close();

    // Fetch department name
    if (!empty($d_id)) {
        $stmt = $conn->prepare("SELECT department_name FROM departments WHERE d_id = ?");
        $stmt->bind_param("s", $d_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $department_name = htmlspecialchars($row['department_name']);
        }
        $stmt->close();
    }

    // Fetch course name
    if (!empty($c_id)) {
        $stmt = $conn->prepare("SELECT course_name FROM course WHERE c_id = ?");
        $stmt->bind_param("s", $c_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $course_name = htmlspecialchars($row['course_name']);
        }
        $stmt->close();
    }
}
?>

<!-- Display Student Information -->
<form>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <h5 class="mb-2">Credentials Code</h5>
                <span><?php echo htmlspecialchars($student_vcode); ?></span>
            </div>
            <div class="col-lg-6">
                <h6 class="mb-2"><?php echo $student_status; ?></h6>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        <i class="bi bi-person"></i>
        <label>Student Information</label>
        <div class="col-lg-12"><br></div>
        <div class="row">
            <div class="col-lg-12">
                <center>
                    <label><h6 class="mb-2">Profile</h6></label>
                <br>
                <img src="<?php echo $profile; ?>" 
                     alt="Profile Picture" width="250" height="300" >
                </center>
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Full Name</h6></label><br>
                <span><?php echo $full_name; ?></span>
            </div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Graduation Date</h6></label><br>
                <span><?php echo !empty($date_graduation) ? date("F j, Y", strtotime($date_graduation)) : 'N/A'; ?></span>
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Birthdate</h6></label><br>
                <span><?php echo !empty($date_birth) ? date("F j, Y", strtotime($date_birth)) : 'N/A'; ?></span>
            </div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Department</h6></label><br>
                <span><?php echo $department_name; ?></span>
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Age</h6></label><br>
                <span><?php echo $age; ?></span>
            </div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Course</h6></label><br>
                <span><?php echo $course_name; ?></span>
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Gender</h6></label><br>
                <span><?php echo $gender; ?></span>
            </div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Honors</h6></label><br>
                <span><?php echo $honors; ?></span>
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Civil Status</h6></label><br>
                <span><?php echo $civil_status; ?></span>
            </div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Address</h6></label><br>
                <span><?php echo $address; ?></span>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        <i class="bi bi-calendar"></i>
        <label>Issued Date :</label>
        <span><?php echo !empty($date) ? date("F j, Y", strtotime($date)) : 'N/A'; ?></span>
        <div class="col-lg-12"><br></div>
        <div class="col-lg-12">
            <center>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed d-flex justify-content-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <span class="w-100 text-center">See More Credentials</span>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
    <form id="searchForm" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
    <div class="input-group input-group-lg shadow-sm">
        <span class="input-group-text bg-primary text-white">
            <i class="bi bi-search"></i>
        </span>
        <input name="student_id" type="search" class="form-control border-primary" id="student_id" 
               placeholder="Enter the Credentials Code" aria-label="Search" 
               oninput="validateNumberInput(this)">
        <button type="button" class="btn btn-primary" onclick="searchStudent()">Search</button>
    </div>
</form>

<div id="message" class="alert alert-danger mt-3" style="display: none;"></div>

<div id="studentData" class="col-lg-12" style="display: none;">
    <div class="row">
        <div class="col-lg-6">
            <label><h6 class="mb-2">Certificate of Diploma</h6></label>
            <br>
            <img id="diplomaImg" src="" alt="Certificate of Diploma" width="250" height="300">
        </div>
        <div class="col-lg-6">
            <label><h6 class="mb-2">Certificate of Graduation</h6></label>
            <br>
            <img id="graduationImg" src="" alt="Certificate of Graduation" width="250" height="300">
        </div>
        <div class="col-lg-12"><br></div>
        <div class="col-lg-6">
            <label><h6 class="mb-2">Transcript of Record (TOR)</h6></label>
            <br>
            <img id="torImg" src="" alt="Transcript of Record (TOR)" width="250" height="300">
        </div>
    </div>
</div>

<?php include 'conn.php'; ?>

<script>
function searchStudent() {
    var student_id = document.getElementById('student_id').value.trim();
    var messageDiv = document.getElementById('message');
    if (!/^[0-9]+$/.test(student_id)) {
        messageDiv.innerHTML = 'Invalid Student ID. Please enter numbers only.';
        messageDiv.style.display = 'block';
        document.getElementById('studentData').style.display = 'none';
        return;
    }

    <?php
    $query = "SELECT student_id FROM students";
    $result = $conn->query($query);
    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row['student_id'];
    }
    ?>

    var students = <?php echo json_encode($students); ?>;
    
    if (students.includes(student_id)) {
        document.getElementById('diplomaImg').src = "diploma/" + student_id + ".jpg";
        document.getElementById('graduationImg').src = "graduation/" + student_id + ".jpg";
        document.getElementById('torImg').src = "tor/" + student_id + ".jpg";
        document.getElementById('studentData').style.display = 'block';
        messageDiv.style.display = 'none';
    } else {
        messageDiv.innerHTML = 'Student ID is incorrect. No records found.';
        messageDiv.style.display = 'block';
        document.getElementById('studentData').style.display = 'none';
    }
}
</script>

<?php include 'scripts.php'; ?>




                            </div>
                        </div>
                    </div>
                </div>
            </center>

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
                            <h2 class="mb-5">Contact US</h2>
                        </div>

                        <div class="col-lg-5 col-12 mb-4 mb-lg-0">
                            <iframe class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2595.065641062665!2d-122.4230416990949!3d37.80335401520422!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858127459fabad%3A0x808ba520e5e9edb7!2sFrancisco%20Park!5e1!3m2!1sen!2sth!4v1684340239744!5m2!1sen!2sth" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
