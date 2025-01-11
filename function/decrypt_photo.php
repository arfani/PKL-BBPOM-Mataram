<?php
require('../koneksi.php');
// Konfigurasi enkripsi
$encryption_key = "your-secret-key"; // Kunci enkripsi harus sama dengan yang digunakan sebelumnya
$iv = "your-initialization-vector"; // IV juga harus sama
$method = "aes-256-cbc"; // Metode enkripsi yang digunakan

// Ambil nama file dari parameter GET
if (isset($_GET['file'])) {
    $file_name = $_GET['file'];
    $file_path = "Asset/Document/Pengaduan/Foto-Identitas/" . $file_name;
    
    $file_path = "Asset/Document/Pengaduan/Foto-Identitas/" . $file_name;

    // Cek apakah file ada
    if (file_exists($file_path)) {
        // Baca konten file terenkripsi
        $encrypted_content = file_get_contents($file_path);

        // Dekripsi konten
        $decrypted_content = openssl_decrypt($encrypted_content, $method, $encryption_key, 0, $iv);

        if ($decrypted_content !== false) {
            // Kirim header untuk menampilkan gambar
            header('Content-Type: image/jpeg'); // Ubah sesuai dengan jenis gambar (jpg/png)
            echo $decrypted_content;
            exit;
        } else {
            die("Gagal mendekripsi file.");
        }
    } else {
        die("File tidak ditemukan.");
    }
} else {
    die("Parameter file tidak ditemukan.");
}
?>
<?php
// Pastikan Anda telah menyertakan library dekripsi dan kunci
require 'encryption_lib.php'; // Ganti dengan file library enkripsi Anda

// Tentukan folder tempat file tersimpan
$encrypted_dir = "Asset/Document/Pengaduan/Encrypted/";

// Ambil parameter file dari URL
if (!empty($_GET['file'])) {
    $file_name = basename($_GET['file']); // Pastikan hanya nama file, bukan path penuh
    $file_path = $encrypted_dir . $file_name;

    // Periksa apakah file ada
    if (file_exists($file_path)) {
        // Baca isi file terenkripsi
        $encrypted_data = file_get_contents($file_path);

        // Dekripsi data
        $decrypted_data = decrypt_data($encrypted_data); // decrypt_data adalah fungsi dekripsi Anda

        // Kirim file ke browser
        header('Content-Type: image/jpeg'); // Sesuaikan dengan jenis file (JPEG, PNG, dll.)
        header('Content-Disposition: inline; filename="' . $file_name . '"');
        echo $decrypted_data;
        exit;
    } else {
        http_response_code(404);
        echo "File tidak ditemukan.";
        exit;
    }
} else {
    http_response_code(400);
    echo "Parameter file tidak valid.";
    exit;
}
?>

