<h2>Data Mahasiswa</h2>

<table border="1" width="450">
    <tr>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Nilai</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php foreach($data as $key => $value): ?>
    <tr>
        <td><?= $value['nama'] ?></td>
        <td><?= $value['kelas'] ?></td>
        <td><?= $value['nilai'] ?></td>
        <td><?= $value['status'] ?></td>
        <td>
            <a href="edit.php?id="<?= $key ?>>Edit</a> | 
            <a href="delete.php?id="<?= $key ?>>Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br />
<a href="create.php">Tambah</a>