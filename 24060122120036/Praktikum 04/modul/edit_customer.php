<?php
// Nama         : Aniqah Nursabrina
// NIM          : 24060122120036
// Tanggal      : 22/09/2024
// File         : edit_customer.php
// Deskripsi    : Menampilkan form edit data customer dan mengupdate data ke database.

// TODO 1: Konek Database
require_once('./lib/db_login.php');

// TODO 2: Dapatkan id dari url
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Memeriksa apakah user belum menekan tombol submit
if (!isset($_POST["submit"])) {
    // TODO 3: Tuliskan Kueri dan eksekusi data
    $query = 'SELECT * FROM customers WHERE customerid="'.$id.'"';
    $result = $db->query($query);
    if (!$result) {
        die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
    } else {
    // TODO 4: Handle form submission   
        while ($row = $result->fetch_object()) {
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        }
    }

} else {
    $valid = TRUE;
    $name = test_input($_POST['name']);

    // Validasi terhadap field name
    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    // Validasi terhadap field address
    $address = test_input($_POST['address']);
    if ($address == '') {
        $error_address = "Address is required";
        $valid = FALSE;
    }

    // Validasi terhadap field city
    $city = $_POST['city'];
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    // Update data into database
    if ($valid) {
        // Jika valid, update data pada database dengan mengeksekusi query yang sesuai
        $address = $db->real_escape_string($address);
        $query = "UPDATE customers SET name='".$name."', address='".$address."', city='".$city."' WHERE customerid=".$id."";
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
        } else {
            $db->close();
            header('Location: view_customer.php');
        }
    }
    // Fungsi real_escape_string() dalam PHP mencegah kesalahan sintaks pada query SQL akibat karakter khusus, 
    // seperti tanda kutip tunggal ('). Dengan mengubah karakter tersebut menjadi bentuk aman (misalnya, \'), 
    // fungsi ini memastikan query dapat dijalankan dengan benar. Selain itu, penggunaan real_escape_string() 
    // melindungi aplikasi dari serangan injeksi SQL dan menjaga integritas data dalam basis data.

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
                <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($name)) {echo $name;}?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
            <div class="form-group">
                <label for="name">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="5"><?php if(isset($address)) {echo $address;}?></textarea>
                <div class="error"><?php if (isset($error_address)) echo $error_address ?></div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" <?php if (!isset($city)) echo 'selected' ?>>--Select a city--</option>
                    <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected' ?>>Airport West</option>
                    <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected' ?>>Box Hill</option>
                    <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected' ?>>Yarraville</option>
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