<?php
include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role != "pkl" && $role != "admin") {
        header('location:' . $urlweb . '/' . $role . '.php');
    }
} else {
    header("Location: " . $urlweb);
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $tanggal_hari_ini = date('Y-m-d');
    
    if ($role == "admin") {
        $email = "";
        $nama = "";
        $no_hp = "";
        $status = "";
    } else {
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $nama = $row['nama'];
        $no_hp = $row['no_hp'];
        $status = $row['status'];
        
        // Query untuk mendapatkan waktu_masuk dan waktu_keluar pada tanggal hari ini
        $sql_absensi = "SELECT waktu_masuk, waktu_keluar FROM absensi WHERE user_id = ? AND tanggal = ?";
        $stmt = $conn->prepare($sql_absensi);
        $stmt->bind_param("is", $id, $tanggal_hari_ini);
        $stmt->execute();
        $result_absensi = $stmt->get_result();
        $data_absensi = $result_absensi->fetch_assoc();

        // Ambil waktu_masuk dan waktu_keluar jika tersedia
        $waktu_masuk = $data_absensi['waktu_masuk'] ?? "";
        $waktu_keluar = $data_absensi['waktu_keluar'] ?? "";
    }
} else {
    $email = "";
    $nama = "";
    $no_hp = "";
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="Asset/CSS/style_pkl.css">
    <title>PKL</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .section-title { font-size: 2.5rem; color: #343a40; margin-bottom: 1rem; }
        .section-description { font-size: 1.25rem; color: #6c757d; }
        .bidang-card { border: 1px solid rgba(156, 156, 156, 0.1); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s, box-shadow 0.3s; }
        .bidang-card:hover { transform: translateY(-10px); box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); }
        .card-img-top { border-radius: 10px; height: 200px; object-fit: cover; }
        .card-title { font-size: 1.5rem; color: #007bff; margin-bottom: 0.5rem; }
        .card-text { font-size: 1rem; color: #495057; }
        .clock { font-size: 3rem; font-weight: bold; color: #333; }
        @media (max-width: 768px) { .card-title { font-size: 1.25rem; } .card-text { font-size: 0.875rem; } }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="row align-items-center">
        <div class="col-md-4">
            <div class="row mt-4">
                <div class="card bidang-card">
                    <div class="card-body">
                        <div class="text-center">
                            <label for="jam_masuk">Waktu Masuk</label>
                            <input type="text" id="jam_masuk" readonly 
                                   style="font-size: 1.5rem; border: none; background: transparent; text-align: center;" 
                                   value="<?php echo $waktu_masuk ? $waktu_masuk : ''; ?>">
                            <a href="tambah_absensi.php?keterangan=Masuk" class="btn btn-primary" style="margin:auto">
                                Absen Masuk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="row mt-4">
                <div class="card bidang-card">
                    <div class="card-body">
                        <div class="text-center">
                            <label for="jam_keluar">Waktu Keluar</label>
                            <input type="text" id="jam_keluar" readonly 
                                   style="font-size: 1.5rem; border: none; background: transparent; text-align: center;" 
                                   value="<?php echo $waktu_keluar ? $waktu_keluar : ''; ?>">
                            <a href="tambah_absensi.php?keterangan=Keluar" class="btn btn-primary" style="margin:auto">
                                Absen Keluar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('cs.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script>
// Fungsi untuk update waktu
function updateClock() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const currentTime = `${hours}:${minutes}:${seconds}`;

    // Update waktu_masuk hanya jika belum ada di database
    <?php if (!$waktu_masuk): ?>
        document.getElementById('jam_masuk').value = currentTime;
    <?php endif; ?>
    
    // Update waktu_keluar hanya jika belum ada di database
    <?php if (!$waktu_keluar): ?>
        document.getElementById('jam_keluar').value = currentTime;
    <?php endif; ?>
}

// Jalankan updateClock setiap detik
setInterval(updateClock, 1000);
updateClock(); // Panggil sekali saat halaman pertama kali dimuat

</script>

</body>
</html>
