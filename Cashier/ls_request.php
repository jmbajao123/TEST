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
  <title>List of Student Request (Unpaid) &mdash; Credential Verification System</title>
  <link rel="shortcut icon" href="assets/img/s.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
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
      <div class="navbar-bg bg-info"></div>
      <?php include 'Include/navbar.php'; ?>
      <div class="main-sidebar sidebar-style-2">
        <?php include 'Include/sidebar.php'; ?>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>List of Student Request (Unpaid)</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">List of Student Request (Unpaid)</a></div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">List of Student Request (Unpaid)</h2>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>List of Student Request (Unpaid)</h4>
                    <!-- <div class="card-header-action">
                      <form>
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search">
                          <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div> -->
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <?php
include 'conn.php';

// Fetch unpaid requests with student full name and payment status
$query = "
SELECT r.req_referrence, r.req_id,
       CONCAT(s.first_name, ' ', 
              IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(s.middle_name, ' '), ''), 
              s.last_name,
              IF(s.suffix_name IS NOT NULL AND s.suffix_name != '' AND s.suffix_name != 'None', CONCAT(' ', s.suffix_name), '')
       ) AS full_name,
       r.payment_status
FROM request r
JOIN students s ON r.s_id = s.s_id
WHERE r.payment_status = 'Unpaid'
ORDER BY r.req_id DESC
";

$result = $conn->query($query);

// Count total unpaid requests
$total_unpaid_requests = $result ? $result->num_rows : 0;
?>

<table class="table table-striped" id="sortable-table">
    <thead>
        <tr>
            <th>Request Reference</th>
            <th>Student Name</th>
            <th>Payment Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['req_referrence']); ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td>
                        <div class="badge badge-warning"><?php echo htmlspecialchars($row['payment_status']); ?></div>
                    </td>
                    <td>
                        <a href="view_request.php?req_id=<?php echo $row['req_id']; ?>" class="btn btn-secondary">Detail</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No unpaid requests found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Display total number of Unpaid requests -->
<div class="mt-3">
    <h5>Total Unpaid Requests: <?php echo $total_unpaid_requests; ?></h5>
</div>



                    </div>
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