<?php
require_once './lib/db_login.php';

// Cek apakah email parameter diatur
if (isset($_GET['email'])) {
    $email = test_input($_GET['email']);
    
    // Siapkan dan eksekusi query untuk memeriksa apakah email ada
    $query = "SELECT * FROM tb_characters WHERE email = ?";
    $stmt = $conn->prepare($query); // Pastikan $db bukan null
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kembalikan 'exists' jika email ditemukan, jika tidak kembalikan 'available'
    if ($result->num_rows > 0) {
        echo 'exists';  // Respon ini akan memicu peringatan di fungsi JS
    } else {
        echo 'available';  // Respon ini akan menunjukkan bahwa email dapat digunakan
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>
