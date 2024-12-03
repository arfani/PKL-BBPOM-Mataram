<?php
session_start();
require('../koneksi.php'); // File koneksi database
require('fpdf/fpdf.php'); // Pastikan FPDF sudah tersedia

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Periksa apakah user sudah login dan nilai nama dikirimkan
$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

// Ambil nama dari POST
$userName = $_POST['nama'];


// Ambil periode dari tabel pengajuan_pkl
$queryPeriode = "SELECT periode FROM pengajuan_pkl WHERE nama = ?";
$stmtPeriode = $conn->prepare($queryPeriode);
$stmtPeriode->bind_param('s', $userName);
$stmtPeriode->execute();
$resultPeriode = $stmtPeriode->get_result();
$periode = $resultPeriode->fetch_assoc()['periode'] ?? 'Tidak ada periode';
$stmtPeriode->close();

$sql = "SELECT COUNT(*) as jumlah FROM absensi WHERE nama = '$userName' AND status = 'hadir'";
$result = mysqli_query($conn, $sql);
$hadir = mysqli_fetch_assoc($result)['jumlah'];

$sql = "SELECT COUNT(*) as jumlah FROM absensi WHERE nama = '$userName' AND status = 'sakit'";
$result = mysqli_query($conn, $sql);
$sakit = mysqli_fetch_assoc($result)['jumlah'];

$sql = "SELECT COUNT(*) as jumlah FROM absensi WHERE nama = '$userName' AND status = 'izin'";
$result = mysqli_query($conn, $sql);
$izin = mysqli_fetch_assoc($result)['jumlah'];

$queryProdi = "SELECT department FROM pengajuan_pkl WHERE nama = ?";
$stmtProdi = $conn->prepare($queryProdi);
$stmtProdi->bind_param('s', $userName);
$stmtProdi->execute();
$resultProdi = $stmtProdi->get_result();
$Prodi = $resultProdi->fetch_assoc()['department'] ?? '-';
$stmtProdi->close();

$queryUniversitas = "SELECT university FROM pengajuan_pkl WHERE nama = ?";
$stmtUniversitas = $conn->prepare($queryUniversitas);
$stmtUniversitas->bind_param('s', $userName);
$stmtUniversitas->execute();
$resultUniversitas = $stmtUniversitas->get_result();
$Universitas = $resultUniversitas->fetch_assoc()['university'] ?? '-';
$stmtUniversitas->close();


// Query untuk mengambil data absensi user berdasarkan nama
$query = "SELECT id, nama, status, keterangan, tanggal, foto, foto_keluar, latitude, latitude_keluar, longitude, longitude_keluar, waktu_masuk, waktu_keluar, durasi, kesimpulan 
          FROM absensi 
          WHERE nama = ? 
          ORDER BY tanggal ASC";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $userName);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();

// Jika data kosong
if (empty($data)) {
    die('Tidak ada data absensi tersedia.');
}

// Buat PDF menggunakan FPDF
$pdf = new FPDF('L', 'mm', 'Legal'); // Landscape, mm unit, Legal size
$pdf->AddPage();

// Lebar halaman PDF
$pageWidth = $pdf->GetPageWidth();

// Tambahkan gambar di tengah atas halaman
$logoWidth = 40; // Sesuaikan lebar logo
$xPos = ($pageWidth - $logoWidth) / 2; // Hitung posisi X agar logo berada di tengah
$pdf->Image('../Asset/Gambar/bpom.png', $xPos, 10, $logoWidth); // Parameter: (file, x, y, width)
$pdf->SetY(50); // Pindahkan posisi Y setelah gambar selesai

// Header
$pdf->SetFont('Times', 'B', 30);
$pdf->Cell(0, 10, "REKAP DATA ABSENSI", 0, 1, 'C');
$pdf->Ln(3);

$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 10, "Nama: " . $userName, 0, 1, 'L');
$pdf->Ln(0);

// Tampilkan periode
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 10, "Periode PKL: " . $periode, 0, 1, 'L');
$pdf->Ln(0);

$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 10, "Universitas: " . $Universitas, 0, 1, 'L');
$pdf->Ln(0);

