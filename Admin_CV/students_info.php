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
  <title>Students Informations- Credentials Verification Sibugay Technical Institute Inc.</title>

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
            <h1>Students Information</h1>
          </div>
          
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="col-lg-12">
                  <div class="row">
                    <?php
// Assuming you have a database connection already established

// Check if s_id is provided in the URL
if (isset($_GET['s_id'])) {
    $s_id = $_GET['s_id'];

    // Fetch student data from the database
    $sql = "SELECT * FROM students WHERE s_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $s_id); // 'i' indicates the parameter type (integer)
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a record is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Fetch department name using d_id from department table
        $d_id = $row['d_id']; // Department ID
        $sql_department = "SELECT department_name FROM departments WHERE d_id = ?";
        $stmt_department = $conn->prepare($sql_department);
        $stmt_department->bind_param("i", $d_id);
        $stmt_department->execute();
        $result_department = $stmt_department->get_result();
        
        if ($result_department->num_rows > 0) {
            $department_row = $result_department->fetch_assoc();
            $department_name = $department_row['department_name'];
        } else {
            $department_name = "Department not found.";
        }

        // Fetch course name using c_id from course table
        $c_id = $row['c_id']; // Course ID
        $sql_course = "SELECT course_name FROM course WHERE c_id = ?";
        $stmt_course = $conn->prepare($sql_course);
        $stmt_course->bind_param("i", $c_id);
        $stmt_course->execute();
        $result_course = $stmt_course->get_result();
        
        if ($result_course->num_rows > 0) {
            $course_row = $result_course->fetch_assoc();
            $course_name = $course_row['course_name'];
        } else {
            $course_name = "Course not found.";
        }
    } else {
        echo "No student found.";
        exit;
    }
}
?>

<form method="post" action="#">
    <div class="col-lg-12">
        <div class="row">
            <center>
                <div class="col-lg-3">
                    <label>
                        <h6>Profile</h6>
                    </label><br>
                    <img src="<?php echo $row['profile'] ?? ''; ?>" alt="Profile Picture" class="rounded-circle" width="200" height="200">
                </div>
            </center>

            <div class="col-lg-12">
                <br>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>First Name</h6>
                </label>
                <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($row['first_name'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Middle Name</h6>
                </label>
                <input type="text" name="middle_name" class="form-control" value="<?php echo htmlspecialchars($row['middle_name'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Last Name</h6>
                </label>
                <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($row['last_name'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Suffix Name</h6>
                </label>
                <select class="form-control" name="suffix_name" disabled>
                    <option value="">Choose a Suffix Name</option>
                    <option value="Jr" <?php echo ($row['suffix_name'] ?? '' == 'Jr') ? 'selected' : ''; ?>>Jr</option>
                    <option value="Sr" <?php echo ($row['suffix_name'] ?? '' == 'Sr') ? 'selected' : ''; ?>>Sr</option>
                    <option value="III" <?php echo ($row['suffix_name'] ?? '' == 'III') ? 'selected' : ''; ?>>III</option>
                    <option value="IV" <?php echo ($row['suffix_name'] ?? '' == 'IV') ? 'selected' : ''; ?>>IV</option>
                    <option value="V" <?php echo ($row['suffix_name'] ?? '' == 'V') ? 'selected' : ''; ?>>V</option>
                    <option value="None" <?php echo ($row['suffix_name'] ?? '' == 'None') ? 'selected' : ''; ?>>None</option>
                </select>
            </div>

            

            <div class="col-lg-12">
                <br>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Birthdate</h6>
                </label>
                <input type="text" name="date_birth" class="form-control" value="<?php echo htmlspecialchars($row['date_birth'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Age</h6>
                </label>
                <input type="text" name="age" class="form-control" value="<?php echo htmlspecialchars($row['age'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Gender</h6>
                </label>
                <input type="text" name="gender" class="form-control" value="<?php echo htmlspecialchars($row['gender'] ?? ''); ?>" readonly>
                
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Civil Status</h6>
                </label>
                <input type="text" name="civil_status" class="form-control" value="<?php echo htmlspecialchars($row['civil_status'] ?? ''); ?>" readonly>
            </div>

            <div class="col-lg-12">
                <br>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Province</h6>
                </label>
                <input type="text" name="province" class="form-control" value="<?php echo htmlspecialchars($row['province'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Municipality</h6>
                </label>
                <input type="text" name="municipality" class="form-control" value="<?php echo htmlspecialchars($row['municipality'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Barangay</h6>
                </label>
                <input type="text" name="barangay" class="form-control" value="<?php echo htmlspecialchars($row['barangay'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Purok/Street</h6>
                </label>
                <input type="text" name="street" class="form-control" value="<?php echo htmlspecialchars($row['street'] ?? ''); ?>" readonly>
            </div>

            <div class="col-lg-12">
                <br>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Student ID</h6>
                </label>
                <input type="text" name="student_id" class="form-control" value="<?php echo htmlspecialchars($row['student_id'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Student Verification Code</h6>
                </label>
                <input type="text" name="student_vcode" class="form-control" value="<?php echo htmlspecialchars($row['student_vcode'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>School Year Graduated</h6>
                </label>
                <input type="text" name="year_graduated" class="form-control" value="<?php echo htmlspecialchars($row['year_graduated'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Date of Graduation</h6>
                </label>
                <input type="text" name="date_graduation" class="form-control" value="<?php echo htmlspecialchars($row['date_graduation'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-12">
              <br>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Honors</h6>
                </label>
                <input type="text" name="honors" class="form-control" value="<?php echo htmlspecialchars($row['honors'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Department</h6>
                </label>
                <input type="text" name="department_name" class="form-control" value="<?php echo htmlspecialchars($department_name ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Course</h6>
                </label>
                <input type="text" name="course_name" class="form-control" value="<?php echo htmlspecialchars($course_name ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Status</h6>
                </label>
                <select class="form-control" name="status" disabled>
                    <option value="Verified" <?php echo ($row['status'] ?? '' == 'Verified') ? 'selected' : ''; ?>>Verified</option>
                    <option value="Not Verified" <?php echo ($row['status'] ?? '' == 'Not Verified') ? 'selected' : ''; ?>>Not Verified</option>
                </select>
            </div>
            <div class="col-lg-12">
              <br>
            </div>
            <div class="col-lg-4">
                <label>
                    <h6>Certificate of Diploma</h6>
                </label><br>
                <img src="<?php echo $row['diploma'] ?? ''; ?>" alt="Certificate of Diploma" class="rounded-circle" width="200" height="200">
            </div>
            <div class="col-lg-4">
                <label>
                    <h6>Certificate of Graduation</h6>
                </label><br>
                <img src="<?php echo $row['graduation'] ?? ''; ?>" alt="Certificate of Graduation" class="rounded-circle" width="200" height="200">
            </div>
            <div class="col-lg-4">
                <label>
                    <h6>Transcipt of Records (TOR)</h6>
                </label><br>
                <img src="<?php echo $row['tor'] ?? ''; ?>" alt="Transcipt of Records (TOR" class="rounded-circle" width="200" height="200">
            </div>
            <div class="col-lg-12">
                <br>
            </div>
            <div class="col-lg-12">
                <a href="student.php" class="btn btn-outline-secondary">Back</a>
                <a href="up_students.php?s_id=<?php echo htmlspecialchars($row['s_id']); ?>" class="btn btn-outline-primary" style="float: right;">Update</a>
            </div>
        </div>
    </div>
</form>




                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
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