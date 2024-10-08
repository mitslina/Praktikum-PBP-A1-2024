<?php
include('header.html');
require_once 'lib/db_login.php';

/*
  TODO 2 : BUATLAH
  1. server side validation
  2. insert new character
  3. tampilan hasilnya error / berhasil

*/
if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Player Name Validation
    // Player Name tidak boleh kosong dan hanya berisi huruf dan spasi
    $player_name = test_input($_POST['player_name']);
    if ($player_name == '') {
        $error_playername = "Player name is required";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $player_name)) {
        $error_playername = "Only letters and white space allowed";
        $valid = FALSE;
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
    } elseif (strlen($password) < 8) {
        $error_password = "Password must be at least 8 characters long";
        $valid = FALSE;
    }
    // Race Validation
    // Race tidak boleh kosong
    $race_id = $_POST['race'];
    if ($race_id == '') {
        $error_race = "Race is required";
        $valid = FALSE;
    }

    // Class Validation
    // Class tidak boleh kosong
    $class_id = $_POST['class'];
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
    if ($total_attributes != 100) {
        $error_attributes = "Total attributes must equal 100";
        $valid = FALSE;
    }

    // Skills Validation
    // Skills tidak boleh kosong
    if (isset($_POST['skills']) && is_array($_POST['skills']) && !empty($_POST['skills'])) {
        $skills = $_POST['skills'];
    } else {
        $error_skills = "At least one skill must be selected";
        $valid = FALSE;
    }

    if ($valid) {
        // Insert ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $skills_str = implode(", ", $skills); 

        $query = "INSERT INTO tb_characters (player_name, email, password, race_id, class_id, strength, agility, intelligence, skills) 
                  VALUES ('$player_name', '$email', '$hashed_password', '$race_id', '$class_id', '$strength', '$agility', '$intelligence', '$skills_str')";

        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $db->error);
        } else {
            echo "<div class='alert alert-success'>Character registration success!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Error creating character. Please fix the errors below.</div>";
    }
    $db->close();
}
?>

<div class="card">
        <div class="card-header text-center">
            <h3>RPG Character Registration</h3>
        </div>
        <div class="card-body">
            <!-- TODO 3 : DEFINISIKAN METHOD DAN ACTIONS YANG SESUAI -->
            <form name="regist" method="POST" action="">
                <!-- Player Name -->
                <div class="form-group">
                    <label for="player_name">Player Name</label>
                    <input type="text" name="player_name" id="player_name" class="form-control" value="<?php if(isset($player_name)) echo $player_name; ?>"><!-- TAMPILKAN INPUTAN JIKA TELAH DIISIKAN -->
                    <div class="text-danger">
                        <!-- ERROR MSG -->
                        <?php if (isset($error_playername)) echo $error_playername ?>
                    </div>
                </div>
                
                <!-- Email -->
                <!-- TODO 4 : BUATLAH CEK EMAIL MENGGUNAKAN AJAX -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" onkeyup="getCharacter()" /><!-- TAMPILKAN INPUTAN JIKA TELAH DIISIKAN -->
                    <div class="text-danger" id="error_email">
                        <!-- ERROR MSG -->
                        <?php if (isset($error_email)) echo $error_email ?>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" >
                    <div class="text-danger">
                        <!-- ERROR MSG -->
                        <?php if (isset($error_password)) echo $error_password ?>
                    </div>
                </div>

                <!-- Race and Class -->
                <!-- TODO 5 : TAMPILKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE YANG DIPILIH MENGGUNAKAN AJAX -->
                <div class="form-group">
                    <label for="race">Race</label>
                    <select onchange="getClasses(this.value)" name="race" id="race" class="form-control" >
                        <option value="">Select Race</option>
                        <?php include 'get_races.php'; ?>
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
                            <input type="number" name="strength" id="strength" class="form-control flex-fill" min="0" max="100">
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
                        <!-- ERROR MSG -->
                        <?php if (isset($error_attributes)) echo $error_attributes ?>
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
                        <!-- ERROR MSG -->
                        <div class="error"><?php if (isset($error_skills)) echo $error_skills ?></div>
                    </div>
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Create Character</button>
            </form>
        </div>
    </div>

<?php include('footer.html') ?>
