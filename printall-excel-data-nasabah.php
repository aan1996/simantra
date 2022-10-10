<!DOCTYPE html>
<html>

<head>
    <title>Data Perusahaan</title>
    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com" />
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Open Sans:400,500,600,700&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans:400,500,600,700&display=swap" media="print" onload="this.media='all'">
</head>

<body data-rsssl=1>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;
        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php

    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data-nasabah.xls");

    ?>

    <body>
        <center>
            <h1>Data Perusahaan</h1>
        </center>
        <table border="1">
            <tr>
                <th>NO</th>
                <th>ID Perusahaan</th>
                <th>Nama Perusahan</th>
                <th>Bidang Usaha</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Tempat Berdiri</th>
                <th>Tanggal Berdiri</th>
                <th>Owner</th>
                <th>No Handphone</th>
            </tr>
            <?php
            require "include/function.php";
            $sql = mysqli_query($link, "SELECT * FROM data-nasabah");
            $no = 1;
            while ($row = mysqli_fetch_array($sql)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['id_perusahaan']; ?></td>
                    <td><?= $row['nama_perusahaan']; ?></td>
                    <td><?= $row['bidang_usaha']; ?></td>
                    <td><?= substr($row['alamat'], 0, 255); ?></td>
                    <td><?= $row['kota']; ?></td>
                    <td><?= $row['tmp_berdiri_perusahaan']; ?></td>
                    <td><?= $row['tgl_berdiri_perusahaan']; ?></td>
                    <td><?= $row['nama_owner']; ?></td>
                    <td><?= $row['nohp']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </body>

</html>