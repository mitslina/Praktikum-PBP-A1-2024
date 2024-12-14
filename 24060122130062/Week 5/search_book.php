<!-- 
Nama         : Helga Nurul Bhaiti
NIM          : 24060122130062
Tanggal      : 01/10/2024
File       : search_book.php
Deskripsi  : Melakukan pencarian buku (live search) dengan memasukkan judul buku yang diinginkan dan menjalankan fungsi ajax
 -->

<?php include("header.php")?>

<br>
<div class="card">
    <div class="card-header">Search Book</div>
    <div class="card-body">
        <!-- TODO: Buat elemen input untuk mencari dgn inputan judul buku-->
        <!-- Hint : gunakan onkeyup="searchBookByTitle()" untuk menerapkan live search -->
        <input type="text" id="book_title" class="form-control" placeholder="Enter book title" onkeyup="searchBookByTitle()">
    </div>
</div><br>

    </div>
</div><br>

<!-- TODO: Tambahkan elemen untuk menampilkan detail buku yang di cari -->
<div id="book_detail"></div>

<?php include("footer.php")?>