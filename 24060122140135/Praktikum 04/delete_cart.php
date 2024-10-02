<?php 
// Nama         : Kanz Allief Aryaputra
// NIM          : 24060122140135
// Tanggal      : 23/09/2024
// File         : delete_cart.php
// Deskripsi    : untuk menghapus session

session_start(); // Memulai session

// Mengecek apakah session cart ada
if (isset($_SESSION['cart'])) {
    // Fungsi unset() digunakan untuk menghapus session cart
    unset($_SESSION['cart']);
}

// Redirect ke halaman view_books.php setelah cart dihapus
header('Location: view_books.php');
exit();
?>