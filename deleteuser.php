<?php
  include "config.php";
  session_start();
  $hapus = mysqli_query($conn, "delete from user where nim='$_GET[id]'");
  header("location:user.php");
  ?>