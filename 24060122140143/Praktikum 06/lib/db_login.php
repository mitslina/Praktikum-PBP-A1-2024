<!-- 
    Nama : Arsyad Grant Saputro
    NIM  : 240060122140143
    RESPONSI
-->

<?php
// TODO 1 : SETUP & CONNECT DATABASE

$host = 'localhost';
$username = 'root';
$password = ''; // Sesuaikan dengan password MySQL Anda
$database = 'rpg_registration'; // Nama database yang digunakan

// Koneksi ke database
$db = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>