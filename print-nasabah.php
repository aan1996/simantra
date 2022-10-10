<?php
include "vendor/tcpdf/tcpdf.php";
include "head.php";
include "foot.php";

date_default_timezone_set("Asia/Jakarta");

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

  //Page header
  public function Header()
  {
    // Logo
    $image_file = 'dist/assets/img/' . 'logomandiri.png';
    $this->Image($image_file, 10, 10, 35, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Set font
    $this->SetFont('helvetica', 'B', 14);
    // Title
    $this->SetX(50);
    $this->Cell(0, 15, 'Bank Mandiri KCP Morowali Bahodopi', 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $this->ln(1);
    $this->SetX(50);
    $this->SetFont('helvetica', 'B', 10);
    $this->Cell(0, 15, 'Jl. Trans Sulawesi, Desa Keurea, Kecamatan Bahodopi, Kabupaten Morowali, Sulawesi Selatan, 94974', 0, false, 'L', 0, '', 0, false, 'T', 'M');
    $this->ln(5);
    $this->SetX(50);
    $this->SetFont('helvetica', 'B', 10);
    $this->Cell(0, 15, 'Website : https://bankmandiri.co.id/', 0, false, 'L', 0, '', 0, false, 'T', 'M');
    $this->ln(5);
  }
}

// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jusman Tamrin');
$pdf->SetTitle('Data Perusahaan');
$pdf->SetSubject('Data Perusahaan');
$pdf->SetKeywords('Data Perusahaan');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->Cell(0, 0.7, '==========================================================================================', 0, 0, 'C');
$pdf->ln(10);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 0.7, 'Laporan Data Perusahaan', 0, 0, 'C');
$pdf->ln(10);
$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->Cell(50, 10, "Print pada : " . date("d/m/Y"), 0, 0, 'C');
$pdf->ln(10);

// Set some content to print
$tbl_header = '<table style="width: 100%; font-family: arial, sans-serif; border-collapse: collapse;" border="1" cellpadding="2" cellspacing="2">
<thead>
      <tr style="text-align: center;">
          <th>NO</th>
          <th colspan="2"ID Perusahaan</th>
          <th colspan="2">Nama Perusahan</th>
          <th colspan="2"Bidang Usaha</th>
          <th colspan="4"Alamat</th>
          <th colspan="2"Kota</th>
          <th colspan="2"Tempat Berdiri</th>
          <th colspan="2"Tanggal Berdiri</th>
          <th colspan="2"Owner</th>
          <th colspan="2"No Handphone</th>         
      </tr>
  </thead>
  <tbody>';
$tbl_footer = '</tbody></table>';
$tbl = '';

$con = mysqli_connect("localhost", "root", "", "aplikasimantra");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = $_GET['id'] ? $_GET['id'] : "";
$result = mysqli_query($con, "SELECT * FROM perusahaan WHERE id='$id'");
$no = 0;
while ($row = mysqli_fetch_array($result)) {
  $id_perusahaan = $row['id_perusahaan'];
  $nama_perusahaan = $row['nama_perusahaan'];
  $bidang_usaha = $row['bidang_usaha'];
  $alamat = $row['alamat'];
  $kota = $row['kota'];
  $tmp_berdiri_perusahaan = $row['tmp_berdiri_perusahaan'];
  $tgl_berdiri_perusahaan = $row['tgl_berdiri_perusahaan'];
  $nama_owner = $row['nama_owner'];
  $nohp = $row['nohp'];
  $no++;

  $tbl .= '<tr style="text-align: left;">
              <td style="text-align: center;">' . $no . '</td>
              <td colspan="2">' . $row['id_perusahaan'] . '</td>
              <td colspan="2">' . $row['nama_perusahaan'] . '</td>
              <td colspan="2">' . $row['bidang_usaha'] . '</td>
              <td colspan="4">' . substr($row['alamat'], 0, 255) . '</td>
              <td colspan="2">' . $row['kota'] . '</td>
              <td colspan="4">' . substr($row['alamat'], 0, 255) . '</td>
              <td colspan="2">' . $row['tmp_berdiri_perusahaan'] . '</td>
              <td colspan="2">' . $row['tgl_berdiri_perusahaan'] . '</td>
              <td colspan="2">' . $row['nama_owner'] . '</td>
              <td colspan="2">' . $row['nohp'] . '</td>
          </tr>';
}

// Print text using writeHTMLCell()
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
$pdf->Cell(260, 0, "Morowali, " . date("d M Y"), 0, 0, 'R');
$pdf->ln(4);
$pdf->Cell(250, 0, "Mengetahui,", 0, 0, 'R');
$pdf->ln(4);
$pdf->Cell(270, 0, "Branch Manager KCP Morowali Bahodopi", 0, 0, 'R');
$pdf->ln(20);
$pdf->Cell(255, 0, "Hari Siswanto", 0, 0, 'R');
$pdf->ln(4);


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('Data_perusahaan.pdf', 'I');
