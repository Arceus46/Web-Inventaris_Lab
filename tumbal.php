<?php
include "config.php";
echo "Tes koneksi ke DB<br>";
$sql = mysqli_query($conn, "SELECT * FROM barang");
echo "Jumlah data: " . mysqli_num_rows($sql);
?>
