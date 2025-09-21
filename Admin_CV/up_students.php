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
// Ensure you have a valid DB connection in $conn
$department_name = $course_name = '';
$row = []; // Default row to avoid undefined variable if s_id is not set

if (isset($_GET['s_id'])) {
    $s_id = $_GET['s_id'];

    // Prepare and execute student query
    $stmt = $conn->prepare("SELECT * FROM students WHERE s_id = ?");
    $stmt->bind_param("i", $s_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If student is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Fetch department name
        if (!empty($row['d_id'])) {
            $stmt_department = $conn->prepare("SELECT department_name FROM departments WHERE d_id = ?");
            $stmt_department->bind_param("i", $row['d_id']);
            $stmt_department->execute();
            $dept_result = $stmt_department->get_result();
            $department_name = $dept_result->fetch_assoc()['department_name'] ?? "Department not found.";
        }

        // Fetch course name
        if (!empty($row['c_id'])) {
            $stmt_course = $conn->prepare("SELECT course_name FROM course WHERE c_id = ?");
            $stmt_course->bind_param("i", $row['c_id']);
            $stmt_course->execute();
            $course_result = $stmt_course->get_result();
            $course_name = $course_result->fetch_assoc()['course_name'] ?? "Course not found.";
        }

    } else {
        echo "No student found.";
        exit;
    }
}
?>
<form method="post">
    <div class="col-lg-12">
        <div class="row">
            <center>
                <div class="col-lg-3">
                    <label><h6>Profile</h6></label><br>
                    <img src="<?= htmlspecialchars($row['profile'] ?? '') ?>" alt="Profile Picture" class="rounded-circle" width="200" height="200">
                </div>
            </center>

            <div class="col-lg-12"><br></div>

            <!-- Personal Info -->
            <?php
            $fields = [
                'first_name' => 'First Name',
                'middle_name' => 'Middle Name',
                'last_name' => 'Last Name'
            ];
            foreach ($fields as $name => $label) {
                echo '<div class="col-lg-3">
                        <label><h6>' . $label . '</h6></label>
                        <input type="text" name="' . $name . '" class="form-control" value="' . htmlspecialchars($row[$name] ?? '') . '">
                      </div>';
            }
            ?>
            <div class="col-lg-3">
                <label><h6>Suffix Name</h6></label>
                <select class="form-control" name="suffix_name">
                    <option value="">Choose a Suffix Name</option>
                    <?php
                    $suffixes = ["Jr", "Sr", "III", "IV", "V", "None"];
                    foreach ($suffixes as $suffix) {
                        $selected = ($row['suffix_name'] ?? '') === $suffix ? 'selected' : '';
                        echo "<option value=\"$suffix\" $selected>$suffix</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-lg-12"><br></div>

            <div class="col-lg-3">
                <label><h6>Birthdate</h6></label>
                <input type="date" name="date_birth" class="form-control" value="<?= htmlspecialchars($row['date_birth'] ?? '') ?>">
            </div>
            <div class="col-lg-3">
                <label><h6>Age</h6></label>
                <input type="text" name="age" class="form-control" value="<?= htmlspecialchars($row['age'] ?? '') ?>" readonly>
                <?php include 'date_age.php'; ?>
            </div>
            <div class="col-lg-3">
                <label><h6>Gender</h6></label>
                <select class="form-control" name="gender" required>
                    <option disabled>Choose a Gender</option>
                    <?php
                    $genders = ["Male", "Female", "Others"];
                    foreach ($genders as $gender) {
                        $selected = ($row['gender'] ?? '') === $gender ? 'selected' : '';
                        echo "<option value=\"$gender\" $selected>$gender</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-3">
                <label><h6>Civil Status</h6></label>
                <select class="form-control" name="civil_status" required>
                    <option disabled>Choose a Civil Status</option>
                    <?php
                    $statuses = ["Married", "Single", "Divorce", "Widowed"];
                    foreach ($statuses as $status) {
                        $selected = ($row['civil_status'] ?? '') === $status ? 'selected' : '';
                        echo "<option value=\"$status\" $selected>$status</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-lg-12"><br></div>

            <!-- Address Fields -->
            <?php
            $address_fields = [
                'province' => 'Province',
                'municipality' => 'Municipality',
                'barangay' => 'Barangay',
                'street' => 'Purok/Street'
            ];
            foreach ($address_fields as $field => $label) {
                echo '<div class="col-lg-3">
                        <label><h6>' . $label . '</h6></label>
                        <input type="text" name="' . $field . '" class="form-control" value="' . htmlspecialchars($row[$field] ?? '') . '">
                      </div>';
            }
            ?>

            <div class="col-lg-12"><br></div>

            <!-- School Info -->
            <div class="col-lg-3">
                <label><h6>Student ID</h6></label>
                <input type="text" name="student_id" class="form-control" value="<?= htmlspecialchars($row['student_id'] ?? '') ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label><h6>Student Verification Code</h6></label>
                <input type="text" name="student_vcode" class="form-control" value="<?= htmlspecialchars($row['student_vcode'] ?? '') ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label><h6>School Year Graduated</h6></label>
                <input type="text" name="year_graduated" class="form-control" value="<?= htmlspecialchars($row['year_graduated'] ?? '') ?>">
            </div>
            <div class="col-lg-3">
                <label><h6>Date of Graduation</h6></label>
                <input type="date" name="date_graduation" class="form-control" value="<?= htmlspecialchars($row['date_graduation'] ?? '') ?>">
            </div>

            <div class="col-lg-12"><br></div>

            <div class="col-lg-3">
                <label><h6>Honors</h6></label>
                <input type="text" name="honors" class="form-control" value="<?= htmlspecialchars($row['honors'] ?? '') ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label><h6>Department</h6></label>
                <input type="text" name="department_name" class="form-control" value="<?= htmlspecialchars($department_name ?? '') ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label><h6>Course</h6></label>
                <input type="text" name="course_name" class="form-control" value="<?= htmlspecialchars($course_name ?? '') ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label><h6>Status</h6></label>
                <select class="form-control" name="status">
                    <option value="Verified" <?= ($row['status'] ?? '') === 'Verified' ? 'selected' : '' ?>>Verified</option>
                    <option value="Not Verified" <?= ($row['status'] ?? '') === 'Not Verified' ? 'selected' : '' ?>>Not Verified</option>
                </select>
            </div>

            <div class="col-lg-12"><br></div>

            <!-- Certificates -->
            <?php
            $certificates = [
                'diploma' => 'Certificate of Diploma',
                'graduation' => 'Certificate of Graduation',
                'tor' => 'Transcript of Records (TOR)'
            ];
            foreach ($certificates as $field => $label) {
                echo '<div class="col-lg-4">
                        <label><h6>' . $label . '</h6></label><br>
                        <img src="' . htmlspecialchars($row[$field] ?? '') . '" alt="' . $label . '" class="rounded-circle" width="200" height="200">
                      </div>';
            }
            ?>

            <div class="col-lg-12"><br></div>

            <div class="col-lg-12">
                <button type="submit" class="btn btn-outline-success">Update</button>
            </div>
        </div>
    </div>
</form>
<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and fetch
    $data = array_map(function ($key) use ($conn) {
        return mysqli_real_escape_string($conn, $_POST[$key] ?? '');
    }, [
        'first_name', 'middle_name', 'last_name', 'suffix_name', 'date_birth', 'age',
        'gender', 'civil_status', 'province', 'municipality', 'barangay', 'street',
        'student_id', 'student_vcode', 'year_graduated', 'date_graduation'
    ]);

    // Assign
    list($first_name, $middle_name, $last_name, $suffix_name, $date_birth, $age,
         $gender, $civil_status, $province, $municipality, $barangay, $street,
         $student_id, $student_vcode, $year_graduated, $date_graduation) = $data;

    // Query
    $sql = "UPDATE students SET 
                first_name = '$first_name',
                middle_name = '$middle_name',
                last_name = '$last_name',
                suffix_name = '$suffix_name',
                date_birth = '$date_birth',
                age = '$age',
                gender = '$gender',
                civil_status = '$civil_status',
                province = '$province',
                municipality = '$municipality',
                barangay = '$barangay',
                street = '$street',
                year_graduated = '$year_graduated',
                date_graduation = '$date_graduation'
            WHERE student_id = '$student_id' AND student_vcode = '$student_vcode'";

    if (mysqli_query($conn, $sql)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Student information updated successfully.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'student.php';
                });
              </script>";
    } else {
        $error = mysqli_error($conn);
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    html: 'Error updating record:<br><pre>$error</pre>',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
    mysqli_close($conn);
}
?>






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