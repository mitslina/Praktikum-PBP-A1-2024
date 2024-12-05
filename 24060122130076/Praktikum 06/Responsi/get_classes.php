<!-- 
Nama         : Azzam Saefudin Rosyidi
NIM          : 24060122130076
Tanggal      :  1 Oktober 2024
File       : get_classes.php
 -->
<?php
require_once('lib/db_login.php');

// TODO 5 : MENGAMBIL DATA DAFTAR CLASS DARI TABEL 'tb_classes' BERDASARKAN RACE YANG DIPILIH MENGGUNAKAN AJAX

if (isset($_GET['race_id'])) {
    $race_id = $_GET['race_id'];
    $query = "SELECT * FROM tb_classes WHERE race_id = '$race_id'";
    $result = $db->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<option value='".$row['class_id']."'>".$row['class_name']."</option>";
    }
}
?>