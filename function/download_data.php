<?php
include('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['month'])) {
    $month = $_POST['month'];
    
    // Format month for SQL query
    $formattedMonth = date('Y-m', strtotime($month));

    // Query to get data for the selected month
    $sql = "SELECT tanggal, nama, status, waktu_masuk, foto, latitude, longitude, 
            waktu_keluar, foto_keluar, latitude_keluar, longitude_keluar, durasi, kesimpulan 
            FROM absensi 
            WHERE DATE_FORMAT(tanggal, '%Y-%m') = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $formattedMonth);
    $stmt->execute();
    $result = $stmt->get_result();

    // Set CSV headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data_' . $formattedMonth . '.csv"');

    // Open file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // Write column headers
    fputcsv($output, ['Tanggal', 'Nama', 'Status', 'Jam Masuk', 'Foto Masuk', 'Lat Masuk', 'Long Masuk', 'Jam Keluar', 'Foto Keluar', 'Lat Keluar', 'Long Keluar', 'Total Jam Kerja', 'Kesimpulan']);

    // Write data rows
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [
            $row['tanggal'],
            $row['nama'],
            $row['status'],
            $row['waktu_masuk'],
            $row['foto'],
            $row['latitude'],
            $row['longitude'],
            $row['waktu_keluar'] ?: '-',
            $row['foto_keluar'] ?: '-',
            $row['latitude_keluar'] ?: '-',
            $row['longitude_keluar'] ?: '-',
            $row['durasi'] ?: '-',
            $row['kesimpulan'] ?: '-'
        ]);
    }

    fclose($output);
    exit();
} else {
    echo "Invalid request.";
}
?>
