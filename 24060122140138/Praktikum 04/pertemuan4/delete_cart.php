<?php 
// Nama         : Adzkiya Qarina Salsabila
// NIM          : 24060122140138
// Tanggal      : 17-09-2024
// File         : delete_cart.php
// Deskripsi    : untuk menghapus session

// TODO 1: Inisialisasi session
session_start();

// TODO 2: Hapus session
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
  
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}
}

// TODO 3: Redirect ke halaman show_cart.php
header('Location: show_cart.php');