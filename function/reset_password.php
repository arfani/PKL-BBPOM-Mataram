<?php
// Koneksi ke database
include('../koneksi.php'); // Pastikan file koneksi sudah ada

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $user_id = $_POST['user_id'];

    // Validasi input
    if (!empty($user_id)) {
        // Reset password ke default (contoh: "password123")
        $new_password = '1234';

        // Update password di database
        $query = "UPDATE users SET password = ? WHERE nama = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $new_password, $nama);

        if ($stmt->execute()) {
            echo "<script>alert('Password berhasil direset!'); window.location.href='../admin_pkl.php';</script>";
        } else {
            echo "<script>alert('Gagal mereset password.'); window.location.href='../admin_pkl.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('ID user tidak valid.'); window.location.href='../admin_pkl.php';</script>";
    }
}

$conn->close();
?>
