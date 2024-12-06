<?php
// Nama         : Adzkiya Qarina Salsabila
// NIM          : 24060122140138
// Tanggal      : 1-10-2024
// File         : get_classes.php

require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR CLASS DARI TABEL 'tb_classes' BERDASARKAN RACE YANG DIPILIH MENGGUNAKAN AJAX
$race_id = isset($_GET['race_id']) ? intval($_GET['race_id']) : 0;

if ($race_id > 0) {
    $query = "SELECT class_id, class_name FROM tb_classes WHERE race_id = $race_id";
    $result = $db->query($query);

    if ($result) {
        $classes = array();
        while ($row = $result->fetch_assoc()) {
            $classes[] = $row;
        }
        echo json_encode($classes);
    } else {
        echo json_encode(array('error' => 'Gagal mendapatkan data classes.'));
    }
} else {
    echo json_encode(array('error' => 'Race ID tidak valid.'));
}

$db->close();
?>