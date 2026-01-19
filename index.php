<?php

require_once __DIR__ . "/classes/Mahasiswa.php";
require_once __DIR__ . "/classes/MahasiswaBeasiswa.php";

$daftarMahasiswa = [
    new Mahasiswa(80, "A", "Farid Nugraha", "Makassar", 22, "L"),
    new Mahasiswa(85, "B", "Putri", "Malang", 20, "P"),
    new MahasiswaBeasiswa("Prestasi KIP", "Agus Fuadi", "Semarang", 25, "L", "A", 80),
    new MahasiswaBeasiswa("Prestasi KIP", "Miftah", "Madiun", 22, "P", "C", 92)
];

?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>DATA MAHASISWA</h2>

<table>
  <tr>
    <th>NAMA</th>
    <th>KELAS</th>
    <th>JENIS KELAMIN</th>
    <th>ALAMAT</th>
    <th>UMUR</th>
    <th>NILAI</th>
    <th>STATUS</th>
  </tr>
  <?php foreach ($daftarMahasiswa as $mahasiswa){ ?>
    <tr>
        <td><?= $mahasiswa->getNama() ?></td>
        <td><?= $mahasiswa->getKelas() ?></td>
        <td><?= $mahasiswa->getJenisKelamin() ?></td>
        <td><?= $mahasiswa->getAlamat() ?></td>
        <td><?= $mahasiswa->getUmur() ?></td>
        <td><?= $mahasiswa->getNilai() ?></td>
        <td><?= $mahasiswa->getStatus() ?></td>
    </tr>
  <?php } ?>
  
</table>

</body>
</html>

