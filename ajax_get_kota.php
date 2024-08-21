<?php
require_once('./koneksi/koneksi.php');
$id = $_GET['id'];
$list_kota = mysqli_query($conn, "SELECT * FROM kota WHERE province_id = '$id'");
while ($data = mysqli_fetch_assoc($list_kota)) {
    echo "<option>$data[name]</option>";
}
