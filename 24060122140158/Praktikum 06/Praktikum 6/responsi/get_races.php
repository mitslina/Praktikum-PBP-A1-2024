<?php
//Nama : ADIB WILLY KUSUMA ADRIGANTARA
//NIM : 24060122140158
//Kelas : A1

// Include file untuk koneksi database
require_once 'lib/db_login.php';

// Query untuk mendapatkan data races
$query = "SELECT * FROM races";
$result = $db->query($query);

// Mengecek apakah ada hasil
if ($result) {
    $races = array();
    while ($row = $result->fetch_assoc()) {
        $races[] = $row;
    }
    // Mengirimkan data dalam format JSON
    echo json_encode($races);
} else {
    // Menampilkan error jika query gagal
    echo json_encode(array('error' => 'Gagal mendapatkan data races.'));
}

// Menutup koneksi database
$db->close();
?>
