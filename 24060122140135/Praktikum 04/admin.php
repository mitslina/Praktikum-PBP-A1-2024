<?php 
// Nama         : Kanz Allief Aryaputra
// NIM          : 24060122140135
// Tanggal      : 23/09/2024
// Nama File    : admin.php
// Deskripsi    : untuk session halaman admin

session_start(); //inisialisasi session
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

include('header.html') ?>
<br>
<div class="container">
    <div class="card">
        <div class="card-header">Login Form</div>
        <div class="card-body">
            <p>Welcome ...</p>
            <p>You are logged in as <b><?php echo $_SESSION['username']; ?></p>
            <br><br>
            <a class="tn btn-primary" href="logout.php">Logout</a>
        </div>
    </div>
    <?php include('footer.html') ?>