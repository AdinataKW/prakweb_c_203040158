<?php
require 'function.php';
$buku = query("SELECT * FROM buku");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACIL</title>
    <style>
        h3{
            margin: 0 auto;
            text-align:center;
        }
    </style>
</head>
<body>
    <h3 >DAFTAR BUKU</h3>
    <a href="tambah.php">Tambah</a>
<table border="1" cellpadding="13" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Judul</th>
      <th>Penerbit</th>
      <th>Pengarang</th>
      <th>Gambar</th>
      <td>Aksi</td>
    </tr>

    <?php $i = 1; ?>
    <?php foreach ($buku as $bk) : ?>
        <tr>
            <td><?= $i; ?></td>
           
            <td><?= $bk['judul']; ?></td>
            <td><?= $bk['penerbit']; ?></td>
            <td><?= $bk['pengarang']; ?></td>
            <td><img width="100px" height="125px" src="img/<?= $bk['gambar']; ?>"></td>
            <td>
          <a href="ubah.php?id=<?= $bk['id']?>"><button>Ubah</button></a>
          <a href="hapus.php?id=<?= $bk['id']; ?>" onclick="return confirm('Hapus Data??')"><button>Hapus</button></a>
        </td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
</body>
</html>