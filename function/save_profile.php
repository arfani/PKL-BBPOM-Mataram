<?php
session_start();
include('koneksi.php');
$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['profileName'];
    $email = $_POST['profileEmail'];
    $no_hp = $_POST['profilePhone'];
    $user_id = $_SESSION['id'];
    $redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'pkl.php';

    // Check if email or phone number is already used by another user
    $check_sql = "SELECT * FROM users WHERE (email='$email' OR no_hp='$no_hp') AND id != '$user_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $message = 'Email atau nomor telepon sudah digunakan oleh pengguna lain.';
        header('Location:' . $urlweb . '/' . $redirect . '?status=error&message=' . urlencode($message));
    } else {
        $sql = "UPDATE users SET nama='$nama', email='$email', no_hp='$no_hp' WHERE id='$user_id'";

        if (mysqli_query($conn, $sql)) {
            $update = mysqli_query($conn, "UPDATE pengajuan_pkl SET nama = '$nama' WHERE phone='$no_hp'");
            $message = 'Profil berhasil disimpan.';
            header('Location:' . $urlweb . '/' . $redirect . '?status=success&message=' . urlencode($message));
        } else {
            $message = 'Gagal menyimpan profil: ' . mysqli_error($conn);
            header('Location:' . $urlweb . '/' . $redirect . '?status=error&message=' . urlencode($message));
        }
    }

    mysqli_close($conn);
}
