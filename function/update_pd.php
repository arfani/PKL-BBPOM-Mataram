<?php
// Memeriksa apakah parameter 'nama' ada di query string
if (isset($_GET['nama'])) {
    // Mengambil nilai dari query string dan mendeklarasikannya sebagai variabel
    $nama = $_GET['nama'];

    // Menampilkan nilai untuk verifikasi
    echo "Nama yang diterima: " . htmlspecialchars($nama);
} else {
    echo "Tidak ada nama yang diterima.";
}
?>