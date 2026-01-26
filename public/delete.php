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
$paramURLID = (int) $getID;
$storage = new JSONStorage('../storage/mahasiswa.json');
$service = new MahasiswaService($storage);
$helper = new General();

$service->delete($paramURLID);

$helper->redirectTo('index.php');