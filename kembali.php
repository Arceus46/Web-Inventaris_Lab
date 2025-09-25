<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Terminate script execution after the redirect
} elseif ($_SESSION['role'] !== 'admin') {
    header("Location: unauthorized.php");
    exit(); // Redirect non-admin users to an unauthorized page
} else {
    $adminUsername = $_SESSION['username'];
}
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
<style>
    .table table-bordered table-striped{
        width: auto;
    }
    .table-responsive {
        width: auto;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    table {
        border-collapse: collapse;
        width: auto;
    }
    th, td {
        padding: 8px;
        text-align: center;
    }
</style>    
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inventaris Lab</title>

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/icon/open-book.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!--==============================
	  Google Fonts
	============================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&amp;family=Yantramanav:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">


    <!--==============================
	    All CSS File
	============================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <!-- Slick Slider -->
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
    <!--********************************
   		Code Start From Here 
	******************************** -->




    <!--==============================
     Preloader
    ==============================-->
    <div class="preloader ">
        <div class="preloader-inner">
            <span class="loader"></span>
        </div>
    </div>
    <!--==============================
    Mobile Menu
    ============================== -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-area">
            <div class="mobile-logo">
                <a href=""><img src="assets/img/icon/il1.png" alt="Inventaris Lab"></a>
                <button class="menu-toggle"><i class="fa fa-times"></i></button>
            </div>
            <div class="mobile-menu">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="barang.php">Barang</a>
                    </li>
                    <li>
                        <a href="user.php">User</a>
                    </li>
                    <li>
                        <a href="pinjam.php">Peminjaman</a>
                    </li>
                    <li>
                        <a href="kembali.php">Pengembalian</a>
                    </li>
                    <li>
                        <a href="logout.php">Exit</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
	Header Area
    ==============================-->
    <header class="nav-header header-layout1">
        <div class="sticky-wrapper">
            <!-- Main Menu Area -->
            <div class="menu-area">
                <div class="header-navbar-logo">
                    <a href=""><img src="assets/img/icon/il6.png" alt="logo" style="width: 150px; height: auto; max-width: 100%;"></a>
                </div>
                <div class="container">
                    <div class="row align-items-center justify-content-lg-start justify-content-between">
                        <div class="col-auto d-xl-none d-block">
                            <div class="header-logo">
                                <a href=""><img src="assets/img/icon/il6.png" alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    <li>
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li>
                                        <a href="barang.php">Barang</a>
                                    </li>
                                    <li>
                                        <a href="user.php">User</a>
                                    </li>
                                    <li>
                                        <a href="pinjam.php">Peminjaman</a>
                                    </li>
                                    <li>
                                        <a href="kembali.php">Pengembalian</a>
                                    </li>
                                    <li>
                                    <a href="logout.php">Exit</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="navbar-right d-inline-flex d-lg-none">
                                <button type="button" class="menu-toggle icon-btn"><i class="fas fa-bars"></i></button>
                            </div>
                        </div>
                        <div class="col-auto ms-auto d-xl-block d-none">
                            <div class="navbar-right-desc">
                                <div class="navbar-right-desc-details">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="logo-bg"></div>
            </div>
        </div>
    </header>
    <!--==============================
    Info Area  
    ==============================-->
    <div class="about-area-1 space">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="text-center w-100">
                    <h1 class="text-center">Data Pengembalian</h1>
                    <form method="GET" action="kembali.php" class="mb-3 d-flex align-items-center justify-content-center">
                        <input type="text" name="cari" placeholder="Cari Pengembalian" class="form-control me-2" style="max-width: 300px;">
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="font-size: 15px;">
                            <thead>
                                <tr>
                                    <th>ID Pengembalian</th>
                                    <th>ID Peminjaman</th>
                                    <th>Tanggal Dikembalikan</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "config.php";
                                if (isset($_GET['cari'])) {
                                    $cari = $_GET['cari'];
                                    $query = "SELECT * FROM pengembalian WHERE id_pengembalian LIKE '%" . $cari . "%'
                                    OR id_peminjaman LIKE '%" . $cari . "%'
                                    OR tanggal_dikembalikan LIKE '%" . $cari . "%'
                                    OR denda LIKE '%" . $cari . "%'";
                                } else {
                                    $query = "SELECT * FROM pengembalian";
                                }
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "
                                    <tr align='center'>
                                        <td style='white-space: nowrap;'>$row[id_pengembalian]</td>
                                        <td style='white-space: nowrap;'>$row[id_peminjaman]</td>
                                        <td style='white-space: nowrap;'>$row[tanggal_dikembalikan]</td>
                                        <td style='white-space: nowrap;'>$row[denda]</td>
                                    </tr>
                                    ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
        Footer Area
    ==============================-->

        <div class="footer-top-1 bg-theme" style="background-image: url(assets/img/bg/footer-top-bg1-1.png);">
            <div class="footer-logo">
                <a href=""><img src="assets/img/icon/il6.png" alt="Fixturbo"></a>
            </div>
            <div class="call-media-wrap">
                </div>
            <div class="social-btn">
                <a href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/"><i class="fab fa-twitter"></i></a>
                <a href="https://instagram.com/"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    <footer class="footer-wrapper footer-layout1" style="background-image: url(assets/img/bg/footer-bg1-1.png);">    
        <div class="container">
                    </div>                    
                </div>
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="container">
                <div class="row gy-3 justify-content-md-between justify-content-center">
                    <div class="col-auto align-self-center"><p class="copyright-text text-center">© <a href="#">Inventaris Lab</a> 2025 | All Rights Reserved</p></div>
                    <div class="col-auto">
                        <!-- <div class="footer-links">
                            <a href="contact.html">Tarms & Condition</a>
                            <a href="contact.html">Privacy Policy</a>
                            <a href="contact.html">Contact Us</a>
                        </div> -->
                    </div>
                </div>                
            </div>
        </div>
    </footer>
    <!--********************************
			Code End  Here 
	******************************** -->

    <!-- Scroll To Top -->
    <div class="scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>

    <!--==============================
    All Js File
    ============================== -->
    <!-- Jquery -->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- Slick Slider -->
    <script src="assets/js/slick.min.js"></script>
    <!-- Range Slider -->
    <script src="assets/js/jquery-ui.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Magnific Popup -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Counter Up -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- Marquee -->
    <script src="assets/js/jquery.marquee.min.js"></script>
    <!-- Isotope Filter -->
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    
    <!-- Main Js File -->
    <script src="assets/js/main.js"></script>
</body>


<!-- Mirrored from wowtheme7.com/tf/fixturbo/demo/home-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 May 2025 04:40:08 GMT -->
</html>