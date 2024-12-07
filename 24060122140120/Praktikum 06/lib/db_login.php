<!-- db_login.php -->
<?php
// TODO 1 : SETUP & CONNECT DATABASE
$db_host = 'localhost';
$db_database = 'responsi';
$db_username = 'root';
$db_password = '';

$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if($db->connect_errno){
    die('Could not connect to database: <br />'. $db->connect_error);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
