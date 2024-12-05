<?php
// Nama         : Fikri Azka Pradya
// NIM          : 24060122140171
require_once 'lib/db_login.php';

//  TODO 4 : MENGAMBIL DATA USER DARI TABEL 'tb_characters' DENGAN PARAMETER EMAIL 
if (isset($_GET['email']) && !empty($_GET['email'])) { 
    $email = $_GET['email']; 
    $query = "SELECT * FROM tb_characters WHERE email = '$email'"; // pake petik
    $result = $db->query($query);

    // Periksa hasil query
    if ($result && $result->num_rows > 0) {
        echo "<span style='color: red;'>Email sudah terdaftar</span>";
    } else {
        echo "<span style='color: green;'>Email tersedia</span>";
    }
}
$result->free();
$db->close();
?>

