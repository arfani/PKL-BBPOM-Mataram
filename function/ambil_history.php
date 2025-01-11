<?php
// Koneksi ke database
require('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil kode_unik dari POST
    $kode_unik = $_POST['kode_unik'] ?? '';

    if (!empty($kode_unik)) {
        // Query database untuk mengambil data berdasarkan kode_unik, diurutkan berdasarkan tanggal terbaru
        $stmt = $conn->prepare("SELECT kode_unik,tanggal, status, keterangan FROM history WHERE kode_unik = ? ORDER BY tanggal DESC");
        $stmt->bind_param("s", $kode_unik);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Kode unik tidak valid']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode tidak valid']);
}
?>
