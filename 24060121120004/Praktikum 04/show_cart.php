<?php 
// Nama         : 
// NIM          :
// Tanggal      :
// File         : show_cart.php
// Deskripsi    : Untuk menambahkan item ke shopping cart dan menampilkan isi shopping cart

// TODO 1: Buat sebuah sesi baru

// TODO 2: Dapatkan id dari url

if ($id != '') {
    // TODO 3: Tuliskan session

}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Shopping Cart</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Price * Qty</th>
            </tr>
            <?php 
            // TODO 4: Tuliskan dan eksekusi query

            ?>
            
        </table>
        Total items = 

        // TODO 5: Tambahkan tautan ke view_books.php
        <a class="btn btn-primary">Continue Shopping</a>

        // TODO 6: Tambahkan tautan ke delete_cart.php
        <a class="btn btn-danger">Empty Cart</a>
    </div>
</div>
<?php include('./footer.php') ?>