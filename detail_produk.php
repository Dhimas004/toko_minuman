<?php
include 'header.php';
$kode = mysqli_real_escape_string($conn, $_GET['produk']);
$result = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$kode'");
$row = mysqli_fetch_assoc($result);
$harga = $row['harga'];
$minimal_pemesanan = $row['minimal_pemesanan'];

?>
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Detail produk</b></h2>

	<div class="row">
		<div class="col-md-4">
			<div style="display: flex; align-items: center; justify-content: center;">
				<center>
					<img src="image/produk/<?= $row['image']; ?>" style="width: 300px; height: 300px; border-radius: 5px;">
				</center>
			</div>
		</div>

		<div class="col-md-8">
			<form action="proses/add.php" method="GET">
				<input type="hidden" name="kd_cs" value="<?= $kode_cs; ?>">
				<input type="hidden" name="produk" value="<?= $kode;  ?>">
				<input type="hidden" name="hal" value="2">
				<table class="table table-striped">
					<tbody>
						<tr>
							<td><b>Nama</b></td>
							<td><?= $row['nama']; ?></td>
						</tr>
						<tr>
							<td><b>Harga</b></td>
							<td>Rp. <span id="harga"><?= number_format($harga, 0, ',', '.'); ?></span></td>
						</tr>
						<tr>
							<td><b>Deskripsi</b></td>
							<td><?= $row['deskripsi'];  ?></td>
						</tr>
						<?php
						$varian_rasa = mysqli_query($conn, "SELECT * FROM varian_rasa_produk WHERE kode_produk = '$kode'");
						?>
						<tr style="display: <?= (mysqli_num_rows($varian_rasa) == 0  ? 'none' : '') ?>">
							<td><b>Rasa</b></td>
							<td>
								<select class=" form-control" id="id_varian_rasa_produk" name="id_varian_rasa_produk" style="width: 155px;">
									<option value="">-- Pilih --</option>
									<?php

									while ($row = mysqli_fetch_assoc($varian_rasa)) {
										echo "<option value='$row[id]'>$row[rasa]</option>";
									}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td><b>Ukuran</b></td>
							<td>
								<select class="form-control" id="id_varian_ukuran_produk" name="id_varian_ukuran_produk" style="width: 155px;">
									<option value="" data-harga="<?= $harga ?>">Medium</option>
									<?php
									$varian_ukuran = mysqli_query($conn, "SELECT * FROM varian_ukuran_produk WHERE kode_produk = '$kode'");
									while ($row = mysqli_fetch_assoc($varian_ukuran)) {
										echo "<option value='$row[id]' data-harga='$row[harga]'>$row[ukuran]</option>";
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td><b>Jumlah</b></td>
							<td>
								<input class="form-control qty" type="number" min="<?= $minimal_pemesanan ?>" name="jml" value="<?= $minimal_pemesanan ?>" style="width: 155px;">
							</td>
						</tr>
					</tbody>
				</table>
				<?php
				if (isset($_SESSION['user'])) {
				?>
					<button type="submit" class="btn btn-success">Booking</button>
				<?php
				} else {

				?>
					<a href="keranjang.php" class="btn btn-success">Booking</a>
				<?php
				}
				?>
				<a href="index.php" class="btn btn-primary">Kembali</a>
		</div>
		</form>
	</div>
	<?php
	$maksimal_pemesanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM maksimal_pemesanan WHERE id = '1'"))['maksimal_pemesanan'];
	$pemesanan_hari_ini = 0;
	$tanggal_sekarang = date('Y-m-d');
	$list_pemesanan_hari_ini = mysqli_query($conn, "SELECT * FROM `order` WHERE tanggal = '$tanggal_sekarang'");
	while ($data = mysqli_fetch_assoc($list_pemesanan_hari_ini)) {
		$pemesanan_hari_ini += $data['qty'];
	}
	$maksimal_pemesanan -= $pemesanan_hari_ini;
	?>
	<input type="hidden" id="maksimal_pemesanan" value="<?= $maksimal_pemesanan ?>">
	<script>
		$(document).ready(function() {
			$('#id_varian_ukuran_produk').change(function() {
				var harga = $(this).find(':selected').data('harga');
				$('#harga').text(formatRupiah(harga));
			})

			$('.qty').change(function() {
				let maksimal_pemesanan = $('#maksimal_pemesanan').val();
				let qty = $(this).val();
				if (qty > parseInt(maksimal_pemesanan)) {
					alert('Pemesanan Hari Ini Sudah Mencapai Batas Maksimal Pemesanan');
					$(this).val(qty - 1);
					return false;
				}
			})
		})

		function formatRupiah(amount) {
			const formatted = new Intl.NumberFormat('id-ID', {
				style: 'currency',
				currency: 'IDR',
				minimumFractionDigits: 0, // You can adjust this based on your needs
				maximumFractionDigits: 0 // You can adjust this based on your needs
			}).format(amount);

			// Remove the "Rp" prefix
			return formatted.replace(/\u00A0Rp|Rp\u00A0|Rp/g, '').trim();
		}
	</script>
</div>
<br>
<br>

<?php
include 'footer.php';
?>