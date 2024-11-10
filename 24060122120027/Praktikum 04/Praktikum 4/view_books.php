<?php
// Nama         : Yesi Dwi Ningtias
// NIM          : 24060122120027
// Tanggal      : 21 September 2024
// Nama File    : view_books.php
// Deskripsi    : Untuk menampilkan halaman melihat buku dan detailnya

session_start();
require_once('./lib/db_login.php');

// hanya dibuka oleh admin setelah berhasil login.
if (!isset($_SESSION['username'])) {
  header('Location: ./login.php');
  exit;
}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-5">
  <div class="card-header">Books Data</div>
  <div class="card-body">
    <table class="table table-striped">
      <tr>
        <th>ISBN</th>
        <th>Author</th>
        <th>Title</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
      <?php
      // TODO 1: Lakukan koneksi dengan database
      require_once('./lib/db_login.php');
      // TODO 2: Tulis dan eksekusi query ke database
      $query = "SELECT * FROM books";
      $result = $db->query($query);
      if (!$result) {
        die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
      }

      //TODO 3: Parsing data yang diterima dari database ke halaman
      $i = 1;
      while ($row = $result->fetch_object()) {
        echo '<tr>';
        echo '<td>' . $row->isbn . '</td>';
        echo '<td>' . $row->author . '</td>';
        echo '<td>' . $row->title . '</td>';
        echo '<td>$' . $row->price . '</td>';
        echo '<td><a class="btn btn-primary btn-sm" href="show_cart.php?id=' . $row->isbn . '">Add to Cart</a></td>';
        echo '</tr>';
        $i++;
      }
      echo '</table>';
      echo '<br />';
      echo 'Total Rows = ' . $result->num_rows;
      // TODO 4: Lakukan dealokasi variabel $result
      $result->free();
      // TODO 5: Tutup koneksi dengan database
      $db->close();
      ?>
  </div>
</div>
<?php include('./footer.php') ?>