<!-- 
Nama         : Azzam Saefudin Rosyidi
NIM          : 24060122130076
Tanggal      : 1 Oktober 2024
File       : character_registration.php
 -->

<?php
include('header.html');
require_once('lib/db_login.php');

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
    if (empty($player_name)) {
        $error_player_name = "Player Name is required";
        $valid = FALSE;
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $player_name)) {
        $error_player_name = "Player Name only contains letters and spaces";
        $valid = FALSE;
    }

    // Email Validation
    // Email tidak boleh kosong dan harus sesuai format email
    $email = test_input($_POST['email']);
    if (empty($email)) {
        $error_email = "Email is required";
        $valid = FALSE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Email format is incorrect";
        $valid = FALSE;
    }


    // Password Validation
    // Password tidak boleh kosong dan minimal 8 karakter
    $password = test_input($_POST['password']);
    if (empty($password)) {
        $error_password = "Password is required";
        $valid = FALSE;
    } elseif (strlen($password) < 8) {
        $error_password = "Password must be at least 8 characters long ";
        $valid = FALSE;
    }

    // Race Validation
    // Race tidak boleh kosong
    $race = test_input($_POST['race']);
    if (empty($race)) {
        $error_race = "Race is required";
        $valid = FALSE;
    }

    // Class Validation
    // Class tidak boleh kosong
    $class = test_input($_POST['class']);
    if (empty($class)) {
        $error_class = "Class is required";
        $valid = FALSE;
    }

    // Attributes Validation
    // Attributes tidak boleh kosong dan total attributes harus sama dengan 100
    $strength = test_input($_POST['strength']);
    $agility = test_input($_POST['agility']);
    $intelligence = test_input($_POST['intelligence']);
    $total_attributes = $strength + $agility + $intelligence;
    if ($total_attributes != 100) {
        $error_attributes = "Total attributes must equal 100";
        $valid = FALSE;
    }

    // Skills Validation
    // Skills tidak boleh kosong
    $skills = $_POST['skills'] ?? [];
    if (empty($skills)) {
        $error_skills = "At least one skill must be selected";
        $valid = FALSE;
    }

    if ($valid) {
        // Insert ke database
        $skills_string = implode(", ", $skills);
        $query = "INSERT INTO tb_characters (player_name, email, password, strength, agility, intelligence, profile_picture, race_id, class_id) 
                  VALUES ('$player_name', '$email', '" . password_hash($password, PASSWORD_BCRYPT) . "', '$strength', '$agility', '$intelligence', '$skills_string', $race, $class)";

        $result = $db->query($query);
        if ($result) {
            echo "<div class='alert alert-success'>Character berhasil dibuat</div>";
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat membuat character: " . $db->error . "</div>";
        }
    }
}
?>

<div class="card">
    <div class="card-header text-center">
        <h3>RPG Character Registration</h3>
    </div>
    <div class="card-body">
        <!-- TODO 3 : DEFINISIKAN METHOD DAN ACTIONS YANG SESUAI -->
        <form name="regist" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <!-- Player Name -->
            <div class="form-group">
                <label for="player_name">Player Name</label>
                <input type="text" name="player_name" id="player_name" class="form-control" value="<?php echo isset($player_name) ? $player_name : ''; ?>">
                <div class="text-danger">
                    <?php if (isset($error_player_name)) echo $error_player_name; ?>
                </div>
            </div>

            <!-- Email -->
            <!-- TODO 4 : BUATLAH CEK EMAIL MENGGUNAKAN AJAX -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" onblur="getCharacter()" name="email" id="email" class="form-control" value="<?php echo isset($email) ? $email : ''; ?>">
                <div class="text-danger" id="error_email">
                    <!-- ERROR MSG -->
                    <?php if (isset($error_email)) echo $error_email; ?>
                </div>
                <div class="text-success" id="success_email">
                    <!-- SUCCESS MSG-->
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <div class="text-danger">
                    <!-- ERROR MSG -->
                    <?php if (isset($error_password)) echo $error_password; ?>
                </div>

            </div>

            <!-- Race and Class -->
            <div class="form-group">
                <label for="race">Race</label>
                <select onchange="getClasses(this.value)" name="race" id="race" class="form-control">
                    <option value="">Select Race</option>

                </select>
                <div class="text-danger" id="error_race">
                    <!-- ERROR MSG -->
                    <?php if (isset($error_race)) echo $error_race; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="class">Class</label>
                <select name="class" id="class" class="form-control">
                    <option value="">Select Class</option>
                </select>
                <div class="text-danger" id="error_class">
                    <!-- ERROR MSG -->
                    <?php if (isset($error_class)) echo $error_class; ?>
                </div>
            </div>

            <!-- Attributes (Strength, Agility, Intelligence) -->
            <div class="form-group">
                <label for="attributes">Character Attributes (Total: 100)</label>
                <div class="d-flex justify-content-between">
                    <div class="p-2 flex-grow-1">
                        <label for="strength">Strength: </label>
                        <input type="number" name="strength" id="strength" class="form-control flex-fill" min="0" max="100" value="<?php echo isset($strength) ? $strength : 0; ?>">
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
                    <!-- ERROR MSG -->
                    <?php if (isset($error_skills)) echo $error_skills; ?>
                </div>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Create Character</button>
        </form>
    </div>
</div>

<?php include('footer.html') ?>