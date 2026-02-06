<?php

require "../config/Database.php";
require "../models/Buku.php";

$db = (new Database())->connect();
$buku = new Buku($db);
$data = $buku->all();

?>

<h2>Data Mahasiswa</h2>

<table style="border:1px solid #000;" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Jenis Buku</th>
            <th>Status Buku</th>
            <th>Tanggal Buat</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($data as $key => $value): ?>
        <tr>
            <td align="center"><?= $key + 1 ?></td>
            <td><?= $value['judul'] ?></td>
            <td><?= $value['penulis'] ?></td>
            <td align="center"><?= $value['tahun_terbit'] ?></td>
            <td align="center"><?= $value['jenis_buku'] ?></td>
            <td align="center"><?= $value['status_buku'] ?></td>
            <td align="center"><?= $value['tanggal_buat'] ?></td>
            <td align="center"><a href="edit.php?id=<?= $value['id']; ?>">Edit</a> | <a href="delete.php?id=<?= $value['id']; ?>">Hapus</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="create.php">Buat Buku</a>