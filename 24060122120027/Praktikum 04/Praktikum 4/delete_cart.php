<?php
// Nama         : Yesi Dwi Ningtias
// NIM          : 24060122120027
// Tanggal      : 21 September 2024
// File         : delete_cart.php
// Deskripsi    : untuk menghapus session

// TODO 1: Inisialisasi session
session_start();
// TODO 2: Hapus session
if (isset($_SESSION['cart'])) {
  unset($_SESSION['cart']);
}
// TODO 3: Redirect ke halaman show_cart.php
header('Location: show_cart.php');