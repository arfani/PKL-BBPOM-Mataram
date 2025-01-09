<?php
require('fpdf/fpdf.php');
require('../koneksi.php');

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

$nama = $_POST['nama'];

// Buat instance FPDF
$pdf = new FPDF('L', 'mm', 'A4'); // Format Landscape, ukuran mm, A4
$pdf->AddPage();

// Gunakan gambar sebagai latar belakang
$template = '../sertifikat-fix.jpg'; // Path ke file JPG Anda
$pdf->Image($template, 0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight());
$pageWidth = $pdf->GetPageWidth();
// Tambahkan teks dinamis di atas template
$pdf->SetFont('Arial', 'B', 16);

// Nomor Sertifikat
$pdf->SetXY(135, 62); // Koordinat X dan Y
$pdf->Cell(0, 8, '123', 0, 1, 'L'); // Nomor sertifikat dinamis

// Nama Peserta
$pdf->SetFont('Arial', 'B', 20);
$text = $nama;
$textWidth = $pdf->GetStringWidth($text);
$xNama = ($pageWidth - $textWidth) / 2;

// Posisi Y
$yNama = 85; // Tetap pada posisi Y tertentu

// Set posisi dan tulis teks
$pdf->SetXY($xNama, $yNama);
$pdf->Cell($textWidth, 10, $text, 0, 1, 'C');

// Tanggal Mulai - Selesai
$pdf->SetFont('Arial', '', 14);
$pdf->SetXY(10, 126);
$pdf->Cell(0, 11, '01 Januari 2023           31 Januari 2023', 0, 1, 'C'); // Tanggal dinamis

// Output PDF
$pdf->Output('I', 'Sertifikat_' . str_replace(' ', '-', $nama) . '.pdf');
exit;
?>
