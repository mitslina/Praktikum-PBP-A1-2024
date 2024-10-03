<!--  
Nama            : Aniqah Nursabrina
NIM             : 24060122120036
Hari, Tanggal   : Selasa, 01 Oktober 2024
Lab             : A1
-->

<?php
require_once('./lib/db_login.php');

if (isset($_GET['race_id'])) {
    $race_id = $_GET['race_id'];
    $query = "SELECT * FROM tb_classes WHERE race_id = '$race_id'";
    $result = $db->query($query);
    
    if ($result->num_rows > 0) {
        echo "<option value='-' selected disabled>-- Pilih class --</option>";

        while ($row = $result->fetch_object()) {
            echo "<option value='" . $row->class_id . "'>" . $row->class_name . "</option>";
        }
    } else {
        echo "<option value='-' selected disabled>No classes available</option>";
    }
    
    $result->free();
}
$db->close();
?>
