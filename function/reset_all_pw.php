<?php
require('../koneksi.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil nilai reset_pw dari tabel admin
    $sql_1 = "SELECT reset_pw FROM `admin` WHERE id = 1";
    $result_1 = mysqli_query($conn, $sql_1);

    if ($result_1 && mysqli_num_rows($result_1) > 0) {
        $s1 = mysqli_fetch_assoc($result_1);
        $new_pw = $s1['reset_pw'];
        // Pastikan nilai reset_pw sudah di-hash, jika tidak, hash ulang
        $hashedPassword = password_hash($new_pw, PASSWORD_BCRYPT);
        // Update seluruh kolom password di tabel users
        $sql = "UPDATE `users` SET `password` = '$hashedPassword'";
        if (mysqli_query($conn, $sql)) {
            // Berhasil di-update
            echo "<script>console.log('Berhasil di update');</script>";
            header("Location: ../admin.php?status=success");
            exit();
        } else {
            // Tampilkan pesan kesalahan jika update gagal
            header("Location: ../admin.php?status=fail");
        }
    } else {
        echo "Error: Could not fetch reset password from admin table.";
    }
}
?>