<?php
include('../koneksi.php');

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
        $processedFileName = str_replace(' ', '_', $newFileName);
        $uploadFileDir = 'Asset/Document/Tamu/';
        $dest_path = $uploadFileDir . $processedFileName;

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
                
                header('location: ../admin_tamu.php?status=success');
            } else {
                header('location: ../admin_tamu.php?status=fail');
            }

            $stmt->close();
        } else {
            header('location: ../admin_tamu.php?status=fail');
        }
    } else {
        header('location: ../admin_tamu.php?status=fail');
    }
} else {
    header('location: ../admin_tamu.php?status=fail');
}

exit; // Digunakan untuk debugging, ganti dengan redirect jika sudah selesai debugging
?>
