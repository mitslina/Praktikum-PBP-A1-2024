<!-- 
Nama       : Adzkiya Qarina Salsabila
NIM        : 24060122140138
Tanggal    : 24-09-2024
File       : show_server_time.php
Deskripsi  : Menampilkan waktu server dengan ajax
-->

<?php include('lib/header.html'); ?>

<div class="card">
    <div class="card-header">Ajax Server Time</div>
    <div class="card-body">
        <!-- TODO: Membuat tombol Show Server Time -->
        <button class="btn btn-success" onclick="get_server_time()">Show Server Time</button>
        <br><br>
        <!-- TODO: Membuat elemen untuk menampilkan server time -->
        <div id="showtime"></div>
    </div>
</div>

<?php include('lib/footer.html'); ?>