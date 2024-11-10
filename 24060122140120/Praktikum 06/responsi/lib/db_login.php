<?php
//Nama : Bisma Wira Adi Wicaksono
//NIM : 24060122140120
//Kelas : A1
// TODO 1 : SETUP & CONNECT DATABASE
$db_host="localhost";
$db_database= "rpg_registration";   
$db_username= "root";
$db_password= "";

// connect database
$db = new mysqli ($db_host, $db_username, $db_password, $db_database);
if ($db->connect_error){
    die("Could not Connect to the database: <br />". $db->connect_error);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>