<?php

require "../config/Database.php";
require "../models/Buku.php";

$db = (new Database())->connect();
$buku = new Buku($db);

if (isset($_GET['id'])){
    $buku->softDelete($_GET['id']);
    header("Location: index.php");
} else {
    echo "halaman tidak bisa diakses";
}