<?php
include 'header.php';
?>

<style>
	th {
		text-align: center !important;
		vertical-align: middle !important;
	}
</style>
<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray;"><b>Master Produk</b></h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col" class="text-center">No</th>
				<th scope="col" class="text-center">Kode Produk</th>
				<th scope="col" class="text-center">Nama Produk</th>
				<th scope="col" class="text-center">Rasa</th>
				<th scope="col" class="text-center">Minimal Pemesanan</th>
				<th scope="col" class="text-center">Image</th>
				<th scope="col" class="text-center">Ukuran</th>
				<th scope="col" class="text-center">Harga</th>
				<th scope="col" class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$result = mysqli_query($conn, "SELECT * FROM produk");
			$no = 1;
			while ($row = mysqli_fetch_assoc($result)) {
				$kode_produk = $row['kode_produk'];
				$nama = $row['nama'];
				$minimal_pemesanan = $row['minimal_pemesanan'];
			?>
				<tr>
					<td align="center" style="width: 5%;"><?= $no; ?></td>
					<td style="width: 13.5%;"><?= $kode_produk; ?></td>
					<td style="width: 13.5%;"><?= $nama;  ?></td>
					<td style="width: 13.5%;">
						<?php
						$list_varian_rasa = mysqli_query($conn, "SELECT * FROM varian_rasa_produk WHERE kode_produk = '$kode_produk'");
						if (mysqli_num_rows($list_varian_rasa) > 0) {
							echo "<ul style='padding: 0; padding-left: 15px; margin: 0;'>";
							while ($row2 = mysqli_fetch_assoc($list_varian_rasa)) {
						?>
								<li><?= $row2['rasa'] ?></li>
						<?php
							}
							echo "</ul>";
						}
						?>
						<a href="tambah_rasa.php?kode_produk=<?= $kode_produk ?>">Tambah Rasa</a>
					</td>
					<td align="right"><?= $minimal_pemesanan ?></td>
					<td style="width: 13.5%;" align="center"><img src="../image/produk/<?= $row['image']; ?>" width="150" height="150" style="border-radius: 5px;"></td>
					<td style="width: 13.5%;">
						<?php
						$list_varian_ukuran = mysqli_query($conn, "SELECT * FROM varian_ukuran_produk WHERE kode_produk = '$kode_produk'");
						if (mysqli_num_rows($list_varian_ukuran) > 0) {
							echo "<ul style='padding: 0; padding-left: 15px; margin: 0;'>";
							while ($row2 = mysqli_fetch_assoc($list_varian_ukuran)) {
						?>
								<li><?= $row2['ukuran'] ?> (<?= number_format(round($row2['harga'], 0), 0, ',', '.') ?>)</li>
						<?php
							}
							echo "</ul>";
						}
						?>
						<a href="tambah_ukuran.php?kode_produk=<?= $kode_produk ?>">Tambah Ukuran</a>
					</td>
					<td style="width: 13.5%;" align="right">Rp. <?= number_format($row['harga'], 0, ',', '.');  ?></td>
					<td style="width: 13.5%;" align="center">
						<a href="edit_produk.php?kode=<?= $kode_produk; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> </a>
						<a href="proses/del_produk.php?kode=<?= $kode_produk; ?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
				</tr>
			<?php
				$no++;
			}
			?>

		</tbody>
	</table>
	<a href="tm_produk.php" class="btn btn-success">Tambah Produk</a>
</div>
<!-- Button trigger modal -->

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