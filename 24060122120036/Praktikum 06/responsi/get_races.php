<!--  
Nama            : Aniqah Nursabrina
NIM             : 24060122120036
Hari, Tanggal   : Selasa, 01 Oktober 2024
Lab             : A1
-->

<?php
require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR RACE DARI TABEL 'tb_races'
$query = "SELECT race_id, race_name FROM tb_races";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['race_id'] . "'>" . $row['race_name'] . "</option>";
    }
} else {
    echo "<option value=''>No races available</option>";
}

$conn->close();
?>