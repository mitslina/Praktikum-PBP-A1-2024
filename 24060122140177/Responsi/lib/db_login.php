<?php
// TODO 1 : SETUP & CONNECT DATABASE
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_database = 'rpg_registration';


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
