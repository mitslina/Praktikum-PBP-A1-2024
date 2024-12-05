<!-- 
    Nama : Maulida Aprillia Cinta Ariyatin
    NIM  : 240060122120029 
    RESPONSI
-->
<?php

require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR CLASS DARI TABEL 'tb_classes' BERDASARKAN RACE YANG DIPILIH MENGGUNAKAN AJAX
if (isset($_GET['race_id'])) {
    $race_id = (int)$_GET['race_id']; // Sanitize the input
    error_log("Race ID: " . $race_id);
    $query = "SELECT * FROM tb_classes WHERE race_id = '$race_id'";
    $result = $db->query($query);

    // Return options for the select input
    echo "<option value=''>Select Class</option>";
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['class_id']}'>{$row['class_name']}</option>";
    }
}
?>