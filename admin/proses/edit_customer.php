<?php
include '../../koneksi/koneksi.php';
$kode_customer = $_POST['kode_customer'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$telp = $_POST['telp'];
$username = $_POST['username'];
$password_baru = $_POST['password_baru'];

if ($password_baru == '') {
	mysqli_query($conn, "UPDATE
		`customer`
		SET
		`nama` = '$nama',
		`email` = '$email',
		`username` = '$username',
		`telp` = '$telp'
		WHERE `kode_customer` = '$kode_customer';
	");
} else {
	$password = password_hash(htmlspecialchars($password_baru), PASSWORD_DEFAULT);
	mysqli_query($conn, "UPDATE
		`customer`
		SET
		`nama` = '$nama',
		`email` = '$email',
		`username` = '$username',
		`telp` = '$telp',
		`password` = '$password'
		WHERE `kode_customer` = '$kode_customer';
	");
}
echo "
		<script>
		alert('CUSTOMER BERHASIL DIEDIT');
		window.location = '../m_customer.php';
		</script>
		";
