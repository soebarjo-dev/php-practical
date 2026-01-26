<h2>Edit Mahasiswa - Nomor: #<?= $paramURLID ?></h2>

<form method="post">
    <input type="text" name="nama" placeholder="Input nama" value="<?= $dataByID['nama'] ?>" /> <br/><br/>
    <input type="text" name="kelas" placeholder="Input kelas" value="<?= $dataByID['kelas'] ?>" /> <br/><br/>
    <input type="text" name="nilai" placeholder="Input nilai" value="<?= $dataByID['nilai'] ?>" /> <br/><br/>
    <input type="text" name="umur" placeholder="Input umur" value="<?= $dataByID['umur'] ?>" /> <br/><br/>
    <select name="jenisKelamin">
        <option <?= $dataByID['jenisKelamin'] === "Pria" ? "selected":"" ?>>Pria</option>
        <option <?= $dataByID['jenisKelamin'] === "Wanita" ? "selected":"" ?>>Wanita</option>
    </select>
    <br/><br/>
    <button type="submit">Simpan</button>
</form>