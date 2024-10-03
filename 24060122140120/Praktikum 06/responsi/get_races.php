<?php
//Nama : Bisma Wira Adi Wicaksono
//NIM : 24060122140120
//Kelas : A1

require_once 'lib/db_login.php'; // Include the database connection

//  TODO 5 : MENGAMBIL DATA DAFTAR RACE DARI TABEL 'tb_races'

// Function to get the list of races from the database

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
