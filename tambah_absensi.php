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
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];
    $tanggal = $_POST['tanggal'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $jam = $_POST['jam'];

    // Proses upload foto
    $foto = $_FILES['foto'];
    $target_dir = "Asset/Gambar/";
    $target_file = $target_dir . basename($foto["name"]);

    if (move_uploaded_file($foto["tmp_name"], $target_file)) {
        // Foto berhasil diupload
        // Cek duplikasi absensi
        $sql = "SELECT * FROM absensi WHERE keterangan=? AND nama=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $keterangan, $nama);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Simpan absensi ke database
            $sql = "INSERT INTO absensi (user_id, nama, status, keterangan, tanggal, foto, latitude, longitude, jam)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issssssss", $user['id'], $nama, $status, $keterangan, $tanggal, $foto["name"], $latitude, $longitude, $jam);
            $result = $stmt->execute();

            if ($result) {
                $message = "Absensi Telah Disimpan.";
            } else {
                $message = "Woops! Ada Kesalahan saat menyimpan.";
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
<br><br><a href="pkl.php" class="btn btn-success">Kembali</a>
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
            <label for="keterangan">Masuk Atau Keluar</label>
            <select class="form-control" id="keterangan" name="keterangan" required>
                <option value="Masuk">Masuk</option>
                <option value="izin">Keluar</option>
            </select>
        </div>

        <!-- Unggah Foto Selfie -->
        <div class="form-group">
            <label for="foto">Foto Selfie:</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
        </div>

        <!-- Tanggal Otomatis (Tidak Bisa Diubah) -->
        <div class="form-group">
            <label for="tanggal">Tanggal :</label>
            <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" readonly>
        </div>

        <!-- Menampilkan Waktu saat user membuat absensi -->
        <div class="form-group">
            <label for="jam">Jam:</label>
            <input type="text" class="form-control" id="jam_tampil" name="jam_tampil" readonly>
            <input type="hidden" id="jam" name="jam">
        </div>

        <!-- Geotagging (Latitude & Longitude) -->
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">

        <button type="submit" name="submit" class="btn btn-success">Simpan Absensi</button>
    </form>
    
    <br><a href="absensi_pkl.php" class="btn btn-success">Rekap Absensi</a>
    <br><br><a href="pkl.php" class="btn btn-success">Kembali</a>
</div>

<script>
    // Geolocation API untuk mendapatkan lokasi user
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
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

        // Tampilkan waktu di kolom "Jam" untuk tampilan
        document.getElementById('jam_tampil').value = currentTime;

        // Simpan waktu di kolom tersembunyi untuk dikirim ke server
        document.getElementById('jam').value = currentTime;
    }

    // Perbarui jam setiap detik
    setInterval(updateClock, 1000);
    updateClock(); // Panggil sekali saat halaman pertama kali dimuat
</script>

</body>
</html>
