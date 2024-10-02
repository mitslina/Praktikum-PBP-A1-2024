<?php 
// Nama         : M. Dimas Saputra
// NIM          : 24060122140159
// Tanggal      : 24 September 2024
// File         : delete_cart.php
// Deskripsi    : untuk menghapus session

session_start();

// TODO 2: Hapus session
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

// TODO 3: Redirect ke halaman show_cart.php
header('Location: show_cart.php');
exit();
?>