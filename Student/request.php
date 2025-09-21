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
  <title>List of Request - Credentials Verifications</title>
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
  	<?php
include 'conn.php';

if (!isset($_SESSION['s_id'])) {
    die("Access denied.");
}

if (isset($_GET['req_id'])) {
    $req_id = intval($_GET['req_id']);

    // Mark payment and status notifications as read
    $stmt = $conn->prepare("
        UPDATE request 
        SET st_is_read = 1, rs_is_read = 1 
        WHERE req_id = ?
    ");
    $stmt->bind_param("i", $req_id);
    $stmt->execute();
    $stmt->close();
}
?>




    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container">
        <div class="row gy-10 justify-content-center text-center">
          <div class="col-lg-12 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center">
            <h1 data-aos="zoom-out">My Request List</h1>
            <div class="container my-4">
			  <div class="col-lg-12">
			    <div class="card shadow-sm rounded-3 border-0">
			      
			      <div class="card-body p-4">
			        <div class="table-responsive">
			         <?php
include "conn.php";

// ✅ Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Get current logged in IDs
$u_id = $_SESSION['u_id'] ?? null;
$s_id = $_SESSION['s_id'] ?? null;

if (!$u_id || !$s_id) {
    echo "<div class='alert alert-danger'>Error: Please log in first.</div>";
    exit;
}

// ✅ Fetch requests for the logged-in user (fetch everything)
$sql = "SELECT * FROM request 
        WHERE u_id = ? AND s_id = ? 
        ORDER BY req_id DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $u_id, $s_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<table class="table table-hover align-middle">
    <thead class="table-success">
        <tr>
            <th scope="col">Request Number</th>
            <th scope="col">Request Status</th>
            <th scope="col">Cashier Code</th>
            <th scope="col">Payment Date</th>
            <th scope="col">Documents</th>
            <th scope="col">Total Payment</th>
            <th scope="col">Payment Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                // ✅ Format Payment Date
                $paymentDate = "";
                if (!empty($row['pay_date'])) {
                    $paymentDate .= date("F j, Y", strtotime($row['pay_date'])) . "<br>";
                }
                if (!empty($row['pay_day'])) {
                    $paymentDate .= htmlspecialchars($row['pay_day']) . "<br>";
                }
                if (!empty($row['pay_time'])) {
                    $paymentDate .= date("g:i A", strtotime($row['pay_time']));
                }

                // ✅ OR Number & Date (show message if empty)
                $orNumber = !empty($row['or_number']) ? htmlspecialchars($row['or_number']) : "<span class='text-danger'>You have not paid the payment in the Cashier.</span>";
                $orDate   = !empty($row['or_date']) ? date("F j, Y", strtotime($row['or_date'])) : "<span class='text-danger'>You have not paid the payment in the Cashier.</span>";

                // ✅ Request Date from `date` column (timestamp when inserted)
                $reqDate = !empty($row['date']) ? date("F j, Y g:i A", strtotime($row['date'])) : "";

                // ✅ Release Date (new) with professional message if empty
                $releaseDate = !empty($row['release_date']) ? date("F j, Y g:i A", strtotime($row['release_date'])) : "<span class='text-danger'>The Registrar has not released your documents yet.</span>";
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['req_referrence']); ?></td>
                    <!-- ✅ Request Status -->
                    <td>
                        <span class="badge 
                            <?php 
                                echo ($row['status'] === 'Processing Documents') ? 'bg-warning text-dark' : 
                                     (($row['status'] === 'Release Documents') ? 'bg-success' : 'bg-secondary'); 
                            ?>">
                            <?php echo htmlspecialchars($row['status']); ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($row['cashier_number']); ?></td>
                    <td><?php echo $paymentDate; ?></td>
                    
                    <!-- ✅ Display documents with * prefix -->
                    <td>
                        <?php 
                        $docs = explode(",", $row['documents']); 
                        foreach ($docs as $doc) {
                            echo "* " . htmlspecialchars(trim($doc)) . "<br>";
                        }
                        ?>
                    </td>

                    <td>₱<?php echo number_format($row['total_payment'], 2); ?></td>
                    <!-- ✅ Cashier Status -->
                    <td>
                        <span class="badge 
                            <?php 
                                echo ($row['payment_status'] === 'Waiting for Payment') ? 'bg-warning text-dark' : 
                                     (($row['payment_status'] === 'Paid') ? 'bg-success' : 'bg-secondary'); 
                            ?>">
                            <?php echo htmlspecialchars($row['payment_status']); ?>
                        </span>
                    </td>
                    

                    

                    <td>
                        <!-- ✅ Button to trigger modal -->
                        <button type="button" 
                                class="btn btn-outline-success btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#viewModal<?php echo $row['req_id']; ?>">
                            <i class="bi bi-eye"></i> View
                        </button>
                    </td>
                </tr>

                <!-- ✅ Modal for each request -->
                <div class="modal fade" id="viewModal<?php echo $row['req_id']; ?>" tabindex="-1" aria-labelledby="viewModalLabel<?php echo $row['req_id']; ?>" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header bg-success-subtle text-white">
                        <h5 class="modal-title" id="viewModalLabel<?php echo $row['req_id']; ?>">
                          Request Details (<?php echo htmlspecialchars($row['req_referrence']); ?>)
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                        	<div class="col-lg-6">
                        		<p><strong>Request Reference:</strong> <?php echo htmlspecialchars($row['req_referrence']); ?></p>
                        		<p><strong>Request Status:</strong> <?php echo htmlspecialchars($row['status']); ?></p>
                        		<p><strong>Request Date:</strong><br> <?php echo $reqDate; ?></p>
                        		<p><strong>Documents:</strong><br>
                                <?php 
                                foreach ($docs as $doc) {
                                    echo "* " . htmlspecialchars(trim($doc)) . "<br>";
                                }
                                ?>
                            </p>
                            <p><strong>OR Number:</strong><br> <?php echo $orNumber; ?></p>
                        	</div>
                          <div class="col-md-6">
                          	<p><strong>Cashier Code:</strong> <?php echo htmlspecialchars($row['cashier_number']); ?></p>
                            <p><strong>Cashier Status:</strong> <?php echo htmlspecialchars($row['payment_status']); ?></p>
                            <p><strong>Payment Date:</strong><br> <?php echo $paymentDate; ?></p>
                            <p><strong>Total Payment:</strong> ₱<?php echo number_format($row['total_payment'], 2); ?></p>
                            <p><strong></strong><br></p>
                            <p><strong>Release Date:</strong><br> <?php echo $releaseDate; ?></p>
                          </div>
                          
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center text-muted">No requests found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$stmt->close();
$conn->close();
?>

			        </div>
			      </div>
			    </div>
			  </div>
			</div>
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