<?php

require('vendor/fpdf/fpdf.php');
require('vendor/fpdi/src/autoload.php');

use setasign\Fpdi\Fpdi;

include('koneksi.php');
session_start();

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM pkl where id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $nama = $row['nama'];
    $no_hp = $row['no_hp'];
} else {
    $email = "";
    $nama = "";
    $no_hp = "";
    header("Location: index.php");
}
$sql1 = "SELECT * FROM pengajuan_pkl where phone ='$no_hp'";
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


// Buat PDF baru dalam ukuran A4 landscape
$pdf = new FPDI('L', 'pt', array(842, 595)); // A4 landscape in points

// Referensi PDF yang ingin digunakan (gunakan path relatif)
$pagecount = $pdf->setSourceFile('sertifikat4.pdf');

// Impor halaman pertama dari PDF dan tambahkan ke PDF dinamis
$tpl = $pdf->importPage(1);
$size = $pdf->getTemplateSize($tpl);

// Tambahkan halaman baru dengan orientasi landscape
$pdf->AddPage();

// Gunakan halaman yang diimpor sebagai template
$pdf->useTemplate($tpl, 0, 0, 842, 595); // 842pt x 595pt adalah ukuran A4 landscape

// Atur font default yang akan digunakan
$pdf->AddFont('Poppins-SemiBold', '', 'poppins-semibold.php');
$pdf->AddFont('Poppins-Medium', '', 'poppins-medium.php');

// Kotak pertama - Nama pengguna
$pdf->SetFont('Poppins-SemiBold', '', 35); // atur ukuran font ke points
$pdf->SetXY(171, 240); // atur posisi kotak ke points
$pdf->Cell(500, 35, $nama, 0, 0, 'C'); // tambahkan teks, rata tengah

$pdf->SetFont('Poppins-Medium', '', 14);
$pdf->SetXY(252, 366);
$pdf->Cell(141, 15, $tanggalAwal, 0, 0, 'R');

$pdf->SetFont('Poppins-Medium', '', 15);
$pdf->SetXY(449, 366);
$pdf->Cell(141, 15, $tanggalAkhir, 0, 0, 'L');

$pdf->SetFont('Poppins-Medium', '', 15);
$pdf->SetXY(315, 401);
$pdf->Cell(232, 17, 'Mataram, ' . $tanggalSaatIni, 0, 0, 'C');


// Render PDF ke browser
$pdf->Output();
