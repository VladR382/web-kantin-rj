<?php
session_start();
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - Kantin R6J</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="style.css"> </head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php#home">Kantin R6J</a>
    
    <div class="d-flex ms-auto">
      <a href="index.php" class="btn btn-outline-light">
        <i class="fas fa-home"></i> Kembali ke Home
      </a>
    </div>
  </div>
</nav>

<div style="padding-top: 80px;">
    <div class="container py-5">
        <div class="card shadow-sm"> <div class="card-body">
                <h2 class="card-title text-center mb-4">Checkout Pesanan</h2> <form action="simpan.php" method="post">
                    <div class="mb-3">
                        <label for="namaPembeli" class="form-label">Nama Pembeli</label>
                        <input type="text" name="nama" id="namaPembeli" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="metodePembayaran" class="form-label">Metode Pembayaran</label>
                        <select name="metode" id="metodePembayaran" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Tunai">Tunai</option>
                            <option value="QRIS">QRIS</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2 mt-4"> <button type="submit" class="btn btn-primary btn-lg">Kirim Pesanan</button> <a href="index.php" class="btn btn-secondary btn-lg">Kembali Berbelanja</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Kantin R6J. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>