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
  <title>Request Documents Information &mdash; Barangay Information System</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
  <link rel="shortcut icon" href="assets/img/s.png" type="image/x-icon">
  <!-- CSS Libraries -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
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
            <h1>Request Documents Information</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></div>
              <div class="breadcrumb-item">Request Documents Information</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12 col-lg-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <div class="col-lg-12">
                        <h2>Request Documents Information</h2>
                    </div>
                  </div>
                  <div class="card-body">
<?php
include 'conn.php'; // Database connection

// ✅ Ensure admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>alert('Unauthorized access! Please login first.'); window.location.href='login.php';</script>";
    exit;
}

$a_id = intval($_SESSION['a_id']); // Logged-in admin ID

// Initialize variables
$req_referrence = $total_payment = $payment_status = $status = $c_date = "";
$req_id = 0;
$profile = $full_name = "";
$semester = $year_graduated = $elementary = $e_sy = $high_school = $hs_sy = $course_year = $documents = "";
$cashier_number = $pay_date = $pay_day = $pay_time = "";
$or_number = $or_date = "";

// ✅ Fetch request details
if (isset($_GET['req_id'])) {
    $req_id = intval($_GET['req_id']); 

    $query = "
        SELECT r.req_id, r.req_referrence, r.total_payment, r.payment_status, r.status, r.c_date,
               r.semester, r.year_graduated, r.elementary, r.e_sy, r.high_school, r.hs_sy,
               r.course_year, r.documents, r.cashier_number, r.pay_date, r.pay_day, r.pay_time,
               r.or_number, r.or_date, r.r_is_read,
               s.profile, s.first_name, s.middle_name, s.last_name, s.suffix_name
        FROM request r
        JOIN students s ON r.s_id = s.s_id
        WHERE r.req_id = ?
    ";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $req_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Request details
            $req_referrence = $row['req_referrence'];
            $total_payment = $row['total_payment'];
            $payment_status = $row['payment_status'];
            $status = $row['status'];
            $c_date = $row['c_date'];
            $semester = $row['semester'];
            $year_graduated = $row['year_graduated'];
            $elementary = $row['elementary'];
            $e_sy = $row['e_sy'];
            $high_school = $row['high_school'];
            $hs_sy = $row['hs_sy'];
            $course_year = $row['course_year'];
            $documents = $row['documents'];
            $cashier_number = $row['cashier_number'];
            $pay_date = $row['pay_date'];
            $pay_day = $row['pay_day'];
            $pay_time = $row['pay_time'];
            $or_number = $row['or_number'];
            $or_date = $row['or_date'];

            // Student info
            $profile = !empty($row['profile']) ? $row['profile'] : 'default.png';
            $full_name = $row['first_name'] . ' ' . 
                        (!empty($row['middle_name']) ? $row['middle_name'] . ' ' : '') . 
                        $row['last_name'] . 
                        (!empty($row['suffix_name']) ? ', ' . $row['suffix_name'] : '');
        } else {
            echo "Request not found!";
            exit;
        }
        $stmt->close();
    }
}

// ✅ Handle update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $req_id = intval($_POST['req_id']);

    if ($req_id > 0) {
        if ($status === "Release Documents") {
            // Update with release_date
            $update_query = "UPDATE request 
                             SET status = ?, a_id = ?, r_is_read = 1, release_date = NOW() 
                             WHERE req_id = ?";
        } else {
            // Update without touching release_date
            $update_query = "UPDATE request 
                             SET status = ?, a_id = ?, r_is_read = 1 
                             WHERE req_id = ?";
        }

        if ($stmt = $conn->prepare($update_query)) {
            $stmt->bind_param("sii", $status, $a_id, $req_id);
            $update_success = $stmt->execute();
            $stmt->close();

            if ($update_success) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Request updated successfully!',
                        confirmButtonColor: '#28a745'
                    }).then(() => {
                        window.location.href='list_request_release.php';
                    });
                </script>";
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'No changes were made or error updating request.',
                        confirmButtonColor: '#dc3545'
                    }).then(() => {
                        window.history.back();
                    });
                </script>";
            }
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: 'Invalid request ID.',
                confirmButtonColor: '#ffc107'
            }).then(() => {
                window.history.back();
            });
        </script>";
    }
}

mysqli_close($conn);
?>

