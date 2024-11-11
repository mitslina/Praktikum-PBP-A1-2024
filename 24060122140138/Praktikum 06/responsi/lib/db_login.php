<?php
// Nama File    : db_login.php
// Nama         : Adzkiya Qarina Salsabila
// Deskripsi    : Untuk koneksi ke database

// TODO 1 : SETUP & CONNECT DATABASE
$db_host = 'localhost:3307';
$db_database = 'rpg_registration';
$db_username = 'root';
$db_password = '';

//  Connect database
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno) {
    die('Could not connect to the database: <br/>' . $db->connect_error);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}