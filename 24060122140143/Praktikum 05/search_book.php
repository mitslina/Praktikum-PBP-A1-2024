<!-- 
Nama         : Arsyad Grant Saputro
NIM          : 24060122140143
Tanggal      : 29 September 2024
File         : search_book.php
Deskripsi    : Melakukan pencarian buku (live search) dengan memasukkan judul buku yang diinginkan dan menjalankan fungsi ajax
 -->

 <?php include("header.php")?>

<br>
<div class="card">
    <div class="card-header">Search Book</div>
    <div class="card-body">
        <!-- TODO: Buat elemen input untuk mencari dengan inputan judul buku -->
        <!-- Hint: gunakan onkeyup="searchBookByTitle()" untuk menerapkan live search -->
        <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan Judul" onkeyup="searchBookByTitle()">
        <br>
        <!-- TODO: Tambahkan elemen untuk menampilkan detail buku yang dicari -->
        <div id="detail_book"></div>
    </div>
</div><br>

<?php include("footer.php")?>