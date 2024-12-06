<?php
// Nama         : Kanz Allief Aryaputra
// NIM          : 24060122140135
// Tanggal      : 23/09/2024
// File         : edit_customer.php
// Deskripsi    : Menampilkan form edit data customer dan mengupdate data ke database.

require_once('db_login.php');
$id = $_GET['id']; //mendapatkan customerid yang dilewatkan ke url

//mengecek apakah user belum menekan tombol submit
if (!isset($_POST["submit"])) {
    $query = " SELECT * FROM customers WHERE customerid=" . $id . " ";
    //execute the query
    $result = $db->query($query);
    if (!$result) {
        die("Could not query the database: <br />" . $db->error);
    } else {
        while ($row = $result->fetch_object()) {
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        }
    }
} else {
    $valid = TRUE; //flag validasi
    $name = test_input($_POST['name']);
    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    $adddress = test_input($_POST['address']);
    if ($address == '') {
        $error_address = "Address is required";
        $valid = FALSE;
    }

    $city = test_input($_POST['city']);
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    //updare data into database
    if ($valid) {
        //escape inputs data
        $address = $db->real_escape_string($address);
        //assign a query
        $query = " UPDATE customers SET name='" . $name . "',address='" . $address . "',city='" . $city . "' WHERE customerid=" . $id . "";
        //execute the query
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $db->error . '<br />Query:' . $query);
        } else {
            $db->close();
            header('Location: view_customer.php');
        }
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Praktikum PBP</title>
</head>

<body>
<br>
<div class="container"><br>
    <div class="card">
        <div class="card-header">Customer Data</div>
        <div class="card-body">
            <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                    <div class="error"><?php if (isset($error_name)) echo $error_name; ?></div>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="5"><?php echo $address; ?></textarea>
                    <div class="error"><?php if (isset($error_address)) echo $error_address; ?></div>
                </div>

                <div class="form-group">
                        <label for="city">City:</label>
                        <select name="city" id="city" class="form-control" required>
                            <option value="none" <?php if (!isset($city)) echo 'selected="true"'; ?>>--Select a city--</option>
                            <option value="Airport West" <?php if (($city) && $city == "Airport West") echo 'selected="true"'; ?>>Airport West</option>
                            <option value="Box Hill" <?php if (($city) && $city == "Box Hill") echo 'selected="true"'; ?>>Box Hill</option>
                            <option value="Yarraville" <?php if (($city) && $city == "Yarraville") echo 'selected="true"'; ?>>Yarraville</option>
                        </select>
                        <div class="error"><?php if (isset($error_city)) echo $error_city ?></div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

</body>

</html>

<?php
$db->close();
?>