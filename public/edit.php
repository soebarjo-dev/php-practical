<?php

require "../config/Database.php";
require "../models/Buku.php";

$db = (new Database())->connect();
$buku = new Buku($db);

$id = $_GET['id'];
$isPinjam = (bool) isset($_GET['is_borrowable']) ? $_GET['is_borrowable']:"0";
$isReturn = (bool) isset($_GET['is_return']) ? $_GET['is_return']:"0";
$dataByID = $buku->find($id);

$title = "Edit Data Buku";
if ($isPinjam){
    $title = "Konfirmasi buku yang dipinjam";
}

if ($isReturn){
    $title = "Konfirmasi pengembalikan buku";
}

$lableButton = "Simpan";
if ($isPinjam){
    $lableButton = "Pinjam";
}

if ($isReturn){
    $lableButton = "Kembalikan";
}

?>

<h2><?= $title ?></h2>

<form action="save.php?id=<?= $dataByID['id']; ?>&is_borrowable=1" method="post" autocomplete="off">
    <label>Judul Buku</label> <br/>
    <input type="text" name="judulBuku" required autofocus value="<?= $dataByID['judul'] ?>" <?= $isPinjam ? 'readonly':''; ?> />
    <br/><br/>
    <label>Penulis</label> <br/>
    <input type="text" name="penulis" required autofocus value="<?= $dataByID['penulis'] ?>" <?= $isPinjam ? 'readonly':''; ?> />
    <br/><br/>
    <label>Tahun Terbit</label> <br/>
    <input type="number" name="tahunTerbit" required autofocus value="<?= $dataByID['tahun_terbit'] ?>" <?= $isPinjam ? 'readonly':''; ?> />
    <br/><br/>
    
    <?php if ($isPinjam): ?>
    <label>Jenis Buku</label> <br/>
    <input type="text" name="jenisBuku" value="<?= $dataByID['jenis_buku'] ?>" style="text-transform: capitalize;" readonly />
    <input type="hidden" name="statusBuku" value="dipinjam" />
    <?php elseif ($isReturn): ?>
    <label>Jenis Buku</label> <br/>
    <input type="text" name="jenisBuku" value="<?= $dataByID['jenis_buku'] ?>" style="text-transform: capitalize;" readonly />
    <input type="hidden" name="statusBuku" value="tersedia" />
    <?php else: ?>
        <label>Jenis Buku</label> <br/>
        <input id="jenisBukuBiasa" type="radio" name="jenisBuku" value="biasa" <?= $dataByID['jenis_buku'] === "biasa" ? "checked":"" ?> />
        <label for="jenisBukuBiasa">Biasa</label>

        <input id="jenisBukuReferensi" type="radio" name="jenisBuku" value="referensi" <?= $dataByID['jenis_buku'] === "referensi" ? "checked":"" ?> />
        <label for="jenisBukuReferensi">Referensi</label>
        <br/><br/>
        <label>Status Buku Saat Ini</label> <br/>
        <input type="text" name="statusBuku" value="<?= $dataByID['status_buku'] ?>" style="text-transform: capitalize;" readonly />

    <?php endif; ?>
<br/>
<br/>
<br/>
<button type="submit"><?= $lableButton; ?></button>
<button type="button" onclick="window.history.back()">Batal</button>
</form