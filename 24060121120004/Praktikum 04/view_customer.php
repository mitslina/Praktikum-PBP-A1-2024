<?php
// Nama         : 
// NIM          :
// Tanggal      :
// Nama File    : view_customer.php
// Deskripsi    : Untuk menampilkan halaman melihat detail customer


// TODO 6 - Praktikum 3 : Buat sesi baru dan handle session untuk user

include('./header.php') 
?>
<div class="card mt-5">
    <div class="card-header">Customers Data</div>
    <div class="card-body">
        <a href="add_customer.php" class="btn btn-primary mb-4">+ Add Customer Data</a>
        <a href="logout.php" class="btn btn-danger mb-4">Logout</a>
        <br>
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Action</th>
            </tr>
            <?php
            // TODO 1 - Praktikum 1 : Lakukan koneksi dengan database

            // TODO 2 - Praktikum 1 : Tulis dan eksekusi query ke database
            
            //TODO 3 - Praktikum 1 : Parsing data yang diterima dari database ke halaman 

            // TODO 4 - Praktikum 1 : Lakukan dealokasi variabel $result

            // TODO 5 - Praktikum 1 : Tutup koneksi dengan database

            ?>
    </div>
</div>
<?php include('./footer.php') ?>