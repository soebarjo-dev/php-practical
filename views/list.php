<h2>Data Mahasiswa</h2>

<table border="1" width="450">
    <tr>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Nilai</th>
        <th>Alamat</th>
        <th>Jenis Kelamin</th>
        <th>Umur</th>
        <th>Aksi</th>
    </tr>
    <?php foreach($data as $key => $value): ?>
    <tr>
        <td><?= $value['nama'] ?></td>
        <td><?= $value['kelas'] ?></td>
        <td><?= $value['nilai'] ?></td>
        <td><?= $value['alamat'] ?></td>
        <td><?= $value['jenisKelamin'] ?></td>
        <td><?= $value['umur'] ?></td>
        <td>
            <a href="edit.php?id=<?= base64_encode($key) ?>">Edit</a> | 
            <a href="delete.php?id=<?= base64_encode($key) ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<br />
<a href="create.php">Tambah</a>