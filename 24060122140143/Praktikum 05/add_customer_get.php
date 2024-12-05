<!-- 
Nama       : Arsyad Grant Saputro
NIM        : 24060122140143
Tanggal    : 29 September 2024
File       : add_customer_get.php
Deskripsi  : Menyimpan inputan form ke basis data dan menampilkan respon berupa konfirmasi hasil query menggunakan method GET
 -->
 <?php
    //TODO: Koneksi ke database
    require_once('../Praktikum5/lib/db_login.php');
    //TODO: Dapatkan nilai inputan form
    $name = $db->real_escape_string($_GET['name']);
    $address = $db->real_escape_string($_GET['address']);
    $city = $db->real_escape_string($_GET['city']);

    //TODO: Buat dan eksekusi query
    $query = " INSERT INTO customers (name, address, city) VALUES ('".$name."', '".$address."', '".$city."') ";
    $result = $db->query( $query );

    if (!$result) {
        echo '<div class="alert alert-danger alert-dismissible">
        <strong>Error!</strong> Could not query the database<br>'.
        $db->error.'<br>query = ',$query.
        '</div>';
    } else {
        //TODO: Tampilkan alert berupa data dengan GET
        echo '<div class="alert alert-success alert-dismissible">
        <strong>Success!</strong> Data has been added.<br>
        Name: '.$_GET['name'].'<br>
        Address: '.$_GET['address'].'<br>
        City: '.$_GET['city'].'<br>
        </div>';

    }
    // TODO: Tutup koneksi database
    $db->close();
    
?>