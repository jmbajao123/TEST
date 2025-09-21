<?php
session_start(); 
include 'conn.php';
if (isset($_SESSION['email']) && isset($_SESSION['a_id']) && isset($_SESSION['cash_id']) && ($_SESSION['password']) && $_SESSION['ad_usertype'] === "Registrar Account")  {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard - Credentials Verifications Sibugay Technical Institute Inc.</title>

  <!-- General CSS Files -->
  <link rel="shortcut icon" href="assets/img/s.png" type="image/x-icon">
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
      <div class="navbar-bg"></div>
      <?php include 'Include/header.php'; ?>
      <div class="main-sidebar sidebar-style-2">
        <?php include 'Include/side_bar.php'; ?>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <?php 
include "conn.php"; 

$query = "SELECT COUNT(*) as rowCount FROM request WHERE status = 'Request Documents'";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
?>
<div class="col-lg-4 col-md-6 col-sm-6 col-12">
  <a href="request.php">
    <div class="card card-statistic-1">
      <div class="card-icon bg-warning">
        <i class="fas fa-file-alt"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Request Documents</h4>
        </div>
        <div class="card-body">
          <?php echo $row['rowCount']; ?>
        </div>
      </div>
    </div>
  </a>
</div>
<?php 
} else {
    // Error handling if query fails
    echo "Error: " . $conn->error;
}
?>
<?php 
include "conn.php"; 

$query = "SELECT COUNT(*) as rowCount FROM request WHERE status = 'Release Documents'";
$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
?>
<div class="col-lg-4 col-md-6 col-sm-6 col-12">
  <a href="list_request_release.php">
    <div class="card card-statistic-1">
      <div class="card-icon bg-success">
        <i class="fas fa-file-alt"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Release Documents</h4>
        </div>
        <div class="card-body">
          <?php echo $row['rowCount']; ?>
        </div>
      </div>
    </div>
  </a>
</div>
<?php 
} else {
    // Error handling if query fails
    echo "Error: " . $conn->error;
}
?>

            <?php 
                            include "conn.php"; 
                            
                            $query = "SELECT COUNT(*) as rowCount FROM departments WHERE department_status = 'Active'";
                            $result = $conn->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                        ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <a href="department.php">
                  <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-list"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>List of Department</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $row['rowCount']; ?>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <?php 
                            } else {
                                // Error handling if query fails
                                echo "Error: " . $conn->error;
                            }
                        ?>
                        <?php 
                            include "conn.php"; 
                            
                            $query = "SELECT COUNT(*) as rowCount FROM course WHERE course_status = 'Active'";
                            $result = $conn->query($query);

                            if ($result) {
                                $row = $result->fetch_assoc();
                        ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <a href="course.php">
                  <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-list"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>List of Course</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $row['rowCount']; ?>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <?php 
                            } else {
                                // Error handling if query fails
                                echo "Error: " . $conn->error;
                            }
                        ?>
                        <?php 
include "conn.php"; 

// Query to count available documents (adjust status value if needed)
$query = "SELECT COUNT(*) as rowCount 
          FROM documents
          WHERE status = 'Available Document'";

$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
?>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="list_documents.php">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>List of Documents</h4>
                    </div>
                    <div class="card-body">
                        <?php echo $row['rowCount']; ?>
                    </div>
                </div>
            </div>
        </a>
    </div>  
<?php 
} else {
    echo "Error: " . $conn->error;
}
?>

                        <?php 
include "conn.php"; 

$query = "SELECT COUNT(*) as rowCount 
          FROM students
          WHERE student_status = 'Verified'";

$result = $conn->query($query);

if ($result) {
    $row = $result->fetch_assoc();
?>
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <a href="student.php">
            <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>List of Student </h4>
                </div>
                <div class="card-body">
                    <?php echo $row['rowCount']; ?>
                </div>
            </div>
        </div>
        </a>
    </div>  
<?php 
} else {
    echo "Error: " . $conn->error;
}
?>

                
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
  <script src="assets/js/page/index-0.js"></script>
  
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