<?php
// TODO 1 : SETUP & CONNECT DATABASE
$servername = "localhost";  
$username = "root";        
$password = "";            
$dbname = "responsi";      

$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>