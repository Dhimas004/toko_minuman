<?php
include 'header.php';
$kd = mysqli_real_escape_string($conn, $_GET['kode_cs']);
$cs = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '$kd'");
$rows = mysqli_fetch_assoc($cs);
?>

<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container" style="padding-bottom: 200px">
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Checkout</b></h2>
	<div class="row">
		<div class="col-md-6">
			<h4>Daftar Pesanan</h4>
			<table class="table table-stripped">
				<tr>
					<th class="text-center">No</th>
					<th class="text-center">Nama</th>
					<th class="text-center">Rasa</th>
					<th class="text-center">Ukuran</th>
					<th class="text-center">Harga</th>
					<th class="text-center">Qty</th>
					<th class="text-center">Sub Total</th>
				</tr>
				<?php
				$result = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kd'");
				$no = 1;
				$hasil = 0;
				while ($row = mysqli_fetch_assoc($result)) {
					$id_varian_rasa_produk = $row['id_varian_rasa_produk'];
					$id_varian_ukuran_produk = $row['id_varian_ukuran_produk'];

					$rasa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM varian_rasa_produk WHERE id = '$id_varian_rasa_produk'"))['rasa'];
					$rasa = ($rasa == '' ? '-' : $rasa);
					$ukuran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM varian_ukuran_produk WHERE id = '$id_varian_ukuran_produk'"))['ukuran'];
					$ukuran = ($ukuran == '' ? 'Medium' : $ukuran);
				?>
					<tr>
						<td align="center"><?= $no; ?></td>
						<td><?= $row['nama_produk']; ?></td>
						<td><?= $rasa ?></td>
						<td><?= $ukuran ?></td>
						<td align="right">Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></td>
						<td align="center"><?= $row['qty']; ?></td>
						<td align="right">Rp. <?= number_format($row['harga'] * $row['qty'], 0, ',', '.');  ?></td>
					</tr>
				<?php
					$total = $row['harga'] * $row['qty'];
					$hasil += $total;
					$no++;
				}
				?>
				<tr>
					<td colspan="7" style="text-align: right; font-weight: bold;">Grandtotal : Rp. <?= number_format($hasil, 0, ',', '.'); ?></td>
				</tr>
			</table>
		</div>
	</div>


	<div class="row">
		<div class="col-md-6 bg-success">
			<h5>Pastikan Pesanan Anda Sudah Benar</h5>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6 bg-warning">
			<h5>isi Form dibawah ini </h5>
		</div>
	</div>
	<br>
	<form action="proses/order.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="kode_cs" value="<?= $kd; ?>">
		<div class="form-group">
			<label for="nama">Nama</label>
			<input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" style="width: 557px;" value="<?= $rows['nama']; ?>" readonly>
		</div>
		<div class="form-group">
			<label for="tanggal_pengambilan">Tanggal Pengambilan/Pengiriman</label>
			<input type="text" class="form-control datepicker" id="tanggal_pengambilan" name="tanggal_pengambilan" style="width: 557px;" required>
			<div class="text-danger" id="info-pengambilan" style="display: none;">
				<small style="font-weight: bold;">
					Pemesanan paling sedikit 1 hari sebelum hari H
				</small>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="metode_pembayaran">Metode Pembayaran</label>
					<select class="form-control" id="metode_pembayaran" name="metode_pembayaran" style="width: 557px;" required>
						<option value="">-- Pilih --</option>
						<option value="tunai">Tunai</option>
						<option value="non_tunai">Non Tunai</option>
					</select>
				</div>
				<ul style="padding: 0; margin-left: 3%; display: none;" id="bank">
					<li>BRI (0838-01-046709-53-2) a/n Suparjo</li>
				</ul>
			</div>
			<div class="col-md-6">
				<div class="form-group" id="form-bukti-pembayaran">
					<label for="bukti_pembayaran">Bukti Pembayaran <small>(Foto/Screenshot)</small></label>
					<input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" style="width: 557px;" accept="image/*">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="provinsi">Provinsi</label>
					<!-- <input type="text" class="form-control" id="provinsi" placeholder="Provinsi" name="prov" required> -->
					<select name="provinsi" id="provinsi" class="form-control select2" required>
						<option value="">-- Pilih --</option>
						<?php
						$list_provinsi = mysqli_query($conn, "SELECT * FROM provinsi ORDER BY name");
						while ($data = mysqli_fetch_assoc($list_provinsi)) {
							echo "<option data-id='$data[id]'>$data[name]</option>";
						}
						?>
					</select>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="kota">Kota</label>
					<!-- <input type="text" class="form-control" id="kota" placeholder="Kota" name="kota" required> -->
					<select name="kota" id="kota" class="form-control select2" required>
						<option value="">-- Pilih --</option>
						<?php
						$list_kota = mysqli_query($conn, "SELECT * FROM kota ORDER BY name");
						while ($data = mysqli_fetch_assoc($list_kota)) {
							echo "<option>$data[name]</option>";
						}
						?>
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<input type="text" class="form-control" id="alamat" placeholder="Alamat" name="almt" required>
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="kode_pos">Kode Pos</label>
					<input type="text" class="form-control" id="kode_pos" placeholder="Kode Pos" name="kopos" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="catatan_khusus">Catatan Khusus Pesanan <small>(Opsional)</small></label>
					<textarea class="form-control" id="catatan_khusus" name="catatan_khusus" rows="2"></textarea>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success" id="btn-submit"><i class="glyphicon glyphicon-shopping-cart"></i> Order Sekarang</button>
		<a href="keranjang.php" class="btn btn-primary">Kembali</a>
	</form>
</div>
<script>
	$(document).ready(function() {
		$('.select2').select2();
		let current_date = new Date();
		$(".datepicker").datepicker({
			dateFormat: "yy-mm-dd"
		});

		$('#tanggal_pengambilan').change(function() {
			const date1 = current_date;
			const date2 = new Date($(this).val() + "T00:00:00");

			if (dateDiffInMinutes(date1, date2) < 720) {
				toastr.error('Pengambilan/Pengiriman paling sedikit 1 hari sebelum hari H');
				$('#info-pengambilan').css('display', 'block');
				$(this).val('');
				$('#btn-submit').attr('disabled', 'disabled');
			} else {
				$('#info-pengambilan').css('display', 'none');
				$('#btn-submit').removeAttr('disabled');
			}
		})

		$('#metode_pembayaran').change(function() {
			let metode_pembayaran = $(this).val();
			if (metode_pembayaran == 'tunai') {
				$('#form-bukti-pembayaran').css('display', 'none');
				$('#bank').css('display', 'none');
				$('#bukti_pembayaran').removeAttr('required');
			} else if (metode_pembayaran == 'non_tunai') {
				$('#form-bukti-pembayaran').css('display', 'block');
				$('#bank').css('display', 'block');
				$('#bukti_pembayaran').attr('required', 'required');
			}
		})

		$('#metode_pembayaran').trigger('change');

		$('#provinsi').change(function() {
			let id = $(this).find('option:selected').attr('data-id');
			$.get('ajax_get_kota.php', {
				id
			}, function(res) {
				$('#kota').html("<option value=''>-- Pilih --</option>" + res);
				$('#kota').select2();
			})
		})

	})

	function dateDiffInMinutes(date1, date2) {
		// Ensure the dates are valid Date objects
		const d1 = new Date(date1);
		const d2 = new Date(date2);

		// Calculate the difference in milliseconds
		const diffInMs = d2 - d1;

		// Convert the difference from milliseconds to minutes
		const diffInMinutes = diffInMs / (1000 * 60);

		return diffInMinutes;
	}
</script>
<?php
include 'footer.php';
?>