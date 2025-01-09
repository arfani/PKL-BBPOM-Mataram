<?php
include('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_pengajuan'];

    // Ambil nama pengguna dari database berdasarkan id pengajuan
    $sql_nama = "SELECT nama FROM pengajuan_pkl WHERE id_pengajuan = ?";
    $stmt_nama = $conn->prepare($sql_nama);
    $stmt_nama->bind_param('i', $id);
    $stmt_nama->execute();
    $stmt_nama->bind_result($nama);
    $stmt_nama->fetch();
    $stmt_nama->close();

    // Jika $nama tidak ditemukan, hentikan proses
    if (!$nama) {
        die("Nama pengguna tidak ditemukan untuk ID: $id");
    }

    // Periksa apakah file diunggah
    if (isset($_FILES['sertifikat']) && $_FILES['sertifikat']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['sertifikat']['tmp_name'];
        $fileName = $_FILES['sertifikat']['name'];
        $fileSize = $_FILES['sertifikat']['size'];
        $fileType = $_FILES['sertifikat']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = 'Sertifikat_' . $nama . '.' . $fileExtension;
        $processedFileName = str_replace(' ', '_', $newFileName);
        $uploadFileDir = '../Asset/Dokumen/Sertifikat/';
        $dest_path = $uploadFileDir . $processedFileName;

        // Periksa apakah direktori upload ada
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }

        // Pindahkan file yang diunggah ke server
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Perbarui database
            $sql = "UPDATE pengajuan_pkl SET sertifikat = ? WHERE id_pengajuan = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $dest_path, $id);

            if ($stmt->execute()) {
                $message = 'File berhasil diunggah dan database berhasil diperbarui.';
            } else {
                $message = 'Terjadi kesalahan saat memperbarui database: ' . $conn->error;
            }

            $stmt->close();
        } else {
            $message = 'Terjadi kesalahan saat memindahkan file ke direktori upload.';
        }
    } else {
        $message = 'File tidak valid atau terjadi kesalahan dalam pengunggahan. Silakan periksa file dan coba lagi.';
    }
} else {
    $message = 'Metode permintaan tidak valid.';
}

exit; // Digunakan untuk debugging, ganti dengan redirect jika sudah selesai debugging
?>
