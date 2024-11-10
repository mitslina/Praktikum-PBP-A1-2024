<!-- 
    Nama : Maulida Aprillia Cinta Ariyatin
    NIM  : 240060122120029 
    RESPONSI
-->

<?php
include('header.html');
require_once 'lib/db_login.php';

/*
  TODO 2 : BUATLAH
  1. server side validation
  2. insert new character
  3. tampilan hasilnya error / berhasil

*/
$success_message = '';
$error_message = '';

if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Player Name Validation
    // Player Name tidak boleh kosong dan hanya berisi huruf dan spasi
    $player_name = test_input($_POST['player_name']);
    if (empty($player_name) || !preg_match("/^[a-zA-Z ]*$/", $player_name)) {
        $valid = FALSE;
        $error_player_name = "Player names cannot be empty and can only contain letters and spaces";
    }

    // Email Validation
    // Email tidak boleh kosong dan harus sesuai format email
    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = "Email is required";
        $valid = FALSE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Invalid email format";
        $valid = FALSE;
    }

    // Password Validation
    // Password tidak boleh kosong dan minimal 8 karakter
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = "Password is required";
        $valid = FALSE;
    }

    // Race Validation
    // Race tidak boleh kosong
    $race_id = isset($_POST['race']) ? $_POST['race'] : '';
    if ($race_id == '') {
        $error_race = "Race is required";
        $valid = FALSE;
    }

    // Class Validation
    // Class tidak boleh kosong
    $class_id = isset($_POST['class']) ? $_POST['class'] : '';
    if ($class_id == '') {
        $error_class = "Class is required";
        $valid = FALSE;
    }

    // Attributes Validation
    // Attributes tidak boleh kosong dan total attributes harus sama dengan 100
    $strength = (int)$_POST['strength'];
    $agility = (int)$_POST['agility'];
    $intelligence = (int)$_POST['intelligence'];
    $total_attributes = $strength + $agility + $intelligence;
    if ($total_attributes !== 100) {
        $valid = FALSE;
        $error_attributes = "Total attributes must equal 100.";
    }

    // Skills Validation
    // Skills tidak boleh kosong
    $skills = isset($_POST['skills']) ? $_POST['skills'] : [];
    if (empty($skills)) {
        $error_skills = "Skills are required.";
        $valid = FALSE;
    }

    if ($valid) {
        // Insert ke database
        $password_hashed = md5($password);
        $query = "INSERT INTO tb_characters (player_name, email, password, strength, agility, intelligence, race_id, class_id) 
            VALUES ('$player_name', '$email', '$password_hashed', $strength, $agility, $intelligence, '$race_id', '$class_id')";
        $result = $db->query($query);
        if ($result) {
            $success_message = "Character creation successful!";
        } else {
            $error_message = "Error creating character: " . $db->error;
        }
    }
}
?>
<!-- Display success or error messages -->
<?php if ($success_message): ?>
    <div class="alert alert-success">
        <?php echo $success_message; ?>
    </div>
<?php elseif ($error_message): ?>
    <div class="alert alert-danger">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>

<div class="card">
        <div class="card-header text-center">
            <h3>RPG Character Registration</h3>
        </div>
        <div class="card-body">
        
            <!-- TODO 3 : DEFINISIKAN METHOD DAN ACTIONS YANG SESUAI -->
            <form name="regist" method="POST" action="character_registration.php">
                <!-- Player Name -->
                <div class="form-group">
                    <label for="player_name">Player Name</label>
                    <input type="text" name="player_name" id="player_name" class="form-control" value="<?php echo isset($player_name) ? $player_name : ''; ?>">
                    <div class="text-danger">
                        <?php echo isset($error_player_name) ? $error_player_name : ''; ?>
                    </div>
                </div>
            
                <!-- Email -->
                <!-- TODO 4 : BUATLAH CEK EMAIL MENGGUNAKAN AJAX -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" onblur="getCharacter()" value="<?php echo isset($email) ? $email : ''; ?>"> <!-- TAMPILKAN INPUTAN JIKA TELAH DIISIKAN -->
                    <div class="text-danger" id="error_email">
                        <!-- ERROR MSG -->
                        <?php echo isset($error_email) ? $error_email : ''; ?>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <div class="text-danger">
                        <!-- ERROR MSG -->
                        <?php echo isset($error_password) ? $error_password : ''; ?>
                    </div>
                </div>

                <!-- Race and Class -->
                <!-- TODO 5 : TAMPILKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE YANG DIPILIH MENGGUNAKAN AJAX -->
                <div class="form-group">
                    <label for="race">Race</label>
                    <select onchange="getClasses(this.value)" name="race" id="race" class="form-control">
                        <option value="">Select Race</option>
                        <?php  require_once 'get_races.php'; ?>
                    </select>
                    <div class="text-danger" id="error_race">
                        <!-- ERROR MSG -->
                        <?php if (isset($error_race)) echo $error_race ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <select name="class" id="class" class="form-control">
                        <option value="">Select Class</option>
                        <!-- <?php 
                            if (isset($class_id) && !empty($class_id)) {
                                echo "<option value='$class_id' selected>$class_name</option>";
                            }
                        ?> -->
                    </select>
                    <div class="text-danger" id="error_class">
                        <!-- ERROR MSG -->
                        <?php if (isset($error_class)) echo $error_class ?>
                    </div>
                </div>

                <!-- Attributes (Strength, Agility, Intelligence) -->
                <div class="form-group">
                    <label for="attributes">Character Attributes (Total: 100)</label>
                    <div class="d-flex justify-content-between">
                        <div class="p-2 flex-grow-1">
                            <label for="strength">Strength: </label>
                            <input type="number" name="strength" id="strength" class="form-control" min="0" max="100" value="<?php echo isset($strength) ? $strength : 0; ?>">
                        </div>
                        <div class="p-2 flex-grow-1">
                            <label for="agility">Agility: </label>
                            <input type="number" name="agility" id="agility" class="form-control" min="0" max="100" value="<?php echo isset($agility) ? $agility : 0; ?>">
                        </div>
                        <div class="p-2 flex-grow-1">
                            <label for="intelligence">Intelligence: </label>
                            <input type="number" name="intelligence" id="intelligence" class="form-control" min="0" max="100" value="<?php echo isset($intelligence) ? $intelligence : 0; ?>">
                        </div>
                    </div>
                    <div class="text-danger">
                        <!-- ERROR MSG -->
                        <?php echo isset($error_attributes) ? $error_attributes : ''; ?>
                    </div>
                </div>

                <!-- Skills -->
                <div class="form-group">
                    <label for="skills">Select Skills (Ctrl + Click for multiple)</label>
                    <select name="skills[]" id="skills" class="form-control" multiple>
                        <option value="Swordsmanship" <?php echo isset($skills) && in_array('Swordsmanship', $skills) ? 'selected' : ''; ?>>Swordsmanship</option>
                        <option value="Archery" <?php echo isset($skills) && in_array('Archery', $skills) ? 'selected' : ''; ?>>Archery</option>
                        <option value="Magic" <?php echo isset($skills) && in_array('Magic', $skills) ? 'selected' : ''; ?> >Magic</option>
                        <option value="Stealth" <?php echo isset($skills) && in_array('Stealth', $skills) ? 'selected' : ''; ?>>Stealth</option>
                    </select>
                    <div class="text-danger">
                        <!-- ERROR MSG -->
                        <?php echo isset($error_skills) ? $error_skills : ''; ?>
                    </div>
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Create Character</button>
            </form>
        </div>
    </div>
    
<?php include('footer.html') ?>
