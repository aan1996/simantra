<?php

include 'header.php';
require_once 'include/auth.php';
require "include/function.php";

$sql = mysqli_query($link, "SELECT * FROM nasabahmenunggak ORDER BY id DESC");
if (isset($_POST['searchnasabahmenunggak'])) {
  $sql = carinasabahmenunggak($_POST['carinasabahmenunggak']);
}

?>

<main>
  <div class="container-fluid">
    <h1 class="mt-4">Status Pengajuan</h1>
    <div class="card mb-4">
      <div class="card-header">Tabel
        <form class="form-inline my-2 my-lg-0 float-right" method="post">
          <input class="form-control mr-sm-2" type="search" name="carinasabahmenunggak" placeholder="Cari">
          <button class="btn btn-outline-success mr-sm-2" type="submit" name="searchnasabahmenunggak">Cari</button>
          <a href="data-nasabah-menunggak.php" class="btn btn-danger mr-sm-2">Reset</a>
          <a href="tambah-data-nasabah-menunggak.php" class="btn btn-primary mr-sm-2">Tambah Data</a>
          <!-- <a href="printall-nasabah-menunggak.php" class="btn btn-success" target="_blank">Print Semua</a> -->
        </form>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-sm table-hover table-bordered">
          <thead>
            <tr>
              <th>NO</th>
              <th>Nama Nasabah</th>
              <th>Nomor HP</th>
              <th>Alamat</th>
              <th>Nomor Rekening</th>
              <th>Pinjaman</th>
              <th>Angsuran</th>
              <th>Tanggal Jatuh Tempo</th>
              <!-- <th>Sisa Waktu</th> -->
              <th>Jumlah Menunggak</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php
            foreach ($sql as $row) :
              $tempo = new DateTime($row['tgljatuhtempo']);
              $sekarang = new DateTime();
              $diff = $sekarang->diff($tempo);
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['nohp']; ?></td>
                <td><?= substr($row['alamat'], 0, 255); ?></td>
                <td><?= $row['norekening']; ?></td>
                <td>Rp.<?= number_format($row['pinjaman'], 0, ',', '.'); ?></td>
                <td><?= $row['angsuran']; ?></td>
                <td><?= $row['tgljatuhtempo']; ?></td>
                <!-- <td> //$diff->y . " Tahun, ", $diff->m . " Bulan, ", $diff->d . " Hari"; </td> -->
                <td>Rp.<?= number_format($row['jumlahmenunggak'], 0, ',', '.'); ?></td>
                <td>
                  <div class="btn-group">
                    <a href="edit-data-nasabah-menunggak.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="hapus-data-nasabah-menunggak.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    <a href="print-nasabah-menunggak.php?id=<?= $row['id']; ?>" class="btn btn-success" target="_blank">Print</a>
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