<?php
include 'header.php';
if (isset($_POST['submit'])) {
	$maksimal_pemesanan = $_POST['maksimal_pemesanan'];
	mysqli_query($conn, "UPDATE maksimal_pemesanan SET maksimal_pemesanan = '$maksimal_pemesanan' WHERE id = '1'");
	echo "<script>alert('Berhasil Update Maksimal Pemesanan'); window.location.href = ''</script>";
}
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
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Maksimal Pemesanan</b></h2>
	<div class="row justify-content-center">
		<form action="" method="POST">
			<div class="col-md-2">
				<?php
				$maksimal_pemesanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM maksimal_pemesanan WHERE id = '1'"))['maksimal_pemesanan'];
				?>
				<input type="text" name="maksimal_pemesanan" id="maksimal_pemesanan" class="form-control" value="<?= $maksimal_pemesanan ?>">
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-primary" name="submit">Simpan</button>
				<a href="order.php" class="btn btn-info">Kembali</a>
			</div>
		</form>
	</div>
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