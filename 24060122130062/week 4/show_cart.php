<?php 
// Nama         : Helga Nurul Bhaiti
// NIM          : 24060122130062
// Tanggal      : 24/09/2024
// File         : show_cart.php
// Deskripsi    : Untuk menambahkan item ke shopping cart dan menampilkan isi shopping cart

// TODO 1: Buat sebuah sesi baru
session_start();

// TODO 2: Dapatkan id dari url
$id = $_GET['id'];

if ($id != "") {
    // TODO 3: Tuliskan session
    //jika $_SESSION['cart'] belum ada, maka inisialisasi dengan array kosong
    //$_SESSION['cart'] merupakan array asosiatif
    //indeksnya berisi isbn buku yang dipilih
    //value-nya berisi jumlah (qty) dari buku dengan isbn tersebut
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Jika $_SESSION['cart']  dengan indeks isbn buku yang dipilih sudah ada, 
    // tambahkan value-nya dengan 1, jika belum ada,
    //buat elemen baru dengan indeks tersebut dan set nilainya dengan 1
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}
?>
<!-- Menampilkan isi shopping cart -->
<?php include('./header.php') ?>
<br>
<div class="card">
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
            // Include our login information
            require_once 'lib/db_login.php';
            $sum_qty = 0; //inisialisasi total item di shopping cart
            $sum_price = 0; //inisialisasi total price di shopping cart
            if(is_array($_SESSION['cart'])){
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $query = "SELECT * FROM books WHERE isbn='".$id."'";
                    $result = $db->query($query);
                    if (!$result) {
                        die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
                    } 
                    // else {
                        while ($row = $result->fetch_object()) {
                            echo '<tr>';
                            echo '<td>' . $row->isbn . '</td>';
                            echo '<td>' . $row->author . '</td>';
                            echo '<td>' . $row->title . '</td>';
                            $sum_price = $sum_price + ($row->price * $qty);
                        }
                }
                    echo'<tr><td></td><td></td><td></td><td></td><td>' .$sum_qty.'</td><td>' .$sum_price . '</td></tr>';
                    $result->free();
                    $db->close();
                    // }
            }else{
                echo '<tr><td colspan="6" align="center">There is no item in shopping cart</td></tr>';         
            }
            ?>
        </table>
        Total items = <?php echo $sum_qty; ?><br><br>
        
        <!-- // TODO 5: Tambahkan tautan ke view_books.php -->
        <a class="btn btn-primary">Continue Shopping</a>

        <!-- // TODO 6: Tambahkan tautan ke delete_cart.php -->
        <a class="btn btn-danger">Empty Cart</a>
    </div>
</div>
<?php include('./footer.php') ?>