<?php
include 'header.php';
?>

<div class="container" style="padding-bottom: 250px;">
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Register</b></h2>
	<form action="proses/register.php" method="POST">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Nama</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama" name="nama" autocomplete="off" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Email</label>
					<input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" name="email" autocomplete="off" required>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Username</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Username" name="username" autocomplete="off" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">No. Telp</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="081234567891" name="telp" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
				</div>
			</div>

		</div>


		<div class="row">

			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" autocomplete="off" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword1">Konfirmasi Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Konfirmasi Password" name="konfirmasi" autocomplete="off" required>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success">Register</button>
	</form>
</div>

<?php
include 'footer.php';
?>