<?php
include '../../koneksi/koneksi.php';
$id = $_POST['id'];
$layanan = $_POST['layanan'];
$atas_nama = $_POST['atas_nama'];
$nomor = $_POST['nomor'];

mysqli_query($conn, "UPDATE
 `metode_pembayaran`
SET
  `layanan` = '$layanan',
  `nomor` = '$nomor',
  `atas_nama` = '$atas_nama'
WHERE `id` = '$id';
");

echo "<script>alert('Berhasil Ubah Metode Pembayaran');window.location.href='../m_metode_pembayaran.php'</script>";
