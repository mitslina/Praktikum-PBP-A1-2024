<!-- 
Nama         : Adzkiya Qarina Salsabila
NIM          : 24060122140138
Tanggal      : 24-09-2024
File       : search_book.php
Deskripsi  : Melakukan pencarian buku (live search) dengan memasukkan judul buku yang diinginkan dan menjalankan fungsi ajax
 -->

<?php include('lib/header.html')?>

<br>
<div class="card">
    <div class="card-header">Search Book</div>
    <div class="card-body">
        <!-- TODO: Buat elemen input untuk mencari dgn inputan judul buku -->
        <input type="text" id="book_title" onkeyup="searchBookByTitle()" placeholder="Enter book title">
    </div>
</div><br>

<!-- TODO: Tambahkan elemen untuk menampilkan detail buku yang di cari -->
<div id="book_detail"></div>

<?php include('lib/footer.html')?>