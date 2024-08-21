<?php
include '../../koneksi/koneksi.php';

$kode = $_POST['kode'];
$nm_produk = $_POST['nama'];
$katalog = $_POST['katalog'];
$harga = $_POST['harga'];
$desk = $_POST['desk'];
$minimal_pemesanan = $_POST['minimal_pemesanan'];

$nama_gambar = $_FILES['files']['name'];
$size_gambar = $_FILES['files']['size'];
$tmp_file = $_FILES['files']['tmp_name'];
$eror = $_FILES['files']['error'];
$type = $_FILES['files']['type'];

// BOM
if ($eror === 4) {
	echo "
	<script>
	alert('TIDAK ADA GAMBAR YANG DIPILIH');
	window.location = '../tm_produk.php';
	</script>
	";
	die;
}

$ekstensiGambar = array('jpg', 'jpeg', 'png');
$ekstensiGambarValid = explode(".", $nama_gambar);
$ekstensiGambarValid = strtolower(end($ekstensiGambarValid));

if (!in_array($ekstensiGambarValid, $ekstensiGambar)) {
	echo "
	<script>
	alert('EKSTENSI GAMBAR HARUS JPG, JPEG, PNG');
	window.location = '../tm_produk.php';
	</script>
	";
	die;
}

if ($size_gambar > 1000000) {
	echo "
	<script>
	alert('UKURAN GAMBAR TERLALU BESAR');
	window.location = '../tm_produk.php';
	</script>
	";
	die;
}

$namaGambarBaru = uniqid();
$namaGambarBaru .= ".";
$namaGambarBaru .= $ekstensiGambarValid;

if (move_uploaded_file($tmp_file, "../../image/produk/" . $namaGambarBaru)) {

	$result = mysqli_query($conn, "INSERT INTO produk (kode_produk,katalog,nama,image,deskripsi,harga,minimal_pemesanan) VALUES('$kode','$katalog','$nm_produk','$namaGambarBaru','$desk','$harga','$minimal_pemesanan')");

	if ($result) {
		echo "
		<script>
		alert('PRODUK BERHASIL DITAMBAHKAN');
		window.location = '../m_produk.php';
		</script>
		";
	}
}
