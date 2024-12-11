<?php 
// Nama File    : db_login.php
// Nama         : Helga Nurul Bhaiti
// NIM          : 24060122130062
// Tanggal      : 24/09/2024
// Deskripsi    : Untuk koneksi ke database

// TODO 1: Buatlah koneksi dengan database
$db_host = 'localhost';
$db_database = 'bookorama';
$db_username = 'root';
$db_password = '';

$db = new mysqli($db_host, $db_username, $db_password, $db_database); //setelah berhasil dihubungkan
if($db->connect_errno){ //lakukan pengecekan menggunakan properti yang mengembalikan nilai 0 jika db berhasil terhubung 
    die('Could not connect to database: <br />'. $db->connect_error); //dan mengembalikan nilai berupa angka jika gagal, kemudian menghentikan eksekusi
}
// TODO 2: Buatlah function test_input
function test_input($data){ //sering digunakan utk memastikan inputan pengguna benar dan aman utk dimasukkan ke db
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>