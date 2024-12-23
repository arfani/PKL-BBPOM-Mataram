<?php
// Pastikan koneksi ke database sudah dilakukan
include '../koneksi.php'; // Ganti dengan file koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil nilai dari formulir
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Menyiapkan query untuk memperbarui status kunjungan
    $query = "UPDATE kunjungan SET status_kunjungan = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id); // "si" berarti string dan integer

    // Eksekusi query
    if ($stmt->execute()) {
        // Jika berhasil, arahkan kembali dengan SweetAlert
        echo "<script>
                swal({
                    title: 'Berhasil!',
                    text: 'Status kunjungan berhasil diperbarui.',
                    type: 'success'
                }).then(function() {
                    window.location.href = '../admin_tamu.php'; // Ganti dengan path halaman sebelumnya
                });
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>