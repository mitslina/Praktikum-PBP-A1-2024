<!--
// Nama         : Kanz Allief Aryaputra
// NIM          : 24060122140135
// Tanggal      : 23/09/2024
Nama File    : view_books.php
Deskripsi    : Untuk menampilkan halaman melihat buku dan detailnya
-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
          crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="card mt-4">
        <div class="card-header">Books Data</div>
        <div class="card-body">
            <br>
            <table class="table table-striped">
                <tr>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>

                <?php
                // Include login information
                require_once('db_login.php');

                // Execute query to fetch books data
                $query = "SELECT * FROM books ORDER BY isbn";
                $result = $db->query($query);
                if (!$result) {
                    die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
                }

                // Fetch and display books data
                while ($row = $result->fetch_object()) {
                    echo '<tr>';
                    echo '<td>' . $row->isbn . '</td>';
                    echo '<td>' . $row->author . '</td>';
                    echo '<td>' . $row->title . '</td>';
                    echo '<td>$' . $row->price . '</td>';
                    echo '<td><a class="btn btn-primary" href="show_cart.php?id=' . $row->isbn . '">Add to Cart</a></td>';
                    echo '</tr>';
                }

                // Display total rows
                echo '</table>';
                echo '<br />';
                echo 'Total Rows = ' . $result->num_rows;

                // Free result set and close database connection
                $result->free();
                $db->close();
                ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7Nnikv bZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>
