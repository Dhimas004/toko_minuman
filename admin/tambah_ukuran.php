<?php
include 'header.php';
$kode_produk  = $_GET['kode_produk'];
$produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$kode_produk'"));
$kode_produk = $produk['kode_produk'];
$katalog = $produk['katalog'];
$nama = $produk['nama'];
$image = $produk['image'];
?>
<div class="container">
    <h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Tambah Ukuran</b></h2>

    <form action="proses/tu_produk.php" method="POST" enctype="multipart/form-data">
        <center style="margin-top: 2%;">
            <div class="form-group">
                <img src="../image/produk/<?= $image ?>" id="image-preview" width="150" style="border-radius: 5px;">
                <center>
                    <h3 style="margin: 0; margin-top: 10px; text-transform: uppercase;"><b><?= $nama ?></b></h3>
                </center>
            </div>
        </center>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kode_produk">Kode Produk</label>
                    <input type="text" class="form-control" id="kode_produk" disabled value="<?= $kode_produk; ?>">
                    <input type="hidden" name="kode" class="form-control" id="kode_produk" value="<?= $kode_produk; ?>">
                </div>
                <div class="form-group">
                    <label for="nama_produk">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" disabled value="<?= $nama; ?>">
                </div>
                <div class="form-group">
                    <label for="ukuran">Ukuran</label>
                    <input type="text" class="form-control" id="ukuran" name="ukuran">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                </div>
                <a class="btn btn-primary" href="m_produk.php" style="float: right; margin-left: 5px;">Kembali</a>
                <button class="btn btn-success" style="float: right;">Tambah Ukuran</button>
                <br />
                <br />
                <hr>
                <?php
                $varian_ukuran = mysqli_query($conn, "SELECT * FROM varian_ukuran_produk WHERE kode_produk = '$kode_produk'");
                if (mysqli_num_rows($varian_ukuran) > 0) {
                ?>
                    <b>Varian Ukuran</b>
                    <br>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Ukuran</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($varian_ukuran)) {
                                $id_varian_ukuran_produk = $row['id'];
                                $ukuran = $row['ukuran'];
                                $harga = $row['harga'];
                            ?>
                                <tr>
                                    <td align="center"><?= $ukuran ?></td>
                                    <td align="right">Rp. <?= number_format(round($harga, 0), 0, ',', '.') ?></td>
                                    <td align="center"><a href="proses/hapus_ukuran.php?kode_produk=<?= $kode_produk ?>&hapus=<?= $id_varian_ukuran_produk ?>">Hapus</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<b>Tidak Ada Ukuran</b>";
                }
                ?>
            </div>
        </div>
        <br>
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