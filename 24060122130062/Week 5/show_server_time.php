<!-- 
Nama         : Helga Nurul Bhaiti
NIM          : 24060122130062
Tanggal      : 01/10/2024
File       : show_server_time.php
Deskripsi  : Menampilkan waktu server dengan ajax
-->
<!-- // program untuk membuka serrver type .php bkn html, ada tombol show server type dengan fungsi get server time ketika di klik ia akan jalan -->
<?php include("header.php"); ?> <br>

<div class="card">
    <div class="card-header">Ajax Server Time</div>
    <div class="card-body">
        <!-- TODO: Membuat tombol Show Server Time -->
        <button class="btn btn-success" onclick="get_server_time()">Show Server Time</button>        
        <br><br>
        <!-- TODO: Membuat elemen untuk menampilkan server time -->
        <div id ="showtime"></div>
    </div>
</div>

<?php include("footer.php"); ?> <br>

