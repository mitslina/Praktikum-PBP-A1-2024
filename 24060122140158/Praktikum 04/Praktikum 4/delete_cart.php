<?php 
// Nama         : Adib Willy Kusuma Adrigantara
// NIM          : 24060122140158
// Tanggal      : 23 September 2024
// File         : delete_cart.php
// Deskripsi    : untuk menghapus session

session_start();
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

header('Location: show_cart.php');
exit();
?>