<?php
include 'header.php';
$date = date('Y-m-d');

if (isset($_POST['submit'])) {
	$date1 =  date_format(date_create($_POST['date1']), 'Y-m-d');
	$date2 = date_format(date_create($_POST['date2']), 'Y-m-d');
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
	<h2 style=" width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Laporan Pembatalan Pesanan</b></h2>
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
			<form action="exp_pembatalan.php" method="POST">
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
			<th class="text-center">tanggal</th>
			<th class="text-center">Qty</th>
		</tr>
		<?php
		if (isset($_POST['submit'])) {
			$result = mysqli_query($conn, "SELECT * FROM `order` WHERE tolak = 1 and tanggal between '$date1' and '$date2' ORDER BY invoice DESC");
			$no = 1;
			$total = 0;
			while ($row = mysqli_fetch_assoc($result)) {
		?>
				<tr>
					<td align="center"><?= $no; ?></td>
					<td><?= $row['nama_produk']; ?></td>
					<td align="center"><?= tgl_indo($row['tanggal']); ?></td>
					<td align="center"><?= $row['qty']; ?></td>
				</tr>
			<?php
				$total += $row['qty'];
				$no++;
			}

			?>
			<tr>
				<td colspan="4" class="text-right"><b>Jumlah dibatalkan : <?= $total; ?></b></td>
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