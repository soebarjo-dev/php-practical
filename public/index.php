<?php

require "../config/Database.php";
require "../models/Buku.php";

$db = (new Database())->connect();
$buku = new Buku($db);
$search = isset($_GET['cariBuku']) ? $_GET['cariBuku']:'';
$data = $buku->all($search);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Data Perpustakaan</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            table, th, table, td {
                border: 1px solid #000;
                padding: 5px;
            }

            @media print {
                @page {
                    size: A4 portrait;
                    margin: 0mm;
                }

                body {
                    margin: 0;
                    padding: 0;
                    font-family: Arial, Helvetica, sans-serif;
                }

                .hideWhenPrint {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <h2>Data Perputakaan Umum</h2>

        <form method="get" autocomplete="off" class="hideWhenPrint">
            <label>Pencarian berdasarkan Judul Buku</label><br/>
            <input type="text" name="cariBuku" placeholder="Cari buku..." value="<?= $search ?>" autofocus />
        </form><br/>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Jenis Buku</th>
                    <th>Status Buku</th>
                    <th>Tanggal Buat</th>
                    <th class="hideWhenPrint">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $total = 0; foreach ($data as $key => $value): $total += 1; ?>
                <tr>
                    <td align="center"><?= $key + 1 ?></td>
                    <td><?= $value['judul'] ?></td>
                    <td><?= $value['penulis'] ?></td>
                    <td align="center"><?= $value['tahun_terbit'] ?></td>
                    <td align="center"><?= $value['jenis_buku'] ?></td>
                    <td align="center"><?= $value['status_buku'] ?></td>
                    <td align="center"><?= $value['tanggal_buat'] ?></td>
                    <td align="center" class="hideWhenPrint">
                        <?php if ($value['jenis_buku'] === "biasa"): ?>
                            <?php if ($value['status_buku'] === "dipinjam"): ?>
                                <a href="edit.php?id=<?= $value['id']; ?>&is_return=1">Kembalikan</a> |
                            <?php else: ?>
                                <a href="edit.php?id=<?= $value['id']; ?>&is_borrowable=1">Pinjam</a> |
                            <?php endif; ?>
                        <?php else: ?>
                            <a style="text-decoration: line-through; cursor: no-drop; ">Pinjam</a> |
                        <?php endif; ?> 
                        <a href="edit.php?id=<?= $value['id']; ?>">Edit</a> | 
                        <a href="delete.php?id=<?= $value['id']; ?>">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table><br/>
        <span style="float: right">Total Data Buku : <?= $total; ?></span>
        <br/>
        <div class="hideWhenPrint">
            <a href="create.php">Buat Buku</a> | <a style="cursor: pointer" href="#" onclick="onPrint()">Cetak</a>
        </div>
        <script type="text/javascript">
            function onPrint(){
                event.preventDefault();

                window.print();
            }
        </script>
    </body>
</html>