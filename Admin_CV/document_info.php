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
  <title>Document Information &mdash; Barangay Information System</title>

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
            <h1>Document Information</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="dashboard.php">Dashboard</a></div>
              <div class="breadcrumb-item">Document Information</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row">
              <div class="col-12 col-lg-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <div class="col-lg-6">
                        <h2>Document Information</h2>
                    </div>
                  </div>
                  <div class="card-body">
<?php
include 'conn.php'; // Database connection

// Initialize variables
$documents_name = $doc_price = $status = "";
$doc_id = 0; // Initialize document ID

// Check if 'doc_id' is provided in the URL to fetch document details
if (isset($_GET['doc_id'])) {
    $doc_id = intval($_GET['doc_id']); // Sanitize input to prevent SQL injection

    // Fetch document details
    $query = "SELECT doc_id, documents_name, doc_price, status FROM documents WHERE doc_id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $doc_id); // Bind the doc_id parameter
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $documents_name = $row['documents_name'];
            $doc_price = $row['doc_price'];
            $status = $row['status']; // Store status
        } else {
            echo "Document not found!";
            exit;
        }
        $stmt->close();
    }
}

// Handle form submission for updating document details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Sanitize and escape form input
    $documents_name = mysqli_real_escape_string($conn, $_POST['documents_name']);
    $doc_price = mysqli_real_escape_string($conn, $_POST['doc_price']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $doc_id = intval($_POST['doc_id']); // Ensure doc_id is passed via the form

    // Check if the document ID is valid
    if ($doc_id > 0) {
        // Prepare the SQL query
        $update_query = "UPDATE documents SET documents_name = ?, doc_price = ?, status = ? WHERE doc_id = ?";

        // Set values for bind_param
        $new_documents_name = !empty($documents_name) ? $documents_name : $row['documents_name']; // Use existing if empty
        $new_doc_price = !empty($doc_price) ? $doc_price : $row['doc_price']; // Use existing if empty
        $new_status = $status; // Status will always be updated

        // Prepare statement
        if ($stmt = $conn->prepare($update_query)) {
            // Bind the parameters
            $stmt->bind_param("sssi", $new_documents_name, $new_doc_price, $new_status, $doc_id);

            // Execute the query
            $update_success = $stmt->execute();
            $stmt->close();

            // Check if the update was successful
            if ($update_success) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Document updated successfully!',
                    confirmButtonColor: '#28a745'
                }).then(() => { window.location.href='list_documents.php'; });";
                echo "</script>";
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>";
                echo "Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'No changes were made or error updating document.',
                    confirmButtonColor: '#dc3545'
                }).then(() => { window.history.back(); });";
                echo "</script>";
            }
        }
    } else {
        // If document ID is invalid
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>";
        echo "Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: 'Invalid document ID.',
            confirmButtonColor: '#ffc107'
        }).then(() => { window.history.back(); });";
        echo "</script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<form method="post" action="document_info.php">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4">
                <label><h4>Document Name</h4></label>
                <input type="text" name="documents_name" class="form-control" 
                       value="<?php echo htmlspecialchars($documents_name); ?>" required>
            </div>
            <div class="col-lg-4">
                <label><h4>Document Price</h4></label>
                <input type="text" name="doc_price" class="form-control" 
                       value="<?php echo htmlspecialchars($doc_price); ?>" required>
            </div>
            <div class="col-lg-4">
                <label><h4>Status</h4></label>
                <select name="status" class="form-control" required>
                    <option value="Available Document" <?php echo ($status === 'Available Document') ? 'selected' : ''; ?>>Available Document</option>
                    <option value="Unavailable Document" <?php echo ($status === 'Unavailable Document') ? 'selected' : ''; ?>>Unavailable Document</option>
                </select>
            </div>

            <!-- Hidden field to store the document ID -->
            <input type="hidden" name="doc_id" value="<?php echo $doc_id; ?>">

            <div class="col-lg-12"><br></div>
            <div class="col-lg-12">
                <a href="list_documents.php" class="btn btn-outline-secondary">Back</a>
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