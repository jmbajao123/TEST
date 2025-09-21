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
  <title>Department Information &mdash; Barangay Information System</title>

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
            <h1>Department Information</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></div>
              <div class="breadcrumb-item">Department Information</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12 col-lg-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <div class="col-lg-6">
                        <h2>Department Information</h2>
                    </div>
                  </div>
                  <div class="card-body">
<?php
include 'conn.php'; // Database connection

// Initialize variables
$department_name = $department_status = "";
$d_id = 0; // Initialize department ID

// Check if 'd_id' is provided in the URL to fetch department details
if (isset($_GET['d_id'])) {
    $d_id = intval($_GET['d_id']); // Sanitize input to prevent SQL injection

    // Fetch department details
    $query = "SELECT d_id, department_name, department_status FROM departments WHERE d_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $d_id); // Bind the d_id parameter
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $department_name = $row['department_name'];
            $department_status = $row['department_status']; // Store department_status
        } else {
            echo "Department not found!";
            exit;
        }
        $stmt->close();
    }
}

// Handle form submission for updating department details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Sanitize and escape form input
    $department_name = mysqli_real_escape_string($conn, $_POST['department_name']);
    $department_status = mysqli_real_escape_string($conn, $_POST['department_status']);
    $d_id = intval($_POST['d_id']); // Ensure d_id is passed via the form

    // Check if both fields are not empty and the department ID is valid
    if (!empty($department_name) && !empty($department_status) && $d_id > 0) {
        // Update query
        $update_query = "UPDATE departments SET department_name = ?, department_status = ? WHERE d_id = ?";
        if ($stmt = $conn->prepare($update_query)) {
            $stmt->bind_param("ssi", $department_name, $department_status, $d_id);
            $update_success = $stmt->execute();
            $stmt->close();

            // Check if the update was successful
            if ($update_success) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Department updated successfully!',
                    confirmButtonColor: '#28a745'
                }).then(() => { window.location.href='department.php'; });";
                echo "</script>";
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'No changes were made or error updating department.',
                    confirmButtonColor: '#dc3545'
                }).then(() => { window.history.back(); });";
                echo "</script>";
            }
        }
    } else {
        // If fields are empty, show warning alert
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        echo "Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: 'Please fill in all fields!',
            confirmButtonColor: '#ffc107'
        }).then(() => { window.history.back(); });";
        echo "</script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<form method="post" action="department_info.php">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <label><h4>Department Name</h4></label>
                <input type="text" name="department_name" class="form-control" value="<?php echo htmlspecialchars($department_name); ?>" required>
            </div>
            
            <div class="col-lg-6">
                <label><h4>Status</h4></label>
                <select name="department_status" class="form-control" required>
                    <option value="Active" <?php echo ($department_status === 'Active') ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?php echo ($department_status === 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>

            <!-- Hidden field to store the department ID -->
            <input type="hidden" name="d_id" value="<?php echo $d_id; ?>">

            <div class="col-lg-12"><br></div>
            <div class="col-lg-12">
                <a href="department.php" class="btn btn-outline-secondary">Back</a>
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