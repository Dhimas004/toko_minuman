<?php
include 'header.php';
?>
<!-- IMAGE -->
<div class="container-fluid" style="margin: 0;padding: 0;">
	<div class="image" style="margin-top: -21px">
		<img src="image/home/banner-toko-minuman.jpg" style="width: 100%;  height: 650px;">
	</div>
</div>
<br>
<br>

<!-- PRODUK TERBARU -->
<div class="container">
	<h4 class="text-center" style="font-family: arial; padding-top: 10px; padding-bottom: 10px; font-style: italic; line-height: 29px; border-top: 2px solid #ff8d87; border-bottom: 2px solid #ff8d87;">Selamat datang di home industry Pakde Parjo, kami siap melayani pesanan anda dengan menu es krim dan minuman tradisional yang kami telah kami sediakan. Kami memberikan produk yang berkualitas dibuat dengan bahan alami pilihan terbaik.</h4>
	<h2 style=" width: 100%; border-bottom: 4px solid #ff8680; margin-top: 80px;"><b>Produk Kami</b></h2>

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
								<a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>" class="btn btn-success btn-block " style="float: right;">Booking</a>
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
<br>
<br>
<br>
<br>
<script>
	$(document).ready(function() {
		$('#nav-home').css({
			'font-weight': 'bold',
			'color': 'black'
		})
	})
</script>
<?php
include 'footer.php';
?>