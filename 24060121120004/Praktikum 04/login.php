<?php
// Nama         : 
// NIM          :
// Tanggal      :
// File         : login.php
// Deskripsi    : Menampilkan form login dan melakukan login ke halaman admin.php

// TODO 1: Inisialisasi session

// TODO 2 : Lakukan koneksi dengan database

// Memeriksa apakah user sudah submit form
if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Memeriksa validasi email

    // Memeriksa validasi password

    // Memeriksa validasi
    if ($valid) {
        // TODO 3: Buatlah query untuk melakukan verifikasi terhadap kredensial yang diberikan // .md5($password).

        // TODO 4: Eksekusi query
        
        // TODO 5: Tutup koneksi dengan database
    }
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Login Form</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($email)) echo $email; ?>">
                <div class="error"><?php if (isset($error_email)) echo $error_email ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="">
                <div class="error"><?php if (isset($error_password)) echo $error_password ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>