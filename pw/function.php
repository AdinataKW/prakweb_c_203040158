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
  while ($row = mysqli_fetch_assoc($result)) {
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
  // tambah diubah jadi bisa upload yg asalnya gak bisa
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

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

// asalnya gada fungsi upload
function upload()
{
  $conn = koneksi();
  $nama_file = $_FILES['gambar']['name'];
  $tipe_file = $_FILES['gambar']['type'];
  $ukuran_file = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp_file = $_FILES['gambar']['tmp_name'];

  //ketika tidak ada gambar
  if ($error == 4) {
    return 'nophoto.png';
  }

  //cek ekstensi file 
  $daftar_gambar = ['jpg', 'jpeg', 'png'];
  $ekstensi_file = explode('.', $nama_file);
  $ekstensi_file = strtolower(end($ekstensi_file));
  if (!in_array($ekstensi_file, $daftar_gambar)) {
    echo "<script>
     alert('wrong file upload, please try again!');
  </script>";
    return false;
  }

  //cek tipe file
  if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
    echo "<script>
     alert('wrong file upload, please try again!');
  </script>";
    return false;
  }

  //cek ukuran file
  if ($ukuran_file > 10000000) {
    echo "<script>
     alert('File size too big, please upload another file');
  </script>";
    return false;
  }

  //upload file
  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;
  move_uploaded_file($tmp_file, './img/' . $nama_file_baru);

  return $nama_file_baru;
}
function ubah($data)
{
  $conn = koneksi();

  // asalnya gk ada id
  $id = htmlspecialchars($data["id"]);
  $judul = htmlspecialchars($data["judul"]);
  $penerbit = htmlspecialchars($data["penerbit"]);
  $pengarang   = htmlspecialchars($data["pengarang"]);
  $gambar = upload();

  if (!$gambar) {
    return false;
  }

  $query = "UPDATE buku SET
              judul = '$judul',
              penerbit = '$penerbit',
              pengarang = '$pengarang',
              gambar = '$gambar'
            WHERE id = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}
