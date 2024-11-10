<?php
//Nama : Bisma Wira Adi Wicaksono
//NIM : 24060122140120
//Kelas : A1

include('header.html');
require_once 'lib/db_login.php';

/*
  TODO 2 : BUATLAH
  1. server side validation
  2. insert new character
  3. tampilan hasilnya error / berhasil
*/

// Ambil daftar race untuk dropdown
$races_query = "SELECT race_id, race_name FROM tb_races";
$races_result = $db->query($races_query);

// Ambil daftar class untuk dropdown berdasarkan race yang dipilih menggunakan AJAX
if (isset($_POST['get_classes']) && isset($_POST['race_id'])) {
    $race_id = intval($_POST['race_id']);
    $classes_query = "SELECT class_id, class_name FROM tb_classes WHERE race_id = $race_id";
    $classes_result = $db->query($classes_query);
    $classes = [];

    while ($class = $classes_result->fetch_assoc()) {
        $classes[] = $class;
    }

    echo json_encode($classes);
    exit();
}

/* 
  Proses registrasi karakter saat form di-submit
*/
if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Player Name Validation
    $player_name = trim($_POST['player_name']);
    if (empty($player_name) || !preg_match("/^[a-zA-Z\s]+$/", $player_name)) {
        $valid = FALSE;
        $error_player_name = "Player Name hanya boleh berisi huruf dan spasi";
    }

    // Email Validation
    $email = trim($_POST['email']);
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = FALSE;
        $error_email = "Email harus memiliki format yang benar";
    } else {
        // Cek apakah email sudah digunakan
        $email_query = "SELECT email FROM tb_characters WHERE email = '$email'";
        $email_result = $db->query($email_query);
        if ($email_result->num_rows > 0) {
            $valid = FALSE;
            $error_email = "Email sudah terdaftar";
        }
    }

    // Password Validation
    $password = trim($_POST['password']);
    if (empty($password) || strlen($password) < 8) {
        $valid = FALSE;
        $error_password = "Password harus memiliki minimal 8 karakter";
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    }

    // Race Validation
    $race_id = $_POST['race'];
    if (empty($race_id)) {
        $valid = FALSE;
        $error_race = "Race harus dipilih";
    }

    // Class Validation
    $class_id = isset($_POST['class']) ? $_POST['class'] : null; // Memastikan variabel didefinisikan
    if (empty($class_id)) {
        $valid = FALSE;
        $error_class = "Class harus dipilih";
    }

    // Attributes Validation
    $strength = intval($_POST['strength']);
    $agility = intval($_POST['agility']);
    $intelligence = intval($_POST['intelligence']);
    $total_attributes = $strength + $agility + $intelligence;

    if ($strength == 0 || $agility == 0 || $intelligence == 0 || $total_attributes != 100) {
        $valid = FALSE;
        $error_attributes = "Total Attributes harus berjumlah 100 dan setiap atribut minimal bernilai 1.";
    }

    // Skills Validation
    if (isset($_POST['skills']) && is_array($_POST['skills']) && !empty($_POST['skills'])) {
        $skills = $_POST['skills'];
        // ...
    } else {
        $valid = FALSE;
        $error_skills = "Minimal satu skill harus dipilih";
    }
    
    // Jika validasi lolos, masukkan ke database
    if ($valid) {
        $skills_str = implode(", ", $skills);
        $query = "INSERT INTO tb_characters (player_name, email, password, strength, agility, intelligence, race_id, class_id, profile_picture) 
                  VALUES ('$player_name', '$email', '$password_hashed', $strength, $agility, $intelligence, $race_id, $class_id, NULL)";
        $result = $db->query($query);

        if ($result) {
            echo "<div class='alert alert-success'>Character created successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $db->error . "</div>";
        }
    }
}
?>

