<?php

include 'header.php';
require_once 'include/auth.php';
require "include/function.php";

$sql = mysqli_query($link, "SELECT * FROM perusahaan ORDER by id DESC");
if (isset($_POST['searchnasabah'])) {
  $sql = carinasabah($_POST['carinasabah']);
}

?>

<main>
  <div class="container-fluid">
    <h1 class="mt-4">Data Perusahaan</h1>
    <div class="card mb-4">
      <div class="card-header">Tabel
        <form class="form-inline my-2 my-lg-0 float-right" method="post">
          <input class="form-control mr-sm-2" type="search" name="carinasabah" placeholder="Cari">
          <button class="btn btn-outline-success mr-sm-2" type="submit" name="searchnasabah">Cari</button>
          <a href="data-nasabah.php" class="btn btn-danger mr-sm-2">Reset</a>
          <a href="tambah-data-nasabah.php" class="btn btn-primary mr-sm-2">Tambah Data</a>
          <!-- <a href="printall-perusahaan.php" class="btn btn-success" target="_blank">Print Semua</a> -->
        </form>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-sm table-hover table-bordered">
          <thead>
            <tr>
              <th scope="col">NO</th>
              <th scope="col">ID</th>
              <th scope="col">CIF</th>
              <th scope="col">Jenis Usaha</th>
              <th scope="col">Nama</th>
              <th scope="col">Debitur/Non Debitur</th>
              <th scope="col">Segment</th>
              <th scope="col">Region</th>
              <th scope="col">Alamat</th>
              <th scope="col">Owner</th>
              <th scope="col">Contact Person</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($sql as $row) : ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $row['id_perusahaan']; ?></td>
                <td><?= $row['cif']; ?></td>
                <td><?= $row['jenis_usaha']; ?></td>
                <td><?= $row['nama_perusahaan']; ?></td>
                <td><?= $row['debitur']; ?></td>
                <td><?= $row['segment']; ?></td>
                <td><?= $row['region']; ?></td>
                <td><?= substr($row['alamat'], 0, 255); ?></td>
                <td><?= $row['nama_owner']; ?></td>
                <td><?= $row['nohp']; ?></td>
                <td>
                  <div class="btn-group">
                    <a href="edit-data-nasabah.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="hapus-data-nasabah.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                  </div>
                </td>
              </tr>
              <?php $no++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</main>

<?php

include 'footer.php';

?>