<form method="post" action="request_info.php">
    <div class="col-lg-12">
        <div class="row">

            <!-- Profile and Full Name -->
            <div class="col-lg-12 mb-3 text-center">
                <img src="../uploads/<?php echo htmlspecialchars($profile); ?>" 
                     alt="Profile Picture" 
                     class="rounded-circle" width="200" height="200">
                <h4 class="mt-2"><?php echo htmlspecialchars($full_name); ?></h4>
            </div>

            <div class="col-lg-4">
                <label><h4>Reference No :</h4></label>
                <h6><?php echo htmlspecialchars($req_referrence); ?></h6>
            </div>

            <div class="col-lg-4">
                <label><h4>Request Date</h4></label>
                <h6>
                    <?php echo !empty($c_date) ? date("F j, Y", strtotime($c_date)) : "N/A"; ?>
                </h6>
            </div>

            <div class="col-lg-4">
                <label><h4>Request Status</h4></label>
                <select name="status" class="form-control" required>
                    <option value="Request Documents"    <?php echo ($status === 'Request Documents') ? 'selected' : ''; ?>>Request Documents</option>
                    <option value="Release Documents" <?php echo ($status === 'Release Documents') ? 'selected' : ''; ?>>Release Documents</option>
                </select>
            </div>

            <div class="col-lg-12"><br></div>

            <div class="col-lg-4">
                <label><h4>Semester Last Attended</h4></label>
                <h6><?php echo htmlspecialchars($semester); ?></h6>
            </div>
            <div class="col-lg-4">
                <label><h4>Year Graduated</h4></label>
                <h6><?php echo htmlspecialchars($year_graduated); ?></h6>
            </div>
            <div class="col-lg-4">
                <label><h4>Course Year</h4></label>
                <h6><?php echo htmlspecialchars_decode($course_year); ?></h6>
            </div>

            <div class="col-lg-12"><br></div>

            <div class="col-lg-6">
                <label><h4>Elementary School Name</h4></label>
                <h6><?php echo htmlspecialchars($elementary); ?></h6>
            </div>
            <div class="col-lg-6">
                <label><h4>School Year</h4></label>
                <h6><?php echo !empty($e_sy) ? date("F j, Y", strtotime($e_sy)) : "N/A"; ?></h6>
            </div>

            <div class="col-lg-12"><br></div>

            <div class="col-lg-6">
                <label><h4>High School Name</h4></label>
                <h6><?php echo htmlspecialchars($high_school); ?></h6>
            </div>
            <div class="col-lg-6">
                <label><h4>School Year</h4></label>
                <h6><?php echo !empty($hs_sy) ? date("F j, Y", strtotime($hs_sy)) : "N/A"; ?></h6>
            </div>

            <div class="col-lg-12"><br></div>

            <!-- Requested Documents -->
            <div class="col-lg-4">
                <label><h4>Requested Documents</h4></label>
                <h6>
                    <?php 
                        if (!empty($documents)) {
                            $docs = explode(",", $documents); 
                            foreach ($docs as $doc) {
                                echo "* " . htmlspecialchars(trim($doc)) . "<br>";
                            }
                        } else {
                            echo "No documents requested.";
                        }
                    ?>
                </h6>
            </div>

            <div class="col-lg-4">
                <label><h4>Total Payment</h4></label>
                <h6>₱ <?php echo htmlspecialchars($total_payment); ?></h6>
            </div>

            <div class="col-lg-4">
                <label><h4>Payment Status</h4></label>
                <h6><?php echo htmlspecialchars($payment_status); ?></h6>
            </div>

            <div class="col-lg-12"><br></div>

            <div class="col-lg-6">
                <label><h4>Cashier Code</h4></label>
                <h6><?php echo htmlspecialchars($cashier_number); ?></h6>
            </div>
            <div class="col-lg-6">
                <label><h4>Cashier Pay Date</h4></label>
                <h6>
                    <?php 
                        if (!empty($pay_date) && !empty($pay_day) && !empty($pay_time)) {
                            echo date("F j, Y", strtotime($pay_date)) . " - " . 
                                 htmlspecialchars($pay_day) . " at " . 
                                 htmlspecialchars($pay_time);
                        } else {
                            echo "Not yet paid";
                        }
                    ?>
                </h6>
            </div>

            <!-- ✅ OR Number & Date -->
            <div class="col-lg-6">
                <label><h4>O.R. Number</h4></label>
                <h6><?php echo !empty($or_number) ? htmlspecialchars($or_number) : "N/A"; ?></h6>
            </div>
            <div class="col-lg-6">
                <label><h4>O.R. Date</h4></label>
                <h6><?php echo !empty($or_date) ? date("F j, Y", strtotime($or_date)) : "N/A"; ?></h6>
            </div>

            <input type="hidden" name="req_id" value="<?php echo $req_id; ?>">

            <div class="col-lg-12"><br></div>

            <div class="col-lg-12">
                <a href="request.php" class="btn btn-outline-secondary">Back</a>
                <button type="submit" name="update" class="btn btn-outline-success" style="float: right;">Update</button>
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