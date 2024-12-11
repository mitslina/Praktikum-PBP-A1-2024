<!-- 
Nama         : Helga Nurul Bhaiti
NIM          : 24060122130062
Tanggal      : 01/10/2024
File       : get_book.php
Deskripsi  : Mencari data buku berdasarkan judul buku yang di-request menggunakan ajax dan menampilkan detail buku sesuai inputan
 -->

<?php
// TODO : Koneksi ke basis data
require_once('lib/db_login.php');

//TODO : Mendapatkan judul buku
$book_title = isset($_GET['title']) ? $_GET['title'] : '';

//TODO : Membuat dan mengeksekusi query untuk memperoleh data buku yang dicari
$query = "SELECT * FROM books WHERE title LIKE '%" . $db->real_escape_string($book_title) . "%' ";
$result = $db->query($query);

//TODO : Cek apakah eksekusi query gagal atau berhasil
if (!$result) {
    die("Could not query the database: <br />" . $db->error);
}

//TODO : Tampilkan data customer dengan perulangan while
while($row = $result->fetch_object()){
    echo 'Name: '.$row->name.'<br />';
    echo 'Address: '.$row->address.'<br />';
    echo 'City: '.$row->city.'<br />';
}

//TODO : bebaskan $result dari memory dan tutup koneksi database
$result->free();
$db->close();

?>