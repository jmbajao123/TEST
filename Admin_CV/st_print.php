<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Students List Reports - Credentials Verification Sibugay Technical Institute Inc.</title>

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

<body>
<br><br><br>
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-body">
                <center>
                    <h2 class="section-title">Student List Reports</h2>
                </center>

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <?php
                        include 'conn.php';

                        // Fetch all student records with department and course names
                        $query = "SELECT s.s_id, s.first_name, s.middle_name, s.last_name, s.suffix_name, s.profile, s.student_status, 
                                         d.department_name, c.course_name
                                  FROM students s
                                  LEFT JOIN departments d ON s.d_id = d.d_id
                                  LEFT JOIN course c ON s.c_id = c.c_id"; // Fixed table name from 'course' to 'courses'

                        $result = mysqli_query($conn, $query);
                        ?>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Student Name</th>
                                            <th>Profile Picture</th>
                                            <th>Department</th>
                                            <th>Course</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($result) > 0) :
                                            $count = 1;
                                            while ($row = mysqli_fetch_assoc($result)) :
                                                $fullName = trim("{$row['first_name']} {$row['middle_name']} {$row['last_name']}");
                                                if (!empty($row['suffix_name']) && strtolower($row['suffix_name']) !== "none") {
                                                    $fullName .= " " . htmlspecialchars($row['suffix_name']);
                                                }
                                        ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><?= htmlspecialchars($fullName) ?></td>
                                                    <td class="text-center">
                                                        <?php if (!empty($row['profile'])): ?>
                                                            <img src="<?= htmlspecialchars($row['profile']) ?>" alt="Profile Picture" width="80" height="80" class="rounded-circle">
                                                        <?php else: ?>
                                                            <span>No Profile Picture</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($row['department_name'] ?? 'N/A') ?></td>
                                                    <td><?= htmlspecialchars($row['course_name'] ?? 'N/A') ?></td>
                                                    <td><?= htmlspecialchars($row['student_status']) ?></td>
                                                </tr>
                                        <?php
                                                $count++;
                                            endwhile;
                                        else : ?>
                                            <tr>
                                                <td colspan="6" class="text-center">No Student Records Found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php
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
            filename: 'studentlist.pdf',
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
        html2pdf().from(printableElement).set(options).save().then(function () {
            window.print();
        });
    }
</script>


</body>

</html>