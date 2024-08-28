<?php
include 'header.php';
// generate kode material
$id = $_GET['id'];
$kode = mysqli_query($conn, "SELECT * from metode_pembayaran where id = '$id'");
$data = mysqli_fetch_assoc($kode);

?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Edit Metode Pembayaran</b></h2>

	<form action="proses/edit_metode_pembayaran.php" method="POST" id="form-edit-customer" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= $id ?>">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="layanan">Layanan</label>
					<input type="text" class="form-control" name="layanan" id="layanan" value="<?= $data['layanan']; ?>" autocomplete="off">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="atas_nama">Atas Nama</label>
					<input type="text" class="form-control" name="atas_nama" id="atas_nama" value="<?= $data['atas_nama']; ?>" autocomplete="off">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="nomor">Nomor</label>
					<input type="text" class="form-control" name="nomor" id="nomor" value="<?= $data['nomor']; ?>" autocomplete="off">
				</div>
			</div>
		</div>

		<hr>
		<div class="row">

			<div class="col-md-6">
				<button type="submit" class="btn btn-warning btn-block"><i class="glyphicon glyphicon-edit"></i> Edit</button>
			</div>
			<div class="col-md-6">
				<a href="m_produk.php" class="btn btn-danger btn-block">Cancel</a>
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
		$('#form-edit-customer').submit(function() {
			let password_baru = $('#password_baru').val();
			let konfirmasi_password = $('#konfirmasi_password').val();
			if (password_baru != '' && password_baru != konfirmasi_password) {
				alert('Password Baru dan Konfirmasi Password Tidak Sama');
				return false;
			}
		})

	})
</script>

<?php
include 'footer.php';
?>