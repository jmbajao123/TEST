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
  <title>List of Documents - Credentials Verification Sibugay Technical Institute Inc.</title>

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
            <h1>List of Documents</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"> <a href="dashboard.php"> Dashboard </a> </div>
              <!-- <div class="breadcrumb-item"><a href="#">Department List</a></div> -->
              <div class="breadcrumb-item">List of Documents
              	
              </div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">List of Documents
            	<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float: right;">
              		Add new Documents
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
$total_sql = "SELECT COUNT(*) AS total FROM documents";
$total_result = mysqli_query($conn, $total_sql);
if (!$total_result) {
    die("Error in query: " . mysqli_error($conn));
}
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch data with pagination (now selecting status instead of a_id)
$sql = "SELECT doc_id, documents_name, doc_price, status FROM documents LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error in query: " . mysqli_error($conn));
}
?>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-md">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Document Name</th>
                        <th>Document Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): 
                        $count = $offset + 1;
                        while ($row = mysqli_fetch_assoc($result)): 
                            $status_badge = ($row['status'] == 'Available Document') ? 'badge-success' : 'badge-danger';
                    ?>
                    <tr>
                        <td><?= $count; ?></td>
                        <td><?= htmlspecialchars($row['documents_name']); ?></td>
                        <td><span class="">₱ </span> <?= htmlspecialchars($row['doc_price']); ?></td>
                        <td><div class="badge <?= $status_badge; ?>"><?= htmlspecialchars($row['status']); ?></div></td>
                        <td>
                            <a href="document_info.php?doc_id=<?= $row['doc_id']; ?>" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <?php 
                        $count++;
                        endwhile; 
                    else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No Document record found</td>
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
                <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= max(1, $page - 1); ?>"><i class="fas fa-chevron-left"></i></a>
                </li>
                <!-- Page Numbers -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
                <!-- Next Page -->
                <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= min($total_pages, $page + 1); ?>"><i class="fas fa-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
        
    </div>
</div>
<!-- Total Documents Display -->
        <div class="mt-2 text-muted">
            <strong>Total Documents: <?= $total_records; ?></strong>
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
		        <h5 class="modal-title" id="exampleModalLabel">Add new Documents</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		       <form method="post" action="list_documents.php">
		       	<div class="col-lg-12">
		       		<label>
		       			<h6>Documents Name</h6>
		       		</label>
		       		<input type="text" name="documents_name" id="documents_name" class="form-control" placeholder="Input the Documents Name" required>
		       	</div>
                <div class="col-lg-12">
                    <br>
                </div>
		       	<div class="col-lg-12">
    <label for="doc_price">
        <h6>Documents Price Payment</h6>
    </label>
    <div class="input-group">
        <span class="input-group-text">₱</span>
        <input type="number" name="doc_price" id="doc_price" class="form-control" placeholder="Enter amount" required min="0" step="1">
    </div>
</div>

<script>
    const docPriceInput = document.getElementById('doc_price');

    docPriceInput.addEventListener('keydown', function (e) {
        // Block non-numeric characters: e, E, +, -, ., and anything with shift key
        if (
            ['e', 'E', '+', '-', '.', ','].includes(e.key) ||
            (e.shiftKey && (e.key >= '0' && e.key <= '9'))
        ) {
            e.preventDefault();
        }
    });

    docPriceInput.addEventListener('input', function () {
        // Allow only whole numbers (digits only)
        this.value = this.value.replace(/\D/g, '');
    });
</script>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-outline-primary">Add Now</button>
		      </div>
		      </form>
		    </div>
		  </div>
		</div>
        <?php
include 'conn.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure admin is logged in
    if (!isset($_SESSION['a_id'])) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Unauthorized',
                    text: 'You must be logged in as an admin to add documents.',
                }).then(() => {
                    window.location.href = 'index.php';
                });
            </script>
        </body>
        </html>";
        exit;
    }

    $a_id = intval($_SESSION['a_id']); // Admin ID from session
    $documents_name = isset($_POST['documents_name']) ? trim($_POST['documents_name']) : '';
    $doc_price = isset($_POST['doc_price']) ? trim($_POST['doc_price']) : '';

    // Validate document name and price
    if (!empty($documents_name) && !empty($doc_price) && is_numeric($doc_price) && $doc_price >= 0) {
        // Insert with admin ID and document price
        $stmt = $conn->prepare("INSERT INTO documents (documents_name, doc_price, a_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $documents_name, $doc_price, $a_id);

        if ($stmt->execute()) {
            // Success
            echo "<!DOCTYPE html>
            <html>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Document Added',
                        text: 'The document has been successfully added!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'list_documents.php'; // Redirect back
                    });
                </script>
            </body>
            </html>";
        } else {
            // Error
            echo "<!DOCTYPE html>
            <html>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Database Error',
                        text: 'There was an issue adding the document. Please try again.',
                    }).then(() => {
                        window.history.back();
                    });
                </script>
            </body>
            </html>";
        }

        $stmt->close();
    } else {
        // Missing input or invalid price
        echo "<!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing or Invalid Input',
                    text: 'Please enter a valid document name and price.',
                }).then(() => {
                    window.history.back();
                });
            </script>
        </body>
        </html>";
    }

    $conn->close();
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