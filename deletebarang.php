<?php
  include "config.php";
  session_start();
  $hapus = mysqli_query($conn, "delete from barang where id_barang='$_GET[id]'");
  header("location:barang.php");
  ?>