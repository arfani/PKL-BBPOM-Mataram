<?php
require('../koneksi.php');

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $subject = $conn->real_escape_string($_POST['keperluan']);
    $keterangan = $conn->real_escape_string($_POST['keterangan']);
    $status = $conn->real_escape_string($_POST['status']);
    $tanggal = date('Y-m-d'); // Tanggal saat ini
    $kode_unik = $conn->real_escape_string($_POST['kode_unik']);

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO history ( kode_unik, subject, tanggal, status, keterangan)
            VALUES ('$kode_unik', '$subject', '$tanggal', '$status', '$keterangan')";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
