<?php 
// Nama         : Mochammad Qaynan Mahdaviqya
// NIM          : 24060122140170
// Tanggal      : 17-09-2024
// File         : delete_cart.php
// Deskripsi    : untuk menghapus session

// TODO 1: Inisialisasi data session
session_start();
include('./lib/db_login.php');

// TODO 2: Hapus session
if(isset($_SESSION['cart'])){
    unset($_SESSION['cart']);
}

// TODO 3: Redirect ke halaman show_cart.php
header('Location: show_cart.php')
?>