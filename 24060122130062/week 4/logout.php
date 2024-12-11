<?php 
// Nama         : Helga Nurul Bhaiti
// NIM          : 24060122130062
// Tanggal      : 24/09/2024
// File         : logout.php
// Deskripsi    : Untuk logout (menghapus session yang dibuat saat login)

// TODO 1: Inisialisasi session
session_start();

// TODO 2: Hapus session dan destroy
if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
    session_destroy();
}

// TODO 3: Redirect ke halaman login.php
header('Location: login.php');
?>