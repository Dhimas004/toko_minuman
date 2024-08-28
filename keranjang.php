<?php
include 'header.php';
if (isset($_GET['del'])) {
	$id_keranjang = $_GET['id'];
	$del = mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang'");
	if ($del) {
		echo "
		<script>
		alert('1 PRODUK DIHAPUS');
		window.location = 'keranjang.php';
		</script>
		";
	}
}

if (isset($_POST['checkout'])) {
	$array_id_keranjang = $_POST['id_keranjang'];
	$array_harga = $_POST['harga'];
	$array_qty = $_POST['qty'];
	$kode_customer = $_POST['kode_customer'];

	foreach ($array_id_keranjang as $index => $id_keranjang) {
		$qty = $array_qty[$index];
		$harga = $array_harga[$index];
		mysqli_query($conn, "UPDATE keranjang SET harga = '$harga', qty = '$qty' WHERE id_keranjang = '$id_keranjang'");
	}

	echo "<script>window.location.href='checkout.php?kode_cs=$kode_customer'</script>";
}
?>
<div class="container" style="padding-bottom: 300px;">
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Keranjang</b></h2>
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
	<form method="POST" id="form-keranjang">
		<table class="table table-striped table-bordered">

			<?php
			if (isset($_SESSION['user'])) {
				$kode_cs = $_SESSION['kd_cs'];
				// CEK JUMLAH KERANJANG
				$cek = mysqli_query($conn, "SELECT * FROM keranjang WHERE kode_customer = '$kode_cs'");
				$jml = mysqli_num_rows($cek);

				if ($jml > 0) {
			?>
					<thead>
						<tr>
							<th class="text-center" scope="col">No</th>
							<th class="text-center" scope="col" style="width: 11%;">Image</th>
							<th class="text-center" scope="col" style="width: 11%;">Nama</th>
							<th class="text-center" scope="col" style="width: 11%;">Rasa</th>
							<th class="text-center" scope="col" style="width: 11%;">Ukuran</th>
							<th class="text-center" scope="col" style="width: 11%;">Harga</th>
							<th class="text-center" scope="col" style="width: 11%;">Qty</th>
							<th class="text-center" scope="col" style="width: 11%;">Subtotal</th>
							<th class="text-center" scope="col" style="width: 11%;">Action</th>
						</tr>
					</thead>
					<?php
					if (isset($_SESSION['kd_cs'])) {
						$kode_cs = $_SESSION['kd_cs'];

						$result = mysqli_query($conn, "SELECT k.id_keranjang as keranjang, k.kode_produk as kd, k.nama_produk as nama, k.qty as jml, p.image as gambar, k.harga as hrg, k.id_varian_rasa_produk, k.id_varian_ukuran_produk, p.minimal_pemesanan FROM keranjang k join produk p on k.kode_produk=p.kode_produk WHERE kode_customer = '$kode_cs'");
						$no = 1;
						$hasil = 0;
						while ($row = mysqli_fetch_assoc($result)) {
							$keranjang = $row['keranjang'];
							$id_varian_rasa_produk = $row['id_varian_rasa_produk'];
							$minimal_pemesanan = $row['minimal_pemesanan'];
							$id_varian_ukuran_produk = $row['id_varian_ukuran_produk'];

							$rasa = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM varian_rasa_produk WHERE id = '$id_varian_rasa_produk'"))['rasa'];
							$rasa = ($rasa == '' ? '-' : $rasa);
							$ukuran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM varian_ukuran_produk WHERE id = '$id_varian_ukuran_produk'"))['ukuran'];
							$ukuran = ($ukuran == '' ? 'Medium' : $ukuran);
					?>
							<tbody>
								<input type="hidden" name="kode_customer" value="<?= $kode_cs ?>">
								<input type="hidden" name="id_keranjang[]" value="<?php echo $row['keranjang']; ?>">
								<input type="hidden" name="harga[]" value="<?= $row['hrg'] ?>">
								<tr id="tr-<?= $no ?>">
									<td scope="row" align="center" style="width: 5%;"><?= $no;  ?></td>
									<td><img src="image/produk/<?= $row['gambar']; ?>" width="100"></td>
									<td><?= $row['nama']; ?></td>
									<td><?php
										if ($id_varian_rasa_produk == 10) {
											$list_custom_rasa = mysqli_query($conn, "SELECT * FROM custom_rasa WHERE id_keranjang = '$keranjang'");
											while ($row2 = mysqli_fetch_assoc($list_custom_rasa)) {
												$rasa2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM varian_rasa_produk WHERE id = '$row2[varian_rasa_produk_id]'"))['rasa'];
												echo $rasa2 . " (" . $row2['qty'] . ")<br />";
											}
										} else {
											echo $rasa;
										}
										?></td>
									<td><?= $ukuran ?></td>
									<td align="right">Rp. <?= number_format($row['hrg'], 0, ',', '.');  ?></td>
									<td>
										<input type="number" name="qty[]" class="form-control qty" style="text-align: center;" value="<?= $row['jml']; ?>" data-id="<?= $no ?>" data-harga=<?= $row['hrg'] ?> min="<?= $minimal_pemesanan ?>" data-id-keranjang="<?= $keranjang ?>">
									</td>
									<td align="right">Rp. <span id="harga-<?= $no ?>"><?= number_format($row['hrg'] * $row['jml'], 0, ',', '.');  ?></span></td>
									<td align="center">
										<a href="keranjang.php?del=1&id=<?= $row['keranjang']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin dihapus ?')">Delete</a>
									</td>
								</tr>
						<?php
							$sub = $row['hrg'] * $row['jml'];
							$hasil += $sub;
							$no++;
						}
					}
						?>

						<tr>
							<td colspan="9" style="text-align: right; font-weight: bold;">Grand Total = Rp. <span id="grandtotal"><?= number_format($hasil, 0, ',', '.'); ?></span></td>
						</tr>
						<tr>
							<td colspan="9" style="text-align: right; font-weight: bold;">
								<a href="index.php" class="btn btn-primary">Kembali</a>
								<button type="submit" name="checkout" class="btn btn-success">Checkout</button>
							</td>
						</tr>
				<?php
				} else {
					echo "
						<tr>
						<th scope='col'>No</th>
						<th scope='col'>Image</th>
						<th scope='col'>Nama</th>
						<th scope='col'>Harga</th>
						<th scope='col'>Qty</th>
						<th scope='col'>SubTotal</th>
						<th scope='col'>Action</th>
						</tr>
						<tr>
						<td colspan='7' class='text-center bg-warning'><h5><b>KERANJANG BELANJA ANDA KOSONG </b></h5></td>
						</tr>

						";
				}
			} else {
				echo "<tr>
					<td colspan='7' class='text-center bg-danger'><h5><b>SILAHKAN LOGIN TERLEBIH DAHULU SEBELUM BERBELANJA</b></h5></td>
					</tr>";
			}
				?>
							</tbody>
		</table>
	</form>
