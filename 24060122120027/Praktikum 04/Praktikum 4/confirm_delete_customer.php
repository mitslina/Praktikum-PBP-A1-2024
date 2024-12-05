<?php
// Nama         : Yesi Dwi Ningtias
// NIM          : 24060122120027
// Tanggal      : 21 September 2024
// File         : confirm_delete_costumer.php
//Deskripsi     : Untuk meminta konfirmasi penghapusan
session_start();

require_once('./lib/db_login.php');

if (!isset($_SESSION['username'])) {
  header('Location: ./login.php');
  exit;
}

$id = $_GET['id'];
// TODO 3: Handle konfirmasi penghapusan, menampilkan data dan meminta konfirmasi untuk penghapusan

$query = 'SELECT * FROM customers WHERE customerid="' . $id . '"';
$result = $db->query($query);

if (!$result) {
  die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
} else {
  while ($row = $result->fetch_object()) {
    $id = $row->customerid;
    $name = $row->name;
    $address = $row->address;
    $city = $row->city;
  }
}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-4">
  <div class="card-header">Confirm Delete Customer</div>
  <div class="card-body">
    <p>Are you sure you want to delete the following customer?</p>
        <table class="table">
            <tr>
                <th>Customer Id</th>
                <td><?= $id; ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?= $name; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?= $address; ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?= $city; ?></td>
            </tr>
        </table>
    <div class="mt-3">
      <a class="btn btn-danger mb-4" href=<?php echo 'delete_customer.php?id=' . $id ?>>Confirm Delete</a>
      <a class="btn btn-secondary mb-4" href="view_customer.php">Cancel</a>
    </div>
  </div>
</div>
<footer class="footer bg-light text-center py-3">
        <div class="container">
            <?php include('./footer.php') ?>
        </div>
        <div class="madeby">
            <p style=" position: fixed;bottom: 0;width: 100%;background-color: #f8f9fa;text-align: center;padding: 10px 0;">Made with &#10084; by <strong>yesi dwi</strong></p>
        </div>
</footer>
<?php
$db->close();
?>