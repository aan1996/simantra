<?php

include 'include/function.php';
/*$id = $_GET['id'];
$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$alamat = $_POST['alamat'];
$keterangansurat = $_POST['keterangansurat'];
$rand = rand();
$ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
$filename = $_FILES['images']['name'];
$ukuran = $_FILES['images']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array($ext, $ekstensi)) {
echo "<script>
alert('Format gambar tidak sesuai');
</script>";

return false;
} else {
if ($ukuran < 1044070) {
$xx = $rand . '_' . $filename;
move_uploaded_file($_FILES['images']['tmp_name'], 'upload/' . $rand . '_' . $filename);
mysqli_query($link, "UPDATE tandaterimaagunan SET nama='$nama', nohp='$nohp', alamat='$alamat', image='$xx', keterangansurat='$keterangansurat' WHERE id='$id'");
echo "<script>
alert('Edit data berhasil');
window.location.href='data-tanda-terima-agunan.php';
</script>";
} else {
echo "<script>
alert('Edit data gagal');
window.location.href='tambah-data-tanda-terima-agunan.php';
</script>";
}
}*/

// membuat variabel untuk menampung data dari form
$id = $_POST['id'];
$nama   = $_POST['nama'];
$nohp     = $_POST['nohp'];
$alamat    = $_POST['alamat'];
$keterangansurat    = $_POST['keterangansurat'];
$images = $_FILES['images']['name'];
//cek dulu jika merubah gambar produk jalankan coding ini
if ($images != "") {
  $ekstensi_diperbolehkan = array('png', 'jpg'); //ekstensi file gambar yang bisa diupload
  $x = explode('.', $images); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['images']['tmp_name'];
  $angka_acak     = rand(1, 999);
  $nama_gambar_baru = $angka_acak . '-' . $images; //menggabungkan angka acak dengan nama file sebenarnya
  if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    move_uploaded_file($file_tmp, 'upload/' . $nama_gambar_baru); //memindah file gambar ke folder gambar

    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
    $query  = "UPDATE tandaterimaagunan SET nama = '$nama', nohp = '$nohp', alamat = '$alamat', images = '$nama_gambar_baru', keterangansurat = '$keterangansurat'";
    $query .= "WHERE id = '$id'";
    $result = mysqli_query($link, $query);
    // periska query apakah ada error
    if (!$result) {
      die("Query gagal dijalankan: " . mysqli_errno($link) .
      " - " . mysqli_error($link));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil diubah.');window.location='data-tanda-terima-agunan.php';</script>";
    }
  } else {
    //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='edit-data-tanda-terima-agunan.php';</script>";
  }
} else {
  // jalankan query UPDATE berdasarkan ID yang produknya kita edit
  $query  = "UPDATE tandaterimaagunan SET nama = '$nama', nohp = '$nohp', alamat = '$alamat', keterangansurat = '$keterangansurat'";
  $query .= "WHERE id = '$id'";
  $result = mysqli_query($link, $query);
  // periska query apakah ada error
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($link) .
    " - " . mysqli_error($link));
  } else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil diubah.');window.location='data-tanda-terima-agunan.php';</script>";
  }
}
