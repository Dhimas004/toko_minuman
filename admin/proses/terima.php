<?php
include '../../koneksi/koneksi.php';
$inv = $_GET['inv'];
$page = $_GET['page'];
mysqli_query($conn, "UPDATE `order` SET terima = '1', status = '0' WHERE invoice = '$inv'");

if ($page == 'order_tunai') {
	echo "
				<script>
				alert('PESANAN BERHASIL DITERIMA');
				window.location = '../order_tunai.php';
				</script>
				";
} else {
	echo "
				<script>
				alert('PESANAN BERHASIL DITERIMA');
				window.location = '../order.php';
				</script>
				";
}