<div class="card">
    <div class="card-header text-center">
        <h3>RPG Character Registration</h3>
    </div>
    <div class="card-body">
        <form method="post" action="character_registration.php">
            <!-- Player Name -->
            <div class="form-group">
                <label for="player_name">Player Name</label>
                <input type="text" name="player_name" id="player_name" class="form-control">
                <div class="text-danger">
                    <?php if (isset($error_player_name)) echo $error_player_name; ?>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
                <div class="text-danger" id="email-status">
                    <!-- Tempat di mana pesan validasi email akan muncul -->
                    <?php if(isset($error_email)) echo $error_email;?>
                </div>
            </div>


            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <div class="text-danger">
                    <?php if (isset($error_password)) echo $error_password; ?>
                </div>
            </div>

            <!-- Race -->
            <div class="form-group">
                <label for="race">Race</label>
                <select name="race" id="race" class="form-control">
                    <option value="">Select Race</option>
                    <?php
                    while ($race = $races_result->fetch_assoc()) {
                        echo "<option value='" . $race['race_id'] . "'>" . $race['race_name'] . "</option>";
                    }
                    ?>
                </select>
                <div class="text-danger" id="error_race">
                    <?php if (isset($error_race)) echo $error_race; ?>
                </div>
            </div>

            <!-- Class -->
            <div class="form-group">
                <label for="class">Class</label>
                <select name="class" id="class" class="form-control">
                    <option value="">Select Class</option>
                </select>
                <div class="text-danger" id="error_class">
                    <?php if (isset($error_class)) echo $error_class; ?>
                </div>
            </div>

            <!-- Attributes -->
            <div class="form-group">
                <label for="attributes">Character Attributes (Total: 100)</label>
                <div class="d-flex justify-content-between">
                    <div class="p-2 flex-grow-1">
                        <label for="strength">Strength: </label>
                        <input type="number" name="strength" id="strength" class="form-control" min="0" max="100">
                    </div>
                    <div class="p-2 flex-grow-1">
                        <label for="agility">Agility: </label>
                        <input type="number" name="agility" id="agility" class="form-control" min="0" max="100">
                    </div>
                    <div class="p-2 flex-grow-1">
                        <label for="intelligence">Intelligence: </label>
                        <input type="number" name="intelligence" id="intelligence" class="form-control" min="0" max="100">
                    </div>
                </div>
                <div class="text-danger">
                    <?php if (isset($error_attributes)) echo $error_attributes; ?>
                </div>
            </div>

            <!-- Skills -->
            <div class="form-group">
                <label for="skills">Select Skills (Ctrl + Click for multiple)</label>
                <select name="skills[]" id="skills" class="form-control" multiple>
                    <option value="Swordsmanship">Swordsmanship</option>
                    <option value="Archery">Archery</option>
                    <option value="Magic">Magic</option>
                    <option value="Stealth">Stealth</option>
                </select>
                <div class="text-danger">
                    <?php if (isset($error_skills)) echo $error_skills; ?>
                </div>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Create Character</button>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // Ketika dropdown Race berubah, ambil class yang sesuai
    $('#race').change(function() {
        var race_id = $(this).val();

        // Kosongkan dropdown Class
        $('#class').find('option').not(':first').remove();

        if (race_id != '') {
            getClasses(race_id); // Memanggil fungsi getClasses
        }
    });

    // Fungsi untuk mendapatkan daftar class berdasarkan race_id
    function getClasses(race_id) {
        $.ajax({
            url: 'get_classes.php', // URL PHP untuk mendapatkan class berdasarkan race_id
            type: 'GET',
            data: { race_id: race_id }, // Mengirimkan race_id ke server
            dataType: 'json',
            success: function(response) {
                var classSelect = document.getElementById('class'); // Elemen dropdown kelas dengan ID 'class'

                // Kosongkan dropdown sebelum menambahkan opsi baru
                classSelect.innerHTML = '<option value="">Select Class</option>';

                // Tambahkan opsi kelas yang diterima dari response
                response.forEach(function(cls) {
                    var option = document.createElement('option');
                    option.value = cls.class_id;  // Menambahkan class_id sebagai value
                    option.text = cls.class_name; // Menambahkan class_name sebagai teks yang tampil
                    classSelect.appendChild(option);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }
});
</script>


<?php include('footer.html'); ?>
