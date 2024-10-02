<?php 
// Nama File    : db_login.php
// Nama         : Adzkiya Qarina Salsabila
// Deskripsi    : Untuk koneksi ke database

// TODO 1: Buatlah koneksi dengan database
//ini diambil dari user account
$db_host = 'localhost:3307';
$db_database = 'bookorama';
$db_username = 'root';
$db_password = '';

$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if($db->connect_errno){ //properti connect errno mengembalikan nilai 0 jika database berhasil dihubungkan dan mengembalikan 1 / die jika gagal terhubung
    die('Could not connect to database: <br />'. $db->connect_error);
}
// TODO 2: Buatlah function test_input
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>