<?php 
// Nama         : Kanz Allief Aryaputra
// NIM          : 24060122140135
// Tanggal      : 23/09/2024
// File         : show_cart.php
// Deskripsi    : Untuk menambahkan item ke shopping cart dan menampilkan isi shopping cart

session_start();

// Mendapatkan id buku dari URL
$id = $_GET['id'];

// Jika id tidak kosong
if ($id != "") {
    // Jika $_SESSION['cart'] belum ada, inisialisasi dengan array kosong
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Jika item sudah ada di dalam cart, tambahkan jumlahnya
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        // Jika belum ada, tambahkan item baru dengan jumlah 1
        $_SESSION['cart'][$id] = 1;
    }
}
?>

<!-- Menampilkan isi shopping cart -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
          crossorigin="anonymous">
</head>
<body>
<br>
<div class="container">
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
                    <th>Total</th>
                </tr>

                <?php
                // Include informasi login ke database
                require_once('db_login.php');

                $sum_qty = 0;  // Total item dalam shopping cart
                $sum_price = 0;  // Total harga dalam shopping cart

                // Jika shopping cart berbentuk array
                if (is_array($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $id => $quantity) {
                        // Mengambil detail buku berdasarkan ISBN
                        $query = "SELECT * FROM books WHERE isbn='$id'";
                        $result = $db->query($query);
                        if (!$result) {
                            die("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
                        }

                        // Tampilkan buku yang ada di shopping cart
                        while ($row = $result->fetch_object()) {
                            echo '<tr>';
                            echo '<td>' . $row->isbn . '</td>';
                            echo '<td>' . $row->author . '</td>';
                            echo '<td>' . $row->title . '</td>';
                            echo '<td>$' . $row->price . '</td>';
                            echo '<td>' . $quantity . '</td>';
                            $total_price = $row->price * $quantity;
                            echo '<td>$' . $total_price . '</td>';
                            echo '</tr>';

                            // Hitung total item dan total harga
                            $sum_price += $total_price;
                            $sum_qty += $quantity;
                        }
                    }

                    // Tampilkan total item dan total harga
                    echo '<tr>';
                    echo '<td colspan="4"></td>';
                    echo '<td><strong>Total Qty: ' . $sum_qty . '</strong></td>';
                    echo '<td><strong>Total Price: $' . $sum_price . '</strong></td>';
                    echo '</tr>';
                    $result->free();
                    $db->close();
                } else {
                    // Jika tidak ada item di shopping cart
                    echo '<tr><td colspan="6" align="center">There is no item in the shopping cart</td></tr>';
                }
                ?>

            </table>

            <!-- Tombol untuk melanjutkan belanja dan mengosongkan cart -->
            <a class="btn btn-primary" href="view_books.php">Continue Shopping</a>
            <a class="btn btn-danger" href="delete_cart.php">Empty Cart</a><br /><br />
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7Nnikv bZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>