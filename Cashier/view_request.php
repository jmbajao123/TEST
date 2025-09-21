<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['email']) && isset($_SESSION['a_id']) && isset($_SESSION['cash_id']) && ($_SESSION['password']) && $_SESSION['ad_usertype'] === "Cashier Account")  {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Request Informations- Credentials Verification Sibugay Technical Institute Inc.</title>

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
      <?php include 'Include/navbar.php'; ?>
      <div class="main-sidebar sidebar-style-2">
        <?php include 'Include/sidebar.php'; ?>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Request Informations</h1>
          </div>
          
          <div class="section-body">
            <div class="card">
              <div class="card-body">
                <div class="col-lg-12">
                  <div class="row">
<?php
include 'conn.php';

// Get request ID from GET
$req_id = $_GET['req_id'] ?? null;

$student_row = null;
$request_row = null;

if ($req_id) {
    // Fetch student and request details
    $query = "
        SELECT s.profile,
               CONCAT(s.first_name, ' ',
                      IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(s.middle_name, ' '), ''),
                      s.last_name,
                      IF(s.suffix_name IS NOT NULL AND s.suffix_name != '' AND s.suffix_name != 'None', CONCAT(' ', s.suffix_name), '')
               ) AS full_name,
               r.*
        FROM request r
        JOIN students s ON r.s_id = s.s_id
        WHERE r.req_id = ?
        LIMIT 1
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $req_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $student_row = [
            'profile' => $row['profile'] ?? '',
            'full_name' => $row['full_name'] ?? ''
        ];
        $request_row = $row;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $req_id_post = $_POST['req_id'] ?? null;
    $payment_status = $_POST['payment_status'] ?? null;

    if ($req_id_post && $payment_status) {

        if (!in_array($payment_status, ['Unpaid', 'Paid'])) {
            $error_msg = 'Invalid payment status';
        } else {
            // Generate unique 8-digit OR number
            $or_number = mt_rand(10000000, 99999999);

            // Real-time timestamp
            $or_date = date("Y-m-d H:i:s");

            // Update payment_status, reset c_is_read, insert OR number + OR date
            $stmt = $conn->prepare("
                UPDATE request 
                SET payment_status = ?, c_is_read = 0, or_number = ?, or_date = ? 
                WHERE req_id = ?
            ");
            $stmt->bind_param("sisi", $payment_status, $or_number, $or_date, $req_id_post);

            if ($stmt->execute()) {
                // Success message and redirect
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Payment status updated, OR number and date generated!',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'lsct.php';
                    });
                </script>";
                exit();
            } else {
                $error_msg = 'Error updating status: ' . $conn->error;
            }
        }

    } else {
        $error_msg = "Invalid request.";
    }
}

