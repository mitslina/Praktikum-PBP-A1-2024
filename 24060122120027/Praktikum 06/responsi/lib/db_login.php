<?php
// Setup & connect database
$db_host = 'localhost';  // Nama host database
$db_user = 'root';       // Username database
$db_pass = '';           // Password database (kosong jika default)
$db_name = 'rpg_registration';  // Nama database yang akan digunakan

// Membuat koneksi ke database
$db = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Memeriksa apakah koneksi berhasil atau gagal
if ($db->connect_error) {
    error_log("Connection failed: " . $db->connect_error); // Log error ke file log server
    die("Database connection failed. Please try again later."); // Pesan yang lebih umum untuk pengguna
}
?>
