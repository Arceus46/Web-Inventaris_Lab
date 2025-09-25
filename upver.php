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
  $adminId = $_SESSION['id_admin']; // Pastikan id_admin sudah diset di session saat login
}
  include "config.php";
  $hapus = mysqli_query($conn, "update peminjaman set status = 'Diverifikasi', id_admin='$adminUsername'
where id_peminjaman='$_GET[id]'");
  header("location:pinjam.php");
  ?>