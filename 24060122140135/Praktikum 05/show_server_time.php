<!-- 
 Nama - NIM : Kanz Allief Aryaputra - 24060122140135
 File       : show_server_time.php
 Deskripsi  : Menampilkan waktu server dengan ajax
 Tanggal    : 30 September 2024
  -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
</body>
<div class="card">
    <div class="card-header">Ajax Server Time</div>
    <div class="card-body">
        <!-- TODO: Membuat tombol Show Server Time -->
        <button class="btn btn-success" onclick="get_server_time()">Show Server Time</button>
        <br><br>
        <!-- TODO: Membuat elemen untuk menampilkan server time -->
        <div id="showtime"></div>
    </div>
</div>

</html>
<?php require_once("footer.php"); ?>