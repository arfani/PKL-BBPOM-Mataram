<?php
session_start();
include('koneksi.php');


$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
// Pastikan user sudah login

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role != "pkl" && $role != "admin") {
        header('location:' . $urlweb . '/' . $role . '.php');
    }
} else {
    header("Location: " . $urlweb);
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
    if($latitude == NULL || $longitude == NULL){
        $message = 'Lokasi Tidak Ditemukan, silahkan nyalakan GPS';
    } else {
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

                    if ($durasi < $batas_waktu) {
                        $durasi_kerja = new DateTime($durasi);
                        $batas = new DateTime($batas_waktu);
                        $selisih = $durasi_kerja->diff($batas);
                        if ($selisih->h > 0){
                        $kesimpulan = "Waktu Kerja Kurang {$selisih->h} jam {$selisih->i} Menit";
                        } else {
                        $kesimpulan = "Waktu Kerja Kurang {$selisih->i} Menit";
                        }
                    } else {
                        $kesimpulan = "Waktu Kerja Sudah cukup";
                    }
                    
                    // Update waktu_keluar, durasi, dan kesimpulan jika ada record check-in
                    $sql = "UPDATE absensi SET  foto_keluar = ?, latitude_keluar = ?, longitude_keluar = ?, waktu_keluar = ?, durasi = ?, kesimpulan = ? WHERE user_id = ? AND tanggal = ? AND keterangan = 'Masuk' AND foto IS NOT NULL AND waktu_keluar IS NULL ";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssssis",  $foto["name"], $latitude, $longitude, $jam, $durasi, $kesimpulan, $id, $tanggal);
                } else {
                    $message = "Anda harus check-in terlebih dahulu sebelum check-out.";
                }
            }
            // Execute the statement and check the result
            if (isset($stmt)) {
                $result = $stmt->execute();

                if ($result) {
                    $message = "Absensi Telah Disimpan.";
                    header("Location: absensi_pkl.php");
                } else {
                    $message = "Woops! Ada Kesalahan saat menyimpan: " . $conn->error;
                }
            }
        
        } else {
            $message = "Anda Sudah Membuat Absensi Masuk, Silahkan Cek Absensi Anda";
        }
    } else {
        $message = "Upload foto gagal.";
    }
}
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3 mb-5">
<a href="pkl.php" style="margin-bottom:10px;" class="btn btn-primary">Kembali</a>
<br>
    <h2>Form Absensi</h2>

    <?php if ($message): ?>
        <script>
            Swal.fire({
                title: 'Informasi',
                text: '<?php echo $message; ?>',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
        <!-- Nama Lengkap dari Database -->
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" readonly>
        </div>

        <!-- Tanggal Otomatis (Tidak Bisa Diubah) -->
        <div class="form-group">
            <label for="tanggal">Tanggal :</label>
            <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('d-m-Y'); ?>" readonly>
        </div>

        <!-- Keterangan Hadir/Izin/Sakit -->
        <div class="form-group">
            <label for="status">Keterangan:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
            </select>
        </div>

        <!-- Absensi Masuk/Keluar-->
        <div class="form-group">
            <label for="keterangan">Absensi Masuk Atau Keluar</label>
            <select class="form-control" id="keterangan" name="keterangan" required>
                <option value="Masuk">Masuk</option>
                <option value="Keluar">Keluar</option>
            </select>
        </div>

        <!-- Unggah Foto Selfie -->
        <div class="form-group">
            <label for="foto">Foto Selfie Saat Membuat Absen:</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
        </div>

        <!-- Menampilkan Waktu saat user membuat absensi -->
        <div class="form-group">
            <input type="hidden" id="jam" name="jam">
        </div>

        <!-- Geotagging (Latitude & Longitude) -->
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
        <button type="submit" name="submit" class="btn btn-primary">Simpan Absensi</button>
    </form>
    
    <br><a href="absensi_pkl.php" class="btn btn-secondary">Rekap Absensi</a>
    <br><br><a href="pkl.php" class="btn btn-primary">Kembali</a>
</div>

<script>
    // Geolocation API untuk mendapatkan lokasi user
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        // Mengambil latitude dan longitude hingga 3 angka setelah koma
        const latitude = position.coords.latitude.toFixed(3);
        const longitude = position.coords.longitude.toFixed(3);

        // Mengisi nilai ke form input tersembunyi
        document.getElementById('latitude').value = latitude;
        document.getElementById('longitude').value = longitude;
        });
    } else {
        alert("Geolocation tidak didukung di browser ini.");
    }

    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const currentTime = `${hours}:${minutes}:${seconds}`;


        // Simpan waktu di kolom tersembunyi untuk dikirim ke server
        document.getElementById('jam').value = currentTime;
    }

    // Perbarui jam setiap detik
    setInterval(updateClock, 1000);
    updateClock(); // Panggil sekali saat halaman pertama kali dimuat
</script>

</body>
</html>
