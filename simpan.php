<?php
session_start();
include 'config.php';

$nama = $_POST['nama'];
$metode = $_POST['metode'];
$total = 0;

foreach ($_SESSION['keranjang'] as $item) {
    $subtotal = $item['harga'] * $item['jumlah'];
    $total += $subtotal;
}

// Simpan ke tabel pesanan (header)
mysqli_query($conn, "INSERT INTO pesanan (nama, metode, total) VALUES ('$nama', '$metode', '$total')");
$pesanan_id = mysqli_insert_id($conn);

// Simpan detail pesanan
foreach ($_SESSION['keranjang'] as $item) {
    $nama_menu = $item['nama'];
    $harga = $item['harga'];
    $jumlah = $item['jumlah'];
    mysqli_query($conn, "INSERT INTO pesanan_detail (pesanan_id, menu, harga, jumlah) 
                            VALUES ('$pesanan_id', '$nama_menu', '$harga', '$jumlah')");
}

// Kosongkan keranjang
unset($_SESSION['keranjang']);
echo "<script>alert('Pesanan anda segera di proses!'); window.location='index.php';</script>";