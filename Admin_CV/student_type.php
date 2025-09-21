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
  <title>Student Types - Credentials Verification Sibugay Technical Institute Inc.</title>

  <!-- General CSS Files -->
  <link rel="shortcut icon" href="assets/img/s.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <h1>Student Types</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"> <a href="dashboard.php"> Dashboard </a> </div>
              <!-- <div class="breadcrumb-item"><a href="#">Department List</a></div> -->
              <div class="breadcrumb-item"> Student Types
              	
              </div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title"> Student Types
            	<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;">
              		Add Student Types
              	</button>
            </h2>

            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <?php
include 'conn.php';

// Pagination settings
$limit = 10; // Maximum records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch total records count
$total_sql = "SELECT COUNT(*) AS total FROM student_types";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch data with pagination
$sql = "SELECT st_id, st_name, status FROM student_types LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
?>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <tr>
                    <th>#</th>
                    <th>Student Types</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php if (mysqli_num_rows($result) > 0): 
                    $count = $offset + 1;
                    while ($row = mysqli_fetch_assoc($result)): 
                        $status_badge = ($row['status'] == 'Available') ? 'badge-success' : 'badge-danger';
                ?>
                <tr>
                    <td><?= $count; ?></td>
                    <td><?= htmlspecialchars($row['st_name']); ?></td>
                    <td><div class="badge <?= $status_badge; ?>"><?= htmlspecialchars($row['status']); ?></div></td>
                    <td><a href="st_info.php?st_id=<?= $row['st_id']; ?>" class="btn btn-secondary">Edit</a></td>
                </tr>
                <?php 
                    $count++;
                    endwhile; 
                else: ?>
                <tr>
                    <td colspan="4" class="text-center">No records found</td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="card-footer text-right">
        <nav class="d-inline-block">
            <ul class="pagination mb-0">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page - 1; ?>"><i class="fas fa-chevron-left"></i></a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page + 1; ?>"><i class="fas fa-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php
// Close connection
mysqli_close($conn);
?>

              </div>
            </div>
            
            
          </div>
        </section>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Add Student Types</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		       <form method="post" action="student_type.php">
		       	<div class="col-lg-12">
		       		<label>
		       			<h6>Student Types </h6>
		       		</label>
		       		<input type="text" name="st_name" id="st_name" class="form-control" placeholder="Input the Student Types " required>
		       	</div>
		       	<div class="col-lg-12">
		       		<br>
		       	</div>
		       	<div class="col-lg-12">
		       		<label>
		       			<h6> Status</h6>
		       		</label>
		       		<select class="form-control" name="status" id="status">
		       			<option selected disabled>Select a Status</option>
		       			<option value="Available">Available</option>
		       			<option value="Unavailable">Unavailable</option>
		       		</select>
		       	</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-outline-primary">Add</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>
		<?php
include 'conn.php';

// Check if admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Access Denied',
                text: 'You must be logged in to perform this action.',
            }).then(() => {
                window.location.href = 'index.php'; // Redirect to login page
            });
          </script>";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $st_name = mysqli_real_escape_string($conn, $_POST['st_name']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $a_id = $_SESSION['a_id']; // Get currently logged-in admin's ID

    // Check if student type already exists
    $check_query = "SELECT * FROM student_types WHERE st_name = '$st_name'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Student type already exists
        echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Duplicate Entry',
                    text: 'The student type already exists in the database!',
                }).then(() => {
                    window.location.href = 'student_type.php'; // Redirect to student types page
                });
              </script>";
    } else {
        // Insert new student type
        $sql = "INSERT INTO student_types (st_name, status, a_id) VALUES ('$st_name', '$status', '$a_id')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Student type added successfully!',
                    }).then(() => {
                        window.location.href = 'student_type.php'; // Redirect to student types page
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Database Error!',
                        text: 'An error occurred: " . mysqli_error($conn) . "',
                    }).then(() => {
                        window.location.href = 'student_type.php'; // Redirect to student types page
                    });
                  </script>";
        }
    }

    // Close the connection
    mysqli_close($conn);
}
?>


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