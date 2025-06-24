<?php
session_start(); 
include 'config.php';

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kantin R6J</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="style.css"> <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  </head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#home">Kantin<span>R6J.</span></a>
    
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#menu">Menu</a>
        </li>
      </ul>
    </div>

    <div class="d-flex">
      <button class="btn btn-outline-light" type="button" data-bs-toggle="modal" data-bs-target="#keranjangModal">
        <i class="fas fa-shopping-cart"></i> (<span id="cartItemCount"><?= count($_SESSION['keranjang']) ?></span>)
      </button>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<div class="pt-0">
    <section id="home" class="home-hero">
      <div class="container">
        <h1 class="display-5">Selamat Datang di Kantin R6J!</h1>
        <p class="fs-4">Nikmati berbagai hidangan lezat dan minuman segar kami. Pesan sekarang dan rasakan kenikmatan setiap gigitannya!</p>
        <a href="#menu" class="btn btn-primary btn-lg">Lihat Menu</a>
      </div>
    </section>

    <div class="container py-4">
      <section id="menu" class="mb-5">
        <h2 class="mb-4">Menu Kantin R6J</h2>
        <div class="row">
          <?php
          $menus = [
            ['id' => 1, 'nama' => 'Martabak Mini', 'harga' => 10000, 'gambar' => 'img/martabakmini.jpg'],
            ['id' => 2, 'nama' => 'Dimsum', 'harga' => 10000, 'gambar' => 'img/dimsum.jpg'],
            ['id' => 3, 'nama' => 'Jelly Ball Cheese', 'harga' => 10000, 'gambar' => 'img/jellyball.jpg'],
            ['id' => 4, 'nama' => 'Batagor', 'harga' => 10000, 'gambar' => 'img/batagor.jpg'],
            ['id' => 5, 'nama' => 'Bajigur', 'harga' => 7000, 'gambar' => 'img/bajigur.jpg'],
            ['id' => 6, 'nama' => 'Es Kopi Susu', 'harga' => 10000, 'gambar' => 'img/eskopi.jpg'],
          ];

          foreach ($menus as $menu): ?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card">
                <img src="<?= $menu['gambar'] ?>" class="card-img-top" height="200">
                <div class="card-body">
                  <h5 class="card-title"><?= $menu['nama'] ?></h5>
                  <p class="card-text">Rp <?= number_format($menu['harga']) ?></p>
                  <form class="add-to-cart-form">
                    <input type="hidden" name="id" value="<?= $menu['id'] ?>">
                    <input type="hidden" name="nama" value="<?= $menu['nama'] ?>">
                    <input type="hidden" name="harga" value="<?= $menu['harga'] ?>">
                    <div class="d-flex align-items-center mb-2">
                      <div class="input-group quantity-input-group me-2">
                        <button type="button" class="btn btn-dark btn-sm quantity-minus">-</button>
                        <input type="number" name="jumlah" class="form-control text-center quantity-input" value="1" min="1" readonly>
                        <button type="button" class="btn btn-dark btn-sm quantity-plus">+</button>
                      </div>
                      <button type="submit" class="btn btn-primary flex-grow-1">Tambah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
    </div>
</div>

