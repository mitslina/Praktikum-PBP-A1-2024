<?php
require_once 'lib/db_login.php';

//  TODO 4 : MENGAMBIL DATA USER DARI TABEL 'tb_characters' DENGAN PARAMETER EMAIL
if (isset($_GET['email'])) {
    $email = test_input($_GET['email']);
    error_log("Email received: " . $email);
    $database = $db->prepare("SELECT * FROM tb_characters WHERE email = ?");
    $database->bind_param("s", $email); // "s" berarti string
    $database->execute();
    $result = $database->get_result();

    if ($result->num_rows > 0) {
        echo "<span class='text-danger'>Email has been used</span>";
    } else {
        echo "<span class='text-success'>Email available</span>";
    }
}
?>