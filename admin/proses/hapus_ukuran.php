<?php
include '../../koneksi/koneksi.php';
$id = $_GET['hapus'];
$kode_produk = $_GET['kode_produk'];

mysqli_query($conn, "DELETE FROM varian_ukuran_produk WHERE id = '$id'");

echo "
		<script>
		alert('BERHASIL HAPUS UKURAN');
		window.location = '../tambah_ukuran.php?kode_produk=$kode_produk';
		</script>
		";
