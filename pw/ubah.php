<?php

require 'function.php';
    
$id = $_GET['id'];
$buku = query("SELECT * FROM buku WHERE id = $id")[0];

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        echo "<script>
                    alert('Data Berhasil diubah!');
                    document.location.href = 'index.php';
                </script>";
    } else {
        echo "<script>
                    alert('Data Gagal diubah!');
                </script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Ubah Data Buku</title>
</head>
<body>
<h3>Form Ubah Data Buku</h3>
<form action="" method="POST">
    <ul>
        <li>
            <label for="judul">Judul :</label><br>
            <input type="text" name="judul" id="judul" required value="<?= $buku['judul']; ?>"><br><br>
        </li>
        <li>
            <label for="penerbit">Penerbit :</label><br>
            <input type="text" name="penerbit" id="penerbit" required value="<?= $buku['penerbit']; ?>"><br><br>
        </li>
        <li>
            <label for="pengarang">Pengarang :</label><br>
            <input type="pengarang" name="pengarang" id="pengarang" required value="<?= $buku['pengarang']; ?>"><br><br>
        </li>
        <li>
            <label for="img">Gambar :</label><br>
            <input type="file" name="img" id="img" ><br><br>
        </li>
        <br>
        <button type="submit" name="ubah">Ubah Data</button>
        <button type="submit">
            <a href="index.php" style="text-decoration: none; color: black;">Kembali</a>
        </button>
    </ul>
</form>
</body>
</html>

