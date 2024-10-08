<!--  
Nama            : Aniqah Nursabrina
NIM             : 24060122120036
Hari, Tanggal   : Selasa, 01 Oktober 2024
Lab             : A1
-->

<?php
require_once ('./lib/db_login.php');

//  TODO 4 : MENGAMBIL DATA USER DARI TABEL 'tb_characters' DENGAN PARAMETER EMAIL
if (isset($_GET['email'])) {
    $value = $_GET['email'];
    $query = "SELECT * FROM tb_characters WHERE email = '" . $db->real_escape_string($value) . "'";

    $result = $db->query($query);

    if (!$result) {
        die("Could not query the database: <br>" . $db->error);
    }

    if ($result->num_rows > 0) {
        echo '<div class="text-danger">Email has been used</div>';
    } 
    if ($result->num_rows == 0){
        echo '<div class="text-success">Email available</div>';
    }

    $result->free();
    $db->close();
}
?>


