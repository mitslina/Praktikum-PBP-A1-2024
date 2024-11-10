<!-- 
Nama         : Maulida Aprillia Cinta Ariyatin
NIM          : 24060122120029
Tanggal      : 24 September 2024
File       : get_book.php
Deskripsi  : Mencari data buku berdasarkan judul buku yang di-request menggunakan ajax dan menampilkan detail buku sesuai inputan
-->
<?php
// TODO : Koneksi ke basis data
require_once('./lib/db_login.php');

//TODO : Mendapatkan judul buku
$title = $_GET['title'];

//TODO : Membuat dan mengeksekusi query untuk memperoleh data buku yang dicari
$query = "SELECT * FROM books WHERE title LIKE '%$title%'";

$result = $db->query($query);

//TODO : Cek apakah eksekusi query gagal atau berhasil
if (!$result) {
    die("Could not query the database: <br>" . $db->error);
}

//TODO : Tampilkan data customer dengan perulangan while
while($row = $result->fetch_object()){
    echo '<strong>Title:</strong> ' . $row->title . '<br>';
        echo '<strong>Author:</strong> ' . $row->author . '<br>';
        echo '<strong>price:</strong> ' . $row->price . '<br>';
        echo '<strong>isbn:</strong> ' . $row->isbn . '<br><br>';
} 

//TODO : bebaskan $result dari memory dan tutup koneksi database
$result->free();
$db->close();

?>