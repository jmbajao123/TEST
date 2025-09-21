<header id="header" class="header d-flex align-items-center sticky-top" style="background: linear-gradient(90deg, #87CEFA 0%, #98FB98 100%);">
  <div class="container position-relative d-flex align-items-center justify-content-between">
    <a href="home.php" class="logo d-flex align-items-center me-auto me-xl-0">
      <!-- <img src="assets/img/logo.png" alt=""> -->
      <img src="assets/img/cv.png" width="80" height="80">
      <h1 class="sitename">CredVerify</h1>
    </a>

    <!-- Navigation -->
    <nav id="navmenu" class="navmenu text-black fw-bold" style="padding-right: 90px;">
      <ul>
        <li><a href="home.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>">Home</a></li>
        <li><a href="#about" class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About</a></li>
        <li><a href="#contact" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>

       <?php
include 'conn.php';

// Make sure student is logged in
if (!isset($_SESSION['s_id'])) {
    die("Please log in to view notifications.");
}

$s_id = $_SESSION['s_id'];

// Initialize
$notifications = [];
$unread_count = 0;

/* --------------------------
   1. Credential Code notification
-------------------------- */
$stmt = $conn->prepare("
    SELECT first_name, middle_name, last_name, suffix_name, student_vcode, sc_is_read
    FROM students 
    WHERE s_id = ?
");
$stmt->bind_param("i", $s_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $student = $result->fetch_assoc();

    $full_name = $student['first_name'];
    if (!empty($student['middle_name'])) $full_name .= ' ' . $student['middle_name'];
    $full_name .= ' ' . $student['last_name'];
    if (!empty($student['suffix_name']) && strtolower($student['suffix_name']) !== 'none') {
        $full_name .= ' ' . $student['suffix_name'];
    }

    if (!empty($student['student_vcode']) && $student['sc_is_read'] == 0) {
        $notifications[] = [
            'type' => 'credential',
            'title' => "Notice Regarding Your Credential Code",
            'message' => "$full_name, your Credential Code has been used. A new Student Credential Code has been generated for your account.",
            'student_vcode' => $student['student_vcode'],
            's_id' => $s_id
        ];
        $unread_count++;
    }
}
$stmt->close();

/* --------------------------
   2. Payment Updates
-------------------------- */
$payment_stmt = $conn->prepare("
    SELECT req_id, req_referrence, or_number, payment_status, st_is_read
    FROM request
    WHERE s_id = ? AND st_is_read = 0 AND payment_status = 'Paid'
    ORDER BY req_id DESC
");
$payment_stmt->bind_param("i", $s_id);
$payment_stmt->execute();
$payment_result = $payment_stmt->get_result();

while ($row = $payment_result->fetch_assoc()) {
    $notifications[] = [
        'type' => 'payment',
        'title' => "Request Documents Alert",
        'message' => "Your request documents has been marked as PAID. OR Number: {$row['or_number']}.",
        'req_id' => $row['req_id']
    ];
    $unread_count++;
}
$payment_stmt->close();

/* --------------------------
   3. Status Updates (Only for "Release Documents")
-------------------------- */
$status_stmt = $conn->prepare("
    SELECT req_id, req_referrence, status, rs_is_read
    FROM request
    WHERE s_id = ? AND rs_is_read = 0 AND status = 'Release Documents'
    ORDER BY req_id DESC
");
$status_stmt->bind_param("i", $s_id);
$status_stmt->execute();
$status_result = $status_stmt->get_result();

while ($row = $status_result->fetch_assoc()) {
    $notifications[] = [
        'type' => 'status',
        'title' => "Request Documents Alert",
        'message' => "Your request documents status has been updated to: {$row['status']}.",
        'req_id' => $row['req_id']
    ];
    $unread_count++;
}
$status_stmt->close();
?>
<!-- 🔔 Notification Dropdown -->
<li class="nav-item dropdown">
    <a class="nav-link position-relative dropdown-toggle" href="#" id="notifDropdown" role="button" aria-expanded="false">
        <i class="bi bi-bell fs-5"></i>
        <?php if ($unread_count > 0): ?>
            <span id="notifBadge" 
                  class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle p-1"
                  style="font-size: 0.7rem; min-width: 18px; height: 18px; line-height: 1.1;">
                <?php echo $unread_count; ?>
            </span>
        <?php endif; ?>
    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-0" 
        aria-labelledby="notifDropdown" 
        style="min-width: 380px; border-radius: 0.75rem; overflow: hidden;">
        
        <!-- Header -->
        <li class="bg-primary-subtle text-black px-3 py-2">
            <span class="fw-semibold">Notifications</span>
        </li>

        <!-- Notifications List -->
        <?php if (!empty($notifications)): ?>
            <?php foreach ($notifications as $index => $notif): ?>
                <li>
                    <?php if ($notif['type'] === 'payment'): ?>
                        <!-- Payment notifications -->
                        <a href="payment_request.php?req_id=<?php echo $notif['req_id']; ?>" 
                           class="dropdown-item d-flex align-items-start gap-3 p-3 border-bottom"
                           style="white-space: normal;">
                            <div class="flex-shrink-0">
                                <i class="bi bi-cash-stack text-success fs-4"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold text-dark mb-1 notif-title">
                                    <?php echo htmlspecialchars($notif['title']); ?>
                                </div>
                                <small class="text-muted notif-subtext">
                                    <?php echo htmlspecialchars($notif['message']); ?>
                                </small>
                            </div>
                        </a>
                    <?php elseif ($notif['type'] === 'status'): ?>
                        <!-- Status update notifications -->
                        <a href="status_request.php?req_id=<?php echo $notif['req_id']; ?>" 
                           class="dropdown-item d-flex align-items-start gap-3 p-3 border-bottom"
                           style="white-space: normal;">
                            <div class="flex-shrink-0">
                                <i class="bi bi-clipboard-check text-primary fs-4"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold text-dark mb-1 notif-title">
                                    <?php echo htmlspecialchars($notif['title']); ?>
                                </div>
                                <small class="text-muted notif-subtext">
                                    <?php echo htmlspecialchars($notif['message']); ?>
                                </small>
                            </div>
                        </a>
                    <?php else: ?>
                        <!-- Credential notifications -->
                        <a href="#" 
                           class="dropdown-item d-flex align-items-start gap-3 p-3 border-bottom notifLink" 
                           data-bs-toggle="modal" 
                           data-bs-target="#notifModal<?php echo $index; ?>"
                           style="white-space: normal;">
                            <div class="flex-shrink-0">
                                <i class="bi bi-info-circle-fill text-warning fs-4"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold text-dark mb-1 notif-title">
                                    <?php echo htmlspecialchars($notif['title']); ?>
                                </div>
                                <small class="text-muted notif-subtext">
                                    <?php echo htmlspecialchars($notif['message']); ?>
                                </small>
                            </div>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>
                <span class="dropdown-item text-muted text-center py-3">
                    No new notifications
                </span>
            </li>
        <?php endif; ?>
    </ul>
</li>




        <?php include 'notif_style.php'; ?>
        <li><a href="request.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'request.php' ? 'active' : ''; ?>">Request</a></li>
        <!-- User Dropdown (opens only on click) -->
        <li class="nav-item dropdown">
          <a href="#" id="userDropdownToggle" class="nav-link d-flex align-items-center" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="me-2"><?php echo htmlspecialchars($full_name); ?></span>
            <i class="bi bi-chevron-down toggle-dropdown"></i>
          </a>

          <ul id="userMenu" class="dropdown-menu dropdown-menu-end shadow border-0 p-2" aria-labelledby="userDropdownToggle" style="min-width: 200px;">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li>
              <a href="#" id="logoutBtn" class="dropdown-item">Sign Out</a>

              <!-- SweetAlert2: sign out script -->
              <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
              <script>
                document.addEventListener("DOMContentLoaded", function () {
                  const logoutBtn = document.getElementById("logoutBtn");
                  if (logoutBtn) {
                    logoutBtn.addEventListener("click", function(event) {
                      event.preventDefault();
                      Swal.fire({
                        title: "Hello, <?php echo addslashes(htmlspecialchars($full_name)); ?>!",
                        html: "<strong>Are you sure you want to sign out?</strong>",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Sign Out",
                        cancelButtonText: "Cancel",
                        customClass: {
                          confirmButton: 'btn btn-outline-success px-4',
                          cancelButton: 'btn btn-outline-danger px-4',
                          popup: 'swal2-custom-buttons'
                        },
                        buttonsStyling: false
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "sign_out.php";
                        }
                      });
                    });
                  }
                });
              </script>

              <style>
                .swal2-custom-buttons .swal2-actions { display: flex !important; justify-content: center; gap: 15px; }
              </style>
            </li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </div>
</header>