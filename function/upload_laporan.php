<?php
include('koneksi.php');

// Periksa apakah file diunggah
if (isset($_FILES['laporanAkhir']) && $_FILES['laporanAkhir']['error'] == 0) {
    $userId = mysqli_real_escape_string($conn, $_POST['user_id']);

    // Cek keberadaan user
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE id = '$userId'");
    if (mysqli_num_rows($cek) > 0) {
        $ce = mysqli_fetch_array($cek);
        $nama = $ce['nama'];
        $no_hp = $ce['no_hp'];

        $targetDir = "../Asset/Document/";
        $targetDb = "Asset/Document/";
        $newname = 'laporan_' . $nama;

        $fileName = basename($_FILES["laporanAkhir"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        $targetFile = $targetDir . $newname . $fileType; // Ekstensi diubah menjadi PNG
        $linkdb = $targetDb . $newname . $fileType;

        $allowedTypes = array("pdf", "doc", "docx");
        if (!in_array($fileType, $allowedTypes)) {
            echo "Maaf, harus file PDF, DOC, and DOCX yang dizinkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Maaf, File kamu tidak dapat di upload.";
        } else {
            // Attempt to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["laporanAkhir"]["tmp_name"], $targetFile)) {
                $sql = "UPDATE pengajuan_pkl SET laporan_akhir='$linkdb' WHERE phone=$no_hp";
                if ($conn->query($sql) === TRUE) {
                    echo "Gambar berhasil diunggah dan disimpan.";
                    header('location: ../dashboardpkl.php?status=success&message=File Laporan Berhasil Di Upload');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }



                // Here, you can add code to save file details to a database or perform other actions.
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "User tidak ditemukan.";
    }
} else {
    echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
}

$conn->close();
