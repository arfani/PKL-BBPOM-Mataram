<?php
require('../koneksi.php');
require('fpdf/fpdf.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cek apakah data POST diterima
    $nama = isset($_POST['nama']) ? $_POST['nama'] : null;
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
    $no_surat = isset($_POST['no_surat']) ? $_POST['no_surat'] : null;

    $queryPeriode = "SELECT periode FROM pengajuan_pkl WHERE nama = ?";
    $stmtPeriode = $conn->prepare($queryPeriode);
    $stmtPeriode->bind_param('s', $nama);
    $stmtPeriode->execute();
    $resultPeriode = $stmtPeriode->get_result();

    // Ambil nilai periode
    $periode = $resultPeriode->fetch_assoc()['periode'] ?? ' ';
    $stmtPeriode->close();

    // Pisahkan periode menjadi dua bagian
    if ($periode !== ' ') {
        $periodeParts = explode(' - ', $periode);
        $startDate = isset($periodeParts[0]) ? date('d-m-Y', strtotime($periodeParts[0])) : ' ';
        $endDate = isset($periodeParts[1]) ? date('d-m-Y', strtotime($periodeParts[1])) : ' ';
    } else {
        $startDate = ' ';
        $endDate = ' ';
    }

    if ($nama && $user_id) {
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
        $pdf->Cell(0, 8, $no_surat, 0, 1, 'L'); // Nomor sertifikat dinamis

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
        $pdf->Cell(0, 11, $startDate .'           '. $endDate , 0, 1, 'C'); // Tanggal dinamis

        // Output PDF
        $pdf->Output('I', str_replace(' ', '-', $nama) . '.pdf');
        exit;
    } else {
        // Jika data kosong
        echo "<h1>Data Tidak Diterima:</h1>";
        echo "<p>Periksa apakah form mengirimkan data dengan benar.</p>";
    }
} else {
    echo "<h1>Metode tidak valid</h1>";
}
?>
