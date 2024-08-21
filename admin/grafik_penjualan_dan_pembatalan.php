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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray; padding-bottom: 5px;"><b>Grafik Penjualan dan Pembatalan</b></h2>
	<div class="row print">
		<div class="col-md-9">


		</div>
	</div>
	<br>
	<br>
	<center>
		<div style="width: 80%; position: relative;">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" style="position: absolute;">
				<table>
					<tr>
						<td>
							<?php
							$bulan = $_GET['bulan'];
							if ($bulan == '') $bulan = (int) date('m');
							?>
							<select name="bulan" id="bulan" class="form-control">
								<option value="">-- Pilih --</option>
								<option value="1" <?= ($bulan == '1' ? 'selected' : '') ?>>Januari</option>
								<option value="2" <?= ($bulan == '2' ? 'selected' : '') ?>>Februari</option>
								<option value="3" <?= ($bulan == '3' ? 'selected' : '') ?>>Maret</option>
								<option value="4" <?= ($bulan == '4' ? 'selected' : '') ?>>April</option>
								<option value="5" <?= ($bulan == '5' ? 'selected' : '') ?>>Mei</option>
								<option value="6" <?= ($bulan == '6' ? 'selected' : '') ?>>Juni</option>
								<option value="7" <?= ($bulan == '7' ? 'selected' : '') ?>>Juli</option>
								<option value="8" <?= ($bulan == '8' ? 'selected' : '') ?>>Agustus</option>
								<option value="9" <?= ($bulan == '9' ? 'selected' : '') ?>>September</option>
								<option value="10" <?= ($bulan == '10' ? 'selected' : '') ?>>Oktober</option>
								<option value="11" <?= ($bulan == '11' ? 'selected' : '') ?>>November</option>
								<option value="12" <?= ($bulan == '12' ? 'selected' : '') ?>>Desember</option>
							</select>
						</td>
						<td>&nbsp;</td>
						<td>
							<?php
							$tahun = $_GET['tahun'];
							if ($tahun == '') $tahun = date('Y');
							?>
							<select name="tahun" id="tahun" class="form-control">
								<option value="">-- Pilih --</option>
								<?php
								for ($i = date('Y') + 5; $i >= 2020; $i--) {
									echo "<option " . ($i == $tahun ? 'selected' : '') . ">$i</option>";
								}
								?>
							</select>
						</td>
						<td>&nbsp;</td>
						<td><input type="submit" class="btn btn-primary" value="Tampilkan"></td>
					</tr>
				</table>
			</form>
			<br />
			<br />
			<br />
			<center>
				<h3><b>DIAGRAM PENJUALAN</b></h3>
			</center>
			<div style="width: 400px;">
				<canvas id="myChart"></canvas>
			</div>
			<br />
			<br />
			<center>
				<h3><b>DIAGRAM PEMBATALAN</b></h3>
			</center>
			<div style="width: 400px;">
				<canvas id="myChart2"></canvas>
			</div>
		</div>
	</center>
</div>
<?php
$array_product = [];
$array_quantity = [];
$total_quantity = 0;
$list_product = mysqli_query($conn, "SELECT * FROM produk ORDER BY nama");
while ($data = mysqli_fetch_assoc($list_product)) {
	$array_product[] = $data['nama'];
	$kode_produk = $data['kode_produk'];
	$qty = 0;
	$list_order = mysqli_query($conn, "SELECT * FROM `order` WHERE kode_produk = '$kode_produk' AND MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' ");
	while ($data2 = mysqli_fetch_assoc($list_order)) {
		if ($data2['terima'] == '2') {
			$qty += $data2['qty'];
			$total_quantity += $data2['qty'];
		} else if ($data2['tolak'] == '1') {
			$alasan_penolakan = $data2['alasan_penolakan'];
			if ($alasan_penolakan == 'dll') $alasan_penolakan = $data2['alasan_dll'];
			$array_penolakan[$alasan_penolakan] += 1;
		}
	}
	$array_quantity[] = $qty;
}
$array_penolakan = [];
$array_penolakan2 = [];
$array_quantity_penolakan2 = [];
$list_penolakan = mysqli_query($conn, "SELECT * FROM `order` WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun' AND tolak = '1' GROUP BY invoice");
while ($data = mysqli_fetch_assoc($list_penolakan)) {
	$alasan_penolakan = $data['alasan_penolakan'];
	// if ($alasan_penolakan == 'dll') $alasan_penolakan = $data['alasan_dll'];
	$array_penolakan[$alasan_penolakan] += 1;
}

foreach ($array_penolakan as $penolakan => $total) {
	$array_penolakan2[] = $penolakan;
	$array_quantity_penolakan2[] = $total;
}

$json_product = json_encode($array_product);
$json_quantity = json_encode($array_quantity);
$json_penolakan2 = json_encode($array_penolakan2);
$json_quantity_penolakan2 = json_encode($array_quantity_penolakan2);

?>
<br>
<br>
<br>
<br>
<br>
<script>
	$(document).ready(function() {
		let product = JSON.parse(`<?= $json_product ?>`);
		let quantity = JSON.parse(`<?= $json_quantity ?>`);
		let penolakan2 = JSON.parse(`<?= $json_penolakan2 ?>`);
		let quantity_penolakan2 = JSON.parse(`<?= $json_quantity_penolakan2 ?>`);
		var ctx = document.getElementById('myChart').getContext('2d');
		var myPieChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: product,
				datasets: [{
					label: 'Quantity',
					data: quantity,
					backgroundColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				plugins: {
					datalabels: {
						color: '#000',
						display: function(context) {
							// Display the label only if the value is not 0
							return context.dataset.data[context.dataIndex] !== 0;
						},
						formatter: function(value, context) {
							if (value === 0) {
								return ''; // Return an empty string if the value is 0
							}
							var sum = context.chart._metasets[0].total;
							var percentage = ((value / sum) * 100).toFixed(2) + '%';
							return `${percentage}`; // Show only percentage with `%` symbol
						},
						anchor: 'center',
						align: 'center',
						font: {
							weight: 'bold',
							size: 16
						},
						offset: 0
					},
					legend: {
						position: 'top'
					}
				}
			},
			plugins: [ChartDataLabels]
		});

		var ctx2 = document.getElementById('myChart2').getContext('2d');
		var myPieChart2 = new Chart(ctx2, {
			type: 'pie',
			data: {
				labels: penolakan2,
				datasets: [{
					label: 'Total Invoice',
					data: quantity_penolakan2,
					backgroundColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				responsive: true,
				plugins: {
					datalabels: {
						color: '#000',
						display: function(context) {
							// Display the label only if the value is not 0
							return context.dataset.data[context.dataIndex] !== 0;
						},
						anchor: 'center',
						align: 'center',
						font: {
							weight: 'bold',
							size: 16
						},
						offset: 0
					},
					legend: {
						position: 'top'
					}
				}
			},
			plugins: [ChartDataLabels]
		});
	})
</script>


<?php
include 'footer.php';
?>