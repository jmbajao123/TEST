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
  <title>Dashboard Cahier &mdash; Credential Verification System</title>
  <link rel="shortcut icon" href="assets/img/s.png" type="image/x-icon">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">

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
      <div class="navbar-bg bg-info"></div>
      <?php include 'Include/navbar.php'; ?>
      <div class="main-sidebar sidebar-style-2">
        <?php include 'Include/sidebar.php'; ?>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="col-lg-12">
          	<div class="row">
	            	<?php
include 'conn.php';

// Get total count of unpaid requests
$query = "SELECT COUNT(req_id) AS total_unpaid FROM request WHERE payment_status = 'Unpaid'";
$result = $conn->query($query);
$total_unpaid = 0;
if ($result && $row = $result->fetch_assoc()) {
    $total_unpaid = $row['total_unpaid'];
}
?>

<div class="col-lg-6 col-md-6 col-sm-6">
    <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
            <i class="fas fa-users"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>List of Student Request (Unpaid)</h4>
            </div>
            <div class="card-body">
                <?php echo $total_unpaid; ?>
            </div>
        </div>
    </div>
</div>

		            <?php
include 'conn.php';

// Get total count of paid requests
$query = "SELECT COUNT(req_id) AS total_paid FROM request WHERE payment_status = 'Paid'";
$result = $conn->query($query);
$total_paid = 0;
if ($result && $row = $result->fetch_assoc()) {
    $total_paid = $row['total_paid'];
}
?>

<div class="col-lg-6 col-md-6 col-sm-6">
    <div class="card card-statistic-1">
        <div class="card-icon bg-success">
            <i class="fas fa-users"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>List of Student Request (Paid)</h4>
            </div>
            <div class="card-body">
                <?php echo $total_paid; ?>
            </div>
        </div>
    </div>
</div>

		            <?php
include 'conn.php';

// Calculate total income from paid requests
$total_income = 0;
$query = "SELECT SUM(total_payment) AS total_income FROM request WHERE payment_status = 'Paid'";
$result = $conn->query($query);

if ($result && $row = $result->fetch_assoc()) {
    $total_income = $row['total_income'] ?? 0;
}
?>

<div class="col-lg-6 col-md-6 col-sm-6">
    <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
            <span style="font-size: 1.5rem; color: white;">&#8369;</span>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>Total Income</h4>
            </div>
            <div class="card-body">
                <?php echo number_format($total_income, 2); ?>
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
  <script src="assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
  <script src="assets/modules/chart.min.js"></script>
  <script src="assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="assets/modules/summernote/summernote-bs4.js"></script>
  <script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Page Specific JS File -->
  
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