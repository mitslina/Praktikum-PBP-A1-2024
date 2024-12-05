<?php
// Nama         : Surya Fajar
// NIM          : 24060122140107
require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR RACE DARI TABEL 'tb_races'
$query = "SELECT race_id, race_name FROM tb_races";
$result = $db->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        echo '<option value="' . $row->race_id . '">' . $row->race_name . '</option>';
    }
} else {
    echo '<option value="-" disabled>No races available</option>';
}
$result->free();
$db->close();
?>
