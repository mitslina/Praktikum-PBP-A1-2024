<!--
// Nama         : Helga Nurul Bhaiti
// NIM          : 24060122130062
// Tanggal      : 24/09/2024
Nama File    : view_books.php
Deskripsi    : Untuk menampilkan halaman melihat buku dan detailnya
-->
<?php include('./header.php') ?>
<div class="card mt-5">
    <div class="card-header">Books Data</div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            <?php
            // TODO 1: Lakukan koneksi dengan database
            require_once('lib/db_login.php');

            // TODO 2: Tulis dan eksekusi query ke database
            $query = "SELECT * FROM books";
            $result = $db->query($query);

            //TODO 3: Parsing data yang diterima dari database ke halaman 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_object()) {
                    echo '<tr>';
                    echo '<td>' . $row->isbn . '</td>';
                    echo '<td>' . $row->author . '</td>';
                    echo '<td>' . $row->title . '</td>';
                    echo '<td>$' . $row->price . '</td>';
                    echo '<td><a class="btn btn-primary" href="show_cart.php?id'.$row->isbn . '">Add to cart </a></td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">No books found.</td></tr>';
            }

            // TODO 4: Lakukan dealokasi variabel $result
            $result->free();
            // TODO 5: Tutup koneksi dengan database
            $db->close();
            ?>
        </table>
    </div>
</div>
<?php include('footer.php') ?>