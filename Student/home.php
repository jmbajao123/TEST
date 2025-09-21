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
  <title>Home - Credentials Verifications</title>
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
        <div class="row gy-10 justify-content-center text-center">
          <div class="col-lg-12 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center">
            <img src="assets/img/new.png" width="80" height="80" data-aos="zoom-out">
            <div class="col-lg-12">
              <br>
            </div>
            <h1 data-aos="zoom-out">CredVerify</h1>
            <div class="col-lg-12">
              <br>
              <br>
            </div>
            <h4 data-aos="fade-up">
              A trusted platform that lets educational institutions, employers,<br> and students verify academic credentials quickly and securely.
            </h4>
            <div class="col-lg-12">
              <br>
              <br>
            </div>
            <div class="d-flex justify-content-center" data-aos="zoom-out" data-aos-delay="200">
              <!-- ✅ Request Button -->
              <a href="request_form.php" id="requestBtn" class="btn btn-outline-success position-relative overflow-hidden rounded-pill px-4 py-2 fw-semibold">
                <span class="btn-text"><i class="bi bi-file-earmark-text me-2"></i> Request Documents</span>
                <span class="btn-loading d-none">
                  <i class="bi bi-file-earmark-arrow-up me-2 spin-icon"></i> <span id="loadingPercent">0%</span>
                </span>
              </a>
            </div>
            <div class="col-lg-12">
              <br>
              <br>
            </div>
          </div>
        </div>
      </div>

    </section>
    <?php include 'req_button.php'; ?>
    <!-- <section id="chefs" class="chefs section">

      <div class="container section-title" data-aos="fade-up">
        <h2>chefs</h2>
        <p><span>Our</span> <span class="description-title">Proffesional Chefs<br></span></p>
      </div>
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/chefs/chefs-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Master Chef</span>
                <p>Velit aut quia fugit et et. Dolorum ea voluptate vel tempore tenetur ipsa quae aut. Ipsum exercitationem iure minima enim corporis et voluptate.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/chefs/chefs-2.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Sarah Jhonson</h4>
                <span>Patissier</span>
                <p>Quo esse repellendus quia id. Est eum et accusantium pariatur fugit nihil minima suscipit corporis. Voluptate sed quas reiciendis animi neque sapiente.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/chefs/chefs-3.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>William Anderson</h4>
                <span>Cook</span>
                <p>Vero omnis enim consequatur. Voluptas consectetur unde qui molestiae deserunt. Voluptates enim aut architecto porro aspernatur molestiae modi.</p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section> -->
  </main>
  <?php include 'footer.php'; ?>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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