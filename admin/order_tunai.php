<?php
include 'header.php';

?>
<style>
	th {
		vertical-align: middle !important;
		text-align: center;
	}

	table .btn {
		margin-top: 0.4rem;
	}
</style>
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Daftar Pesanan (Tunai)</b></h2>
	<br>
	<h5 class="bg-success" style="padding: 7px; width: 100%; font-weight: bold;">
		<marquee>Lakukan Reload Setiap Masuk Halaman ini, untuk menghindari terjadinya kesalahan data dan informasi</marquee>
	</h5>
	<a href="order_tunai.php" class="btn btn-default" style="margin-bottom: 10px;"><i class="glyphicon glyphicon-refresh"></i> Reload</a>
	<br>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Invoice</th>
				<th scope="col">Kode Customer</th>
				<th scope="col">Status</th>
				<th scope="col">Tanggal Order</th>
				<th scope="col">Tanggal Pengambilan/Pengiriman</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>

			<?php
			$result = mysqli_query($conn, "SELECT * FROM `order` WHERE metode_pembayaran = 'tunai' group by invoice ORDER BY invoice DESC");
			$no = 1;
			$array = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$id_order = $row['id_order'];
				$kodep = $row['kode_produk'];
				$inv = $row['invoice'];
			?>

				<tr>
					<td align="center"><?= $no; ?></td>
					<td><?= $row['invoice']; ?></td>
					<td><?= $row['kode_customer']; ?></td>
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
						<td style="color: red;font-weight: bold;">Pesanan Ditolak
						<?php
					}
					if ($row['terima'] == 0 && $row['tolak'] == 0) {
						?>
						<td style="color: orange;font-weight: bold;">Pesanan Baru
						<?php
					}
						?>
						</td>
						<td align="center"><?= tgl_indo($row['tanggal']) ?></td>
						<td align="center"><?= tgl_indo($row['tanggal_pengambilan']) ?></td>
						<td>
							<?php
							if ($row['tolak'] == 1) :

							else : ?>
								<?php
								if ($row['terima'] == 0) :
								?>

									<a href="proses/terima.php?inv=<?= $row['invoice']; ?>&kdp=<?= $row['kode_produk']; ?>&page=order_tunai" class="btn btn-sm btn-success mt-2"><i class="glyphicon glyphicon-ok-sign"></i> Terima</a>
									<a href="proses/tolak.php?inv=<?= $row['invoice']; ?>&page=order_tunai" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Yakin Ingin Menolak ?')"><i class="glyphicon glyphicon-remove-sign"></i> Tolak</a>
								<?php
								elseif ($row['terima'] == 1) :
								?>
									<a href="proses/selesai.php?inv=<?= $row['invoice']; ?>&kdp=<?= $row['kode_produk']; ?>&page=order_tunai" class="btn btn-sm btn-info mt-2"><i class="glyphicon glyphicon-ok-sign"></i> Pesanan Selesai</a>
							<?php
								endif;
							endif;
							?>
							<!-- <a href="#" data-toggle="modal" data-target="#modal-bukti-pembayaran-<?= $id_order ?>" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-eye-open"></i> Bukti Pembayaran</a> -->
							<a href="#" data-toggle="modal" data-target="#modal-detail-pesanan-<?= $id_order ?>" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-eye-open"></i> Detail Pesanan</a>
						</td>
				</tr>
			<?php
				$no++;
			}
			?>

		</tbody>
	</table>

	<?php
	$result = mysqli_query($conn, "SELECT * FROM `order` group by invoice ORDER BY invoice DESC");
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
								<td>No Telp</td>
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
						<center><b>BUKTI PEMBAYARAN (<?= strtoupper($row['metode_pembayaran']) ?>)</b></center>
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





<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<?php
include 'footer.php';
?>