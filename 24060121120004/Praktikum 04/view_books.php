<!--
// Nama         : 
// NIM          :
// Tanggal      :
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

            // TODO 2: Tulis dan eksekusi query ke database
            
            //TODO 3: Parsing data yang diterima dari database ke halaman 

            // TODO 4: Lakukan dealokasi variabel $result

            // TODO 5: Tutup koneksi dengan database

            ?>
    </div>
</div>
<?php include('./footer.php') ?>