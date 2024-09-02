<?php
include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

// Pastikan pengguna telah login
if (!isset($_POST['user_id'])) {
    header("Location: $urlweb");
    exit();
}

// Ambil ID pengguna dari sesi
$userId = $_POST['user_id'];

// Ambil nama pengguna dari database
$sql = "SELECT nama FROM users WHERE id='$userId'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama'];
} else {
    echo "Error fetching user data: " . mysqli_error($conn);
    exit();
}

// Tentukan direktori tujuan untuk menyimpan file
$targetDir = "../Asset/Bukti/";
$targetFile = $targetDir . 'bukti_' . $nama . '/';
if (!is_dir($targetFile)) {
    mkdir($targetFile, 0777, true); // Buat folder jika belum ada
}

// Periksa apakah file diunggah
if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] == 0) {
    $fileName = basename($_FILES['bukti']['name']);
    $filePath = $targetFile . $fileName;
    $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $newName = 'bukti_' . $nama . '.' . $fileType;
    $file = $targetDir . $newName;
    // Validasi jenis file jika diperlukan (misalnya, hanya gambar)
    if ($fileType != "png" && $fileType != "jpg" && $fileType != "jpeg" && $fileType != "gif") {
        echo "Hanya file gambar yang diperbolehkan.";
        exit();
    }

    // Pindahkan file ke direktori tujuan
    if (move_uploaded_file($_FILES['bukti']['tmp_name'], $file)) {
        // Berhasil diunggah, arahkan ke certificate.php   
        header("Location: $urlweb/certificate.php");
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
} else {
    echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
}

mysqli_close($conn);