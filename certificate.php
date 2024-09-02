<?php

require('vendor/fpdf/fpdf.php');
require('vendor/fpdi/src/autoload.php');

use setasign\Fpdi\Fpdi;

include('koneksi.php');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $nama = strtoupper($row['nama']);
    $no_hp = $row['no_hp'];
} else {
    header("Location: index.php");
    exit();
}

$sql1 = "SELECT * FROM pengajuan_pkl WHERE phone ='$no_hp'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$periode = $row1['periode'];

list($tanggalAwal, $tanggalAkhir) = explode(' - ', $periode);

function tanggalIndo($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return (int)$pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

$tanggalSaatIni = tanggalIndo(date('Y-m-d'));

$tanggalAwal = tanggalIndo(date('Y-m-d', strtotime($tanggalAwal)));
$tanggalAkhir = tanggalIndo(date('Y-m-d', strtotime($tanggalAkhir)));

$nomor = '14A.' . date('m') . '.' . date('y') . '.1/PKL/' . $id;

$pdf = new FPDI('L', 'pt', array(842, 595));

$pagecount = $pdf->setSourceFile('sertifikat-fix.pdf');
$tpl = $pdf->importPage(1);
$size = $pdf->getTemplateSize($tpl);

$pdf->AddPage();
$pdf->useTemplate($tpl, 0, 0, 842, 595);

$pdf->AddFont('Amita', '', 'amita-regular.php');
$pdf->AddFont('Poppins-SemiBold', '', 'poppins-semibold.php');
$pdf->AddFont('Poppins-Medium', '', 'poppins-medium.php');

function FitText($pdf, $text, $width, $x, $y, $fontFamily, $fontStyle, $maxFontSize)
{
    $fontSize = $maxFontSize;
    $pdf->SetFont($fontFamily, $fontStyle, $fontSize);
    while ($pdf->GetStringWidth($text) > $width) {
        $fontSize--;
        $pdf->SetFont($fontFamily, $fontStyle, $fontSize);
    }
    $textHeight = $pdf->GetStringWidth($text) * $fontSize / $width;
    $pdf->SetXY($x, $y + 35 - $fontSize);
    $pdf->Cell($width, $fontSize, $text, 0, 0, 'C');
}

FitText($pdf, $nama, 500, 171, 240, 'Poppins-SemiBold', '', 33);

$pdf->SetFont('Poppins-Medium', '', 14);
$pdf->SetXY(252, 366);
$pdf->Cell(141, 15, $tanggalAwal, 0, 0, 'R');

$pdf->SetFont('Poppins-Medium', '', 15);
$pdf->SetXY(449, 366);
$pdf->Cell(141, 15, $tanggalAkhir, 0, 0, 'L');

$pdf->SetFont('Poppins-Medium', '', 15);
$pdf->SetXY(315, 401);
$pdf->Cell(232, 17, 'Mataram, ' . $tanggalSaatIni, 0, 0, 'C');

$pdf->SetFont('Poppins-Medium', '', 14);
$pdf->SetXY(385, 179);
$pdf->Cell(138, 16, $nomor, 0, 0, 'L');

// Nama file dan path folder
$folderPath = './Asset/certificates/';
$fileName = 'sertifikat_' . $nama . '.pdf';
$filePath = $folderPath . $fileName;

// Simpan PDF ke folder
$pdf->Output($filePath, 'F');

// Simpan informasi ke database
$sql2 = "UPDATE pengajuan_pkl SET sertifikat='$filePath' WHERE phone=$no_hp";
if (mysqli_query($conn, $sql2)) {
    // Jika penyimpanan berhasil, arahkan ke file PDF tersebut
    header("Location: " . $filePath);
    exit();
} else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
}
