<!-- 
Nama         : Awang Pratama Putra Mulya
NIM          : 24060122120039
Tanggal      : 1 Oktober 2024
File         : get_character.php
 -->
<?php
require_once 'lib/db_login.php';

// // TODO 4 : MENGAMBIL DATA USER DARI TABEL 'tb_characters' DENGAN PARAMETER EMAIL

if (isset($_POST['email'])) {
    $email = test_input($_POST['email']);

    // Jika format email tidak valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email format is incorrect";
        exit;
    }
    // Query untuk memeriksa email di database
    $query = "SELECT * FROM tb_characters WHERE email = '$email'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        echo "email has been used";  // Jika email sudah digunakan
    } else {
        echo "email is available";  // Jika email tersedia
    }
}

?>