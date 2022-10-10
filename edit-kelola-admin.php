<?php
include 'header.php';
require_once 'include/auth.php';
require 'include/function.php';

$id = $_GET['id'] ? $_GET['id'] : "";
$sql = mysqli_query($link, "SELECT * FROM user WHERE id='$id'");
$row = mysqli_fetch_array($sql);

if (isset($_POST['editnasabah'])) {
    if (editkelolaadmin($_POST) > 0) {
        echo "<script>
    alert('Edit data berhasil');
    window.location.href='kelola-admin.php';
    </script>";
    } else {
        echo "<script>
    alert('Edit data gagal');
    window.location.href='edit-kelola-admin.php';
    </script>";
    }
}

?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Edit Data User</h1>
        <div class="card">
            <div class="card-header">Edit Data
            </div>
            <div class="card-body">
                    <form class="form-item" action="" method="post" role="form">
                    <input type="hidden" name="id" id="id" value="<?= $row['id'] ?>">
                    <div class="form-group">
                
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="  " value="<?= $row['nama']; ?>" required="required">
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" name="nip" placeholder="  " value="<?= $row['nip']; ?>" required="required">
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" placeholder="  " value="<?= $row['jabatan']; ?>" required="required">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" placeholder="  " value="<?= $row['password']; ?>" required="required">
                    </div>
                    <div class="form-group">
                                <label for="akses">Akses</label>
                                <select name="akses" id="akses" class="form-control">
                                    <option value="ADMIN">Admin</option>
                                    <option value="PEGAWAI">Pegawai</option>
                                </select>
                
                    </div>

                    <button type="submit" name="editnasabah" class="btn btn-primary" onclick="return confirm('Simpan perubahan?')">

                    Edit</button>
                    <a href="kelola-admin.php" class="btn btn-warning" onclick="return confirm('Yakin batal edit?')">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php

include 'footer.php';

?>