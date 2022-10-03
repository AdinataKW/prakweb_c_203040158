<?php
function koneksi()
{
    $conn = mysqli_connect("localhost", "root", "");
    mysqli_select_db($conn, "prakweb_c_203040158_pw");

    return $conn;
}
function query($sql)
{
    $conn = koneksi();
    $result = mysqli_query($conn, "$sql");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data)
{
    // ambil data dari tiap elemen dalam form
    $conn = koneksi();
    $judul = htmlspecialchars($data["judul"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $pengarang   = htmlspecialchars($data["pengarang"]);
    $gambar = htmlspecialchars($data["gambar"]);

    // query insert data
    $query = "INSERT INTO buku
              VALUES
              ('', '$judul', '$penerbit', '$pengarang','$gambar');
              ";
    mysqli_query($conn, $query);
    echo mysqli_error($conn);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM buku WHERE id = $id");

    return mysqli_affected_rows($conn);
}
function ubah($data)
{
  $conn = koneksi();

  $judul = htmlspecialchars($data["judul"]);
  $penerbit = htmlspecialchars($data["penerbit"]);
  $pengarang   = htmlspecialchars($data["pengarang"]);
  $gambar = htmlspecialchars($data["gambar"]);
  $gambar = upload();
  
  if (!$gambar) {
    return false;
  }

  if ($gambar == 'no_photo.png') {
    $gambar = $gambar_lama;
  }

  $query = "UPDATE buku SET
              judul = '$judul',
              pengarang = '$pengarang',
              tahun_terbit = '$tahun_terbit',
              gambar = '$gambar'
            WHERE id = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
?>