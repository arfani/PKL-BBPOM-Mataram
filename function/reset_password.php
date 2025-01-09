<?php
// Koneksi ke database
include('../koneksi.php'); // Pastikan file koneksi sudah ada

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $user_id = $_POST['user_id'];

    // Validasi input
    if (!empty($user_id)) {
        // Reset password ke default (contoh: "password123")
        $sql_1 = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = 1");
        $s1 = mysqli_fetch_array($sql_1);
        $new_pw = $s1['reset_pw'];
        $hashedPassword =  password_hash($new_pw, PASSWORD_BCRYPT);
        // Update password di database
        $query = "UPDATE users SET password = ? WHERE nama = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $hashedPassword, $nama);

        if ($stmt->execute()) {
            header('location: ../admin.php?status=berhasil');
        } else {
            header('location: ../admin.php?status=gagal');
        }

        $stmt->close();
    } else {
        header('location: ../admin.php?status=gagal');
    }
}

$conn->close();
?>
