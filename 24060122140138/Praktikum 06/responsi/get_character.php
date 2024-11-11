<?php
// Nama         : Adzkiya Qarina Salsabila
// NIM          : 24060122140138
// Tanggal      : 1-10-2024
// File         : get_character.php

require_once 'lib/db_login.php';

//  TODO 4 : MENGAMBIL DATA USER DARI TABEL 'tb_characters' DENGAN PARAMETER EMAIL
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM tb_characters WHERE email='$email'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        echo "taken";
    } else {
        echo "available";
    }
}
?>