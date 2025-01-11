<?php
// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('../koneksi.php');

// Periksa apakah data dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil kode_unik dan status dari request
    $kode_unik = $conn->real_escape_string($_POST['kode_unik']);
    $status = $conn->real_escape_string($_POST['status']);

    // Query untuk menghapus data
    $query = "DELETE FROM history WHERE kode_unik = '$kode_unik' AND status = '$status'";
    if ($conn->query($query)) {
        echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menghapus data']);
    }
}
