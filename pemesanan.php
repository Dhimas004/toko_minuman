<?php
include 'header.php';

?>
<div class="container" style="padding-bottom: 300px;">
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Pemesanan</b></h2>
	<?php
	if (isset($_POST['ganti_tanggal'])) {
		$invoice = $_POST['invoice'];
		$ganti_tanggal = $_POST['ganti_tanggal'];
		mysqli_query($conn, "UPDATE `order` SET tanggal_pengambilan = '$ganti_tanggal' WHERE invoice = '$invoice'");
		echo "<script>alert('Berhasil Ganti Tanggal Pengambilan'); window.location.href= ''</script>";
	}

	if (isset($_POST['batalkan_pesanan'])) {
		$invoice = $_POST['invoice'];
		$alasan_pembatalan = $_POST['alasan_pembatalan'];
		$form_dll = $_POST['form_dll'];
		mysqli_query($conn, "UPDATE `order` SET terima='0', tolak = '1', alasan_penolakan = '$alasan_pembatalan', alasan_dll = '$form_dll' WHERE invoice = '$invoice'");
		echo "<script>alert('Berhasil Membatalkan Transaksi'); window.location.href= ''</script>";
	}
	?>
	<form method="POST">
		<table class="table table-striped table-bordered">
			<tbody>
				<?php
				if (isset($_SESSION['user'])) :
				?>
					<tr>
						<th class="text-center" style="width: 5%;">No</th>
						<th class="text-center">Invoice</th>
						<th class="text-center">Status</th>
						<th class="text-center">Metode Pembayaran</th>
						<th class="text-center">Tanggal Order</th>
						<th class="text-center">Tanggal Pengambilan/Pengiriman</th>
						<th class="text-center">Pesanan</th>
						<th class="text-center">Aksi</th>
					</tr>
					<?php
					$kd_cs = $_SESSION['kd_cs'];
					$list_order = mysqli_query($conn, "SELECT * FROM `order` WHERE kode_customer = '$kd_cs' GROUP BY invoice ORDER BY invoice DESC");
					$no = 1;
					while ($row = mysqli_fetch_assoc($list_order)) {
						$id_order = $row['id_order'];
						$id_varian_rasa_produk = $row['id_varian_rasa_produk'];
						$id_varian_ukuran_produk = $row['id_varian_ukuran_produk'];
						$invoice = $row['invoice'];
						$kode_customer = $row['kode_customer'];
						$kode_produk = $row['kode_produk'];
						$nama_produk = $row['nama_produk'];
						$qty = $row['qty'];
						$harga = $row['harga'];
						$status = $row['status'];
						$metode_pembayaran = $row['metode_pembayaran'];
						$bukti_pembayaran = $row['bukti_pembayaran'];
						$tanggal = $row['tanggal'];
						$tanggal_pengambilan = $row['tanggal_pengambilan'];
						$provinsi = $row['provinsi'];
						$kota = $row['kota'];
						$alamat = $row['alamat'];
						$kode_pos = $row['kode_pos'];
						$terima = $row['terima'];
						$tolak = $row['tolak'];
						$cek = $row['cek'];
						$catatan_khusus = $row['catatan_khusus'];
					?>
						<tr>
							<td align="center"><?= $no ?></td>
							<td align="center"><?= $invoice ?></td>
							<?php if ($row['terima'] == 2) {
							?>
								<td style="color: #2aabd2;font-weight: bold;">Pesanan Selesai
								<?php
							}
							if ($row['terima'] == 1) { ?>
								<td style="color: green;font-weight: bold;">Pesanan Sedang Dibuat
								<?php
							} else if ($row['tolak'] == 1) {
								?>
								<td>
									<span style="color: red;font-weight: bold;">Pesanan Ditolak</span>
									<br />
									<small>(<?= $row['alasan_dll'] ?>)</small>
								<?php
							}
							if ($row['terima'] == 0 && $row['tolak'] == 0) {
								?>
								<td style="color: orange;font-weight: bold;"><?= $row['status']; ?>
								<?php
							}
								?>
								<td align="center" style="text-transform: capitalize;"><?php
																						if ($metode_pembayaran == 'non_tunai') {
																							echo "Non Tunai";
																						} else {
																							echo $metode_pembayaran;
																						}
																						?></td>
								<td align="center"><?= tgl_indo($tanggal) ?></td>
								<td align="center"><?= tgl_indo($tanggal_pengambilan) ?></td>
								<td align="center"><a href="#" data-toggle="modal" data-target="#modal-detail-pesanan-<?= $id_order ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Detail Pesanan</a></td>
								<!-- <td align="center"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ganti_tanggal_<?= $invoice ?>">Ganti Tanggal Pengambilan</button></td> -->
								<td align="center">
									<?php
									if ($row['terima'] == '1' || ($row['terima'] == '0' && $row['tolak'] == '0')) {
									?>
										<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#batalkan_pesanan_<?= $invoice ?>">Batalkan Pesanan</button>
									<?php
									}
									?>
								</td>
						</tr>
						<!-- Modal -->
						<div class="modal fade" id="ganti_tanggal_<?= $invoice ?>" tabindex="-1">
							<div class="modal-dialog">
								<form action="" method="POST">
									<input type="hidden" name="invoice" value="<?= $invoice ?>">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Ganti Tanggal</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label for="ganti_tanggal">Tanggal Pengambilan/Pengiriman Baru</label>
												<input type="date" class="form-control ganti_tanggal" id="ganti_tanggal" name="ganti_tanggal" value="<?= $tanggal_pengambilan ?>">
											</div>

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="modal fade" id="batalkan_pesanan_<?= $invoice ?>" tabindex="-1">
							<div class="modal-dialog">
								<form action="" method="POST">
									<input type="hidden" name="batalkan_pesanan">
									<input type="hidden" name="invoice" value="<?= $invoice ?>">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Batalkan Pesanan (<?= $row['invoice'] ?>)</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label for="alasan_pembatalan" style="text-transform: uppercase;">Alasan Pembatalan</label>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="alasan_pembatalan" id="reschedule_<?= $no ?>" value="reschedule" data-id="<?= $no ?>">
													<label class="form-check-label" for="reschedule_<?= $no ?>">
														Reschedule
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="alasan_pembatalan" id="tidak_merespon_chat_<?= $no ?>" value="penjual_pembeli_tidak_merespon_chat" data-id="<?= $no ?>">
													<label class="form-check-label" for="tidak_merespon_chat_<?= $no ?>">
														Penjual / Pembeli tidak merespon chat
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input" type="radio" name="alasan_pembatalan" id="menolak_pesanan_<?= $no ?>" data-id="<?= $no ?>" value="menolak_pesanan">
													<label class="form-check-label" for="menolak_pesanan_<?= $no ?>">
														Menolak Pesanan
													</label>
												</div>
												<div class="form-check">
													<input class="form-check-input " type="radio" name="alasan_pembatalan" id="dll<?= $no ?>" data-id="<?= $no ?>" value="dll">
													<label class="form-check-label" for="dll<?= $no ?>">
														Dll
													</label>
												</div>
												<div>
													<div class="form-group">
														<label for="form_dll">Alasan</label>
														<textarea class="form-control" id="form_dll" name="form_dll" rows="3"></textarea>
													</div>
												</div>

											</div>

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					<?php
						$no++;
					}
					?>

				<?php else : ?>
					<tr>
						<td colspan='7' class='text-center bg-danger'>
							<h5><b>SILAHKAN LOGIN TERLEBIH DAHULU SEBELUM BERBELANJA</b></h5>
						</td>
					</tr>
				<?php
				endif;
				?>
			</tbody>
		</table>
	</form>
	<?php
	$result = mysqli_query($conn, "SELECT * FROM `order` WHERE kode_customer = '$kd_cs' group by invoice ORDER BY invoice DESC");
	while ($row = mysqli_fetch_assoc($result)) :
		$invoices = $row['invoice'];
		$id_order = $row['id_order'];
		$kode_customer = $row['kode_customer'];
		$bukti_pembayaran = $row['bukti_pembayaran'];
		$customer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '$kode_customer'"));
	?>
		<div class="modal fade" id="modal-detail-pesanan-<?= $id_order ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<a href="m_produk.php" class="btn btn-sm btn-default close"></a>
						<h4 class="modal-title" id="myModalLabel">#<?= $row['invoice']; ?></h4>
					</div>
					<div class="modal-body">
						<table class="table table-striped">
							<tr>
								<td>Invoice</td>
								<td><?= $row['invoice']; ?></td>
							</tr>
							<tr>
								<td>Kode Customer</td>
								<td><?= $row['kode_customer']; ?></td>
							</tr>
							<tr>
								<td>Nama</td>
								<td><?= $customer['nama']; ?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td><?= $row['alamat'] . "," . $row['kota'] . " " . $row['provinsi'] . "," . $row['kode_pos']; ?></td>
							</tr>
							<tr>
								<td>No. Telp</td>
								<td><?= $customer['telp']; ?></td>
							</tr>
							<tr>
								<td style="vertical-align: top;">Catatan Khusus</td>
								<td style="vertical-align: top;"><?= $row['catatan_khusus']; ?></td>
							</tr>
						</table>

						<hr>
						<h4>List Order</h4>
						<table class="table table-striped">
							<tr>
								<th>No</th>
								<th>Kode Produk</th>
								<th>Nama Produk</th>
								<th>Rasa</th>
								<th>Ukuran</th>
								<th>Harga</th>
								<th>qty</th>
								<th>Subtotal</th>
							</tr>
							<?php
							$order = mysqli_query($conn, "SELECT * FROM `order` WHERE invoice = '$invoices'");
							$no = 1;
							$grand = 0;
							while ($list = mysqli_fetch_assoc($order)) :
								$id_varian_rasa_produk = $list['id_varian_rasa_produk'];
								$id_varian_ukuran_produk = $list['id_varian_ukuran_produk'];
								$rasa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM varian_rasa_produk WHERE id = '$id_varian_rasa_produk'"))['rasa'];
								$ukuran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM varian_ukuran_produk WHERE id = '$id_varian_ukuran_produk'"))['ukuran'];
								$ukuran = ($ukuran == '' ? 'Medium' : $ukuran);
							?>
								<tr>
									<td><?= $no;  ?></td>
									<td><?= $list['kode_produk']; ?></td>
									<td><?= $list['nama_produk']; ?></td>
									<td><?= $rasa; ?></td>
									<td><?= $ukuran; ?></td>
									<td>Rp. <?= number_format($list['harga'], 0, ",", ".");  ?></td>
									<td><?= $list['qty'];  ?></td>
									<td>Rp. <?= number_format($list['harga'] * $list['qty'], 0, ",", ".");  ?></td>
								</tr>
							<?php
								$sub = $list['harga'] * $list['qty'];
								$grand += $sub;
								$no++;
							endwhile;
							?>
							<tr>
								<td colspan="8" class="text-right"><b>Grandtotal : Rp. <?= number_format($grand, 0, ",", ".");  ?></b></td>
							</tr>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Bukti Pembayaran -->
		<div class="modal fade" id="modal-bukti-pembayaran-<?= $id_order ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<a href="m_produk.php" class="btn btn-default close"></a>
						<h4 class="modal-title" id="myModalLabel">#<?= $row['invoice']; ?></h4>
					</div>
					<div class="modal-body">
						<center><b>BUKTI PEMBAYARAN</b></center>
						<img src="../image/bukti_pembayaran/<?= $bukti_pembayaran ?>" alt="" style="width: 100%;">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	<?php
	endwhile;
	?>
</div>
<script>
	$(document).ready(function() {
		$('#nav-pemesanan').css({
			'font-weight': 'bold',
			'color': 'black'
		})

		let current_date = new Date();
		$('.ganti_tanggal').change(function() {
			const date1 = current_date;
			const date2 = new Date($(this).val() + "T00:00:00");

			if (dateDiffInMinutes(date1, date2) < 720) {
				alert('Pengambilan/Pengiriman paling sedikit 1 hari sebelum hari H');
				$(this).val('');
			}
		})

		$('input[name="alasan_pembatalan"]').change(function() {
			let id = $(this).attr('data-id');
			let value = $(this).val();

			if (value == 'dll') {
				$('#div-dll-' + id).show();
			} else {
				$('#div-dll-' + id).hide();
			}
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