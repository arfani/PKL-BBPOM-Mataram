<?php
include('koneksi.php');

// Periksa apakah file diunggah
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['surat_balasan']) && $_FILES['surat_balasan']['error'] == 0) {
    
        $id = $_POST['user_id'];
        $nama = $_POST['nama'];

        $targetDir = "../Asset/Document/";
        $targetDb = "Asset/Document/";
        $newname = 'Surat_Balasan_kunjungan' . $nama;
        
        $fileName = basename($_FILES["surat_balasan"]["name"]);
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
            if (move_uploaded_file($_FILES["surat_balasan"]["tmp_name"], $targetFile)) {
                $sql = "UPDATE kunjungan SET surat_balasan = '$linkdb' WHERE nama = $nama";
                if ($conn->query($sql) === TRUE) {
                    echo "surat balasan berhasil diunggah dan disimpan.";
                    header('location: '.$urlweb.'/admin_tamu.php');
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
