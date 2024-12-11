<?php
require_once 'lib/db_login.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    //  TODO 4 : MENGAMBIL DATA USER DARI TABEL 'tb_characters' DENGAN PARAMETER EMAIL
    $query = "SELECT * FROM tb_characters WHERE email = ?";
    

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $email);
        
        
        $stmt->execute();
        
        
        $result = $stmt->get_result();
        
        
        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                echo "Player Name: " . $row['player_name'] . "<br>";
                echo "Race: " . $row['race'] . "<br>";
                echo "Class: " . $row['class'] . "<br>";
                echo "Strength: " . $row['strength'] . "<br>";
                echo "Agility: " . $row['agility'] . "<br>";
                echo "Intelligence: " . $row['intelligence'] . "<br>";
                echo "Skills: " . $row['skills'] . "<br>";
            }
        } else {
            echo "No character found with this email.";
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Email is not provided.";
}
?>
