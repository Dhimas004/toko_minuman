<?php
include 'header.php';

if (isset($_GET['page'])) {
	$id = $_GET['id'];
	$result = mysqli_query($conn, "DELETE FROM metode_pembayaran WHERE id = '$id'");

	if ($result) {
		echo "
		<script>
		alert('DATA BERHASIL DIHAPUS');
		window.location = 'm_metode_pembayaran.php';
		</script>
		";
	}
}

?>


<div class="container">
	<div style="display: flex; justify-content: space-between; border-bottom: 4px solid gray">
		<div>
			<h2 style=" width: 100%; margin: 0;"><b>Data Metode Pembayaran</b></h2>
		</div>
		<div>
			<a href="tm_metode_pembayaran.php" class="btn btn-primary float-right" style="margin-bottom: 10px;">Tambah Metode Pembayaran</a>
		</div>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col" style="width: 5%; text-align: center;">No</th>
				<th scope="col">Layanan</th>
				<th scope="col">Atas Nama</th>
				<th scope="col">Nomor</th>
				<th scope="col">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$list_metode_pembayaran = mysqli_query($conn, "SELECT * FROM metode_pembayaran");
			while ($row = mysqli_fetch_assoc($list_metode_pembayaran)) {
				$layanan = $row['layanan'];
				$atas_nama = $row['atas_nama'];
				$nomor = $row['nomor'];
			?>
				<tr>
					<td align="center"><?= $no ?></td>
					<td><?= $layanan ?></td>
					<td><?= $atas_nama ?></td>
					<td><?= $nomor ?></td>
					<td>
						<a href="edit_metode_pembayaran.php?id=<?= $row['id']; ?>" class="btn btn-warning"><i class="glyphicon glyphicon-edit"></i> </a>
						<a href="m_metode_pembayaran.php?id=<?php echo $row['id']; ?>&page=del" class="btn btn-danger" style="margin-left: 5px;" onclick="return confirm('Yakin Ingin Menghapus Data ?')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
				</tr>
			<?php
				$no++;
			}
			?>
		</tbody>
	</table>

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