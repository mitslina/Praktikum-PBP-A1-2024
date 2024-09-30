<?php 
// Nama         : Arsyad Grant Saputro
// NIM          : 24060122140143
// Tanggal      : 23/09/2024
// File         : edit_customer.php
// Deskripsi    : Menampilkan form edit data customer dan mengupdate data ke database.

// TODO 1: Inisialisasi session
session_start();

// TODO 2: Dapatkan id dari url
require_once('C:\xampp\htdocs\Praktikum 4\lib\db_login.php');

// Cek apakah 'id' ada di URL, jika tidak ada tampilkan pesan error atau redirect
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: Customer ID not specified.");
} else {
    $id = test_input($_GET['id']); // Dapatkan ID dari URL
}

// Mengecek apakah user belum menekan tombol submit
if (!isset($_POST["submit"])) {
    // TODO 3: Tuliskan Kueri dan eksekusi data
    $query = "SELECT * FROM customers WHERE customerid='$id'";
    $result = $db->query($query);

    // Periksa apakah query berhasil
    if(!$result){
        die("Could not query the database: <br />".$db->error);
    } else {
        if ($row = $result->fetch_object()) {
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        } else {
            die("Error: Customer not found.");
        }
    }
} else {
    // TODO 4: Handle form submission   
    $valid = TRUE;

    // Validasi terhadap field name
    $name  = test_input($_POST['name']);
    if ($name == ''){
        $error_name = "Name is required";
        $valid = FALSE;
    } else if(!preg_match("/^[a-zA-Z ]*$/", $name)){
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    // Validasi terhadap field address
    $address  = test_input($_POST['address']);
    if ($address == ''){
        $error_address = "Address is required";
        $valid = FALSE;
    }

    // Validasi terhadap field city
    $city  = test_input($_POST['city']);
    if ($city == '' || $city == 'none'){
        $error_city = "City is required";
        $valid = FALSE;
    }

    // Update data into database jika valid
    if ($valid) {
        // Escape inputs data
        $address = $db->real_escape_string($address);
        
        // Asign a query
        $query = "UPDATE customers SET name='$name', address='$address', city='$city' WHERE customerid='$id'";
        
        // Execute the query
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
        } else {
            $db->close();
            header('Location: view_customer.php');
            exit();
        }
    }
}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Edit Customers Data</div>
    <div class="card-body">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id ?>" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name); ?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="5"><?= htmlspecialchars($address); ?></textarea>
                <div class="error"><?php if (isset($error_address)) echo $error_address ?></div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" <?php if ($city == 'none') echo 'selected' ?>>--Select a city--</option>
                    <option value="Airport West" <?php if ($city == "Airport West") echo 'selected' ?>>Airport West</option>
                    <option value="Box Hill" <?php if ($city == "Box Hill") echo 'selected' ?>>Box Hill</option>
                    <option value="Yarraville" <?php if ($city == "Yarraville") echo 'selected' ?>>Yarraville</option>
                </select>
                <div class="error"><?php if (isset($error_city)) echo $error_city ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>