</div>
<script>
	$(document).ready(function() {

		$('.qty').change(function() {
			let id_keranjang = $(this).attr('data-id-keranjang');
			let maksimal_pemesanan = $('#maksimal_pemesanan').val();
			let data_id = $(this).attr('data-id');
			let harga = $(this).attr('data-harga');
			let qty = $(this).val();
			if (totalQty() > parseInt(maksimal_pemesanan)) {
				alert('Pemesanan Hari Ini Sudah Mencapai Batas Maksimal Pemesanan');
				if ((qty - 1) > maksimal_pemesanan) {
					$(this).val(maksimal_pemesanan);
					$.post('ajax/ajax_keranjang.php', {
						qty: maksimal_pemesanan,
						id_keranjang
					})
				} else {
					$(this).val(qty - 1);
					$.post('ajax/ajax_keranjang.php', {
						qty: (qty - 1),
						id_keranjang
					})
				}
				let total = qty * harga;
				$(`#harga-${data_id}`).text(formatRupiah(total));
				sumGrandtotal();
				return false;
			}
			$.post('ajax/ajax_keranjang.php', {
				qty,
				id_keranjang,
			})
			let total = qty * harga;
			$(`#harga-${data_id}`).text(formatRupiah(total));
			sumGrandtotal();
		})
		$('.qty').trigger('change');
	})

	function sumGrandtotal() {
		let total = 0;
		$('.qty').each(function() {
			var harga = $(this).attr('data-harga');
			let qty = $(this).val();
			total += harga * qty;
		})
		$('#grandtotal').text(formatRupiah(total));
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

	function totalQty() {
		let totalqty = 0;
		$('.qty').each(function() {
			totalqty += parseInt($(this).val());
		})
		return parseInt(totalqty);
	}
</script>
<script>
	$(document).ready(function() {
		$('#nav-keranjang').css({
			'font-weight': 'bold',
			'color': 'black'
		})
	})
</script>
<?php
include 'footer.php';
?>