<div class="modal fade" id="keranjangModal" tabindex="-1" aria-labelledby="keranjangModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="keranjangModalLabel">Isi Keranjang Anda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="cartModalBody">
        <?php
        if (!empty($_SESSION['keranjang'])): ?>
          <table class="table table-bordered">
            <thead class="table-dark">
              <tr>
                <th>Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total_modal_initial = 0;
              foreach ($_SESSION['keranjang'] as $key => $item):
                $subtotal_modal_initial = $item['harga'] * $item['jumlah'];
                $total_modal_initial += $subtotal_modal_initial;
              ?>
                <tr>
                  <td><?= $item['nama'] ?></td>
                  <td>Rp <?= number_format($item['harga']) ?></td>
                  <td><?= $item['jumlah'] ?></td>
                  <td>Rp <?= number_format($subtotal_modal_initial) ?></td>
                  <td>
                      <button type="button" class="btn btn-sm btn-danger remove-from-cart-btn" data-id="<?= $item['id'] ?>">Hapus</button>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="3" class="text-end"><strong>Total</strong></td>
                <td colspan="2"><strong>Rp <?= number_format($total_modal_initial) ?></strong></td>
              </tr>
            </tbody>
          </table>
          <a href="checkout.php" class="btn btn-success float-end mt-3" id="checkoutBtnModal">Lanjutkan ke Checkout</a>
        <?php else: ?>
          <p class="text-muted text-center" id="emptyCartMessageInitial">Keranjang masih kosong.</p>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2025 Kantin R6J.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartItemCountSpan = document.getElementById('cartItemCount');
    const cartModalBody = document.getElementById('cartModalBody');
    const keranjangModal = document.getElementById('keranjangModal');

    function updateCartDisplay(cartData) {
        let cartHtml = '';
        if (cartData && cartData.cart && cartData.cart.length > 0) {
            let totalHtml = 0;
            cartHtml += `
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            cartData.cart.forEach(item => {
                const subtotal = item.harga * item.jumlah;
                totalHtml += subtotal;
                cartHtml += `
                    <tr>
                        <td>${item.nama}</td>
                        <td>Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</td>
                        <td>${item.jumlah}</td>
                        <td>Rp ${new Intl.NumberFormat('id-ID').format(subtotal)}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger remove-from-cart-btn" data-id="${item.id}">Hapus</button>
                        </td>
                    </tr>
                `;
            });
            cartHtml += `
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                            <td colspan="2"><strong>Rp ${new Intl.NumberFormat('id-ID').format(totalHtml)}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <a href="checkout.php" class="btn btn-success float-end mt-3" id="checkoutBtnModal">Lanjutkan ke Checkout</a>
            `;
            cartItemCountSpan.textContent = cartData.cart.length;
        } else {
            cartHtml = '<p class="text-muted text-center">Keranjang masih kosong.</p>';
            cartItemCountSpan.textContent = 0;
        }
        cartModalBody.innerHTML = cartHtml;

        attachRemoveListeners(); 
    }

    function attachRemoveListeners() {
        document.querySelectorAll('.remove-from-cart-btn').forEach(button => {
            button.removeEventListener('click', handleRemoveItem);
            button.addEventListener('click', handleRemoveItem);
        });
    }

    function handleRemoveItem() {
        const itemId = this.dataset.id;

        fetch('cart_actions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=remove&id=${itemId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartDisplay(data);
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message,
                    showConfirmButton: true
                });
            }
        })
        .catch(error => {
            console.error('Error removing item:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan saat menghapus item.',
                showConfirmButton: true
            });
        });
    }

    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const quantityInput = this.querySelector('.quantity-input');
            const quantity = parseInt(quantityInput.value);

            if (isNaN(quantity) || quantity < 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Jumlah Tidak Valid!',
                    text: 'Jumlah item harus minimal 1.',
                    showConfirmButton: true
                });
                return;
            }

            const formData = new FormData(this);
            formData.append('action', 'add');

            fetch('cart_actions.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartDisplay(data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    quantityInput.value = 0; 
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message,
                        showConfirmButton: true
                    });
                }
            })
            .catch(error => {
                console.error('Error adding item:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat menambahkan item.',
                    showConfirmButton: true
                });
            });
        });
    });

    keranjangModal.addEventListener('show.bs.modal', function () {
        fetch('cart_actions.php?action=get_cart')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartDisplay(data);
                } else {
                    cartModalBody.innerHTML = '<p class="text-danger text-center">Gagal memuat keranjang.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching cart data:', error);
                cartModalBody.innerHTML = '<p class="text-danger text-center">Terjadi kesalahan saat memuat keranjang.</p>';
            });
    });

    document.querySelectorAll('.quantity-minus').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.nextElementSibling;
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        });
    });

    document.querySelectorAll('.quantity-plus').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            let value = parseInt(input.value);
            input.value = value + 1;
        });
    });

    attachRemoveListeners();
});
</script>
</body>
</html>