<?php

require "../config/Database.php";
require "../models/Buku.php";

$db = (new Database())->connect();
$buku = new Buku($db);

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "POST"){
    $params = [$_POST['judulBuku'], $_POST['penulis'], $_POST['tahunTerbit'], $_POST['jenisBuku'], $_POST['statusBuku']];
 
    if (isset($_GET['id'])){
        $buku->update($_GET['id'], $params);
    } else {
        $buku->create($params);
    }

    header("Location: index.php");
} else {
    echo "halaman tidak bisa diakses";
}

