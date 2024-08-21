<?php
include '../../koneksi/koneksi.php';
$kode = $_POST['kode'];
$rasa = $_POST['rasa'];

mysqli_query($conn, "INSERT INTO `varian_rasa_produk` (`kode_produk`, `rasa`)
VALUES
  ('$kode', '$rasa');
");

echo "
		<script>
		alert('RASA BERHASIL DITAMBAHKAN');
		window.location = '../tambah_rasa.php?kode_produk=$kode';
		</script>
		";
