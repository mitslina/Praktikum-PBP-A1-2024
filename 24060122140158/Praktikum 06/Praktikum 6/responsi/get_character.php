<?php
//Nama : ADIB WILLY KUSUMA ADRIGANTARA
//NIM : 24060122140158
//Kelas : A1

require_once 'lib/db_login.php';

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
