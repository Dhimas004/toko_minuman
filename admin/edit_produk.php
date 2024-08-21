<?php
include 'header.php';
// generate kode material
$kode_produk = $_GET['kode'];
$kode = mysqli_query($conn, "SELECT * from produk where kode_produk = '$kode_produk'");
$data = mysqli_fetch_assoc($kode);

?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Edit Produk</b></h2>

	<form action="proses/edit_produk.php" method="POST" enctype="multipart/form-data">
		<center>
			<div class="form-group">
				<label for="exampleInputFile"><img src="../image/produk/<?= $data['image']; ?>" width="100" height="100"></label>
				<br />
				<b>Pilih Gambar</b>
				<input type="file" id="exampleInputFile" name="files" accept="image/*" style="margin-left: 6%;">
			</div>
		</center>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail1">Kode Produk</label>
					<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" disabled value="<?= $data['kode_produk']; ?>">
					<input type="hidden" name="kode" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Nama Produk" value="<?= $data['kode_produk']; ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="harga">Nama Produk</label>
					<input type="text" class="form-control" id="nama_produk" name="nama" value="<?= $data['nama'] ?>" required>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="katalog">Katalog</label>
					<select class="form-control" id="katalog" name="katalog" required>
						<option value="">-- Pilih --</option>
						<option value="es_krim" <?= ($data['katalog'] == 'es_krim' ? 'selected' : '') ?>>Es Krim</option>
						<option value="minuman_tradisional" <?= ($data['katalog'] == 'minuman_tradisional' ? 'selected' : '') ?>>Minuman Tradisional</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="minimal_pemesanan">Minimal Pemesanan</label>
					<input type="text" class="form-control" id="minimal_pemesanan" name="minimal_pemesanan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="<?= $data['minimal_pemesanan'] ?>" required>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="harga">Harga</label>
					<input type="text" class="form-control" id="harga" name="harga" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="<?= $data['harga'] ?>" required>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="exampleInputPassword1">Deskripsi</label>
			<textarea name="desk" class="form-control" style="height: 250px;"><?= $data['deskripsi']; ?></textarea>
		</div>
		<hr>
		<div class="row">

			<div class="col-md-6">
				<button type="submit" class="btn btn-warning btn-block"><i class="glyphicon glyphicon-edit"></i> Edit</button>
			</div>
			<div class="col-md-6">
				<a class="btn btn-primary btn-block" href="m_produk.php">Kembali</a>
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

<?php
include 'footer.php';
?>