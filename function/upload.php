<?php
include('koneksi.php');

// Periksa apakah file diunggah
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $userId = mysqli_real_escape_string($conn, $_POST['user_id']);

    // Cek keberadaan user
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE id = '$userId'");
    if (mysqli_num_rows($cek) > 0) {
        $ce = mysqli_fetch_array($cek);
        $nama = $ce['nama'];

        // Validasi file upload
        $gbr = $_FILES['profile_picture']['name'];
        $explode = explode('.', $gbr);
        $extensi = strtolower(end($explode));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($extensi, $allowedExtensions)) {
            $targetDir = "../Asset/Gambar/";
            $targetDb = "Asset/Gambar/";
            $newname = 'profile_' . $nama;
            $targetFile = $targetDir . $newname . '.png'; // Ekstensi diubah menjadi PNG
            $linkdb = $targetDb . $newname . '.png';

            // Periksa apakah file adalah gambar
            $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
            if ($check !== false) {
                // Proses konversi ke PNG jika file adalah JPG atau JPEG
                if ($extensi == 'jpg' || $extensi == 'jpeg') {
                    $image = imagecreatefromjpeg($_FILES["profile_picture"]["tmp_name"]);
                    if ($image !== false) {
                        imagepng($image, $targetFile); // Simpan gambar sebagai PNG
                        imagedestroy($image);
                    } else {
                        echo "Terjadi kesalahan saat konversi gambar.";
                        exit;
                    }
                } else {
                    // Jika file sudah dalam format PNG atau lainnya, cukup pindahkan file
                    if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
                        echo "Terjadi kesalahan saat mengunggah gambar.";
                        exit;
                    }
                }

                // Simpan jalur gambar ke database
                $sql = "UPDATE users SET foto='$linkdb' WHERE id=$userId";

                if ($conn->query($sql) === TRUE) {
                    echo "Gambar berhasil diunggah dan disimpan.";
                    header('location: ../dashboardpkl.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "File bukan gambar.";
            }
        } else {
            echo "Ekstensi file tidak diizinkan.";
        }
    } else {
        echo "User tidak ditemukan.";
    }
} else {
    echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
}

$conn->close();
