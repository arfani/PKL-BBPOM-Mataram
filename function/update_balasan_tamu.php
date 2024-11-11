<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Ambil nama pengguna dari database berdasarkan id pengajuan
    $sql_nama = "SELECT nama FROM kunjungan WHERE id = ?";
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
    if (isset($_FILES['surat_balasan']) && $_FILES['surat_balasan']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['surat_balasan']['tmp_name'];
        $fileName = $_FILES['surat_balasan']['name'];
        $fileSize = $_FILES['surat_balasan']['size'];
        $fileType = $_FILES['surat_balasan']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = 'surat_balasan_' . $nama . '.' . $fileExtension;

        $uploadFileDir = './Asset/Document/kunjungan/';
        $dest_path = $uploadFileDir . $newFileName;

        // Periksa apakah direktori upload ada
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }

        // Pindahkan file yang diunggah ke server
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            // Perbarui database
            $sql = "UPDATE kunjungan SET surat_balasan = ? WHERE id = ?";
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

echo $message; // Digunakan untuk debugging, ganti dengan redirect jika sudah selesai debugging
?>
