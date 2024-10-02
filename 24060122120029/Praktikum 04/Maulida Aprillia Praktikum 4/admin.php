<?php 
// Nama         : Maulida Aprillia Cinta Ariyatin
// NIM          : 2406012210029
// Tanggal      : 17 September 2024
// Nama File    : admin.php
// Deskripsi    : untuk session halaman admin

// TODO 1: Inisialisasi session
session_start();
// TODO 2: Periksa apakah session dengan key username terdefinisi
if (!isset($_SESSION['username'])){
    header('Location : login.php');
}

include('.\header.php');
?>
<br>
<div class="card">
    <div class="card-header">Admin Page</div>
    <div class="card-body">
        <p>Welcome...</p>
        <p>You are logged in as <b><?= $_SESSION['username']; ?></b></p>
        <br><br>
        <a class="btn btn-primary" href="logout.php">Logout</a>
    </div>
</div>
<?php include('./footer.php') ?>