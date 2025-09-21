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
  <title>Students - Credentials Verification Sibugay Technical Institute Inc.</title>

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
            <h1>Students List</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"> <a href="dashboard.php"> Dashboard </a> </div>
              <!-- <div class="breadcrumb-item"><a href="#">Department List</a></div> -->
              <div class="breadcrumb-item">Students List
              	
              </div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Students List
            	<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;">
              		Add Students
              	</button>
            </h2>
            <div class="col-lg-12">
                <div class="row">

                </div>
            </div>

            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <?php
                    include 'conn.php';

                    // Get the current page number from URL, default is 1
                    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                    $limit = 10; // Maximum records per page
                    $offset = ($page - 1) * $limit; // Calculate offset for pagination

                    // Fetch total number of records for pagination
                    $totalQuery = "SELECT COUNT(*) as total FROM students";
                    $totalResult = mysqli_query($conn, $totalQuery);
                    $totalRow = mysqli_fetch_assoc($totalResult);
                    $totalRecords = $totalRow['total'];
                    $totalPages = ceil($totalRecords / $limit);

                    // Fetch student records, ordered by full name alphabetically
                    $query = "SELECT s.s_id, s.first_name, s.middle_name, s.last_name, s.suffix_name, s.student_status,
                                     d.department_name, c.course_name
                              FROM students s
                              LEFT JOIN departments d ON s.d_id = d.d_id
                              LEFT JOIN course c ON s.c_id = c.c_id
                              ORDER BY CONCAT(s.first_name, ' ', s.middle_name, ' ', s.last_name, ' ', s.suffix_name) ASC
                              LIMIT $limit OFFSET $offset";

                    $result = mysqli_query($conn, $query);
                ?>
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Department</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (mysqli_num_rows($result) > 0) :
                                        $count = $offset + 1; // Start count based on offset
                                        while ($row = mysqli_fetch_assoc($result)) :
                                            // Construct full name while handling optional suffix
                                            $fullName = trim("{$row['first_name']} {$row['middle_name']} {$row['last_name']}");
                                            if (!empty($row['suffix_name']) && strtolower($row['suffix_name']) !== "none") {
                                                $fullName .= " " . $row['suffix_name'];
                                            }
                                    ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= htmlspecialchars($fullName) ?></td>
                                                <td><?= htmlspecialchars($row['department_name'] ?? 'N/A') ?></td>
                                                <td><?= htmlspecialchars($row['course_name'] ?? 'N/A') ?></td>
                                                <td><?= htmlspecialchars($row['student_status']) ?></td>
                                                <td><a href="students_info.php?s_id=<?= htmlspecialchars($row['s_id']) ?>" class="btn btn-secondary">Detail</a></td>
                                            </tr>
                                    <?php
                                            $count++;
                                        endwhile;
                                    else : ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No Students Record found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                <!-- Previous Page -->
                                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fas fa-chevron-left"></i></a>
                                </li>

                                <!-- Page Numbers -->
                                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Next Page -->
                                <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                    <div class="col-lg-12">
                        <p class="mb-0"><strong>Total Students:</strong> <?= $totalRecords ?></p>
                    </div>
                <?php
                    // Close the database connection
                    mysqli_close($conn);
                    ?>
              </div>
            </div>
          </div>
        </section>
        <?php include 'add_student.php'; ?>
      <?php
include 'conn.php';

// Handle file upload function
function handleFileUpload($fileInputName, $folderName) {
    $targetDir = $folderName . '/';
    $targetFile = $targetDir . basename($_FILES[$fileInputName]["name"]);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = ["jpg", "jpeg", "png", "pdf", "docx"];
    if (!in_array($fileType, $allowedTypes)) {
        return "";
    }

    // File size limit (5MB)
    if ($_FILES[$fileInputName]["size"] > 5000000) {
        return "";
    }

    return move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile) ? $targetFile : "";
}

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check admin session
if (!isset($_SESSION['a_id'])) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
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

$a_id = $_SESSION['a_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    $required_fields = [
        'd_id', 'c_id', 'first_name', 'middle_name', 'last_name', 'suffix_name',
        'student_id', 'student_vcode', 'student_status', 'date_birth', 'age',
        'gender', 'civil_status', 'province', 'municipality', 'barangay', 'street',
        'year_graduated', 'date_graduation', 'honors',
        's_gmail', 'password', 'con_pass','b_place'
    ];

    foreach ($required_fields as $field) {
        if (empty(trim($_POST[$field] ?? ''))) {
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

    // Check if password matches confirm password
    if ($_POST['password'] !== $_POST['con_pass']) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Password Mismatch',
                text: 'Password and Confirm Password do not match.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit();
    }

    function sanitize($data) {
        global $conn;
        return mysqli_real_escape_string($conn, trim($data));
    }

    $data = array_map('sanitize', $_POST);

    // Hash password before inserting
    $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

    $profile = handleFileUpload('profile', '../uploads');
    $diploma = handleFileUpload('diploma', '../diploma');
    $graduation = handleFileUpload('graduation', '../Credentials');
    $tor = handleFileUpload('tor', '../TOR');
    $date = date('Y-m-d');

    // Insert into students table
    $sql = "INSERT INTO students (
                d_id, c_id, first_name, middle_name, last_name, suffix_name, 
                student_id, student_vcode, student_status, date_birth, age, gender, civil_status, 
                province, municipality, barangay, street, year_graduated, date_graduation, a_id, 
                profile, diploma, graduation, tor, honors, date, s_gmail, password, con_pass, b_place
            ) VALUES (
                '{$data['d_id']}', '{$data['c_id']}', '{$data['first_name']}', '{$data['middle_name']}', '{$data['last_name']}', '{$data['suffix_name']}',
                '{$data['student_id']}', '{$data['student_vcode']}', '{$data['student_status']}', '{$data['date_birth']}', '{$data['age']}', '{$data['gender']}', '{$data['civil_status']}',
                '{$data['province']}', '{$data['municipality']}', '{$data['barangay']}', '{$data['street']}', '{$data['year_graduated']}', '{$data['date_graduation']}', '$a_id',
                '$profile', '$diploma', '$graduation', '$tor', '{$data['honors']}', '$date', '{$data['s_gmail']}', '$hashedPassword','{$data['con_pass']}', '{$data['b_place']}'
            )";

    if (mysqli_query($conn, $sql)) {
        // Get the last inserted student ID
        $s_id = mysqli_insert_id($conn);

        // Insert also into users table
        $sql_user = "INSERT INTO users (s_id, status, s_gmail, password, con_pass, a_id) 
                     VALUES ('$s_id', '{$data['student_status']}', '{$data['s_gmail']}', '$hashedPassword', '{$data['con_pass']}', '$a_id')";
        
        if (mysqli_query($conn, $sql_user)) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Student Credentials Added!',
                    text: 'Credentials of student added successfully and user account created.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href='student.php';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Partial Success',
                    text: 'Student saved, but user account not created. Error: " . mysqli_error($conn) . "',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href='student.php';
                });
            </script>";
        }
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