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
  <title>Request Form Documents - Credentials Verifications</title>
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

<!-- Bootstrap JS (Bundle includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body class="index-page">
  <?php include 'dash_header.php'; ?>
  <?php include 'student_vcode.php'; ?>
  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <div class="container">
        <div class="row gy-10 justify-content-center">
          <div class="col-lg-12 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center">
            <div class="col-lg-12">
            		<form action="request_form.php" method="post">
            			<input type="hidden" name="u_id" value="<?php echo $u_id; ?>">
										<input type="hidden" name="s_id" value="<?php echo $s_id; ?>">

            			<div class="row">
            				<?php include 'request_header.php'; ?>
	              			<div class="col-lg-12"><br></div>
	              			<div class="col-lg-3 mb-3 text-center">
			                	<input type="text" id="c_date" name="c_date" class="form-control fw-semibold text-center" readonly>
			                	<label for="c_date" class="form-label fw-semibold mt-1">Date</label>
			              	</div>
			              	<div class="col-lg-5 mb-3 text-center ms-auto">
										    <input 
										        type="text" 
										        id="req_referrence" 
										        name="req_referrence" 
										        class="form-control fw-semibold text-center d-inline-block w-auto" 
										        readonly
										    ><br>
										    <label for="req_referrence" class="form-label fw-semibold mt-1">Reference Code</label>
										</div>
										<?php include 'req_referrence_script.php'; ?>
			              	<?php include 'date_request_script.php'; ?>
			              	<div class="col-lg-12"><br></div>
			              	<div class="col-lg-8">
										    <label>
										        <strong>REQUEST FOR : </strong> <span>(Please Check)</span>
										    </label>
										    <div class="row mt-2">
										        <?php
										        include 'conn.php'; // ensure $conn is your DB connection

										        $sql = "SELECT doc_id, documents_name, doc_price FROM documents";
										        $result = $conn->query($sql);

										        if ($result && $result->num_rows > 0) {
										            $count = 0;
										            while ($row = $result->fetch_assoc()) {
										                $doc_id = htmlspecialchars($row['doc_id']);
										                $documents_name = htmlspecialchars($row['documents_name']);
										                $doc_price = number_format($row['doc_price'], 2, '.', ''); // make sure it's a valid number

										                // open new column for every 4 items
										                if ($count % 4 == 0) {
										                    echo "<div class='col-lg-12 col-md-6 col-sm-12'><div class='d-flex flex-column gap-2'>";
										                }
										                ?>
										                <div class="form-check">
										                    <input 
										                        class="form-check-input doc-checkbox" 
										                        type="checkbox" 
										                        id="doc_<?php echo $documents_name; ?>" 
										                        name="documents[]" 
										                        value="<?php echo $documents_name; ?>" 
										                        data-price="<?php echo $doc_price; ?>" >
										                    <label class="form-check-label fw-semibold" for="doc_<?php echo $documents_name; ?>">
										                        <?php echo $documents_name; ?> - 
										                        <span class="fw-bold">₱<?php echo $doc_price; ?></span>
										                    </label>
										                </div>
										                <?php
										                $count++;

										                // close column after 4 items
										                if ($count % 4 == 0) {
										                    echo "</div></div>";
										                }
										            }

										            // if last column has less than 4, close it
										            if ($count % 4 != 0) {
										                echo "</div></div>";
										            }

										        } else {
										            echo "<div class='col-12'><p class='text-muted'>No documents available.</p></div>";
										        }
										        ?>
										    </div>
										</div>

										<div class="col-lg-6 mt-3">
										    <h4>Total :</h4>
										    <input 
										        type="number" 
										        id="total_payment" 
										        name="total_payment" 
										        placeholder="Total Price Payment" 
										        class="form-control fw-bold" 
										        readonly
										    >
										</div>

									<?php include 'total_price.php'; ?>

	              			<div class="col-lg-12"><br></div>
	              			<?php include 'student_currently_sign_in.php'; ?>
	              			<!-- Name field (label + input aligned) -->
			              	<div class="col-lg-6">
				                <label for="full_name" class="form-label fw-semibold " >Full Name :</label>
				                <input 
				                  type="text" 
				                  id="full_name" 
				                  name="full_name" 
				                  class="form-control shadow-sm rounded-3" 
				                  value="<?php echo htmlspecialchars($full_name); ?>" 
				                  readonly
				                >
			              	</div>
			              	<div class="col-lg-6">
	                			<label for="course_year" class="form-label fw-semibold " >Course & Year :</label>
				                <input 
				                  type="text" 
				                  id="course_year" 
				                  name="course_year" 
				                  class="form-control shadow-sm rounded-3" 
				                  value="<?php echo htmlspecialchars($course_year); ?>" 
				                  readonly
				                >
	              			</div>
	              			<div class="col-lg-12">
	              				<br>
	              			</div>
	              			<div class="col-lg-12 mb-3">
				                <label class="form-label fw-semibold">
				                  Semester / Year Last Attended:
				                </label>
				                <div class="row g-3 mt-2">
				                  <!-- 1st Sem -->
				                  <div class="col-lg-3 col-md-6">
				                    <div class="form-check">
				                      <input class="form-check-input custom-checkbox" type="checkbox" id="sem1" name="semester[]" value="1st Semester">
				                      <label class="form-check-label" for="sem1">1st Sem</label>
				                    </div>
				                  </div>

				                  <!-- 2nd Sem -->
				                  <div class="col-lg-3 col-md-6">
				                    <div class="form-check">
				                      <input class="form-check-input custom-checkbox" type="checkbox" id="sem2" name="semester[]" value="2nd Semester">
				                      <label class="form-check-label" for="sem2">2nd Sem</label>
				                    </div>
				                  </div>

				                  <!-- Summer -->
				                  <div class="col-lg-3 col-md-6">
				                    <div class="form-check">
				                      <input class="form-check-input custom-checkbox" type="checkbox" id="summer" name="semester[]" value="Summer">
				                      <label class="form-check-label" for="summer">Summer</label>
				                    </div>
				                  </div>

				                  <!-- School Year -->
				                  <?php include 'year_graduated.php'; ?>
				                  <div class="col-lg-3 col-md-12">
				                    <label for="year_graduated" class="form-label fw-semibold me-2 mb-0">School Year:</label><br>
				                    <input 
				                      type="text" 
				                      id="year_graduated" 
				                      name="year_graduated" 
				                      class="form-control shadow-sm rounded-3" 
				                      placeholder="Input the School Year" 
				                      required
				                    >
				                  </div>
				                </div>
		              		</div>
		              		<?php include 'sem_year_script.php'; ?>
		              		
		              		<hr>
		              		<div class="col-lg-12"><br></div>
		              		<div class="col-lg-7">
											  <div class="d-flex align-items-start mb-3">
											    <!-- Label -->
											    <label for="full_name" class="form-label fw-semibold me-2">
											      Full Name :
											    </label>

											    <!-- Input -->
											    <input 
											      type="text" 
											      id="full_name" 
											      name="full_name" 
											      class="form-control shadow-sm rounded-3 w-auto flex-grow-1" 
											      value="<?php echo htmlspecialchars($full_name); ?>" 
											      readonly
											    >
											  </div>
											  <div class="d-flex align-items-start mb-3">
											    <!-- Label -->
											    <label for="address" class="form-label fw-semibold me-2">
											      Address :
											    </label>

											    <!-- Input -->
											    <input 
											      type="text" 
											      id="address" 
											      name="address" 
											      class="form-control shadow-sm rounded-3 w-auto flex-grow-1" 
											      value="<?php echo htmlspecialchars($address); ?>" 
											      readonly
											    >
											  </div>
											  <div class="d-flex align-items-start mb-3">
											    <!-- Label -->
											    <label for="date_birth" class="form-label fw-semibold me-2">
											      B-Date :
											    </label>

											    <!-- Input -->
											    <input 
											      type="text" 
											      id="date_birth" 
											      name="date_birth" 
											      class="form-control shadow-sm rounded-3 w-auto flex-grow-1" 
											      value="<?php echo htmlspecialchars($date_birth); ?>" 
											      readonly
											    >
											  </div>
											  <div class="d-flex align-items-start mb-3">
											    <!-- Label -->
											    <label for="date_place" class="form-label fw-semibold me-2">
											      B-Place :
											    </label>

											    <!-- Input -->
											    <input 
											      type="text" 
											      id="date_place" 
											      name="date_place" 
											      class="form-control shadow-sm rounded-3 w-auto flex-grow-1" 
											      placeholder="Input your Birth Place" 
											      value="<?php echo htmlspecialchars($b_place); ?>" 
											      readonly
											    >
											  </div>
											  <div class="d-flex align-items-start mb-3">
											    <!-- Label -->
											    <label for="civil_status" class="form-label fw-semibold me-2">
											      Civil Status :
											    </label>

											    <!-- Input -->
											    <input 
											      type="text" 
											      id="civil_status" 
											      name="civil_status" 
											      class="form-control shadow-sm rounded-3 w-auto flex-grow-1" 
											      value="<?php echo htmlspecialchars($civil_status); ?>" 
											      readonly
											    >
											  </div>
											</div>
											<div class="col-lg-7">
											  <div class="d-flex align-items-start mb-3">
											    <!-- Label -->
											    <label for="elementary" class="form-label fw-semibold me-2">
											      Elementary :
											    </label>

											    <!-- Input -->
											    <input 
											      type="text" 
											      id="elementary" 
											      name="elementary" 
											      class="form-control shadow-sm rounded-3 w-auto flex-grow-1"
											      placeholder="Input the Elementary School Name" 
											      required 
											    >
											  </div>
											</div>
											<div class="col-lg-5">
											  <div class="d-flex align-items-start mb-3">
											    <!-- Label -->
											    <label for="e_sy" class="form-label fw-semibold me-2">
											      S.Y :
											    </label>

											    <!-- Input -->
											    <input 
											      type="date" 
											      id="e_sy" 
											      name="e_sy" 
											      class="form-control shadow-sm rounded-3 w-auto flex-grow-1"
											      required 
											    >
											  </div>
											</div>
											<div class="col-lg-7">
											  <div class="d-flex align-items-start mb-3">
											    <!-- Label -->
											    <label for="high_school" class="form-label fw-semibold me-2">
											      High School :
											    </label>

											    <!-- Input -->
											    <input 
											      type="text" 
											      id="high_school" 
											      name="high_school" 
											      class="form-control shadow-sm rounded-3 w-auto flex-grow-1"
											      placeholder="Input the High School Name" 
											      required 
											    >
											  </div>
											</div>
											<div class="col-lg-5">
											  <div class="d-flex align-items-start mb-3">
											    <!-- Label -->
											    <label for="hs_sy" class="form-label fw-semibold me-2">
											      S.Y :
											    </label>

											    <!-- Input -->
											    <input 
											      type="date" 
											      id="hs_sy" 
											      name="hs_sy" 
											      class="form-control shadow-sm rounded-3 w-auto flex-grow-1"
											      required 
											    >
											  </div>
											</div>
											<?php include 'sy_script.php'; ?>
											<div class="col-lg-7">
												<div class="d-flex align-items-start mb-3">
												    <!-- Label -->
												    <label for="parents_fname" class="form-label fw-semibold me-2">
												      Parents/Guardian Full Name :
												    </label>

												    <!-- Input -->
												    <input 
												      type="text" 
												      id="parents_fname" 
												      name="parents_fname" 
												      class="form-control shadow-sm rounded-3 w-auto flex-grow-1" 
												      placeholder="Input the Parents/Guardian Full Name" 
												      required 
												    >
											  	</div>
											</div>
		              		<div class="col-lg-12">
												<br>
											</div>
											<hr>
											<div class="col-lg-12">
												<br>
											</div>
											<div class="col-lg-12 d-flex justify-content-between align-items-center">
											  <!-- Home Button (Left) -->
											  <a href="home.php" id="requestBtn" 
											     class="btn btn-outline-secondary position-relative overflow-hidden rounded-pill px-4 py-2 fw-semibold">
											    <span class="btn-text"><i class="bi bi-house-door me-2"></i> Home</span>
											    <span class="btn-loading d-none">
											      <i class="bi bi-house-door me-2 spin-icon"></i> <span id="loadingPercent">0%</span>
											    </span>
											  </a>

											  <!-- Submit Request Button (Right) -->
											  <button type="submit"  
											          class="btn btn-outline-success position-relative overflow-hidden rounded-pill px-4 py-2 fw-semibold">
											    <span class="btn-text"><i class="bi bi-file-earmark-arrow-up me-2"></i> Submit Request</span>
											    <span class="btn-loading d-none">
											      <i class="bi bi-arrow-repeat me-2 spin-icon"></i> <span id="loadingPercent">0%</span>
											    </span>
											  </button>
											</div>
            			</div>
            		</form>
            		<?php
include "conn.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    session_start(); // Ensure session is started

    function validate($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // ✅ IDs of currently signed-in student
    $u_id = $_SESSION['u_id'] ?? null;
    $s_id = $_SESSION['s_id'] ?? null;

    if (!$u_id || !$s_id) {
        die("Error: Missing user or student ID. Please log in again.");
    }

    // ✅ Block new request if there is already a request with status 'Request Documents'
    $check_sql = "SELECT req_id FROM request WHERE (u_id = ? OR s_id = ?) AND status = 'Request Documents' LIMIT 1";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $u_id, $s_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result && $check_result->num_rows > 0) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Warning!',
                text: 'You already have a request with status: Request Documents. Please wait until it is processed before submitting a new request.',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then(() => { window.location.href = 'request_form.php'; });
        </script>";
        exit;
    }
    $check_stmt->close();

    // ✅ Collect posted data
    $c_date         = validate($_POST['c_date'] ?? '');
    $req_referrence = validate($_POST['req_referrence'] ?? '');
    $documents      = $_POST['documents'] ?? [];
    $total_payment  = (float) ($_POST['total_payment'] ?? 0);
    $full_name      = validate($_POST['full_name'] ?? '');
    $course_year    = validate($_POST['course_year'] ?? '');
    $semester       = $_POST['semester'] ?? [];
    $year_graduated = validate($_POST['year_graduated'] ?? '');
    $address        = validate($_POST['address'] ?? '');
    $date_birth     = validate($_POST['date_birth'] ?? '');
    $date_place     = validate($_POST['date_place'] ?? '');
    $civil_status   = validate($_POST['civil_status'] ?? '');
    $elementary     = validate($_POST['elementary'] ?? '');
    $e_sy           = validate($_POST['e_sy'] ?? '');
    $high_school    = validate($_POST['high_school'] ?? '');
    $hs_sy          = validate($_POST['hs_sy'] ?? '');
    $parents_fname  = validate($_POST['parents_fname'] ?? '');

    // Convert arrays to strings
    $documents_str = !empty($documents) ? implode(", ", $documents) : '';
    $semester_str  = !empty($semester) ? implode(", ", $semester) : '';

    // ✅ Holidays
    $holidays = [
        date("Y") . "-01-01",
        date("Y") . "-06-12",
        date("Y") . "-11-01",
        date("Y") . "-12-25",
        date("Y") . "-12-30",
    ];

    // ✅ Function to generate available slot (Monday–Saturday)
    function generatePaySlot($conn, $holidays) {
        $date = date("Y-m-d", strtotime("+1 day")); // Start from tomorrow

        while (true) {
            $day_of_week = date("l", strtotime($date));

            // Skip Sundays and holidays
            if ($day_of_week === "Sunday" || in_array($date, $holidays)) {
                $date = date("Y-m-d", strtotime($date . " +1 day"));
                continue;
            }

            // Define slots (8:00–12:00 & 13:00–17:00)
            $slots = [];
            $times = [
                ["08:00", "12:00"], // Morning
                ["13:00", "17:00"]  // Afternoon
            ];

            foreach ($times as $time_range) {
                $start = strtotime($time_range[0]);
                $end   = strtotime($time_range[1]);
                while ($start < $end) {
                    $slot_start = date("h:i A", $start);
                    $slot_end   = date("h:i A", strtotime("+20 minutes", $start));
                    $slots[] = "$slot_start - $slot_end";
                    $start = strtotime("+20 minutes", $start);
                }
            }

            // Check taken slots
            $taken = [];
            $sql = "SELECT pay_time FROM request WHERE pay_date = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $date);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $taken[] = $row['pay_time'];
            }
            $stmt->close();

            // Assign first available slot
            foreach ($slots as $slot) {
                if (!in_array($slot, $taken)) {
                    return [
                        "pay_day"  => $day_of_week,
                        "pay_date" => $date,
                        "pay_time" => $slot
                    ];
                }
            }

            // Fully booked → next day
            $date = date("Y-m-d", strtotime($date . " +1 day"));
        }
    }

    // ✅ Get available pay slot
    $slot = generatePaySlot($conn, $holidays);
    $pay_day  = $slot["pay_day"];
    $pay_date = $slot["pay_date"];
    $pay_time = $slot["pay_time"];

    // ✅ Insert request into DB
    $sql = "INSERT INTO request 
            (u_id, s_id, c_date, req_referrence, documents, total_payment, full_name, course_year, semester, year_graduated, address, date_birth, date_place, civil_status, elementary, e_sy, high_school, hs_sy, parents_fname, pay_day, pay_date, pay_time) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "iisssdssssssssssssssss", 
            $u_id,
            $s_id,
            $c_date,
            $req_referrence,
            $documents_str,
            $total_payment,
            $full_name,
            $course_year,
            $semester_str,
            $year_graduated,
            $address,
            $date_birth,
            $date_place,
            $civil_status,
            $elementary,
            $e_sy,
            $high_school,
            $hs_sy,
            $parents_fname,
            $pay_day,
            $pay_date,
            $pay_time
        );

        if ($stmt->execute()) {
            $req_id = $stmt->insert_id;

            // ✅ Generate cashier number
            $cashier_number = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 6);

            $update_sql = "UPDATE request SET cashier_number = ? WHERE req_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            if ($update_stmt) {
                $update_stmt->bind_param("si", $cashier_number, $req_id);
                $update_stmt->execute();
                $update_stmt->close();
            }

            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'Success!',
                    html: 'Request submitted successfully!<br>Cashier Code: <b>$cashier_number</b><br>Pay Date: <b>$pay_date</b><br>Pay Day: <b>$pay_day</b><br>Pay Time: <b>$pay_time</b>',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => { window.location.href = 'request.php'; });
            </script>";
        } else {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error inserting request: " . addslashes($stmt->error) . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => { window.history.back(); });
            </script>";
        }
        $stmt->close();
    } else {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Error preparing statement: " . addslashes($conn->error) . "',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then(() => { window.history.back(); });
        </script>";
    }

    $conn->close();
}
?>






            </div>
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

  </main>
  <?php include 'footer.php'; ?>
  <!-- Scroll Top -->
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