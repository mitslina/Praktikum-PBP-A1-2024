<!-- 
Nama - NIM : Kanz Allief Aryaputra - 24060122140135
File       : add_customer_post.php
Deskripsi  : Menyimpan inputan form ke basis data dan menampilkan respon berupa konfirmasi hasil query menggunakan method POST
Tanggal    : 30 September 2024
 -->
 <?php
require_once ('db_login.php');

$name = $db->real_escape_string($_POST['name']);
$address = $db->real_escape_string($_POST['address']);
$city = $db->real_escape_string($_POST['city']);

$query = 'INSERT INTO customers VALUES("' . $name . '","' . $address . '","' . $city . '");';
$result = $db->query($query);


if (!$result) {
  echo '<div class="alert alert-danger alert-dismissible">
  <strong>Error!</strong> Could not query the database <br>';
  echo $db->error;
  echo '<br>query = ' . $query . '</div>';
} else {
  echo '<div class="alert alert-success alert-dismissible"><strong>Data has been added</strong></div>';
}
$db->close();
?>