<?php
include 'header.php';
$kode = mysqli_real_escape_string($conn, $_GET['produk']);
$result = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$kode'");
$row = mysqli_fetch_assoc($result);
$harga = $row['harga'];
$minimal_pemesanan = $row['minimal_pemesanan'];
$custom_rasa = $row['custom_rasa'];

?>
<div class="container">
	<input type="hidden" id="kode_customer" value="<?= $_SESSION['kd_cs'] ?>">
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
				<input type="hidden" name="produk" id="produk" value="<?= $kode;  ?>">
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
								<div style="display: inline-block;">
									<select class=" form-control" id="id_varian_rasa_produk" name="id_varian_rasa_produk" style="width: 155px;">
										<option value="">-- Pilih --</option>
										<?php

										while ($row = mysqli_fetch_assoc($varian_rasa)) {
											echo "<option value='$row[id]'>$row[rasa]</option>";
										}
										?>
									</select>
								</div>

								<?php
								if ($custom_rasa == '1') {
								?>
									<a href="#" style="display: inline-block; margin-left: 10px;" data-toggle="modal" data-target="#modal-custom-rasa">Custom Rasa</a>
								<?php
								}
								?>

								<!-- Modal -->
								<div class="modal fade" id="modal-custom-rasa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Custom Rasa</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<table class="table table-bordered table-hover">
													<thead>
														<tr class="text-center">
															<th>Rasa</th>
															<th>Quantity</th>
														</tr>
													</thead>
													<?php
													$list_varian_rasa = mysqli_query($conn, "SELECT id,rasa FROM varian_rasa_produk WHERE kode_produk = '$_GET[produk]'");
													while ($row = mysqli_fetch_assoc($list_varian_rasa)) {
													?>
														<tr>
															<td><?= $row['rasa'] ?></td>
															<td><input type="number" class="form-control custom_rasa" data-id="<?= $row['id'] ?>" value="0"></td>
														</tr>
													<?php
													}
													?>
												</table>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												<button type="button" class="btn btn-success" id="btn-simpan-custom-rasa" data-dismiss="modal">Simpan Rasa</button>
											</div>
										</div>
									</div>
								</div>
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
								<input class="form-control qty" id="qty" type="number" min="<?= $minimal_pemesanan ?>" name="jml" value="<?= $minimal_pemesanan ?>" style="width: 155px;">
							</td>
						</tr>
					</tbody>
				</table>
				<?php
				if (isset($_SESSION['user'])) {
					$qty_keranjang = 0;
					$list_keranjang = mysqli_query($conn, "SELECT * FROM keranjang");
					while ($data = mysqli_fetch_assoc($list_keranjang)) {
						$qty_keranjang += $data['qty'];
					}
					$maksimal_pemesanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM maksimal_pemesanan WHERE id = '1'"))['maksimal_pemesanan'];
					if ($qty_keranjang >= $maksimal_pemesanan) {
				?>
						<button type="button" class="btn btn-success disabled">Full Booking</button>
						<?php
					} else {
						if ($qty_keranjang + $minimal_pemesanan > $maksimal_pemesanan) {
						?>
							<button type="button" class="btn btn-success disabled">Full Booking</button>
						<?php
						} else {
						?>
							<button type="submit" class="btn btn-success">Booking</button>
					<?php
						}
					}
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
	$maksimal_pemesanan -= $qty_keranjang;
	?>
	<input type="hidden" id="maksimal_pemesanan" value="<?= $maksimal_pemesanan ?>">
	<script>
		$(document).ready(function() {
			$('#id_varian_ukuran_produk').change(function() {
				var harga = $(this).find(':selected').data('harga');
				$('#harga').text(formatRupiah(harga));
			})

			$('#id_varian_rasa_produk').change(function() {
				changeCustomRasa();
			})

			$('.qty').change(function() {
				let maksimal_pemesanan = $('#maksimal_pemesanan').val();
				let qty = $(this).val();
				if (qty > parseInt(maksimal_pemesanan)) {
					alert('Pemesanan Hari Ini Sudah Mencapai Batas Maksimal Pemesanan');
					$(this).val(qty - 1);
					return false;
				}
				changeCustomRasa();
			})

			$('.custom_rasa').change(function() {
				let max_qty = $('#qty').val();
				let total_qty = 0;
				$('.custom_rasa').each(function() {
					qty = parseInt($(this).val());
					if ((total_qty + qty) > max_qty) {
						alert('Quantity Tidak Sesuai');
						$(this).val(max_qty - total_qty);
						return false;
					} else {
						total_qty += qty;
					}
				})
			})

			$('#btn-simpan-custom-rasa').click(function() {
				let kode_customer = $('#kode_customer').val();
				let id_produk = $('#produk').val();
				let array_rasa = [];
				if (kode_customer != '') {
					$('.custom_rasa').each(function() {
						let id = $(this).attr('data-id');
						let value = parseInt($(this).val());
						array_rasa.push({
							id,
							qty: value
						})
					})
					array_rasa = JSON.stringify(array_rasa);

					$.post('ajax/ajax_custom_rasa.php', {
						array_rasa,
						kode_produk: id_produk
					}, function(res) {
						console.log(res);
						$('#id_varian_rasa_produk').val(10);
					})
				}

			})

		})

		function changeCustomRasa() {
			let id_varian_rasa_produk = $('#id_varian_rasa_produk').val();
			let qty = $('#qty').val();
			if (qty > 0 && id_varian_rasa_produk != '') {
				$(`.custom_rasa[data-id="${id_varian_rasa_produk}"]`).val(qty);
			}

		}

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