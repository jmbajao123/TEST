<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Department List Reports - Credentials Verification Sibugay Technical Institute Inc.</title>

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
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
        }

        .picture-box {
            width: 150px;
            height: 150px;
            border: 1px solid #ccc;
            text-align: center;
            line-height: 150px;
            display: inline-block;
            /* Add this line */
            margin-left: 25px;
        }

        .underline {
            text-decoration: underline;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        @media print {
            #printSaveButtonContainer {
                display: none;
            }
            body {
                width: 100%;
            }

            table {
                width: 100%;
            }

            th, td {
                word-break: break-all;
            }
        }
    </style>
</head>

<body >
<br><br><br>
    <div class="container" >
    <div class="row">
        <div class="col-lg-12">
            <div class="section-body">
            <center>
                <h2 class="section-title">Department List Reports
            </h2>
            </center>

            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <?php
                include 'conn.php';

                // Pagination settings
                $limit = 10; // Maximum records per page
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                // Fetch total records count
                $total_sql = "SELECT COUNT(*) AS total FROM departments";
                $total_result = mysqli_query($conn, $total_sql);
                $total_row = mysqli_fetch_assoc($total_result);
                $total_records = $total_row['total'];
                $total_pages = ceil($total_records / $limit);

                // Fetch data with pagination
                $sql = "SELECT d_id, department_name, department_status FROM departments LIMIT $limit OFFSET $offset";
                $result = mysqli_query($conn, $sql);
                ?>

                <div class="card" style="background-color: light-transparent;">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-md" >
                                <tr>
                                    <th>#</th>
                                    <th>Department Name</th>
                                    <th>Status</th>
                                </tr>
                                <?php if (mysqli_num_rows($result) > 0): 
                                    $count = $offset + 1;
                                    while ($row = mysqli_fetch_assoc($result)): 
                                        $status_badge = ($row['department_status'] == 'Active') ? 'badge-success' : 'badge-danger';
                                ?>
                                <tr>
                                    <td><?= $count; ?></td>
                                    <td><?= htmlspecialchars($row['department_name']); ?></td>
                                    <td><div class="badge <?= $status_badge; ?>"><?= htmlspecialchars($row['department_status']); ?></div></td>
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
                    <!-- <div class="card-footer text-right">
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
                    </div> -->
                </div>

                <?php
                // Close connection
                mysqli_close($conn);
                ?>

              </div>
            </div>
            
            
          </div>
        </div>
    </div>
    <div class="text-center mt-4" id="printSaveButtonContainer">
        <button class="btn btn-primary" onclick="printAndSave()">Print & Save</button>
    </div>
</div>




    <script>
        function printAndSave() {
            // Create an HTML element to contain the printable content
            var printableElement = document.getElementById('reports-container');

            // Options for html2pdf
            var options = {
                margin: 10,
                filename: 'Department List Reports.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'landscape'
                }
            };

            // Use html2pdf to generate the PDF and save it
            html2pdf(printableElement, options).then(function (pdf) {
                // Save the PDF using FileSaver.js
                
                window.print();
            });
        }
    </script>

</body>

</html>