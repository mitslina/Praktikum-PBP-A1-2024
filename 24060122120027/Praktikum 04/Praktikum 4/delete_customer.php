<?php
// Nama         : Yesi Dwi Ningtias
// NIM          : 24060122120027
// Tanggal      : 21 September 2024
// File         : delete_customer.php
// Deskripsi    : Untuk menghapus customer

// TODO 1: Lakukan koneksi dengan database
session_start();
require_once('./lib/db_login.php');

if (!isset($_SESSION['username'])) {
  header('Location: ./login.php');
  exit;
}
$id = $_GET['id'];
// if (isset($_GET['id'])) {
//     $customerid = test_input($_GET['id']); // Mendapatkan customerid dari query string

    // TODO 2: Tulis dan eksekusi query untuk menghapus customer
    $query = "DELETE FROM customers WHERE customerid = '" . $id . "'";
    $result = $db->query($query);
    if (!$result) {
      die("Could not query the database: <br />" . $db->error);
    } else {
      $db->close();
      header('Location: view_customer.php');
    }

?>