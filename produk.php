<?php
include 'header.php';
?>

<!-- PRODUK TERBARU -->
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680"><b>Produk Kami</b></h2>

	<div class="row">
		<?php
		$result = mysqli_query($conn, "SELECT * FROM produk");
		while ($row = mysqli_fetch_assoc($result)) {
		?>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="image/produk/<?= $row['image']; ?>" style="width: 250px; height: 250px; border-radius: 5px;">
					<div class="caption">
						<h3><?= $row['nama'];  ?></h3>
						<h4>Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></h4>
						<div class="row">
							<div class="col-md-12">
								<a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-success btn-block">Booking</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>

</div>
<script>
	$(document).ready(function() {
		$('#nav-produk').css({
			'font-weight': 'bold',
			'color': 'black'
		})
	})
</script>
<?php
include 'footer.php';
?>