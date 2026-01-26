<?php 

require_once "../app/Domain/Mahasiswa.php";
require_once "../app/Storage/JSONStorage.php";
require_once "../app/Services/MahasiswaService.php";
require_once "../app/Helpers/General.php";

$storage = new JSONStorage('../storage/mahasiswa.json');
$service = new MahasiswaService($storage);
$helper = new General();

if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $mahasiswa = new Mahasiswa($_POST['nilai'], $_POST['kelas'], $_POST['nama'], 'surabaya', $_POST['umur'], $_POST['jenisKelamin']);
    $binding = [
        'nama' => $mahasiswa->getNama(),
        'kelas' => $mahasiswa->getKelas(),
        'nilai' => $mahasiswa->getNilai(),
        'alamat' => $mahasiswa->getAlamat(),
        'umur' => $mahasiswa->getUmur(),
        'jenisKelamin' => $mahasiswa->getJenisKelamin(),
    ];

    $service->add($binding);

    $helper->redirectTo('index.php');
}

ob_start();

require "../views/form.php";
$content = ob_get_clean();

require "../views/layout.php";