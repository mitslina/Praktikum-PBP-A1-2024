<?php
// Nama         : Kanz Allief Aryaputra
// NIM          : 24060122140135
// Tanggal      : 23/09/2024
// Nama File    : view_customer.php
// Deskripsi    : Untuk menampilkan halaman melihat detail customer

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Praktikum PBP</title>
</head>

<body>
    <div class="container"><br>
        <div class="card">
            <div class="card-header">Customer Data</div>
            <div class="card-body">
                <br>
                <a class="btn btn-primary" href="add_customer.php">+ Add Customer Data</a><br /><br />
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    //inlcude our logun information
                    require_once('db_login.php');
                    //execute the query
                    $query = " SELECT * FROM customers ORDER BY customerid ";
                    $result = $db->query($query);
                    if (!$result) {
                        die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
                    }
                    //fetch and display the results
                    $i = 1;
                    while ($row = $result->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . $i . '</td>';
                        echo '<td>' . $row->name . '</td>';
                        echo '<td>' . $row->address . '</td>';
                        echo '<td>' . $row->city . '</td>';
                        echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id=' . $row->customerid . '">Edit</a>&nbsp;
                            <a class="btn btn-danger btn-sm" href="confirm_delete_customer.php?id=' . $row->customerid . '">Delete</a>
                        </td>';
                        echo '<tr>';
                        $i++;
                    }
                    echo '</table>';
                    echo '<br />';
                    echo 'Total Rows = ' . $result->num_rows;
                    $result->free();
                    $db->close();
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>