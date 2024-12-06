<!--  
Nama            : Aniqah Nursabrina
NIM             : 24060122120036
Hari, Tanggal   : Selasa, 01 Oktober 2024
Lab             : A1
-->

<?php
session_start();
include('header.html');
require_once 'lib/db_login.php';

/*
  TODO 2 : BUATLAH
  1. server side validation
  2. insert new character
  3. tampilan hasilnya error / berhasil
*/

if (isset($_POST['submit'])){
    $valid = TRUE;

    // Player Name Validation
    // Player Name tidak boleh kosong dan hanya berisi huruf dan spasi
    $player_name = test_input($_POST['player_name']);
    if (empty($player_name)) {
        $error_player_name = "player_name harus diisi";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $player_name)) {
        $error_player_name = "player_name hanya dapat berisi huruf dan spasi";
        $valid = FALSE;
    }

    // Email Validation
    // Email tidak boleh kosong dan harus sesuai format email
    $email = test_input($_POST['email']);
    if (empty($email)) {
        $error_email = "Email harus diisi";
        $valid = FALSE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Format email tidak benar";
        $valid = FALSE;
    }

    // Password Validation
    // Password tidak boleh kosong dan minimal 8 karakter
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = 'Password is required';
        $valid = FALSE;
    }

    // Race Validation
    // Race tidak boleh kosong
    if (isset($_POST['race']) && !empty($_POST['race'])) {
        $race = $_POST['race'];
    } else {
        $valid = FALSE;
        $error_race = "Minimal satu race harus dipilih";
    }
    // Class Validation
    // Class tidak boleh kosong
    if (isset($_POST['class']) && !empty($_POST['class'])) {
        $class = $_POST['class'];
    } else {
        $valid = FALSE;
        $error_class = "Minimal satu class harus dipilih";
    }

    // Attributes Validation
    // Attributes tidak boleh kosong dan total attributes harus sama dengan 100
    $strength = intval($_POST['strength']);
    $agility = intval($_POST['agility']);
    $intelligence = intval($_POST['intelligence']);
    if (empty($strength) || $strength == '-') {
        $error_strength = "strength harus diisi";
        $valid = FALSE;
    }
    
    if (empty($agility) || $agility == '-') {
        $error_agility = "agility harus diisi";
        $valid = FALSE;
    }
    
    if (empty($intelligence) || $intelligence == '-') {
        $error_intelligence = "intelligence harus diisi";
        $valid = FALSE;
    }
    
    $total_attributes = $strength + $agility + $intelligence;

    if ($strength == 0 || $agility == 0 || $intelligence == 0 || $total_attributes != 100) {
        $valid = FALSE;
        $error_attributes = "Total Attributes harus berjumlah 100";
    }

    if (isset($_POST['skills']) && !empty($_POST['skills'])) {
        $skills = $_POST['skills'];
    } else {
        $valid = FALSE;
        $error_skills = "Minimal satu skill harus dipilih";
    }

    // Jika validasi berhasil, insert ke database
    if ($valid) {
        $player_name = $db->real_escape_string($player_name);
        $email = $db->real_escape_string($email);
        $password = password_hash($password, PASSWORD_BCRYPT); 
        $strength = intval($strength);
        $agility = intval($agility);
        $intelligence = intval($intelligence);
        
        $race_id = isset($_POST['race']) ? intval($_POST['race']) : null; 
        $class_id = isset($_POST['class']) ? intval($_POST['class']) : null; 

        $query = "INSERT INTO tb_characters (player_name, email, password, strength, agility, intelligence, race_id, class_id) 
        VALUES ('$player_name', '$email', '$password', $strength, $agility, $intelligence, $race_id, $class_id)";

        $result = $db->query($query);
        
        if (!$result) {
            die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
        } else {
            $_SESSION['success_message'] = "Character creation successful";
            $db->close();
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }

}
?>

