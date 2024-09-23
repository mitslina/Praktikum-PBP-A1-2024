<?php 
// Nama         : Kanz Allief Aryaputra
// NIM          : 24060122140135
// Tanggal      : 23/09/2024
// File         : logout.php
// Deskripsi    : Untuk logout (menghapus session yang dibuat saat login)

session_start();
if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
    session_destroy();
}
header("Location: login.php");
?>