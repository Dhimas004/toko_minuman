<?php
include 'header.php';
// generate kode material
$kode = mysqli_query($conn, "SELECT kode_produk from produk order by kode_produk desc");
$data = mysqli_fetch_assoc($kode);
$num = substr($data['kode_produk'], 1, 4);
$add = (int) $num + 1;
if (strlen($add) == 1) {
	$format = "P000" . $add;
} else if (strlen($add) == 2) {
	$format = "P00" . $add;
} else if (strlen($add) == 3) {
	$format = "P0" . $add;
} else {
	$format = "P" . $add;
}
?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Tambah Produk</b></h2>

	<form action="proses/tm_produk.php" method="POST" enctype="multipart/form-data">
		<center>
			<div class="form-group">
				<img src="../image/no-image.jpg" id="image-preview" width="100" height="100">
				<br />
				<label for="gambar_produk">Pilih Gambar </label>
				<input type="file" id="gambar_produk" name="files" accept="image/*" style="margin-left: 6%;">
			</div>
		</center>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="kode_produk">Kode Produk</label>
					<input type="text" class="form-control" id="kode_produk" disabled value="<?= $format; ?>">
					<input type="hidden" name="kode" class="form-control" id="kode_produk" value="<?= $format; ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="harga">Nama Produk</label>
					<input type="text" class="form-control" id="nama_produk" name="nama" required>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="katalog">Katalog</label>
					<select class="form-control" id="katalog" name="katalog" required>
						<option value="">-- Pilih --</option>
						<option value="es_krim">Es Krim</option>
						<option value="minuman_tradisional">Minuman Tradisional</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="minimal_pemesanan">Minimal Pemesanan</label>
					<input type="text" class="form-control" id="minimal_pemesanan" name="minimal_pemesanan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="1" required>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="harga">Harga</label>
					<input type="text" class="form-control" id="harga" name="harga" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="deskripsi">Deskripsi</label>
			<textarea name="desk" id="deskripsi" class="form-control" style="height: 250px;"></textarea>
		</div>

		<div class="row">

			<div class="col-md-6">
				<button type="submit" class="btn btn-success btn-block"><i class="glyphicon glyphicon-plus-sign"></i> Tambah</button>
			</div>
			<div class="col-md-6">
				<a href="m_produk.php" class="btn btn-primary btn-block">Kembali</a>
			</div>
		</div>

		<br>

</div>
</form>

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
<script>
	$(document).ready(function() {
		$('#gambar_produk').on('change', function(event) {
			var file = event.target.files[0];
			if (file) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#image-preview').attr('src', e.target.result);
				}
				reader.readAsDataURL(file);
			}
		});
	})
</script>
<?php
include 'footer.php';
?>