<!-- Display success message -->
<?php
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); // Remove the message after displaying it
}
?>
<div class="card mt-5">
    <div class="card-header text-center">
        <h3>RPG Character Registration</h3>
    </div>
    <div class="card-body">

        <!-- TODO 3 : DEFINISIKAN METHOD DAN ACTIONS YANG SESUAI -->
        <form name="regist" method="post" action="">
            <!-- Player Name -->
            <div class="form-group m-2">
                <label for="player_name">Player Name</label><br />
                <input type="text" class="form-control" id="player_name" name="player_name" maxlength="50" value="<?php if (isset($player_name)) { echo $player_name; } ?>">
                <div class="error text-danger"><?php if (isset($error_player_name)) echo $error_player_name; ?></div>
            </div>
            <!-- Email -->
            <!-- TODO 4 : BUATLAH CEK EMAIL MENGGUNAKAN AJAX -->
            <div class="form-group m-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" onchange="getCharacter()" class="form-control" value="<?php if (isset($email)) { echo $email; } ?>">
                <div class="text-danger" id="error_email">
                    <div class="error text-danger" id="error_email"><?php if (isset($error_email)) echo $error_email; ?></div>
                </div>
                <div id="response"></div>
            </div>

            <!-- Password -->
            <div class="form-group m-2">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" value="<?php if (isset($password)) { echo $password; } ?>">
                <div class="text-danger" id="error_password">
                    <div class="error text-danger" id="error_password"><?php if (isset($error_password)) echo $error_password; ?></div>
                </div>
            </div>

            <!-- Race and Class -->
            <!-- TODO 5 : TAMPILKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE YANG DIPILIH MENGGUNAKAN AJAX -->
            <div class="form-group m-2">
                <label class="label" for="race">race:</label><br />
                <select name="race" id="race" class="form-control" onchange="getClasses(this.value)">
                    <option value="">-- Select Race --</option>
                    <?php
                    require_once('./lib/db_login.php');
                    $query = "SELECT * FROM tb_races ORDER BY race_id";
                    $result = $db->query($query);
                    if (!$result) {
                        die("Could not query the database: <br>" . $db->error);
                    }
                    while ($row = $result->fetch_object()) {
                        echo '<option value="' . $row->race_id . '">' . $row->race_name . '</option>';
                    }
                    $result->free();
                    $db->close();
                    ?>
                </select>
                <div class="error text-danger"><?php if (isset($error_race)) echo $error_race; ?></div>
            </div>

            <div class="form-group m-2">
                <label class="label" for="class">class:</label><br />
                <select name="class" id="class" class="form-control">
                    <option value="-" selected disabled>-- Pilih class --</option>
                </select>
                <div class="error text-danger"><?php if (isset($error_class)) echo $error_class; ?></div>
            </div>

            <!-- Attributes (Strength, Agility, Intelligence) -->
            <div class="form-group">
                <label for="attributes">Character Attributes (Total: 100)</label>
                <div class="d-flex justify-content-between">
                    <div class="p-2 flex-grow-1">
                        <label for="strength">Strength: </label>
                        <input type="number" name="strength" id="strength" class="form-control flex-fill" min="0" max="100" value="<?php if (isset($strength)) { echo $strength; } ?>">
                        <div class="error text-danger" id="error_strength"><?php if (isset($error_strength)) echo $error_strength; ?></div>
                    </div>
                    <div class="p-2 flex-grow-1">
                        <label for="agility">Agility: </label>
                        <input type="number" name="agility" id="agility" class="form-control" min="0" max="100" value="<?php if (isset($agility)) { echo $agility; } ?>">
                        <div class="error text-danger" id="error_agility"><?php if (isset($error_intelligence)) echo $error_agility; ?></div>
                    </div>
                    <div class="p-2 flex-grow-1">
                        <label for="intelligence">Intelligence: </label>
                        <input type="number" name="intelligence" id="intelligence" class="form-control" min="0" max="100" value="<?php if (isset($intelligence)) { echo $intelligence; } ?>">
                        <div class="error text-danger" id="error_intelligence"><?php if (isset($error_intelligence)) echo $error_intelligence; ?></div>
                    </div>
                </div>
                <div class="text-danger">
                    <div class="error text-danger" id="error_strength"><?php if (isset($error_attributes)) echo $error_attributes; ?></div>
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
                    <div class="error text-danger" id="error_skills"><?php if (isset($error_skills)) echo $error_skills; ?></div>
                </div>
            </div>

            <div class="m-2 text-center">
                <button type="submit" class="btn btn-primary btn-block" name="submit">Create Character</button>
            </div>
        </form>
    </div>
</div>

<?php require_once('./footer.html'); ?>