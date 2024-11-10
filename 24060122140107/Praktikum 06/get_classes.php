<?php
// Nama         : Surya Fajar
// NIM          : 24060122140107
require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR CLASS DARI TABEL 'tb_classes' BERDASARKAN RACE YANG DIPILIH MENGGUNAKAN AJAX
if (isset($_GET['race_id'])) {
    $race_id = $_GET['race_id'];
    // query di dalem
    $query = "SELECT class_id, class_name FROM tb_classes WHERE race_id = $race_id";
    $result = $db->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()){
            echo '<option value="' . $row->class_id . '">' . $row->class_name . '</option>';
        }      
    } else {
        echo '<option value="-" disabled>No races available</option>';
    }
}
$result->free();
$db->close();
?>