<!-- 
Nama         : Awang Pratama Putra Mulya
NIM          : 24060122120039
Tanggal      : 1 Oktober 2024
File         : get_races.php
 -->
<?php
require_once ('lib/db_login.php');

// TODO 5 : MENGAMBIL DATA DAFTAR RACE DARI TABEL 'tb_races'

$query = "SELECT race_id, race_name FROM tb_races";
$result = $db->query($query);

// Menampilkan daftar race dalam format opsi HTML
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
        echo "<option value='" . $row['race_id'] . "'>" . $row['race_name'] . "</option>";
    }
} else {
    echo "<option value=''>No races available</option>";
}
?>
