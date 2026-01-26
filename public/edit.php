<?php 

require_once "../app/Domain/Mahasiswa.php";
require_once "../app/Storage/JSONStorage.php";
require_once "../app/Services/MahasiswaService.php";
require_once "../app/Helpers/General.php";

if (!isset($_GET['id'])){
    echo "Error: ID tidak dikirim";
    exit;
}

$getID = base64_decode($_GET['id']);
if (strlen($getID) === 0 && $getID === ""){
    echo "Error: tidak ada ID itu";
    exit;
}

$paramURLID = (int) $getID;
$storage = new JSONStorage('../storage/mahasiswa.json');
$service = new MahasiswaService($storage);
$helper = new General();

$data = $service->getAll();

$dataByID = $data[$paramURLID];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_POST['alamat'] = 'surabaya'; // Data Manual
    $service->update($paramURLID, $_POST);
    $helper->redirectTo('index.php');
}

ob_start();

require "../views/edit.php";
$content = ob_get_clean();

require "../views/layout.php";