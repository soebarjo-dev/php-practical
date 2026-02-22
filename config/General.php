<?php

$menu = [
    ['label' => 'Beranda', 'urlPage' => 'dashboard', 'isNewTab' => false, 'path' => 'dashboard'], 
    ['label' => 'Master Pengguna', 'urlPage' => 'master-user', 'isNewTab' => false, 'path' => 'user'], 
    ['label' => 'Master Unit', 'urlPage' => 'master-unit', 'isNewTab' => false, 'path' => 'unit'], 
    ['label' => 'Master Produk', 'urlPage' => 'master-product', 'isNewTab' => false, 'path' => 'product'], 
    ['label' => 'Master Pelanggan', 'urlPage' => 'master-customer', 'isNewTab' => false, 'path' => 'customer'], 
    ['label' => 'Transaksi', 'urlPage' => 'transaction', 'isNewTab' => false, 'path' => 'transaction'], 
    ['label' => 'Laporan', 'urlPage' => 'report', 'isNewTab' => false, 'path' => 'report'], 
];

$page = isset($_GET['page']) ? $_GET['page'] : 'unknown';