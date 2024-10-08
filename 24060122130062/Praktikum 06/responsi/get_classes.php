<?php
require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR CLASS DARI TABEL 'tb_classes' BERDASARKAN RACE YANG DIPILIH MENGGUNAKAN AJAX
$race_id = $_GET['race_id'];
$query = "SELECT class_id, class_name FROM tb_classes WHERE race_id = '$race_id'";
$result = $db->query($query);

if ($result->num_rows > 0) {
    echo "<option value='' disabled selected>Select Class</option>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['class_id'] . "'>" . $row['class_name'] . "</option>";
    }
} else {
    echo "<option value='' disabled>No classes available</option>";
}

$db->close();
?>