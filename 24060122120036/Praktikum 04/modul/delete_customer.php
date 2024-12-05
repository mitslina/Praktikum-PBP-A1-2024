<?php
// Nama         : Aniqah Nursabrina
// NIM          : 24060122120036
// Tanggal      : 22/09/2024
// File         : delete_customer.php
// Deskripsi    : untuk menghapus customer
// session_start();
require_once('./lib/db_login.php');

$id = $_GET['id'];

$query = "DELETE FROM customers WHERE customerid = '" . $id . "'";
  $result = $db->query($query);
  if (!$result) {
    die("Could not query the database: <br />" . $db->error);
  } else {
    $db->close();
    header('Location: view_customer.php');
  }
?>