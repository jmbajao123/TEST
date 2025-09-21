<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['email']) && isset($_SESSION['a_id']) && ($_SESSION['password']) ) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Students List Rerports- Credentials Verification Sibugay Technical Institute Inc.</title>

  <!-- General CSS Files -->
  <link rel="shortcut icon" href="assets/img/s.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php include 'Include/header.php'; ?>
      <div class="main-sidebar sidebar-style-2">
        <?php include 'Include/side_bar.php'; ?>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Students List Rerports</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"> <a href="dashboard.php"> Dashboard </a> </div>
              <!-- <div class="breadcrumb-item"><a href="#">Department List</a></div> -->
              <div class="breadcrumb-item">Students List Rerports
              	
              </div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Students List Rerports
                <!-- <a href="st_print.php" style="float: right;" target="_blank" class="btn btn-outline-primary">Generate</a> -->
            </h2>
            <div class="col-lg-12">
                <div class="row">
                    
                </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <?php
include 'conn.php';

// Fetch all student records with department and course names
$query = "SELECT s.s_id, s.first_name, s.middle_name, s.last_name, s.suffix_name, s.profile, s.student_status, 
                 d.department_name, c.course_name
          FROM students s
          LEFT JOIN departments d ON s.d_id = d.d_id
          LEFT JOIN course c ON s.c_id = c.c_id";

$result = mysqli_query($conn, $query);
?>

