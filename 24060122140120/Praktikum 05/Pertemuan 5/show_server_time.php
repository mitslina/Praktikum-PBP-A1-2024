<!-- 
Nama         : Bisma Wira Adi Wicaksono
NIM          : 24060122140120
Tanggal      : 30 September 2024
File         : show_server_time.php
Deskripsi    : Menampilkan waktu server dengan ajax
-->

<?php require_once("header.php"); ?> <br>

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

<?php require_once("footer.php"); ?>

