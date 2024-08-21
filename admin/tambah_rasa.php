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
    <h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Tambah Rasa</b></h2>

    <form action="proses/tr_produk.php" method="POST" enctype="multipart/form-data">
        <center style="margin-top: 2%;">
            <div class="form-group">
                <img src="../image/produk/<?= $image ?>" id="image-preview" width="150" height="150" style="border-radius: 5px;">
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
                    <label for="rasa">Rasa Baru</label>
                    <input type="text" class="form-control" id="rasa" name="rasa">
                </div>
                <a class="btn btn-primary" href="m_produk.php" style="float: right; margin-left: 5px;">Kembali</a>
                <button class="btn btn-success" style="float: right;">Tambah Rasa</button>
                <br />
                <br />
                <hr>
                <?php
                $varian_rasa = mysqli_query($conn, "SELECT * FROM varian_rasa_produk WHERE kode_produk = '$kode_produk'");
                if (mysqli_num_rows($varian_rasa) > 0) {
                ?>
                    <b>Varian Rasa</b>
                    <br>
                    <br>
                    <ul style="padding: 0; padding-left: 15px;">
                        <?php
                        while ($row = mysqli_fetch_assoc($varian_rasa)) {
                            $id_varian_rasa_produk = $row['id'];
                            $rasa = $row['rasa'];
                        ?>
                            <li><?= $rasa ?> <a href="proses/hapus_rasa.php?kode_produk=<?= $kode_produk   ?>&hapus=<?= $id_varian_rasa_produk ?>">Hapus</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                <?php
                } else {
                    echo "<b>Tidak Ada Varian Rasa</b>";
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