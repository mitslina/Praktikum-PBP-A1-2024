<?php
// Nama         : Helga Nurul Bhaiti
// NIM          : 24060122130062
// Tanggal      : 24/09/2024
// File         : edit_customer.php
// Deskripsi    : Menampilkan form edit data customer dan mengupdate data ke database.

// TODO 1: Inisialisasi session
// session_start();
require_once('lib/db_login.php');

// TODO 2: Dapatkan id dari url
// Cek jika 'id' ada di URL dan bukan null
if (!isset($_GET['id']) || trim($_GET['id']) === '') {
    // Redirect ke halaman view_customer.php atau tampilkan pesan kesalahan
    header('Location: view_customer.php');
    exit;  // Stop script jika tidak ada ID
}
$id = $_GET['id']; //mendapatkan customerid yang dilewatkan ke url

// mengecek apakah user belum menekan tombol submit
if (!isset($_POST["submit"])) {
    // TODO 3: Tuliskan Kueri dan eksekusi data
    $query = " SELECT * FROM customers WHERE customerid =".$id." ";

    //execetue the query
    $result = $db->query($query);
    if (!$result) {
        die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
    } else {
        while ($row = $result->fetch_object()) {
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        }
    }
} else {
    // TODO 4: Handle form submission   
    $valid = TRUE; //flag validasi

    // Validasi terhadap field name
    $name = test_input($_POST['name']);
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
    $city = test_input($_POST['city']);
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }
    
    // Update data into database
    if ($valid) {
        //escape input data
        // $address = $db->real_escape_string($address);
        //Asign a query
        $query = "UPDATE customers SET name='".$name."', address='".$address."', city='".$city."' WHERE customerid = ".$id." ";
        
        //Execute the query
        $result = $db->query($query);
        if(!$result){
            die ("Could not query the database : <be />".$db->error. '<br>Query:' .$query);
        } else{
            $db->close();
            header('Location: view_customer.php');
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
                <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
            <div class="form-group">
                <label for="name">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="5"><?php echo $address; ?></textarea>
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