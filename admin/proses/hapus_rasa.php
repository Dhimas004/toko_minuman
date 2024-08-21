<?php
include '../../koneksi/koneksi.php';
$id = $_GET['hapus'];
$kode_produk = $_GET['kode_produk'];

mysqli_query($conn, "DELETE FROM varian_rasa_produk WHERE id = '$id'");

echo "
		<script>
		alert('BERHASIL HAPUS RASA');
		window.location = '../tambah_rasa.php?kode_produk=$kode_produk';
		</script>
		";
