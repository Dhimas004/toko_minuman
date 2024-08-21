<?php
require_once('../koneksi/koneksi.php');
$id_keranjang = $_POST['id_keranjang'];
$qty = $_POST['qty'];

mysqli_query($conn, "UPDATE keranjang SET qty = '$qty' WHERE id_keranjang = '$id_keranjang'");
