<?php
session_start();
include 'conn.php';

if (isset($_SESSION['u_id'], $_SESSION['s_id'], $_SESSION['s_gmail'], $_SESSION['password'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Home - Credentials Verifications</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link href="assets/img/cv.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>
<body class="index-page">
  <?php include 'dash_header.php'; ?>
  <?php include 'student_vcode.php'; ?>
  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container">
        <div class="row gy-10 justify-content-center text-center">
          <div class="col-lg-12 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center">
            
            <?php
include "conn.php";

// Check if student is logged in
if (!isset($_SESSION['s_id'])) {
    echo "<div class='alert alert-danger'>You must log in to view this page.</div>";
    exit;
}

$s_id = intval($_SESSION['s_id']); // Securely get student ID from session

// Fetch student details with related course and department
$query = "
SELECT 
    s.s_id, s.first_name, s.middle_name, s.last_name, s.suffix_name, s.s_gmail, s.student_status, s.profile, s.date_birth, s.gender, s.civil_status, 
    s.street, s.barangay, s.municipality, s.province, s.student_vcode, s.student_id, s.year_graduated, s.date_graduation, s.honors,s.sg,
    c.course_name, d.department_name
FROM students s
LEFT JOIN course c ON s.c_id = c.c_id
LEFT JOIN departments d ON s.d_id = d.d_id
WHERE s.s_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $s_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();

    // Build full name
    $full_name = $student['first_name'];
    if (!empty($student['middle_name'])) $full_name .= ' ' . $student['middle_name'];
    $full_name .= ' ' . $student['last_name'];
    if (!empty($student['suffix_name']) && strtolower($student['suffix_name']) !== 'none') $full_name .= ' ' . $student['suffix_name'];

    // Profile image
    $profile = !empty($student['profile']) 
        ? htmlspecialchars($student['profile'])
        : "assets/images/default-profile.png";

    // Build full address
    $address = $student['street'] . ', ' . $student['barangay'] . ', ' . $student['municipality'] . ', ' . $student['province'];

    // Calculate age
    $age = '';
    if (!empty($student['date_birth'])) {
        $dob = new DateTime($student['date_birth']);
        $today = new DateTime();
        $age = $today->diff($dob)->y;
    }
?>

<div class="container">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-primary-subtle text-white">
                        <h1>My Profile</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Profile Image -->
                            <div class="col-lg-12 text-center mb-3">
                                <img src="<?php echo $profile; ?>" 
                                     alt="Profile Picture" 
                                     class="img-thumbnail" 
                                     >
                                <legend><strong>Profile Picture</strong></legend>
                            </div>
                            <div class="col-lg-12 text-center">
                            	<legend>
                            		<strong>
                            			<h2>Personal Information</h2>
                            		</strong>
                            	</legend>
                            	<br>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Full Name: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($full_name); ?></h4>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Date of Birth: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($student['date_birth']); ?></h4>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Age: </strong>
                            	</label>
                            	<h4><?php echo $age; ?></h4>
                            </div>
                            <div class="col-lg-12"><br></div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Gender: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($student['gender']); ?></h4>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Civil Status: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($student['civil_status']); ?></h4>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Address: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($address); ?></h4>
                            </div>
                            <div class="col-lg-12 text-center">
                            	<legend>
                            		<strong>
                            			<h2>Academic Information</h2>
                            		</strong>
                            	</legend>
                            	<br>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Student ID: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($student['student_id']); ?></h4>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Student Crendential Code: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($student['student_vcode']); ?></h4>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Course: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($student['course_name']); ?></h4>
                            </div>
                            <div class="col-lg-12"><br></div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Department: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($student['department_name']); ?></h4>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Year Graduated: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($student['year_graduated']); ?></h4>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Date of Graduation: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($student['date_graduation']); ?></h4>
                            </div>
                            <div class="col-lg-12"><br></div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Honors: </strong>
                            	</label>
                            	<h4><?php echo htmlspecialchars($student['honors']); ?></h4>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Status: </strong>
                            	</label>
                            	<h4>
                            		<?php echo htmlspecialchars($student['student_status']); ?>
                            	</h4>
                            </div>
                            <div class="col-lg-4">
                            	<label>
                            		<strong>Student Status: </strong>
                            	</label>
                            	<h4>
                            		<?php echo htmlspecialchars($student['sg']); ?>
                            	</h4>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
} else {
    echo "<div class='alert alert-warning'>No student record found.</div>";
}

$stmt->close();
$conn->close();
?>





          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->
  </main>
  <?php include 'footer.php'; ?>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<?php 
} else {
    header("Location: ../sign_in.php");
    exit();
}
?>