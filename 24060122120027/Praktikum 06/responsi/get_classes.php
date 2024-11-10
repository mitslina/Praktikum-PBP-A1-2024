<?php
require_once 'lib/db_login.php';

//  TODO 5 : MENGAMBIL DATA DAFTAR CLASS DARI TABEL 'tb_classes' BERDASARKAN RACE YANG DIPILIH MENGGUNAKAN AJAX
if (isset($_GET['race'])) {
    $race = $_GET['race'];

    // Menggunakan prepared statements untuk mencegah SQL Injection
    $stmt = $db->prepare("
        SELECT class_name FROM tb_classes 
        WHERE race_id = (SELECT race_id FROM tb_races WHERE race_name = ?)
    ");
    $stmt->bind_param("s", $race);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Menampilkan daftar class dalam format <option>
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['class_name'], ENT_QUOTES) . "'>" . htmlspecialchars($row['class_name'], ENT_QUOTES) . "</option>";
        }
    } else {
        echo "<option value=''>No classes available</option>";
    }

    $stmt->close();
}
?>
