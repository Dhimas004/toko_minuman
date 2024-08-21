<?php
include '../../koneksi/koneksi.php';
$inv = $_GET['inv'];
$page = $_GET['page'];
$alasan_penolakan = $_GET['alasan_penolakan'];
$tolak = mysqli_query($conn, "UPDATE `order` set tolak = '1', alasan_penolakan = '$alasan_penolakan' WHERE invoice = '$inv'");


if ($tolak) {
	if ($page == 'order_tunai') {
		echo "
		<script>
		alert('PESANAN DITOLAK');
		window.location = '../order_tunai.php';
		</script>
		";
	} else {
		echo "
		<script>
		alert('PESANAN DITOLAK');
		window.location = '../order.php';
		</script>
		";
	}
}
