<?php
//Nama : Bisma Wira Adi Wicaksono
//NIM : 24060122140120
//Kelas : A1

//  TODO 4 : MENGAMBIL DATA USER DARI TABEL 'tb_characters' DENGAN PARAMETER EMAIL

require_once 'lib/db_login.php';

// Function to get user by email

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
