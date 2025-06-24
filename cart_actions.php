<?php
session_start();
include 'config.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'cart' => [], 'total' => 0];

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

function getCartData() {
    $current_cart = $_SESSION['keranjang'];
    $current_total = 0;
    foreach ($current_cart as $item) {
        $current_total += $item['harga'] * $item['jumlah'];
    }
    return ['cart' => $current_cart, 'total' => $current_total];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $id = intval($_POST['id']);
        $nama = $_POST['nama'];
        $harga = floatval($_POST['harga']);
        $jumlah = intval($_POST['jumlah']);

        $item_exists = false;
        foreach ($_SESSION['keranjang'] as &$item) {
            if ($item['id'] == $id) {
                $item['jumlah'] += $jumlah;
                $item_exists = true;
                break;
            }
        }
        if (!$item_exists) {
            $_SESSION['keranjang'][] = [
                'id' => $id,
                'nama' => $nama,
                'harga' => $harga,
                'jumlah' => $jumlah
            ];
        }

        $response['success'] = true;
        $response['message'] = 'Item berhasil ditambahkan ke keranjang!';
        $cart_data = getCartData();
        $response['cart'] = $cart_data['cart'];
        $response['total'] = $cart_data['total'];
    }
    else if ($_POST['action'] === 'remove') {
        $item_id_to_remove = intval($_POST['id']);

        foreach ($_SESSION['keranjang'] as $key => $item) {
            if ($item['id'] == $item_id_to_remove) {
                unset($_SESSION['keranjang'][$key]);
                break;
            }
        }
        $_SESSION['keranjang'] = array_values($_SESSION['keranjang']);

        $response['success'] = true;
        $response['message'] = 'Item berhasil dihapus dari keranjang!';
        $cart_data = getCartData();
        $response['cart'] = $cart_data['cart'];
        $response['total'] = $cart_data['total'];
    }
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_cart') {
    $response['success'] = true;
    $response['message'] = 'Data keranjang berhasil diambil.';
    $cart_data = getCartData();
    $response['cart'] = $cart_data['cart'];
    $response['total'] = $cart_data['total'];
}
else {
    $response['message'] = 'Permintaan tidak valid.';
}

echo json_encode($response);
exit();
?>