$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 10, "Program Studi: " . $Prodi, 0, 1, 'L');
$pdf->Ln(0);


// Tabel Absensi
$pdf->SetFont('Times', 'B', 12);
$pdf->SetFillColor(173, 216, 230);
$headers = [
    'ID', 'Tanggal', 'Status', 'Keterangan', 
    'Waktu Masuk', 'Lat & Long Masuk', 'Waktu Keluar', 'Lat & Long Keluar', 'Durasi', 'Kesimpulan/Alasan'
];

// Lebar kolom untuk setiap header
$widths = [10, 30, 20, 30, 30, 40, 30, 40, 30, 80];

// Tulis header tabel
foreach ($headers as $i => $header) {
    $pdf->Cell($widths[$i], 10, $header, 1, 0, 'C', true);
}
$pdf->Ln();

// Isi tabel
$pdf->SetFont('Times', '', 12);
$no = 1;
foreach ($data as $entry) {
    // Warna background berdasarkan status
    if ($entry['status'] === 'izin') {
        $pdf->SetFillColor(255, 255, 0); // Kuning
    } elseif ($entry['status'] === 'sakit') {
        $pdf->SetFillColor(255, 0, 0); // Merah
    } else {
        $pdf->SetFillColor(0, 255, 0); // Putih (default)
    }

    $pdf->Cell($widths[0], 10, $no, 1, 0, 'C');
    $pdf->Cell($widths[1], 10, $entry['tanggal'], 1, 0, 'C');
    $pdf->Cell($widths[2], 10, ucfirst($entry['status']), 1, 0, 'C', true);
    $pdf->Cell($widths[3], 10, $entry['keterangan'] ?: '-', 1, 0, 'C');
    $pdf->Cell($widths[4], 10, $entry['waktu_masuk'], 1, 0, 'C');
    $pdf->Cell($widths[5], 10, round($entry['latitude'], 3). ' & ' . round($entry['longitude'], 3), 1, 0, 'C');
    $pdf->Cell($widths[6], 10, $entry['waktu_keluar'] ?: '-', 1, 0, 'C');
    $pdf->Cell($widths[7], 10, round($entry['latitude_keluar'], 3) . ' & ' . round($entry['longitude_keluar'], 3), 1, 0, 'C');
    $pdf->Cell($widths[8], 10, $entry['durasi'] ?: '-', 1, 0, 'C');
    $x = $pdf->GetX(); // Posisi X sebelum MultiCell
    $y = $pdf->GetY(); // Posisi Y sebelum MultiCell
    $pdf->MultiCell($widths[9], 10, $entry['kesimpulan'] ?: '-', 1, 'L');
    $pdf->SetXY($x + $widths[9], $y); // Kembali ke posisi X setelah MultiCell
    $pdf->Ln();
    $no++;
}

// Tambahkan keterangan warna di bagian bawah
$pdf->Ln(1);
$pdf->SetFont('Times', 'I', 12);
$pdf->Cell(0, 10, "Latitude & Longitude Kantor : -8.588 & 116.116", 0, 1, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 10, "Keterangan:", 0, 1, 'L');
$pdf->SetFillColor(0, 255, 0); // Hijau
$pdf->Cell(20, 10, '', 1, 0, 'C', true);
$pdf->Cell(50, 10, '  Hadir: ' . $hadir, 0, 1, 'L');
$pdf->SetFillColor(255, 255, 0); // Kuning
$pdf->Cell(20, 10, '', 1, 0, 'C', true);
$pdf->Cell(50, 10, '  izin: ' . $izin, 0, 1, 'L');
$pdf->SetFillColor(255, 0, 0); // Merah
$pdf->Cell(20, 10, '', 1, 0, 'C', true);
$pdf->Cell(50, 10, '  sakit: ' . $sakit, 0, 1, 'L');
// Unduh PDF
$ttdValue = $ttdAbsensi ?: 'TTD'; // Gunakan value jika ada, atau "TTD" jika kosong
    $pdf->Cell($widths[10], 10, $ttdValue, 1, 0, 'C');

$pdf->Output('D', 'Rekap_Absensi_' . str_replace(' ', '_', $userName) . '.pdf');
exit;
?>
