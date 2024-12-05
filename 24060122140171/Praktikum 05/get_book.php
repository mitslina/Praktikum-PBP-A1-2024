<!-- 
Nama         : Fikri Azka Pradya
NIM          : 24060122140171
Tanggal      : 1 Oktober 2024
File         : get_book.php
Deskripsi    : Mencari data buku berdasarkan judul buku yang di-request menggunakan ajax dan menampilkan detail buku sesuai inputan
 -->
 <?php
// TODO: Koneksi ke basis data
require_once('./lib/db_login.php');

// TODO: Mendapatkan judul buku, dan sanitasi input untuk mencegah SQL Injection
$title = $_GET["title"];
if (!empty($title)) {
    // TODO: Membuat dan mengeksekusi query untuk memperoleh data buku yang dicari
    $query = "SELECT books.isbn, books.author, books.title, books.price, categories.name FROM books INNER JOIN categories ON books.categoryid = categories.categoryid WHERE books.title LIKE '%$title%' ";
    $result = $db->query($query);

    // TODO: Cek apakah eksekusi query gagal atau berhasil
    if (!$result) {
        die("Could not query the database: <br />". $db->error);
    }

    // TODO: Tampilkan data buku jika ditemukan, atau tampilkan pesan jika tidak ada hasil
    if ($result->num_rows > 0) {
        // Tampilkan data buku jika ditemukan
        while($row = $result->fetch_object()){
            echo 'ISBN: '.$row->isbn.'<br>';
            echo 'Author: '.$row->author.'<br>';
            echo 'Title: '.$row->title.'<br>';
            echo 'Price: '.$row->price.'<br>';
            echo 'Category: '.$row->name.'<br>';
            echo '<br>';
        }
    } else {
        // Tampilkan pesan jika tidak ada hasil
        echo 'Buku tidak ditemukan.';
    }
    // TODO: bebaskan $result dari memory dan tutup koneksi database
    $result->free();
} else {
    echo 'Masukkan judul buku untuk mencari.';
}

$db->close();
?>
