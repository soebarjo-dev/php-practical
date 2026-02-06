<h2>Tambah Mahasiswa</h2>

<form action="save.php" method="post" autocomplete="off">
    <label>Judul Buku</label> <br/>
    <input type="text" name="judulBuku" required autofocus />
    <br/><br/>
    <label>Penulis</label> <br/>
    <input type="text" name="penulis" required autofocus />
    <br/><br/>
    <label>Tahun Terbit</label> <br/>
    <input type="number" name="tahunTerbit" required autofocus />
    <br/><br/>
    <label>Jenis Buku</label> <br/>
    <input id="jenisBukuBiasa" type="radio" name="jenisBuku" value="biasa" checked />
    <label for="jenisBukuBiasa">Biasa</label>

    <input id="jenisBukuReferensi" type="radio" name="jenisBuku" value="referensi" />
    <label for="jenisBukuReferensi">Referensi</label>
    <br/><br/>
    <label>Status Buku</label> <br/>
    <input id="statusBukuBiasa" type="radio" name="statusBuku" value="tersedia" checked />
    <label for="statusBukuBiasa">Tersedia</label>
    <br/><br/>

<br/>
<br/>
<br/>
<button type="submit">Simpan</button>
<button type="button" onclick="window.history.back()">Batal</button>
</form