<?php
require_once 'lib/db_login.php';

//  TODO 4 : MENGAMBIL DATA USER DARI TABEL 'tb_characters' DENGAN PARAMETER EMAIL
$email = $_GET['email']; // Ambil email dari parameter GET

// Cek ketersediaan email di database
$stmt = $db->prepare("SELECT * FROM tb_characters WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email sudah ada
    echo '<span style="color:red;">Email has been used</span>';
} else {
    // Email tersedia
    echo '<span style="color:green;">Email available</span>';
}

$stmt->close(); // Tutup pernyataan
$db->close();
?>
