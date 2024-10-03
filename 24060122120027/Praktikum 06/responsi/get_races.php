<?php
require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR RACE DARI TABEL 'tb_races'
$query = "SELECT race_name FROM tb_races";
$result = $db->query($query);

if ($result->num_rows > 0) {
    // Menampilkan daftar race dalam format <option>
    echo "<option value=''>Select Race</option>"; // Default option
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . htmlspecialchars($row['race_name'], ENT_QUOTES) . "'>" . htmlspecialchars($row['race_name'], ENT_QUOTES) . "</option>";
    }
} else {
    echo "<option value=''>No races available</option>";
}
?>
