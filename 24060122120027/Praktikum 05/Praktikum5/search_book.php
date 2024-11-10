<!-- 
Nama         : Yesi Dwi Ningtias
NIM          : 24060122120027
Tanggal      : 29 September 2024
File       : search_book.php
Deskripsi  : Melakukan pencarian buku (live search) dengan memasukkan judul buku yang diinginkan dan menjalankan fungsi ajax
 -->

<?php include("header.php")?>

<br>
<div class="card">
    <div class="card-header">Search Book</div>
    <div class="card-body">
        <!-- TODO: Buat elemen input untuk mencari dgn inputan judul buku-->
        <input type="text" id="book_title" onkeyup="searchBookByTitle()" placeholder="search book by title" class="form-control">
        <!-- Hint : gunakan onkeyup="searchBookByTitle()" untuk menerapkan live search -->
    </div>
</div><br>

<!-- TODO: Tambahkan elemen untuk menampilkan detail buku yang di cari -->
<div id="book_details"></div>

<?php include("footer.php")?>