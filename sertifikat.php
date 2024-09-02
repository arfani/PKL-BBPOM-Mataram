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
    $email = "";
    $nama = "";
    $no_hp = "";
    header("Location: index.php");
    exit();
}

$sql1 = "SELECT * FROM pengajuan_pkl WHERE phone ='$no_hp'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$periode = $row1['periode'];

// Pisahkan tanggal awal dan akhir
list($tanggalAwal, $tanggalAkhir) = explode(' - ', $periode);

// Fungsi untuk format tanggal dalam Bahasa Indonesia
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

// Mendapatkan tanggal saat ini
$tanggalSaatIni = tanggalIndo(date('Y-m-d'));

// Konversi ke format yang diinginkan jika perlu
$tanggalAwal = tanggalIndo(date('Y-m-d', strtotime($tanggalAwal)));
$tanggalAkhir = tanggalIndo(date('Y-m-d', strtotime($tanggalAkhir)));

$nomor = '14A.' . date('m') . '.' . date('y') . '.1/PKL/' . $id;

// Buat PDF baru dalam ukuran A4 landscape
$pdf = new FPDI('L', 'pt', array(842, 595)); // A4 landscape in points

// Referensi PDF yang ingin digunakan (gunakan path relatif)
$pagecount = $pdf->setSourceFile('sertifikat-fix.pdf');

// Impor halaman pertama dari PDF dan tambahkan ke PDF dinamis
$tpl = $pdf->importPage(1);
$size = $pdf->getTemplateSize($tpl);

// Tambahkan halaman baru dengan orientasi landscape
$pdf->AddPage();

// Gunakan halaman yang diimpor sebagai template
$pdf->useTemplate($tpl, 0, 0, 842, 595); // 842pt x 595pt adalah ukuran A4 landscape

// Atur font default yang akan digunakan
$pdf->AddFont('Amita', '', 'amita-regular.php');
$pdf->AddFont('Poppins-SemiBold', '', 'poppins-semibold.php');
$pdf->AddFont('Poppins-Medium', '', 'poppins-medium.php');

// Fungsi untuk menyesuaikan ukuran font agar teks pas di dalam lebar tertentu dan vertikal align ke bawah
function FitText($pdf, $text, $width, $x, $y, $fontFamily, $fontStyle, $maxFontSize)
{
    $fontSize = $maxFontSize;
    $pdf->SetFont($fontFamily, $fontStyle, $fontSize);
    while ($pdf->GetStringWidth($text) > $width) {
        $fontSize--;
        $pdf->SetFont($fontFamily, $fontStyle, $fontSize);
    }
    // Menghitung tinggi teks
    $textHeight = $pdf->GetStringWidth($text) * $fontSize / $width;
    // Menyesuaikan posisi Y untuk vertikal align ke bawah
    $pdf->SetXY($x, $y + 35 - $fontSize); // 35 adalah tinggi kotak, disesuaikan dengan tinggi font
    $pdf->Cell($width, $fontSize, $text, 0, 0, 'C');
}

// Kotak pertama - Nama pengguna
FitText($pdf, $nama, 500, 171, 240, 'Poppins-SemiBold', '', 33);

// Tanggal Awal
$pdf->SetFont('Poppins-Medium', '', 14);
$pdf->SetXY(252, 366);
$pdf->Cell(141, 15, $tanggalAwal, 0, 0, 'R');

// Tanggal Akhir
$pdf->SetFont('Poppins-Medium', '', 15);
$pdf->SetXY(449, 366);
$pdf->Cell(141, 15, $tanggalAkhir, 0, 0, 'L');

// Tanggal saat ini
$pdf->SetFont('Poppins-Medium', '', 15);
$pdf->SetXY(315, 401);
$pdf->Cell(232, 17, 'Mataram, ' . $tanggalSaatIni, 0, 0, 'C');

// Nomor
$pdf->SetFont('Poppins-Medium', '', 14);
$pdf->SetXY(385, 179);
$pdf->Cell(138, 16, $nomor, 0, 0, 'L');

// Render PDF ke browser
$pdf->Output();
