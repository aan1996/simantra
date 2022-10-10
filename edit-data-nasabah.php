<?php
include 'header.php';
require_once 'include/auth.php';
require 'include/function.php';

$id = $_GET['id'] ? $_GET['id'] : "";
$sql = mysqli_query($link, "SELECT * FROM perusahaan WHERE id='$id'");
$row = mysqli_fetch_array($sql);

if (isset($_POST['editnasabah'])) {
    if (editnasabah($_POST) > 0) {
        echo "<script>
    alert('Edit data berhasil');
    window.location.href='data-nasabah.php';
    </script>";
    } else {
        echo "<script>
    alert('Edit data gagal');
    window.location.href='edit-data-nasabah.php';
    </script>";
    }
}

?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Edit Data Perusahaan</h1>
        <div class="card">
            <div class="card-header">Edit Data
            </div>
            <div class="card-body">
                    <form class="form-item" action="" method="post" role="form">
                    <input type="hidden" name="id" id="id" value="<?= $row['id'] ?>">
                    <div class="form-group">
                
                    <div class="form-group">
                        <label for="id_perusahaan">ID Perusahaan</label>
                        <input type="text" class="form-control" name="id_perusahaan" placeholder="  " value="<?= $row['id_perusahaan']; ?>" required="required">
                    </div>
                    <div class="form-group">
                        <label for="cif">CIF</label>
                        <input type="text" class="form-control" name="cif" placeholder="  " value="<?= $row['cif']; ?>" required="required">
                    </div>
                    <div class="form-group row-cols-lg-5">
                        <label for="jenis_usaha">Jenis Usaha</label>
                        <select name="jenis_usaha" id="" required="required" class="form-control">
                        <option selected disabled>Pilih</option>
                        <option value="PEMILIK IUP" <?php if(isset($row['jenis_usaha']) && ($row['jenis_usaha']) == 'PEMILIK IUP') echo 'selected="selected"'; ?>>PEMILIK IUP</option>
                        <option value="SUPPLIER" <?php if(isset($row['jenis_usaha']) && ($row['jenis_usaha']) == 'SUPPLIER') echo 'selected="selected"'; ?>>SUPPLIER</option>
                        <option value="KONTRAKTOR TAMBANG" <?php if(isset($row['jenis_usaha']) && ($row['jenis_usaha']) == 'KONTRAKTOR TAMBANG') echo 'selected="selected"'; ?>>KONTRAKTOR TAMBANG</option>
                        </select>
                        <!-- <input type="text" class="form-control" name="jeniskelamin" placeholder="Laki-laki/Perempuan"> -->
                        </div>
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" class="form-control" name="nama_perusahaan" placeholder="  " value="<?= $row['nama_perusahaan']; ?>" required="required">
                    </div>
                    <div class="form-group row-cols-lg-5">
                        <label for="debitur">Debitur/Non Debitur</label>
                        <select name="debitur" id="" required="required" class="form-control">
                        <option selected disabled>Pilih</option>
                        <option value="DEBITUR" <?php if(isset($row['debitur']) && ($row['debitur']) == 'DEBITUR') echo 'selected="selected"'; ?>>DEBITUR</option>
                        <option value="NON DEBITUR" <?php if(isset($row['debitur']) && ($row['debitur']) == 'NON DEBITUR') echo 'selected="selected"'; ?>>NON DEBITUR</option>
                        </select>
                        <!-- <input type="text" class="form-control" name="jeniskelamin" placeholder="Laki-laki/Perempuan"> -->
                    </div>
                    <div class="form-group row-cols-lg-5">
                        <label for="segment">Segment</label>
                        <select name="segment" id="" required="required" class="form-control">
                        <option selected disabled>Pilih</option>
                        <option value="MICRO" <?php if(isset($row['segment']) && ($row['segment']) == 'MICRO') echo 'selected="selected"'; ?>>MIKRO</option>
                        <option value="SME" <?php if(isset($row['segment']) && ($row['segment']) == 'SME') echo 'selected="selected"'; ?>>SME</option>
                        <option value="COMERCIAL" <?php if(isset($row['segment']) && ($row['segment']) == 'COMERCIAL') echo 'selected="selected"'; ?>>COMERCIAL</option>
                        <option value="CORPORATE" <?php if(isset($row['segment']) && ($row['segment']) == 'CORPORATE') echo 'selected="selected"'; ?>>CORPORATE</option>
                        <!-- <input type="text" class="form-control" name="jeniskelamin" placeholder="Laki-laki/Perempuan"> -->
                    </select>
                    </div>

                    <div class="form-group row-cols-lg-5">
                        <label for="region">Region</label>
                        <select name="region" id="" required="required" class="form-control">
                        <option selected disabled>Pilih</option>
                        <option value="REGION X SULAWESI MALUKU" <?php if(isset($row['region']) && ($row['region']) == 'REGION X SULAWESI MALUKU') echo 'selected="selected"'; ?>>REGION X SULAWESI MALUKU</option>
                        <option value="REGION LAIN" <?php if(isset($row['region']) && ($row['region']) == 'REGION LAIN') echo 'selected="selected"'; ?>>REGION LAIN</option>
                        <!-- <input type="text" class="form-control" name="jeniskelamin" placeholder="Laki-laki/Perempuan"> -->
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" placeholder="  " required="required"><?= $row['alamat']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nama_owner">Owner</label>
                        <input type="text" class="form-control" name="nama_owner" placeholder="  " value="<?= $row['nama_owner']; ?>" required="required">
                    </div>
                    <div class="form-group">
                        <label for="nohp">Contact Person</label>
                        <input type="number" class="form-control" name="nohp" placeholder="  " value="<?= $row['nohp']; ?>" required="required">
                    </div>

                    <button type="submit" name="editnasabah" class="btn btn-primary" onclick="return confirm('Simpan perubahan?')">

                    Edit</button>
                    <a href="data-nasabah.php" class="btn btn-warning" onclick="return confirm('Yakin batal edit?')">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</main>

<?php

include 'footer.php';

?>