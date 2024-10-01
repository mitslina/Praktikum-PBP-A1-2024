<?php 
// Nama         : Mochammad Qaynan Mahdaviqya
// NIM          : 24060122140170
// Tanggal      : 17-09-2024
// File         : logout.php
// Deskripsi    : Untuk logout (menghapus session yang dibuat saat login)

// TODO 1: Inisialisasi session (cukup lakukan ini sekali di awal)
session_start();

// TODO 2: Hapus session dan destroy
if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
    session_destroy();
}

// TODO 5: Redirect ke halaman login
header('Location: login.php');
?>