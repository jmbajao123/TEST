<?php ?>
<nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
          
        </form>
        <ul class="navbar-nav navbar-right">
          <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b>
                    <p>Hello, Bro!</p>
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Dedik Sugiharto</b>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Agung Ardiansyah</b>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Ardian Rahardiansyah</b>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                    <div class="time">16 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Alfa Zulkarnain</b>
                    <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li> -->
          <?php
include 'conn.php';

$unread_count = 0; // Initialize to avoid undefined variable

// Fetch unread requests (c_is_read = 0) with student full name and request reference
$query = "
SELECT r.req_id, r.req_referrence,
       CONCAT(s.first_name, ' ', 
              IF(s.middle_name IS NOT NULL AND s.middle_name != '', CONCAT(s.middle_name, ' '), ''), 
              s.last_name,
              IF(s.suffix_name IS NOT NULL AND s.suffix_name != '' AND s.suffix_name != 'None', CONCAT(' ', s.suffix_name), '')
       ) AS full_name
FROM request r
JOIN students s ON r.s_id = s.s_id
WHERE r.payment_status = 'Unpaid' AND r.c_is_read = 0
ORDER BY r.c_date DESC
";

$result = $conn->query($query);

if ($result) {
    $unread_count = $result->num_rows;
}
?>

<li class="dropdown dropdown-list-toggle">
    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
        <i class="far fa-bell"></i>
        <?php if ($unread_count > 0): ?>
            <span class="badge badge-danger badge-counter"><?php echo $unread_count; ?></span>
        <?php endif; ?>
    </a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">
            Notifications
            <div class="float-right">
                <a href="mark_all_read.php">Mark All As Read</a>
            </div>
        </div>
        <div class="dropdown-list-content dropdown-list-icons">
            <?php if ($unread_count > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <a href="view_request.php?req_id=<?php echo $row['req_id']; ?>" class="dropdown-item dropdown-item-unread">
                        <div class="dropdown-item-icon bg-primary text-white">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <div class="dropdown-item-desc">
                            Request from <b><?php echo htmlspecialchars($row['full_name']); ?></b>
                            <br>
                            Reference: <b><?php echo htmlspecialchars($row['req_referrence']); ?></b>
                        </div>
                    </a>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="dropdown-item text-center text-muted">
                    No new notifications
                </div>
            <?php endif; ?>
        </div>
        <div class="dropdown-footer text-center">
            <a href="all_requests.php">View All <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</li>



          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="assets/img/stii.jpg" class="rounded-circle mr-" height="30">
            <div class="d-sm-none d-lg-inline-block"><?php echo $_SESSION['email'] ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <a href="#" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a> -->
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger" id="logoutBtn">
    <i class="fas fa-sign-out-alt"></i> Sign Out
</a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById("logoutBtn").addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default link action

        Swal.fire({
            title: "Are you sure?",
            text: "You will be signed out!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Sign Out",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "sign_out.php"; // Redirect if confirmed
            }
        });
    });
</script>
            </div>
          </li>
        </ul>
      </nav>