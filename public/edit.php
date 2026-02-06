<?php

require "../config/Database.php";
require "../models/Buku.php";

$db = (new Database())->connect();
$buku = new Buku($db);

$id = $_GET['id'];
$dataByID = $buku->find($id);

?>

<h2>Edit Mahasiswa</h2>

<form action="save.php?id=<?= $dataByID['id']; ?>" method="post" autocomplete="off">
    <label>Judul Buku</label> <br/>
    <input type="text" name="judulBuku" required autofocus value="<?= $dataByID['judul'] ?>" />
    <br/><br/>
    <label>Penulis</label> <br/>
    <input type="text" name="penulis" required autofocus value="<?= $dataByID['penulis'] ?>" />
    <br/><br/>
    <label>Tahun Terbit</label> <br/>
    <input type="number" name="tahunTerbit" required autofocus value="<?= $dataByID['tahun_terbit'] ?>" />
    <br/><br/>
    <label>Jenis Buku</label> <br/>
    <input id="jenisBukuBiasa" type="radio" name="jenisBuku" value="biasa" <?= $dataByID['jenis_buku'] === "biasa" ? "checked":"" ?> />
    <label for="jenisBukuBiasa">Biasa</label>

    <input id="jenisBukuReferensi" type="radio" name="jenisBuku" value="referensi" <?= $dataByID['jenis_buku'] === "referensi" ? "checked":"" ?> />
    <label for="jenisBukuReferensi">Referensi</label>
    <br/><br/>
    <label>Status Buku</label> <br/>
    <input id="statusBukuBiasa" type="radio" name="statusBuku" value="tersedia" <?= $dataByID['status_buku'] === "tersedia" ? "checked":"" ?> />
    <label for="statusBukuBiasa">Tersedia</label>

    <input id="statusBukuReferensi" type="radio" name="statusBuku" value="dipinjam" <?= $dataByID['status_buku'] === "dipinjam" ? "checked":"" ?> />
    <label for="statusBukuReferensi">Dipinjam</label>
    <br/><br/>

<br/>
<br/>
<br/>
<button type="submit">Simpan</button>
</form