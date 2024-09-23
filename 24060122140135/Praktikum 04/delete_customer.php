<?php
// Nama         : Kanz Allief Aryaputra
// NIM          : 24060122140135
// Tanggal      : 23/09/2024
// File         : delete_customer.php
// Deskripsi    : Untuk menghapus customer

require_once('db_login.php'); // Memasukkan informasi login

$id = $_GET['id']; // Mendapatkan customerid yang dilewatkan melalui URL

// Mengecek apakah id ditemukan
if (isset($_GET['id'])) {

    // Assign query untuk menghapus data customer sesuai dengan id
    $query = 'DELETE FROM customers WHERE customerid="' . $id . '";';

    // Execute the query
    $result = $db->query($query); 
    if (!$result) {
        die("Could not query the database: <br />" . $db->error);
    } else {
        // Jika data berhasil dihapus, redirect ke halaman view_customer.php
        $db->close();
        header('Location: view_customer.php');
    }
}
?>

<?php include('./header.php'); ?>
<div class="card mt-5">
    <div class="card-header">Confirm Delete Customer</div>
    <div class="card-body">
        <p>Are you sure you want to delete the following customer?</p>
        <table class="table">
            <tr>
                <th>Customer Id</th>
                <td><?= $customerid; ?></td>
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
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $customerid; ?>" method="POST">
            <button type="submit" class="btn btn-danger" name="confirm">Confirm Delete</button>
            <button type="submit" class="btn btn-secondary" name="cancel">Cancel</button>
        </form>
    </div>
</div>
<footer class="footer bg-light text-center py-3">
        <div class="container">
            <?php include('./footer.php') ?>
        </div>
        <div class="madeby">
            <p style=" position: fixed;bottom: 0;width: 100%;background-color: #f8f9fa;text-align: center;padding: 10px 0;">Made with &#10084; by <strong>kelompok 2</strong></p>
        </div>
</footer>
