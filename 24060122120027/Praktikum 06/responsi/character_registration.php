<?php
include('header.html');
require_once 'lib/db_login.php';

/*
  TODO 2 : BUATLAH
  1. Server-side validation
  2. Insert new character ke dalam database jika validasi berhasil
  3. Tampilan hasilnya error atau berhasil
*/

// Inisialisasi variabel error
$error_player_name = $error_email = $error_password = $error_race = $error_class = $error_attributes = $error_skills = "";
$success_message = "";

// Mengambil data race untuk diisi ke dropdown
$query = "SELECT race_name FROM tb_races";
$result = $db->query($query);
$races = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $races[] = $row['race_name'];
    }
}

if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Player Name Validation
    // Player Name tidak boleh kosong dan hanya berisi huruf dan spasi
    $player_name = trim($_POST['player_name']);
    if (empty($player_name) || !preg_match("/^[a-zA-Z ]*$/", $player_name)) {
        $error_player_name = "Player Name is required and should only contain letters and spaces!";
        $valid = FALSE;
    }

     // Email Validation
    // Email tidak boleh kosong dan harus sesuai format email
    $email = trim($_POST['email']);
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Valid email is required!";
        $valid = FALSE;
    }

    // Password Validation
    // Password tidak boleh kosong dan minimal 8 karakter
    $password = $_POST['password'];
    if (empty($password) || strlen($password) < 8) {
        $error_password = "Password must be at least 8 characters!";
        $valid = FALSE;
    } else {
        $password_hashed = $password; 
    }

    // Race Validation
    // Race tidak boleh kosong
    $race = $_POST['race'];
    if (empty($race)) {
        $error_race = "Race is required!";
        $valid = FALSE;
    }

    // Class Validation
    // Class tidak boleh kosong
    $class = $_POST['class'];
    if (empty($class)) {
        $error_class = "Class is required!";
        $valid = FALSE;
    }

    // Attributes Validation
    // Attributes tidak boleh kosong dan total attributes harus sama dengan 100
    $strength = $_POST['strength'];
    $agility = $_POST['agility'];
    $intelligence = $_POST['intelligence'];
    if (empty($strength) || empty($agility) || empty($intelligence) || ($strength + $agility + $intelligence) != 100) {
        $error_attributes = "Total attributes must add up to 100!";
        $valid = FALSE;
    }

     // Skills Validation
    // Skills tidak boleh kosong
    $skills = isset($_POST['skills']) ? $_POST['skills'] : [];
    if (empty($skills)) {
        $error_skills = "At least one skill must be selected!";
        $valid = FALSE;
    }

    if ($valid) {
        $password_hashed = $password; 
        $skills_str = implode(", ", $skills); // Gabungkan skills ke dalam satu string
        $profile_picture = ""; // Inisialisasi profile_picture (jika ada penambahan fitur upload)

        // Mendapatkan race_id dan class_id berdasarkan nama race dan class yang dipilih
        $query_race = "SELECT race_id FROM tb_races WHERE race_name = ?";
        $stmt_race = $db->prepare($query_race);
        $stmt_race->bind_param("s", $race);
        $stmt_race->execute();
        $result_race = $stmt_race->get_result();
        $race_id = $result_race->fetch_assoc()['race_id'];
        $stmt_race->close();

        $query_class = "SELECT class_id FROM tb_classes WHERE class_name = ? AND race_id = ?";
        $stmt_class = $db->prepare($query_class);
        $stmt_class->bind_param("si", $class, $race_id);
        $stmt_class->execute();
        $result_class = $stmt_class->get_result();
        $class_id = $result_class->fetch_assoc()['class_id'];
        $stmt_class->close();

        // Query untuk insert data ke dalam tabel tb_characters
        $query = "INSERT INTO tb_characters 
                (player_name, email, password, strength, agility, intelligence, profile_picture, race_id, class_id, skills) 
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $db->prepare($query);
        $stmt_insert->bind_param("ssiiisssis", $player_name, $email, $password_hashed, $strength, $agility, $intelligence, $profile_picture, $race_id, $class_id, $skills_str);

        if ($stmt_insert->execute()) {
            $success_message = "Character successfully created!";
        } else {
            $success_message = "Error creating character: " . $stmt_insert->error;
        }


        $stmt_insert->close();
    }
}
?>
   <!-- Menampilkan pesan -->
    <?php if (!empty($success_message)): ?>
    <div class='alert alert-success'>
        <?php echo $success_message; ?>
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
                <input type="text" name="player_name" id="player_name" class="form-control" value="<?php if(isset($player_name)) echo $player_name; ?>">
                <div class="text-danger">
                    <?php echo $error_player_name; ?>
                </div>
            </div>

            <!-- Email -->
                <!-- TODO 4 : BUATLAH CEK EMAIL MENGGUNAKAN AJAX -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" onkeyup="getCharacter()"  value="<?php if(isset($email)) echo $email; ?>">
                <div class="text-danger" id="error_email">
                    <?php echo $error_email; ?>
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <div class="text-danger">
                    <?php echo $error_password; ?>
                </div>
            </div>

               <!-- Race and Class -->
                <!-- TODO 5 : TAMPILKAN DAFTAR CLASS BERDASARKAN PILIHAN RACE YANG DIPILIH MENGGUNAKAN AJAX -->
            <div class="form-group">
                <label for="race">Race</label>
                <select onchange="getClasses(this.value)" name="race" id="race" class="form-control">
                    <option value="">Select Race</option>
                    <?php foreach ($races as $race) : ?>
                        <option value="<?php echo $race; ?>"><?php echo $race; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="text-danger" id="error_race">
                    <?php echo $error_race; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="class">Class</label>
                <select name="class" id="class" class="form-control">
                    <option value="">Select Class</option>
                </select>
                <div class="text-danger" id="error_class">
                    <?php echo $error_class; ?>
                </div>
            </div>

            <!-- Attributes (Strength, Agility, Intelligence) -->
            <div class="form-group">
                <label for="attributes">Character Attributes (Total: 100)</label>
                <div class="d-flex justify-content-between">
                    <div class="p-2 flex-grow-1">
                        <label for="strength">Strength: </label>
                        <input type="number" name="strength" id="strength" class="form-control flex-fill" min="0" max="100" value="<?php if(isset($strength)) echo $strength; ?>">
                    </div>
                    <div class="p-2 flex-grow-1">
                        <label for="agility">Agility: </label>
                        <input type="number" name="agility" id="agility" class="form-control" min="0" max="100" value="<?php if(isset($agility)) echo $agility; ?>">
                    </div>
                    <div class="p-2 flex-grow-1">
                        <label for="intelligence">Intelligence: </label>
                        <input type="number" name="intelligence" id="intelligence" class="form-control" min="0" max="100" value="<?php if(isset($intelligence)) echo $intelligence; ?>">
                    </div>
                </div>
                <div class="text-danger">
                    <?php echo $error_attributes; ?>
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
                    <?php echo $error_skills; ?>
                </div>
            </div>
            <br>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Create Character</button>
        </form>
    </div>
</div>

<?php include('footer.html') ?>