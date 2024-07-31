<?php
include('koneksi.php');

// Periksa apakah file diunggah
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $userId = $_POST['user_id'];
    $targetDir = "Asset/Gambar/";
    $targetFile = $targetDir . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Periksa apakah file adalah gambar
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        // Pindahkan file ke direktori target
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
            // Simpan jalur gambar ke database
            $sql = "UPDATE pkl SET foto ='$targetFile' WHERE id=$userId";

            if ($conn->query($sql) === TRUE) {
                echo "Gambar berhasil diunggah dan disimpan.";
                header('location: dashboardpkl.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar.";
        }
    } else {
        echo "File bukan gambar.";
    }
} else {
    echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
}

$conn->close();
