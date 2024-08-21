<?php
include '../../koneksi/koneksi.php';
$inv = $_GET['inv'];
mysqli_query($conn, "UPDATE `order` SET terima = '2', status = '0' WHERE invoice = '$inv'");
if ($_GET['page'] == 'order_tunai') {
	echo "
	<script>
	alert('PESANAN SELESAI');
	window.location = '../order_tunai.php';
	</script>
	";
} else {
	echo "
				<script>
				alert('PESANAN SELESAI');
				window.location = '../order.php';
				</script>
				";
}
