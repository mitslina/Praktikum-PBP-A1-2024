<?php
// Nama         : Helga Nurul Bhaiti
// NIM          : 24060122130062
// Tanggal      : 24/09/2024
// Nama File    : view_customer.php
// Deskripsi    : Untuk menampilkan halaman melihat detail customer


// TODO 6 - Praktikum 3 : Buat sesi baru dan handle session untuk user

include('./header.php') 
?>
<div class="card mt-5">
    <div class="card-header">Customers Data</div> 
    <div class="card-body">
        <a href="add_customer.php" class="btn btn-primary mb-4">+ Add Customer Data</a> <!-- memberikan style button berwarna biru -->
        <a href="logout.php" class="btn btn-danger mb-4">Logout</a>
        <br>
        <table class="table table-striped"> <!-- memberikan style misal baris satu abu2 dst -->
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Action</th>
            </tr>
            <?php
            // TODO 1 - Praktikum 1 : Lakukan koneksi dengan database
            //include out login information -> menjalankan string querynya
            require_once('lib/db_login.php');

            // TODO 2 - Praktikum 1 : Tulis dan eksekusi query ke database
            //execute the query
            // $query = " SELECT * FROM customers ORDER BY customerid ";
            $query = " SELECT customerid AS ID, name AS Nama, address AS Alamat, city AS Kota FROM customers ORDER BY customerid";
            $result = $db->query($query);
            if(!$result){
                die("Could not query the database: <br />". $db->error ."<br>Query: ".$query."<br />");
            }
            
            
            // row-> name berarti row search objek
            //mengarahkan ke cust dgn id, yg idnya 1, dst
            //total row untuk menampilkan brp byk data yg di db
            //result utk menghapus nilai var td lalu di close, pastikan utk menutup koneksi ke db supy tdk trlalu berat
            //TODO 3 - Praktikum 1 : Parsing data yang diterima dari database ke halaman 
            // <!-- fetch mengembalikan satu data saja, menggunakan perulangan while menggunakan penomoran, mengambil objek diambil dri db dan disimpan di dalam var row -->
            $i=1;
            while($row = $result->fetch_object()){
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$row->Nama.'</td>';
                echo '<td>'.$row->Alamat.'</td>';
                echo '<td>'.$row->Kota.'</td>';
                echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id='.$row->ID.'">Edit</a>&nbsp;&nbsp;
                <a class ="btn btn-danger btn-sm" href="confirm_delete.php?id='.$row->ID.'">Delete</a>
                <td>';
                echo '</tr>';
                $i++;
            }
            echo '</table>';
            echo 'Total Rows = '.$result->num_rows;

            // TODO 4 - Praktikum 1 : Lakukan dealokasi variabel $result
            $result->free();

            // TODO 5 - Praktikum 1 : Tutup koneksi dengan database
            $db->close();

            ?>
        </table>
    </div>
</div>
<?php include('./footer.php') ?>