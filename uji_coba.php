<?php
session_start();
include('koneksi.php');

// Pastikan user sudah login
if (!isset($_SESSION['id'])) {
    die("Anda harus login terlebih dahulu.");
}

// Ambil id dari session
$id = $_SESSION['id'];

// Query untuk mengambil data user berdasarkan id
$sql = "SELECT id, nama FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Data user tidak ditemukan.");
}

// Variabel untuk error dan success message
$message = '';


if (isset($_POST['submit'])) {
    // Ambil semua data dari form
    $nama = $user['nama']; // Get user's name from session
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];
    $tanggal = date('Y-m-d'); // Automatically set the current date
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $jam = $_POST['jam']; // Automatically set the current time for storage

    // Proses upload foto
    $foto = $_FILES['foto'];
    $target_dir = "Asset/Gambar/";
    $target_file = $target_dir . basename($foto["name"]);

    if (move_uploaded_file($foto["tmp_name"], $target_file)) {
        // Foto berhasil diupload
        // Cek duplikasi absensi
        $sql = "SELECT * FROM absensi WHERE keterangan=? AND nama=? AND tanggal=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $keterangan, $nama, $tanggal);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            if ($keterangan === "Masuk") {
                // Jika Masuk, simpan waktu_masuk
                $sql = "INSERT INTO absensi (user_id, nama, status, keterangan, tanggal, foto, latitude, longitude, waktu_masuk)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("issssssss", $user['id'], $nama, $status, $keterangan, $tanggal, $foto["name"], 
                $latitude, $longitude, $jam);
            } else if ($keterangan === 'Keluar') {
                // Cek apakah ada record check-in untuk user tersebut pada tanggal yang sama
                $sql = "SELECT * FROM absensi WHERE user_id = ? AND tanggal = ? AND keterangan = 'Masuk' AND waktu_keluar IS NULL";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("is", $id, $tanggal);
                $stmt->execute();
                $result = $stmt->get_result();
            
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $waktu_masuk = $row['waktu_masuk'];

                    $datetime1 = new DateTime($waktu_masuk);
                    $datetime2 = new DateTime($jam);
                    $interval = $datetime1->diff($datetime2);
                    $durasi = $interval->format('%H:%I:%S');
                    
                    $batas_waktu = '08:30:00'; // Batas waktu kerja minimum

                    if ($durasi > $batas_waktu) {
                        $durasi = new DateTime($row2['durasi']);
                        $batas = new DateTime($batas_waktu);
                        $selisih = $durasi->diff($batas);
                        if ($selisih->h > 0){
                        $kesimpulan = "Waktu Kerja Kurang {$selisih->h} jam {$selisih->i} Menit";
                        } else {
                        $kesimpulan = "Waktu Kerja Kurang {$selisih->i} Menit";
                        }
                    } else {
                        $kesimpulan = "Waktu Kerja Sudah cukup";
                    }
                    
                    // Update waktu_keluar, durasi, dan kesimpulan jika ada record check-in
                    $sql = "UPDATE absensi SET waktu_keluar = ?, durasi = ?, kesimpulan = ? WHERE user_id = ? AND tanggal = ? AND keterangan = 'Masuk' AND waktu_keluar IS NULL";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssis", $jam, $durasi, $kesimpulan, $id, $tanggal);
                } else {
                    $message = "Anda harus check-in terlebih dahulu sebelum check-out.";
                }
            }

            // Execute the statement and check the result
            if (isset($stmt)) {
                $result = $stmt->execute();

                if ($result) {
                    $message = "Absensi Telah Disimpan.";
                } else {
                    $message = "Woops! Ada Kesalahan saat menyimpan: " . $conn->error;
                }
            }
        } else {
            $message = "Absensi Gagal, Silahkan Cek Kembali!";
        }
    } else {
        $message = "Upload foto gagal.";
    }
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>