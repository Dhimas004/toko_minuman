<?php
include 'header.php';
// generate kode material
$kode_customer = $_GET['kode_customer'];
$kode = mysqli_query($conn, "SELECT * from customer where kode_customer = '$kode_customer'");
$data = mysqli_fetch_assoc($kode);

?>


<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Edit Customer</b></h2>

	<form action="proses/edit_customer.php" method="POST" id="form-edit-customer" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="kode_customer">Kode Customer</label>
					<input type="text" class="form-control" id="kode_customer" placeholder="Masukkan Nama Produk" disabled value="<?= $data['kode_customer']; ?>">
					<input type="hidden" name="kode_customer" class="form-control" id="kode_customer" placeholder="Masukkan Nama Produk" value="<?= $data['kode_customer']; ?>">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" id="email" name="email" value="<?= $data['email'] ?>" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="telp">No. Telp</label>
					<input type="text" class="form-control" id="telp" name="telp" value="<?= $data['telp'] ?>" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>" required>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="password_baru">Password Baru</label>
					<input type="password" class="form-control" id="password_baru" name="password_baru">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="konfirmasi_password">Konfirmasi Password</label>
					<input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
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