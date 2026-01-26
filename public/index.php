<?php 

require_once "../app/Storage/JSONStorage.php";
require_once "../app/Services/MahasiswaService.php";

$storage = new JSONStorage('../storage/mahasiswa.json');
$service = new MahasiswaService($storage);

$data = $service->getAll();
$content = "";

ob_start();
require "../views/list.php";
$content = ob_get_clean();

require "../views/layout.php";