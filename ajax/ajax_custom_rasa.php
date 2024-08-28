<?php
session_start();
require_once('../koneksi/koneksi.php');
$kode_customer = $_SESSION['kd_cs'];
$array_rasa = json_decode($_POST['array_rasa']);
$kode_produk = $_POST['kode_produk'];
$id_keranjang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `AUTO_INCREMENT`
FROM  INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = DATABASE()
AND   TABLE_NAME   = 'keranjang'"))['AUTO_INCREMENT'];
mysqli_query($conn, "DELETE FROM custom_rasa WHERE kode_customer = '$kode_customer' AND kode_produk = '$kode_produk'");
foreach ($array_rasa as $value) {
    $id = $value->id;
    $qty = $value->qty;
    if ($qty > 0) {
        mysqli_query($conn, "INSERT INTO `custom_rasa` (
        `id_keranjang`,
        `varian_rasa_produk_id`,
        `kode_produk`,
        `kode_customer`,
        `qty`
        )
        VALUES
        (
            '$id_keranjang',
            '$id',
            '$kode_produk',
            '$kode_customer',
            '$qty'
        );
    ");
    }
}
