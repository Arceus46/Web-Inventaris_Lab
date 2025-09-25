<?php
include "config.php";
session_start();

if (!isset($_GET['id'])) {
    die("ID peminjaman tidak ditemukan.");
}

$id_peminjaman = $_GET['id'];

// Ambil data tanggal kembali, id_barang, dan denda (per hari) dari tabel barang
$stmt = $conn->prepare("SELECT p.tanggal_kembali, p.id_barang, b.denda 
                        FROM peminjaman p 
                        JOIN barang b ON p.id_barang = b.id_barang 
                        WHERE p.id_peminjaman = ?");
$stmt->bind_param("s", $id_peminjaman);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("ID peminjaman tidak ditemukan di tabel peminjaman.");
}

$data = $result->fetch_assoc();
$tanggal_kembali = $data['tanggal_kembali'];
$id_barang = $data['id_barang'];
$harga_denda_per_hari = $data['denda'];
$tanggal_dikembalikan = date('Y-m-d');

// Hitung denda
$datetime1 = new DateTime($tanggal_kembali);
$datetime2 = new DateTime($tanggal_dikembalikan);
$interval = $datetime1->diff($datetime2);

if ($datetime2->getTimestamp() > $datetime1->getTimestamp()) {
    $hari_terlambat = $interval->days;
    $denda = $hari_terlambat * $harga_denda_per_hari;
} else {
    $denda = 0;
}

// Update denda ke dalam tabel peminjaman
$update_denda = $conn->prepare("UPDATE peminjaman SET denda = ? WHERE id_peminjaman = ?");
$update_denda->bind_param("is", $denda, $id_peminjaman);
$update_denda->execute();

// Generate id_pengembalian otomatis
$result_id = $conn->query("SELECT MAX(id_pengembalian) AS last_id FROM pengembalian");
$row = $result_id->fetch_assoc();
$last_id = $row['last_id'];

if ($last_id) {
    $last_num = (int)substr($last_id, 1); // format 'K0001'
    $new_num = $last_num + 1;
} else {
    $new_num = 1;
}

$id_pengembalian = 'K' . str_pad($new_num, 4, '0', STR_PAD_LEFT);

// Masukkan ke tabel pengembalian
$insert = $conn->prepare("INSERT INTO pengembalian (id_pengembalian, id_peminjaman, tanggal_dikembalikan, denda) VALUES (?, ?, ?, ?)");
$insert->bind_param("sssi", $id_pengembalian, $id_peminjaman, $tanggal_dikembalikan, $denda);

if ($insert->execute()) {
    // Ubah status peminjaman
    $update = $conn->prepare("UPDATE peminjaman SET status = 'Telah Dikembalikan' WHERE id_peminjaman = ?");
    $update->bind_param("s", $id_peminjaman);
    $update->execute();

    // Tambahkan jumlah barang kembali
    $update_barang = $conn->prepare("UPDATE barang SET jumlah = jumlah + 1 WHERE id_barang = ?");
    $update_barang->bind_param("s", $id_barang);
    $update_barang->execute();

    // Redirect setelah berhasil
    header("Location: kembali.php");
    exit;
} else {
    echo "Gagal menyimpan pengembalian: " . $conn->error;
}
?>