<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>KUDUS FC</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="shortcut icon" href="assets/img/logo-transparant.png" type="image/png">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Satisfy" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <style>

  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php
  // Koneksi ke database
  include "proses/connect.php";
  $sql = "SELECT * FROM pertandingan";
  $result = $conn->query($sql);

  ?>
  <header id="header" class="fixed-top d-flex justify-content-center align-items-center">
    <div class="logo-container">
      <img src="assets/img/logo-transparant.png" alt="Logo Klub" class="logo" style="max-width: 150px; margin-top: 40px;">
    </div>
    <nav id="navbar" class="navbar navbar-expand-md navbar-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul>
          <li class="nav-item"><a class="nav-link scrollto <?php echo (isset($_GET['x']) && $_GET['x'] == 'home') ? 'active' : ''; ?>" href="index.php?page=home">Home</a></li>
          <li class="nav-item"><a class="nav-link scrollto <?php echo (isset($_GET['x']) && $_GET['x'] == 'fixtures') ? 'active' : ''; ?>" href="index.php?page=fixtures">Pertandingan</a></li>
          <li class="nav-item"><a class="nav-link scrollto <?php echo (isset($_GET['x']) && $_GET['x'] == 'ticket') ? 'active' : ''; ?>" href="index.php?page=ticket">Beli tiket</a></li>
          <li class="nav-item"><a class="nav-link scrollto <?php echo (isset($_GET['x']) && $_GET['x'] == 'histori') ? 'active' : ''; ?>" href="index.php?page=histori">Histori Pembelian Tiket</a></li>
          <li style="margin-left: 300px;">
            <?php
            session_start();
            if (isset($_SESSION['id_pengguna'])) {
              echo '<a class="nav-link scrollto" href="logout.php">Logout</a>';
            } else {
              echo '<a class="nav-link scrollto" href="login.php">Login</a>';
            }
            ?>
          </li>
        </ul>
      </div>

    </nav><!-- .navbar -->
  </header><!-- End Header -->


  <main>
    <?php
    // Cek jika parameter 'page' ada
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
      $pagePath = 'pages/' . $page . '.php';


      switch ($page) {
        case 'home':
          include 'pages/home.php';
          break;
        case 'ticket':
          include 'pages/ticket.php';
          break;
        case 'fixtures':
          include 'pages/fixtures.php';
          break;
        case 'histori':
          include 'pages/histori.php';
          break;
        case 'match-detail':
          include 'pages/match_details.php';
          break;
        case 'buy-ticket':
          include 'pages/buy-ticket.php';
          break;
        case 'booking-ticket':
          include 'pages/booking-ticket.php';
          break;
        default:
          if (isset($_GET['page']) && strpos($_GET['page'], 'match-detail') !== false) {
            $matchId = substr($_GET['page'], strpos($_GET['page'], "=") + 1);
            include 'pages/match_details.php';
          } else {
            include 'pages/about.php';
          }
          break;
      }
    }
    ?>
  </main>


  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <span>Contact Us</span>
        <h2>Contact us</h2>
      </div>

      <div class="row justify-content-center">

        <div class="col-lg-10">

          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="10" placeholder="Message" required></textarea>
            </div>
            <!-- <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div> -->
            <div class="text-center" style="margin-top:20px;"><button type="submit">Send Message</button></div>
          </form>

        </div>

      </div>

    </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="container">
    <h3>KUDUS FOOTBALL CLUB</h3>
    <p>Ikuti kami di sosial media untuk mendapatkan update terbaru tentang kami.</p>
    <div class="social-links">
      <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
      <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
      <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
      <a href="#" class="youtube"><i class="bx bxl-youtube"></i></a>
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/laura-free-creative-bootstrap-theme/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
<script>
   $(document).ready(function() {
    $('.btnPembayaran').click(function() {
        var modalId = $(this).data('target');
        $(modalId).modal('show');
    });
});

</script>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>
