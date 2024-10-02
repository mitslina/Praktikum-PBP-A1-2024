<?php
require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR CLASS DARI TABEL 'tb_classes' BERDASARKAN RACE YANG DIPILIH MENGGUNAKAN AJAX
// Periksa apakah parameter 'race_id' dikirim melalui AJAX
if (isset($_GET['race_id'])) {
    $race_id = $_GET['race_id'];

    $query = "SELECT class_id, class_name FROM tb_classes WHERE race_id = ?";
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("i", $race_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah hasil ada
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['class_id'] . "'>" . $row['class_name'] . "</option>";
        }
    } else {
        echo "<option value=''>No classes available</option>";
    }

    // Tutup statement
    $stmt->close();
}
?>