// Display error if exists
if (!empty($error_msg)) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '".addslashes($error_msg)."'
        });
    </script>";
}
?>
<form method="post" action="">
    <div class="col-lg-12">
        <div class="row justify-content-center">
            <!-- Profile -->
            <div class="col-lg-6 text-center">
                <label><h6>Profile</h6></label><br>
                <?php if(!empty($student_row['profile'])): ?>
                    <img src="../uploads/<?php echo htmlspecialchars($student_row['profile']); ?>" alt="Profile Picture" class="rounded-circle" width="200" height="200">
                <?php else: ?>
                    <img src="assets/img/default-profile.png" alt="Default Profile" class="rounded-circle" width="200" height="200">
                <?php endif; ?>
                <?php if(!empty($student_row['full_name'])): ?>
                    <h5 class="mt-2"><?php echo htmlspecialchars($student_row['full_name']); ?></h5>
                <?php endif; ?>
            </div>

            <div class="col-lg-12"><br></div>

            <!-- Course / Year -->
            <div class="col-lg-4 mb-2">
                <label class="form-label">Course / Year</label>
                <h5><?php echo !empty($request_row['course_year']) ? htmlspecialchars(str_replace(['&amp;', '&'], ',', $request_row['course_year'])) : 'N/A'; ?></h5>
            </div>

            <!-- Semester -->
            <div class="col-lg-4 mb-2">
                <label class="form-label">Semester</label>
                <h5><?php echo !empty($request_row['semester']) ? htmlspecialchars($request_row['semester']) : 'N/A'; ?></h5>
            </div>

            <!-- Year Graduated -->
            <div class="col-lg-4 mb-2">
                <label class="form-label">Year Graduated</label>
                <h5><?php echo !empty($request_row['year_graduated']) ? htmlspecialchars($request_row['year_graduated']) : 'N/A'; ?></h5>
            </div>

            <div class="col-lg-12"><br></div>

            <!-- Documents -->
            <div class="col-lg-6 mb-2">
                <label class="form-label">Documents</label>
                <div style="padding-left: 15px;">
                    <?php 
                    if (!empty($request_row['documents'])) {
                        $docs = explode(',', $request_row['documents']);
                        foreach ($docs as $doc) {
                            echo '<h6>* ' . htmlspecialchars(trim($doc)) . '</h6>';
                        }
                    } else {
                        echo '<div>N/A</div>';
                    }
                    ?>
                </div>
            </div>

            <!-- Total Payment -->
            <div class="col-lg-6 mb-2">
                <label class="form-label">Total Payment</label>
                <h5>₱<?php echo isset($request_row['total_payment']) ? number_format($request_row['total_payment'], 2) : '0.00'; ?></h5>
            </div>

            <!-- Request Reference -->
            <div class="col-lg-4 mb-2">
                <label class="form-label">Request Reference</label>
                <h5><?php echo htmlspecialchars($request_row['req_referrence']); ?></h5>
            </div>

            <!-- Request Date -->
            <div class="col-lg-4 mb-2">
                <label class="form-label">Request Date</label>
                <h5><?php echo htmlspecialchars($request_row['c_date']); ?></h5>
            </div>

            <!-- Request Status -->
            <div class="col-lg-4 mb-2">
                <label class="form-label">Request Status</label>
                <h5><?php echo htmlspecialchars($request_row['status']); ?></h5>
            </div>

            <!-- Cashier Number -->
            <div class="col-lg-4 mb-2">
                <label class="form-label">Cashier Number</label>
                <h5><?php echo !empty($request_row['cashier_number']) ? htmlspecialchars($request_row['cashier_number']) : 'N/A'; ?></h5>
            </div>

            <!-- Payment Day -->
            <div class="col-lg-4 mb-2">
                <label class="form-label">Payment Day</label>
                <h5>
                    <?php 
                    if (!empty($request_row['pay_date']) && !empty($request_row['pay_day']) && !empty($request_row['pay_time'])) {
                        echo htmlspecialchars(date('F j, Y', strtotime($request_row['pay_date'])) . " - {$request_row['pay_day']} - {$request_row['pay_time']}");
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </h5>
            </div>

            <!-- Cashier Status -->
            <div class="col-lg-4 mb-2">
                <label class="form-label">Cashier Status</label>
                <select name="payment_status" class="form-control" required>
                    <option value="Unpaid" <?php echo ($request_row['payment_status'] == 'Unpaid') ? 'selected' : ''; ?>>Unpaid</option>
                    <option value="Paid" <?php echo ($request_row['payment_status'] == 'Paid') ? 'selected' : ''; ?>>Paid</option>
                </select>
            </div>

            <input type="hidden" name="req_id" value="<?php echo htmlspecialchars($req_id); ?>">

            <div class="col-lg-12 mt-3">
                <a href="ls_request.php" class="btn btn-outline-secondary mt-3">Back</a>
                <button type="submit" class="btn btn-outline-success mt-3">Update Status</button>
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
    header("Location: ../index.php");
    exit();
}

?>