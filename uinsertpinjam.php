<?php
ob_start();
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // Terminate script execution after the redirect
}

if ($_SESSION['role'] !== 'user') {
    header("Location: unauthorized.php");
    exit(); // Redirect non-user to an unauthorized page
}
$username = $_SESSION['username'];
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
<script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(window).on('load', function () {
            $('.preloader').fadeOut('slow');
        });

        // Ensure menu toggle works
        $('.menu-toggle').on('click', function () {
            $('.mobile-menu-wrapper').toggleClass('open');
        });
    });
</script>
    
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


    <div class="preloader" style="display: none;">
        <div class="preloader-inner">
            <span class="loader"></span>
        </div>
    </div>
    <div class="preloader ">
        <div class="preloader-inner">
            <span class="loader"></span>
        </div>
    </div>
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
                        <a href="homepage.php">Home</a>
                    </li>
                    <li>
                        <a href="ubarang.php">Barang</a>
                    </li>
                    <li>
                        <a href="upinjam.php">Peminjaman</a>
                    </li>
                    <li>
                        <a href="prof.php">Data Diri</a>
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
                                        <a href="homepage.php">Home</a>
                                    </li>
                                    <li>
                                        <a href="ubarang.php">Barang</a>
                                    </li>
                                    <li>
                                        <a href="upinjam.php">Peminjaman</a>
                                    </li>
                                    <li>
                        <a href="prof.php">Data Diri</a>
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
        <?php
include "config.php";

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $id_barang = $_POST['id_barang'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    // Ambil id_peminjaman terakhir
    $result = mysqli_query($conn, "SELECT MAX(id_peminjaman) AS last_id FROM peminjaman");
    $row = mysqli_fetch_assoc($result);
    $last_id = $row['last_id'];

    if ($last_id) {
        // Ambil angka dari belakang id, contoh: dari PMJ007 → 7
        $last_num = (int)substr($last_id, 3);
        $new_num = $last_num + 1;
    } else {
        // Jika belum ada data sama sekali
        $new_num = 1;
    }

    // Buat ID baru dengan format PMJ + 3 digit angka
    $id_peminjaman = 'PMJ' . str_pad($new_num, 3, '0', STR_PAD_LEFT);

    // Simpan ke database
    $simpan = mysqli_query($conn, "INSERT INTO peminjaman SET
        id_peminjaman = '$id_peminjaman',
        nim = '$username',
        id_barang = '$id_barang',
        tanggal_pinjam = '$tanggal_pinjam',
        status = 'Menunggu Verifikasi',
        tanggal_kembali = '$tanggal_kembali',
        denda = '0'");

   if ($simpan) {
        // Kurangi jumlah barang
        $update_barang = mysqli_query($conn, "UPDATE barang SET jumlah = jumlah - 1 WHERE id_barang = '$id_barang'");

        if ($update_barang) {
            header('Location: upinjam.php');
            exit();
        } else {
            echo "<div class='alert alert-warning'>Data tersimpan, tetapi gagal mengurangi stok barang.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Gagal Menambah Data: " . mysqli_error($conn) . "</div>";
    }
}
?>

        <div class="container">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
                <div class="text-center">
                    <h3>Pengisian Peminjaman</h3>
                    <h5>MOHON DIISI DENGAN BENAR!!</h5>
                    <form action="" method="POST">
                        <div class="form-group">
                        <div class="form-group">
                            <label><b>ID Barang</b></label>
                            <select class="form-control" name="id_barang">
                                <option value="" disabled selected hidden>Pilih ID Barang</option>
                                <?php
                                $selectedBarang = isset($_GET['id']) ? $_GET['id'] : '';
                                $queryBarang = mysqli_query($conn, "SELECT id_barang, nama_barang FROM barang");
                                while ($rowBarang = mysqli_fetch_assoc($queryBarang)) {
                                    $selected = ($rowBarang['id_barang'] == $selectedBarang) ? 'selected' : '';
                                    echo "<option value='{$rowBarang['id_barang']}' $selected>{$rowBarang['nama_barang']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><b>Tanggal Pinjam</b></label>
                            <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" placeholder="Isi Tanggal Pinjam" required />
                        </div>
                        <div class="form-group">
                            <label><b>Tanggal Kembali</b></label>
                            <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" placeholder="Isi Tanggal Kembali" required />
                            <small id="tanggal_error" class="text-danger" style="display: none;">Tanggal kembali harus lebih besar atau sama dengan tanggal pinjam.</small>
                        </div>
                        <script>
                            document.getElementById('tanggal_kembali').addEventListener('change', function () {
                                const tanggalPinjam = new Date(document.getElementById('tanggal_pinjam').value);
                                const tanggalKembali = new Date(this.value);
                                const errorElement = document.getElementById('tanggal_error');

                                if (tanggalKembali < tanggalPinjam) {
                                    errorElement.style.display = 'block';
                                    this.value = ''; // Clear the invalid date
                                } else {
                                    errorElement.style.display = 'none';
                                }
                            });
                        </script>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
                            <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                        </div>
                    </form>
                </div>
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
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
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