<?php

include 'header.php';
require_once 'include/auth.php';
require 'include/function.php';

if (isset($_POST['datauser'])) {
    if (tambahkelolaadmin($_POST) > 0) {
        echo "<script>
    alert('Tambah data berhasil');
    window.location.href='kelola-admin.php';
    </script>";
    } else {
        echo "<script>
    alert('Tambah data gagal');
    window.location.href='tambah-kelola-admin.php';
    </script>";
    }
}

?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Data User</h1>
        <div class="card">
            <div class="card-header">Tambah Data
            </div>
            <div class="card-body">
                <form class="form-item" action="" method="post" role="form">
                    <div class="form-group">
                        <label for="noktp">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="  " required="required">
                    </div>
                     <div class="form-group">
                        <label for="nama">NIP</label>
                        <input type="number" class="form-control" name="nip" placeholder="  " required="required">
                    </div>
                     <div class="form-group">
                        <label for="nama">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" placeholder="  " required="required">
                    </div>
                    <div class="form-group">
                        <label for="nama">Password</label>
                        <input type="text" class="form-control" name="password" placeholder="  " required="required">
                    </div>
                    <div class="form-group">
                                <label for="akses">Akses</label>
                                <select name="akses" id="akses" class="form-control">
                                    <option value="Administrator">Administrator</option>
                                    <option value="Pegawai">Pegawai</option>
                                </select>
                    </div>
                    <button type="submit" name="datauser" class="btn btn-primary" onclick="return confirm('Yakin ingin menyimpan?')">Simpan</button>
                    <button type="reset" class="btn btn-warning">Clear</button>
                    <a href="kelola-admin.php" class="btn btn-success" onclick="return confirm('Yakin kembali?')">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php

include 'footer.php';

?>