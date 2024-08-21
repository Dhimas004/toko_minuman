<?php
include '../../koneksi/koneksi.php';
$kode = $_POST['kode'];
$ukuran = $_POST['ukuran'];
$harga = $_POST['harga'];

mysqli_query($conn, "INSERT INTO `varian_ukuran_produk` (
  `kode_produk`,
  `ukuran`,
  `harga`
)
VALUES
  (
    '$kode',
    '$ukuran',
    '$harga'
  );

");

echo "<script>
		alert('UKURAN BERHASIL DITAMBAHKAN');
		window.location = '../tambah_ukuran.php?kode_produk=$kode';
		</script>
		";
