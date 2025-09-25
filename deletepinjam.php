<?php
  include "config.php";
  session_start();
  $hapus = mysqli_query($conn, "delete from peminjaman where id_peminjaman  ='$_GET[id]'");
  header("location:pinjam.php");
  ?>