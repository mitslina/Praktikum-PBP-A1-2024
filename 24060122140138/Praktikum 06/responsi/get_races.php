<?php
// Nama         : Adzkiya Qarina Salsabila
// NIM          : 24060122140138
// Tanggal      : 1-10-2024
// File         : get_races.php

require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR RACE DARI TABEL 'tb_races'
$query = "SELECT * FROM races";
$result = $db->query($query);

if ($result) {
    $races = array();
    while ($row = $result->fetch_assoc()) {
        $races[] = $row;
    }
    echo json_encode($races);
} else {
    echo json_encode(array('error' => 'Gagal mendapatkan data races.'));
}

$db->close();
?>