<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-striped table-md">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Student Profile Picture</th>
                    <th>Department</th>
                    <th>Course</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0) :
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) :
                        $fullName = trim("{$row['first_name']} {$row['middle_name']} {$row['last_name']}");
                        if (!empty($row['suffix_name']) && strtolower($row['suffix_name']) !== "none") {
                            $fullName .= " " . $row['suffix_name'];
                        }
                ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><?= htmlspecialchars($fullName) ?></td>
                            <td>
                               <center>
                                    <?php if (!empty($row['profile'])): ?>
                                    <img src="<?= htmlspecialchars($row['profile']) ?>" alt="Profile Picture" width="80" height="80" class="rounded-circle">
                                <?php else: ?>
                                    <span>No Profile Picture</span>
                                <?php endif; ?>
                               </center>
                            </td>
                            <td><?= htmlspecialchars($row['department_name'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($row['course_name'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($row['student_status']) ?></td>
                        </tr>
                <?php
                        $count++;
                    endwhile;
                else : ?>
                    <tr>
                        <td colspan="6" class="text-center">No Student Records Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
mysqli_close($conn);
?>


                </div>
              </div>
            </div>
            
            
          </div>
        </section>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Students</h5>
            </div>
            <div class="modal-body">
                <form method="post" action="student.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label><h6>First Name</h6></label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Middle Name</h6></label>
                                <input type="text" name="middle_name" class="form-control" placeholder="Enter Middle Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Last Name</h6></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Suffix Name</h6></label>
                                <select class="form-control" name="suffix_name" required>
                                    <option selected disabled>Choose a Suffix</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Date of Birth</h6>
                                </label>
                                <input type="date" name="date_birth" id="date_birth" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Age</h6>
                                </label>
                                <input type="number" name="age" id="age" class="form-control" readonly>
                            </div>
                            <?php include 'date_age.php'; ?>
                            <div class="col-lg-3">
                                <label><h6>Gender</h6></label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option selected disabled>Choose a Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Civil Status</h6></label>
                                <select class="form-control" name="civil_status" id="civil_status" required>
                                    <option selected disabled>Choose a Civil Status</option>
                                    <option value="Married">Married</option>
                                    <option value="Single">Single</option>
                                    <option value="Divorce">Divorce</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Province</h6>
                                </label>
                                <input type="text" name="province" id="province" class="form-control" placeholder="Input the Provice Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Municipality</h6>
                                </label>
                                <input type="text" name="municipality" id="province" class="form-control" placeholder="Input the Municipality Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Barangay</h6>
                                </label>
                                <input type="text" name="barangay" id="barangay" class="form-control" placeholder="Input the Barangay Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Street</h6>
                                </label>
                                <input type="text" name="street" id="street" class="form-control" placeholder="Input the Provice Name" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label><h6>Student ID</h6></label>
                                <input type="number" name="student_id" id="student_id" class="form-control" placeholder="Enter Student ID" required oninput="generateVCode()">
                            </div>

                            <div class="col-lg-3">
                                <label><h6>Student Verification Code</h6></label>
                                <input type="number" name="student_vcode" id="student_vcode" class="form-control" placeholder="Verification Code" readonly>
                            </div>

                            <script>
                                function generateVCode() {
                                    let studentId = document.getElementById("student_id").value;
                                    let vCodeField = document.getElementById("student_vcode");

                                    if (studentId.length > 0) {
                                        let verificationCode = Math.floor(100000 + Math.random() * 900000); // 6-digit random number
                                        vCodeField.value = verificationCode;
                                    } else {
                                        vCodeField.value = "";
                                    }
                                }
                            </script>
                            <?php
                                include 'conn.php';
                                $deptQuery = "SELECT d_id, department_name FROM departments WHERE department_status = 'Active'";
                                $deptResult = mysqli_query($conn, $deptQuery);
                                
                                $courseQuery = "SELECT c_id, course_name, d_id FROM course WHERE course_status = 'Active'";
                                $courseResult = mysqli_query($conn, $courseQuery);
                                
                                $courses = [];
                                while ($row = mysqli_fetch_assoc($courseResult)) {
                                    $courses[$row['d_id']][] = [
                                        'c_id' => $row['c_id'],
                                        'course_name' => $row['course_name']
                                    ];
                                }
                                mysqli_close($conn);
                            ?>

                            <div class="col-lg-3">
                                <label><h6>Department Name</h6></label>
                                <select class="form-control" name="d_id" id="d_id" onchange="filterCourses()">
                                    <option selected disabled>Choose a Department</option>
                                    <?php while ($row = mysqli_fetch_assoc($deptResult)) { ?>
                                        <option value="<?= $row['d_id'] ?>"><?= htmlspecialchars($row['department_name']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <label><h6>Course Name</h6></label>
                                <select class="form-control" name="c_id" id="c_id">
                                    <option selected disabled id="defaultOption">Choose a Course</option>
                                    <?php foreach ($courses as $d_id => $courseList) { ?>
                                        <?php foreach ($courseList as $course) { ?>
                                            <option value="<?= $course['c_id'] ?>" data-dept="<?= $d_id ?>" style="display: none;">
                                                <?= htmlspecialchars($course['course_name']) ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <script>
                                function filterCourses() {
                                    var selectedDept = document.getElementById("d_id").value;
                                    var courseDropdown = document.getElementById("c_id");
                                    var options = courseDropdown.getElementsByTagName("option");
                                    var defaultOption = document.getElementById("defaultOption");

                                    courseDropdown.value = "";
                                    defaultOption.style.display = "block";
                                    defaultOption.selected = true;

                                    for (var i = 1; i < options.length; i++) {
                                        if (options[i].getAttribute("data-dept") === selectedDept) {
                                            options[i].style.display = "block";
                                        } else {
                                            options[i].style.display = "none";
                                        }
                                    }
                                }
                            </script>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label><h6>School Year Graduated</h6></label>
                                <input type="text" name="year_graduated" id="year_graduated" class="form-control" placeholder="Input the Year Graduated" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Date of  Graduation</h6></label>
                                <input type="date" name="date_graduation" id="date_graduation" class="form-control" placeholder="Input the Date of Graduation" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Profile</h6>
                                </label>
                                <input type="file" name="profile" id="profile" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Honors</h6>
                                </label>
                                <input type="text" name="honors" id="honors" class="form-control" placeholder="Input the Honors Name" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Instituional Name</h6>
                                </label>
                                <input type="text" name="institutional_name" id="institutional_name" class="form-control" placeholder="Input the Instituional Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Institutional Location</h6>
                                </label>
                                <input type="text" name="ins_lo" id="ins_lo" class="form-control" placeholder="Input the Location of Instituional" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Certificate of Diploma</h6>
                                </label>
                                <input type="file" name="diploma" id="diploma" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Certificate of Graduation</h6>
                                </label>
                                <input type="file" name="graduation" id="graduation" class="form-control" required>
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Transcipt of Records (TOR)</h6>
                                </label>
                                <input type="file" name="tor" id="tor" class="form-control" required>
                            </div>
                            <div class="col-lg-4">
                                <label><h6>Status</h6></label>
                                <select class="form-control" name="student_status">
                                    <option selected disabled>Select Status</option>
                                    <option value="Verified">Verified</option>
                                    <option value="Not Verified">Not Verified</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
      <?php
include 'conn.php';

// Handle file upload function (move it above where it's used)
function handleFileUpload($fileInputName, $folderName) {
    $targetDir = $folderName . '/'; // Specify folder based on file type
    $targetFile = $targetDir . basename($_FILES[$fileInputName]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file is a valid image or document
    if (isset($_FILES[$fileInputName])) {
        $check = getimagesize($_FILES[$fileInputName]["tmp_name"]);
        if ($check === false) { // If not an image, allow documents
            $uploadOk = 1;
        }
    }

    // Check file size
    if ($_FILES[$fileInputName]["size"] > 5000000) { // Limit to 5MB
        $uploadOk = 0;
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'File Too Large',
                text: 'The file is too large. Maximum allowed size is 5MB.',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    // Allow only specific file formats (e.g., jpg, jpeg, png, pdf, docx)
    if ($fileType != "jpg" && $fileType != "jpeg" && $fileType != "png" && $fileType != "pdf" && $fileType != "docx") {
        $uploadOk = 0;
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid File Format',
                text: 'Only JPG, JPEG, PNG, PDF, and DOCX files are allowed.',
                confirmButtonText: 'OK'
            });
        </script>";
    }

    // If all checks pass, upload the file
    if ($uploadOk == 0) {
        return "";
    } else {
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            return "";
        }
    }
}

// Start session and check if admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'Session Expired!',
            text: 'Please log in again.',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.href='login.php';
        });
    </script>";
    exit();
}

$a_id = $_SESSION['a_id']; // Logged-in admin ID

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>"; // Include SweetAlert

    // Required fields validation
    $required_fields = ['d_id', 'c_id', 'first_name', 'middle_name', 'last_name', 'suffix_name', 'student_id', 'student_vcode', 
                        'student_status', 'date_birth', 'age', 'gender', 'civil_status', 'province', 'municipality', 
                        'barangay', 'street', 'year_graduated', 'date_graduation', 'honors', 'institutional_name', 'ins_lo'];

    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Fields',
                    text: 'Please fill in all required fields.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            </script>";
            exit();
        }
    }

    // Sanitize inputs
    function sanitize($data) {
        global $conn;
        return mysqli_real_escape_string($conn, trim($data));
    }

    $d_id = sanitize($_POST['d_id']);
    $c_id = sanitize($_POST['c_id']);
    $first_name = sanitize($_POST['first_name']);
    $middle_name = sanitize($_POST['middle_name']);
    $last_name = sanitize($_POST['last_name']);
    $suffix_name = sanitize($_POST['suffix_name']);
    $student_id = sanitize($_POST['student_id']);
    $student_vcode = sanitize($_POST['student_vcode']);
    $student_status = sanitize($_POST['student_status']);
    $date_birth = sanitize($_POST['date_birth']);
    $age = sanitize($_POST['age']);
    $gender = sanitize($_POST['gender']);
    $civil_status = sanitize($_POST['civil_status']);
    $province = sanitize($_POST['province']);
    $municipality = sanitize($_POST['municipality']);
    $barangay = sanitize($_POST['barangay']);
    $street = sanitize($_POST['street']);
    $year_graduated = sanitize($_POST['year_graduated']);
    $date_graduation = sanitize($_POST['date_graduation']);
    $honors = sanitize($_POST['honors']);
    $institutional_name = sanitize($_POST['institutional_name']);
    $ins_lo = sanitize($_POST['ins_lo']);

    // Handle file uploads with folder names
    $profile = handleFileUpload('profile', 'uploads');
    $diploma = handleFileUpload('diploma', 'diploma');
    $graduation = handleFileUpload('graduation', 'Credentials');
    $tor = handleFileUpload('tor', 'TOR');

    // Get current date
    $date = date('Y-m-d'); // Current date in YYYY-MM-DD format

    // Insert student data into the database with file paths and the current date
    $sql = "INSERT INTO students (d_id, c_id, first_name, middle_name, last_name, suffix_name, student_id, student_vcode, 
            student_status, date_birth, age, gender, civil_status, province, municipality, barangay, street, 
            year_graduated, date_graduation, a_id, profile, diploma, graduation, tor, honors, institutional_name, ins_lo, date) 
            VALUES ('$d_id', '$c_id', '$first_name', '$middle_name', '$last_name', '$suffix_name', '$student_id', '$student_vcode', 
                    '$student_status', '$date_birth', '$age', '$gender', '$civil_status', '$province', '$municipality', 
                    '$barangay', '$street', '$year_graduated', '$date_graduation', '$a_id', '$profile', '$diploma', '$graduation', '$tor', '$honors', '$institutional_name', '$ins_lo', '$date')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Credentials Student!',
                text: 'Credentials of student added successfully.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href='student.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Database Error',
                text: 'Error: " . mysqli_error($conn) . "',
                confirmButtonText: 'OK'
            }).then(() => {
                window.history.back();
            });
        </script>";
    }

    mysqli_close($conn);
}
?>



    

		  </div>
		</div>
      </div>
      <?php include 'Include/footer.php'; ?>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/jquery-ui/jquery-ui.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/components-table.js"></script>
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>

<?php 
}else{
    header("Location: index.php");
    exit();
}

?>