<?php
include 'header.php';
$date = date('Y-m-d');

if (isset($_POST['submit'])) {
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
}

if ($date1 == '') {
	$date1 = $date;
}

if ($date2 == '') {
	$date2 = $date;
}
?>
<style type="text/css">
	@media print {
		.print {
			display: none;
		}
	}
</style>
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Laporan Penjualan</b></h2>
	<div class="row print">
		<div class="col-md-9">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<table>
					<tr>
						<td><input type="text" name="date1" class="form-control datepicker" value="<?= $date1; ?>"></td>
						<td>&nbsp; - &nbsp;</td>
						<td><input type="text" name="date2" class="form-control datepicker" value="<?= $date2; ?>"></td>
						<td> &nbsp;</td>
						<td><input type="submit" name="submit" class="btn btn-primary" value="Tampilkan"></td>
					</tr>
				</table>
			</form>

		</div>
		<div class="col-md-3">
			<form action="exp_penjualan.php" method="POST">
				<table>
					<tr>
						<td><input type="hidden" name="date1" class="form-control" value="<?= $date1; ?>"></td>
						<td><input type="hidden" name="date2" class="form-control" value="<?= $date2; ?>"></td>
						<td><button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-save-file"></i> Export to Excel</button></td>
						<td> &nbsp;</td>
						<td><a href="" onclick="window.print()" class="btn btn-default"><i class="glyphicon glyphicon-print"></i> Cetak</a></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<br>
	<br>
	<table class="table table-striped table-bordered">
		<tr>
			<th class="text-center" style="width: 5%;">No</th>
			<th class="text-center">Nama Produk</th>
			<th class="text-center">Tanggal</th>
			<th class="text-center">Qty</th>
		</tr>
		<?php
		if (isset($_POST['submit'])) {
			$result = mysqli_query($conn, "SELECT * FROM `order` WHERE terima IN ('1','2') AND tanggal BETWEEN '$date1' AND '$date2' GROUP BY tanggal,kode_produk");
			$no = 1;
			$total = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$tanggal = $row['tanggal'];
				$kode_produk = $row['kode_produk'];
				$total_qty = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(qty) as total_qty FROM `order` WHERE terima IN ('1','2') AND tanggal = '$tanggal' AND kode_produk = '$kode_produk'"))['total_qty'];
		?>
				<tr>
					<td align="center"><?= $no; ?></td>
					<td><?= $row['nama_produk']; ?></td>
					<td align="center"><?= tgl_indo($row['tanggal']); ?></td>
					<td align="center"><?= $total_qty; ?></td>
				</tr>
			<?php
				$total += $total_qty;
				$no++;
			}

			?>
			<tr>
				<td colspan="4" class="text-right"><b>Total Jumlah terjual : <?= $total; ?></b></td>
			</tr>
		<?php 	} ?>
	</table>
</div>

<br>
<br>
<br>
<br>
<br>


<?php
include 'footer.php';
?>