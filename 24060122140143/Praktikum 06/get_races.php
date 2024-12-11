<!-- 
    Nama : Arsyad Grant Saputro
    NIM  : 240060122140143
    RESPONSI
-->
<?php
require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR RACE DARI TABEL 'tb_races'
$result = $db->query("SELECT * FROM tb_races ");
while ($row = $result->fetch_assoc()) {
    echo "<option value='{$row['race_id']}' " . ((isset($race_id)) ? 'selected' : '') . ">{$row['race_name']}</option>";
}

?>