<?php
include 'config.php';
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
$adminUsername = $_SESSION['username'];
$query = "SELECT nama FROM admin WHERE id_admin = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $adminUsername);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$name = $row['nama'] ?? $adminUsername;
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
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
    Hero Area
    ==============================-->
    <div class="hero-wrapper hero-3">
        <div class="hero-3-slider global-carousel" data-slide-show="1" data-fade="true" data-adaptive-height="true">
            <div class="hero-slide" style="background-image: url(assets/img/yo.jpg);">
                <div class="container">
                    <div class="row">                
                        <div class="col-xxl-6 col-xl-5 col-lg-6">
                            <div class="hero-style3">
                            <div class="title-area me-xl-5 mb-30">
                            <span class="sub-title">Inventaris Lab</span>
                        </div>
                                <div class="hero-subtitle text-white" data-ani="slideinup" data-ani-delay="0s">
                                    <span><img src="assets/img/hero/hero_shape_2.png" alt="img">Selamat Datang, <?php echo $name; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center">
                        </div>
                    </div>                
                </div>
            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
    <!--==============================
    About Area  
    ==============================-->
<div class="about-area-1 space">
        <div class="container">
            <div class="row gx-60 align-items-center flex-row-reverse">
                <div class="col-xl-7 text-xl-center">
                    <div class="about-thumb3 mb-40 mb-xl-0"> 
                        <div class="about-img-1">
                            <img src="assets/img/yi.png" alt="img">
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="about-content-wrap">
                        
                        <div class="row gy-4 justify-content-md-between justify-content-end align-items-center flex-row-reverse">
                            <div class="col-md-auto">
                                <div class="checklist style2">
                                    <ul>
                                        <li><i class="fas fa-check-double"></i>Cepat & Akurat</li>
                                        <li><i class="fas fa-check-double"></i>Akses Mudah</li>
                                        <li><i class="fas fa-check-double"></i>Tidak Ribet</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-auto col-lg-6">
                                <div class="checklist style2">
                                    <ul>
                                        <li><i class="fas fa-check-double"></i>Pencatatan Berkala</li>
                                        <li><i class="fas fa-check-double"></i>Perawatan & Pencatatan Berkala</li>
                                        <li><i class="fas fa-check-double"></i>Real Time</li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <!--==============================
    Blog Area  
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

    <!--==============================
        Footer Area
    ==============================-->
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
</html>