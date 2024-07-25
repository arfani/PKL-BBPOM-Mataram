<?php
require('vendor/fpdf/fpdf.php');
require('vendor/fpdi/src/autoload.php');

use setasign\Fpdi\Fpdi;

include('koneksi.php');

// Ambil data user dari database
$sql = "SELECT * FROM pkl";
$result = $conn->query($sql);

// Fungsi untuk membuat sertifikat PDF
function createCertificate($name)
{
    $pdf = new FPDI();

    // Tambahkan halaman dari template PDF
    $pdf->AddPage();
    $pdf->setSourceFile('../Asset/Document/struk_INV1356902PAY.pdf');
    $tplIdx = $pdf->importPage(1);
    $pdf->useTemplate($tplIdx);

    // Atur font dan warna teks
    $pdf->SetFont('Arial', 'B', 24);
    $pdf->SetTextColor(0, 0, 0);

    // Tentukan posisi teks
    $pdf->SetXY(50, 100);
    $pdf->Cell(0, 10, $name, 0, 1, 'C');

    // Menyimpan file PDF
    $filename = 'certificates/' . $name . '.pdf';
    $pdf->Output('F', $filename);
}

// Buat folder untuk menyimpan sertifikat jika belum ada
if (!file_exists('certificates')) {
    mkdir('certificates', 0777, true);
}

// Loop melalui hasil query dan buat sertifikat untuk setiap user
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        createCertificate($row['nama']);
    }
} else {
    echo "0 results";
}

$conn->close();
