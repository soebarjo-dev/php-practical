<?php 

require_once "../app/Storage/JSONStorage.php";
require_once "../app/Services/MahasiswaService.php";

$storage = new JSONStorage('../storage/mahasiswa.json');
$service = new MahasiswaService($storage);

$data = $service->getAll();
$content = "";

// require "../views/layout.php";
require "../views/list.php";