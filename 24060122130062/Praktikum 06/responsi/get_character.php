<?php
require_once 'lib/db_login.php';

//  TODO 4 : MENGAMBIL DATA USER DARI TABEL 'tb_characters' DENGAN PARAMETER EMAIL
if (isset($_GET['email'])) {
    $email = $db->real_escape_string($_GET['email']);
    $query = "SELECT email FROM tb_characters WHERE email = '$email'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        echo "Email has been used";
    }
    else{
        echo "";
    }

    $result->free();
    $db->close();
}
?>