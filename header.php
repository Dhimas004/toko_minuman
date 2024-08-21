<?php
session_start();
include 'koneksi/koneksi.php';
if (isset($_SESSION['kd_cs'])) {
	$kode_cs = $_SESSION['kd_cs'];
}

function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Toko Minuman</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<!-- Jquery UI (Datepicker) -->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>


</head>

<body>
	<div class="container-fluid">
		<div class="row top">
			<center>
				<div class="col-md-4" style="padding: 3px;">
					<span> <i class="glyphicon glyphicon-earphone"></i> <a href="http://wa.me/6281399317984" target="_blank">+62 813-9931-7984</a></span>
				</div>
				<div class="col-md-4" style="padding: 3px;">
					<span>Toko Minuman Indonesia</span>
				</div>
			</center>
		</div>
	</div>

	<nav class="navbar navbar-default" style="padding: 5px;">
		<div class="container">

			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php" style="color: #ff8680"><b>TOKO MINUMAN</b></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php" id="nav-home">Home</a></li>
					<li><a href="produk.php" id="nav-produk">Produk</a></li>
					<li><a href="about.php" id="nav-tentang-kami">Tentang Kami</a></li>
					<?php
					if (isset($_SESSION['kd_cs'])) {
						$kode_cs = $_SESSION['kd_cs'];
						$cek = mysqli_query($conn, "SELECT kode_produk from keranjang where kode_customer = '$kode_cs' ");
						$value = mysqli_num_rows($cek);

					?>
						<li><a href="keranjang.php" id="nav-keranjang">Keranjang</a></li>
						<li><a href="pemesanan.php" id="nav-pemesanan">Pemesanan</a></li>

					<?php
					} else {
						echo "
						<li><a href='keranjang.php' id='nav-keranjang'>Keranjang</a></li>
						<li><a href='pemesanan.php' id='nav-pemesanan'>Pemesanan</a></li>

						";
					}
					if (!isset($_SESSION['user'])) {
					?>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Akun <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="user_login.php">Login</a></li>
								<li><a href="register.php">Register</a></li>
							</ul>
						</li>
					<?php
					} else {
					?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?= $_SESSION['user']; ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="proses/logout.php">Log Out</a></li>
							</ul>
						</li>

					<?php
					}
					?>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>