<?php
// Nama         : Fikri Azka Pradya
// NIM          : 24060122140171
include('header.html');
require_once './lib/db_login.php';

/*
  TODO 2 : BUATLAH
  1. server side validation
  2. insert new character
  3. tampilan hasilnya error / berhasil

*/

$name = $email =  "";  
if (isset($_POST['submit'])) {
    $valid = true;
    // Player Name Validation
    // Player Name tidak boleh kosong dan hanya berisi huruf dan spasi
    $name  = test_input($_POST['player_name']);
    if ($name == ''){
        $error_name = "Name is required";
        $valid = false;
    } else if(!preg_match("/^[a-zA-Z ]*$/", $name)){
        $error_name = "Only letters and white space allowed";
        $valid = false;
    }
    // Email Validation
    // Email tidak boleh kosong dan harus sesuai format email
    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = "Email is required";
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $error_email = "Format email tidak benar";
        $valid = false;
    } else {
        echo "<script>getCharacter()</script>";
    }
    // Password Validation
    // Password tidak boleh kosong dan minimal 8 karakter
    $password = test_input($_POST['password']);
    if ($password == ''){
        $error_password = "Password is required";
        $valid = FALSE;
    } elseif (strlen($password) < 8) {
        $error_password = "Password must be at least 8 characters";
        $valid = FALSE;
    }
    // Race Validation
    // Race tidak boleh kosong
    $race = isset($_POST['race']);
    if ($race == '') {
        $error_race = "Race is required";
        $valid = false;
    }

    // Class Validation
    // Class tidak boleh kosong
    $class  = test_input($_POST['class']);
    if ($class == '' || $class == 'none'){
        $error_class = "Class is required";
        $valid = false;
    }

    // Attributes Validation
    // Attributes tidak boleh kosong dan total attributes harus sama dengan 100
    $strength = isset($_POST['strength']) ? (int)$_POST['strength'] : 0;
    $agility = isset($_POST['agility']) ? (int)$_POST['agility'] : 0;
    $intelligence = isset($_POST['intelligence']) ? (int)$_POST['intelligence'] : 0;
    
    $total_attributes = $strength + $agility + $intelligence;
    
    if ($total_attributes != 100) {
        $error_attributes = "Total attributes must equal 100";
        $valid = false;
    }

    // Skills Validation
    // Skills tidak boleh kosong
    $skills = isset($_POST['skills']) ? $_POST['skills'] : [];
    if (empty($skills)) {
    $error_skills = "Please select at least one skill";
    $valid = false;
    }

    if ($valid) {
        $name = $db->real_escape_string($_POST['player_name']);
        $email = $db->real_escape_string($_POST['email']);
        $password = $db->real_escape_string($_POST['password']);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $strength = $db->real_escape_string($_POST['strength']);
        $agility = $db->real_escape_string($_POST['agility']);
        $intelligence = $db->real_escape_string($_POST['intelligence']);
        $race = $db->real_escape_string($_POST['race']);
        $class = $db->real_escape_string($_POST['class']);

        // query
        $query = "INSERT INTO tb_characters 
                  (player_name, email, password, strength, agility, intelligence, race_id, class_id) 
                  VALUES 
                  ('$name', '$email', '$hashed_password', $strength, $agility, $intelligence, $race, $class)";
        
        // Eksekusi query
        if ($db->query($query)) {
            echo '<div class="alert alert-success">Character creation successful</div>';
        } else {
            echo '<div class="alert alert-danger">Error: ' . $db->error . '</div>';
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
            <form name="regist" method="POST" action="">
                <!-- Player Name -->
                <div class="form-group">
                    <label for="player_name">Player Name</label>
                    <input type="text" name="player_name" id="player_name" class="form-control" value="<?php echo $name; ?>" ><!-- TAMPILKAN INPUTAN JIKA TELAH DIISIKAN -->
                    <div class="text-danger">
                        <!-- ERROR MSG -->
                        <?php if (isset($error_name)) echo $error_name ?>
                    </div>
                </div>
                
                <!-- Email -->
                <!-- TODO 4 : BUATLAH CEK EMAIL MENGGUNAKAN AJAX -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" onblur="getCharacter()" class="form-control" value="<?php echo $email; ?>"><!-- TAMPILKAN INPUTAN JIKA TELAH DIISIKAN -->
                    <div class="text-danger" id="error_email"> 
                         <!-- ERROR MSG -->                   
                        <?php if (isset($error_email)) echo $error_email; ?>
                    </div>
                    <div id="emailStatus" class="text-danger"></div> 
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <div class="text-danger">
                        <!-- ERROR MSG -->
                        <?php if (isset($error_password)) echo $error_password ?>
                    </div>
                </div>

                <!-- Race and Class -->
                <!-- TODO 5 : TAMPILKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE YANG DIPILIH MENGGUNAKAN AJAX -->
                <div class="form-group">
                    <label for="race">Race</label>
                    <select onchange="getClasses(this.value)" name="race" id="race" class="form-control">
                        <option value="-" selected disabled>Select Race</option>
                        <?php require_once('get_races.php')?>
                        <!-- ERROR MSG -->
                    </select>
                    <div class="text-danger" id="error_race">
                        <!-- ERROR MSG -->
                        <?php if(isset($error_race)) echo $error_race;?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="class">Class</label>
                    <select name="class" id="class" class="form-control">
                        <option value="">Select Class</option>
                    </select>
                    <div class="text-danger" id="error_class">
                        <!-- ERROR MSG -->
                        <?php if(isset($error_class)) echo $error_class;?>
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
