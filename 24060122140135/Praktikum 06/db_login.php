<?php
// TODO 1: SETUP & CONNECT DATABASE

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responsi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit;
}

// Function to sanitize input
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
