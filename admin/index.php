<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>KUDUS FC - ADMIN</title>
        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
        <link rel="shortcut icon" href="../assets/img/logo-transparant.png" type="image/png">


        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Satisfy" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
        <style>
            .list-group-item {
        background-color: transparent;
        
    }

    .list-group-item a {
        color: inherit;
        text-decoration: none;
    }
        </style>
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
            <?php
                session_start();
                $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
                ?>
                <div class="sidebar-heading border-bottom bg-light"><?php echo $username; ?></div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-action <?php echo (isset($_GET['page']) && $_GET['page'] == 'home') ?>"><a href="index.php?page=home">Home</a></li>
                    <li class="list-group-item list-group-item-action <?php echo (isset($_GET['page']) && $_GET['page'] == 'kelola-pesanan') ?>"><a href="index.php?page=kelola-pesanan">Kelola Pesanan</a></li>
                    <li class="list-group-item list-group-item-action <?php echo (isset($_GET['page']) && $_GET['page'] == 'kelola-pertandingan') ?>"><a href="index.php?page=kelola-pertandingan">Kelola Pertandingan</a></li>
                    <li class="list-group-item list-group-item-action <?php echo (isset($_GET['page']) && $_GET['page'] == 'kelola-user') ?>"><a href="index.php?page=kelola-user">Kelola User</a></li>
                    <li class="list-group-item list-group-item-action"><a href="logout-admin.php">Logout</a></li>
                </ul>

            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="date">
                                    <script type='text/javascript'>
                                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                        var date = new Date();
                                        var day = date.getDate();
                                        var month = date.getMonth();
                                        var thisDay = date.getDay();
                                        thisDay = myDays[thisDay];
                                        var yy = date.getYear();
                                        var year = (yy < 1000) ? yy + 1900 : yy;
                                        document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                    </script>
                                </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid">
                <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $pagePath = 'pages/' . $page . '.php';

                switch ($page) {
                    case 'home':
                        include 'pages/home.php';
                        break;
                    case 'kelola-pesanan':
                        include 'pages/kelola-pesanan.php';
                        break;
                    case 'kelola-pertandingan':
                        include 'pages/kelola-pertandingan.php';
                        break;
                    case 'kelola-user':
                        include 'pages/kelola-user.php';
                        break;
                    case 'pesanan':
                        include 'pages/pesanan.php';
                         break;
                    case 'edit-pertandingan':
                         include 'pages/edit-pertandingan.php';
                        break;
                    case 'tambah-pertandingan':
                        include 'pages/tambah-pertandingan.php';
                        break;
                    default:
                    if (isset($_GET['page']) && strpos($_GET['page'], 'pesanan') !== false) {
                        $matchId = substr($_GET['page'], strpos($_GET['page'], "=") + 1);
                        include 'pages/pesanan.php';
                      } else {
                        include 'pages/home.php';
                      }
                      break;
                }
            }
            ?>
                </div>
            </div>
        </div>

        <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

    </body>
</html>