<?php
include '../../koneksi/koneksi.php';
$layanan = $_POST['layanan'];
$atas_nama = $_POST['atas_nama'];
$nomor = $_POST['nomor'];

mysqli_query($conn, "INSERT INTO `toko_minuman`.`metode_pembayaran` (
  `layanan`,
  `nomor`,
  `atas_nama`
)
VALUES
  (
    '$layanan',
    '$nomor',
    '$atas_nama'
  );
");

echo "<script>alert('Berhasil Tambah Metode Pembayaran');window.location.href='../m_metode_pembayaran.php'</script>";
