<!-- 
Nama         : Mochammad Qaynan Mahdaviqya
NIM          : 24060122140170
Tanggal      : 24-09-2024
File         : get_book.php
Deskripsi    : Mencari data buku berdasarkan judul buku yang di-request menggunakan ajax dan menampilkan detail buku sesuai inputan
 -->

 <?php
// TODO : Koneksi ke basis data
require_once('lib/db_login.php');

// TODO : Mendapatkan judul buku
$title = $db->real_escape_string($_GET['id']);

// TODO : Membuat dan mengeksekusi query untuk memperoleh data buku yang dicari
$query = "SELECT * FROM books WHERE title LIKE '%$title%'";
$result = $db->query($query);

// TODO : Cek apakah eksekusi query gagal atau berhasil
if (!$result) {
    die ("Could not query the database: <br />". $db->error);
}

// TODO : Tampilkan data customer dengan perulangan while
if ($result->num_rows > 0) {
    echo '<div class="alert alert-success">';
    while ($row = $result->fetch_object()) {
        echo "Title: " . $row->title . "</p>";
        echo "Author: " . $row->author . "</p>";
        echo "ISBN: " . $row->isbn . "</p>";
        echo "Price: " . $row->price . "</p>";
    }
} else {
    echo 'No books found matching your search.';
}

// TODO : bebaskan $result dari memory dan tutup koneksi database
$result->free();
$db->close();

?>
