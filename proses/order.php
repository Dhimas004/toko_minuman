<?php
include '../koneksi/koneksi.php';
$kd_cs = $_POST['kode_cs'];
$nama = $_POST['nama'];
$prov = $_POST['prov'];
$kota = $_POST['kota'];
$alamat = $_POST['almt'];
$kopos = $_POST['kopos'];
$tanggal = date('Y-m-d');
$metode_pembayaran = $_POST['metode_pembayaran'];
$tanggal_pengambilan = $_POST['tanggal_pengambilan'];
$catatan_khusus = $_POST['catatan_khusus'];
$bukti_pembayaran = $_FILES['bukti_pembayaran'];
$new_bukti_pembayaran = uniqid() . "." . end(explode('.', $bukti_pembayaran['name']));

move_uploaded_file($bukti_pembayaran['tmp_name'], "../image/bukti_pembayaran/$new_bukti_pembayaran");


$kode = mysqli_query($conn, "SELECT invoice from `order` order by invoice desc");
$data = mysqli_fetch_assoc($kode);
$num = substr($data['invoice'], 3, 4);
$add = (int) $num + 1;
if (strlen($add) == 1) {
	$format = "INV000" . $add;
} else if (strlen($add) == 2) {
	$format = "INV00" . $add;
} else if (strlen($add) == 3) {
	$format = "INV0" . $add;
} else {
	$format = "INV" . $add;
}

$keranjang = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kd_cs'");
while ($row = mysqli_fetch_assoc($keranjang)) {
	$id_varian_rasa_produk = $row['id_varian_rasa_produk'];
	$id_varian_ukuran_produk = $row['id_varian_ukuran_produk'];
	$kd_produk = $row['kode_produk'];
	$nama_produk = $row['nama_produk'];
	$qty = $row['qty'];
	$harga = $row['harga'];
	$status = "Pesanan Baru";

	// if ($metode_pembayaran == 'non_tunai') {
	$order2 = mysqli_query($conn, "INSERT INTO `order` VALUES('','$id_varian_rasa_produk','$id_varian_ukuran_produk','$format','$kd_cs','$kd_produk','$nama_produk','$qty','$harga','$status','$metode_pembayaran','$new_bukti_pembayaran','$tanggal','$tanggal_pengambilan','$prov','$kota','$alamat','$kopos','0','0','','','0','$catatan_khusus')");
	// } else {
	// 	$order2 = mysqli_query($conn, "INSERT INTO `order` VALUES('','$id_varian_rasa_produk','$id_varian_ukuran_produk','$format','$kd_cs','$kd_produk','$nama_produk','$qty','$harga','$status','$metode_pembayaran','$new_bukti_pembayaran','$tanggal','$tanggal_pengambilan','$prov','$kota','$alamat','$kopos','1','','','0','0','$catatan_khusus')");
	// }
}
$del_keranjang = mysqli_query($conn, "DELETE FROM keranjang WHERE kode_customer = '$kd_cs'");

if ($del_keranjang) {
	header("location:../selesai.php");
}
