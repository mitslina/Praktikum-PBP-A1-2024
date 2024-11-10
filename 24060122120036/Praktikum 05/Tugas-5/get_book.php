<!-- 
Nama         : Aniqah Nursabrina
NIM          : 24060122120036
Tanggal      : 30/09/2024
File       : get_book.php
Deskripsi  : Mencari data buku berdasarkan judul buku yang di-request menggunakan ajax dan menampilkan detail buku sesuai inputan
 -->
<?php
// TODO : Koneksi ke basis data
require_once('./lib/db_login.php');


//TODO : Mendapatkan judul buku
$value = $_GET['title'];

//TODO : Membuat dan mengeksekusi query untuk memperoleh data buku yang dicari
$query = "SELECT * FROM  books WHERE title LIKE '%".$value."%'";

$result = $db->query($query);

//TODO : Cek apakah eksekusi query gagal atau berhasil
if (!$result) {
    die("Could not query the database: <br>".$db->error);
}

//TODO : Tampilkan data customer dengan perulangan while
$i = 1;
while ($row = $result->fetch_object()) {
    echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$row->isbn."</td>";
        echo "<td>".$row->author."</td>";
        echo "<td>".$row->title."</td>";
        echo "<td>".$row->price."</td>";
    echo "</tr>";
    $i++;
}

//TODO : bebaskan $result dari memory dan tutup koneksi database
$result->free();
$db->close();

?>