<?php 
// Nama         : Kanz Allief Aryaputra
// NIM          : 24060122140135
// Tanggal      : 23/09/2024
// File         : add_customer.php
// Deskripsi    : Untuk menambahkan customer baru ke daftar customer

require_once('db_login.php');

// Mengecek apakah user belum menekan tombol submit
if (!isset($_POST["submit"])) {
    $query = " SELECT * FROM customers ";
    //Execute query
    $result = $db->query($query);
    if (!$result){
        die ("Could not the query database: <br />" . $db->error);
    } else {
        while ($row = $result->fetch_object()){
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        }
    }
    
} else {

    $valid = TRUE; //flag validasi

    // Validasi nama
    $name = test_input($_POST['name']);
    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    // Validasi alamat
    $address = test_input($_POST['address']);
    if ($address == '') {
        $error_address = "Address is required";
        $valid = FALSE;
    }

    // Validasi kota
    $city = $_POST['city'];
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    // Jika validasi berhasil, masukkan data ke database
    if ($valid) {
        // Escape inputs data
        $address = $db->real_escape_string($address);

        // Assign query
        $query = "INSERT INTO customers(name, address, city) VALUES ('$name', '$address', '$city')";

        // Execute query
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
        } else {
            // Setelah submit, redirect ke halaman view_customer.php
            $db->close();
            header('Location: view_customer.php');
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Customers Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
          crossorigin="anonymous">
</head>
<body>
<br>
<div class="container">
    <div class="card">
        <div class="card-header">Add Customers Data</div>
        <div class="card-body">
            <form method="POST" autocomplete="on" action="add_customer.php">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="">
                    <div class="text-danger"><?php if (isset($error_name)) echo $error_name; ?></div>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="5"></textarea>
                    <div class="text-danger"><?php if (isset($error_address)) echo $error_address; ?></div>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <select name="city" id="city" class="form-control">
                        <option value="none">--Select a city--</option>
                        <option value="Airport West">Airport West</option>
                        <option value="Box Hill">Box Hill</option>
                        <option value="Yarraville">Yarraville</option>
                    </select>
                    <div class="text-danger"><?php if (isset($error_city)) echo $error_city; ?></div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7Nnikv bZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>

<?php
$db->close();
?>