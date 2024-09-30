<?php 
// Nama         : Arsyad Grant Saputro
// NIM          : 24060122140143
// Tanggal      : 23/09/2024
// Nama File    : admin.php
// Deskripsi    : untuk session halaman admin


// TODO 1: Inisialisasi session
session_start();

// TODO 2: Periksa apakah session dengan key username terdefinisi
if (!isset($_SESSION['username'])) {  
    header('Location: login.php');
    exit();  
}

include('./header.php');
?>
<br>
<div class="card">
    <div class="card-header">Admin Page</div>
    <div class="card-body">
        <p>Welcome...</p>
        <p>You are logged in as <b><?= htmlspecialchars($_SESSION['username']); ?></b></p> <!-- Add htmlspecialchars for security -->
        <br><br>
        <a class="btn btn-primary" href="logout.php">Logout</a>
    </div>
</div>
<?php include('./footer.php') ?>
