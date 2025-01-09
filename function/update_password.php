<?php
// Mulai sesi untuk mengambil user ID
include '../koneksi.php';
session_start();

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input dari form
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];
    
    // Validasi input
    if (empty($password) || empty($konfirmasi_password)) {
        echo "Password dan Konfirmasi Password tidak boleh kosong.";
        exit;
    }

    if ($password !== $konfirmasi_password) {
        echo "Password tidak cocok. Silakan coba lagi.";
        exit;
    }

    // Hash password baru
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Ambil user ID dari session
    $user_id = $_SESSION['id']; // Sesuaikan dengan nama session Anda

    // Update password ke tabel users
    $sql = "UPDATE users SET password = '$hashed_password' WHERE id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Password berhasil diperbarui.";
        // Redirect ke halaman lain setelah sukses
        header("Location: ../pkl.php");
    } else {
        echo "Error: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
}
?>
