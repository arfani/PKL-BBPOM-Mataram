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
        $foto = $row['foto'] ?? '';

    // Query ke tabel pengajuan_pkl untuk data tambahan
    $sql2 = "SELECT * FROM pengajuan_pkl WHERE phone = '$no_hp'";
    $result2 = mysqli_query($conn, $sql2);

    if ($result2 && mysqli_num_rows($result2) > 0) {
        $row2 = mysqli_fetch_assoc($result2);

        // Menginisialisasi variabel dari tabel pengajuan_pkl dengan nilai default jika tidak ada data
        $periode = $row2['periode'] ?? '';
        $penempatan = $row2['penempatan'] ?? '';
        $universitas = $row2['university'] ?? '';
        $jurusan = $row2['department'] ?? '';
        $surat_balasan = $row2['surat_balasan'] ?? '';
        $laporanAkhir = $row2['laporan_akhir'] ?? '';
        $sertifikat = $row2['sertifikat'] ?? '';
        
        // Memproses data periode jika ada
        if ($periode) {
            // Pisahkan start_date dan end_date
            list($start_date, $end_date) = explode(' - ', $periode);
            $current_date = new DateTime();
            $start_date = new DateTime($start_date);
            $end_date = new DateTime($end_date);

            // Hitung hari yang telah berlalu, total hari, dan hari tersisa
            if ($current_date < $start_date) {
                $days_elapsed = 0;
                $total_days = $start_date->diff($end_date)->days;
                $days_left = $total_days;
                $status_pkl = "Belum Mulai";
            } elseif ($current_date > $end_date) {
                $days_elapsed = $start_date->diff($end_date)->days;
                $total_days = $start_date->diff($end_date)->days;
                $days_left = 0;
                $status_pkl = "PKL Sudah Selesai";
            } else {
                $days_elapsed = $start_date->diff($current_date)->days;
                $total_days = $start_date->diff($end_date)->days;
                $days_left = $total_days - $days_elapsed;
                if($days_left < 10){
                    $status_pkl = "$days_elapsed hari berjalan - tersisa $days_left hari";
                } else {
                    $status_pkl = "$days_elapsed hari berjalan";
                }
                
            }
        } else {
            // Jika periode kosong
            $status_pkl = "Periode PKL tidak tersedia";
            $days_elapsed = 0;
            $total_days = 0;
            $days_left = 0;
        }
    } else if($result2 && mysqli_num_rows($result2) == 0){
        // Jika data tidak ditemukan di tabel pengajuan_pkl
        $status_pkl = "Data pengajuan PKL tidak ditemukan";
        $periode = '';
        $penempatan = '';
        $universitas = '';
        $jurusan = '';
        $surat_balasan = '';
        $laporanAkhir = '';
        $sertifikat = '';
        echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Belum Lengkap',
                    text: 'Data belum lengkap, silahkan lengkapi data diri.',
                    showConfirmButton: true
                });
            });
        </script>";
    } 
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


<?php
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']); // Menghindari XSS
    if ($_GET['status'] == 'success') {
        $alert = "<script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success', // Anda dapat mengubah menjadi 'error', 'warning', 'info', atau 'question'
                title: 'Pesan',
                text: '$message',
                showConfirmButton: false,
                timer: 3000 // Durasi notifikasi dalam milidetik
            });
        });
    </script>";
    } else {
        $alert = "<script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error', // Anda dapat mengubah menjadi 'error', 'warning', 'info', atau 'question'
                title: 'Pesan',
                text: '$message',
                showConfirmButton: false,
                timer: 3000 // Durasi notifikasi dalam milidetik
            });
        });
    </script>";
    }

    echo $alert;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor\fontawesome\css\all.min.css">
    <title>pkl</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .disabled a{        
            pointer-events: none;
            cursor: default;
        }
        .hero-section{
            margin-top:7%;
        }
        .section-title {
            font-size: 2.5rem;
            color: #343a40;
            margin-bottom: 1rem;
        }

        .section-description {
            font-size: 1.25rem;
            color: #6c757d;
        }

        .bidang-card {
            border: 1px solid rgba(156, 156, 156, 0.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-img-top {
            border-radius: 10px;
            height: 200px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 1rem;
            color: #495057;
        }

        @media (max-width: 768px) {
            .card-title {
                font-size: 1.25rem;
            }

            .card-text {
                font-size: 0.875rem;
            }
        }
        .clock {
            font-size: 3rem;
            font-weight: bold;
            color: #333;
        }
        @media (max-width: 576px) {
        /* Mengatur ukuran judul pada perangkat mobile */
        .section-title {
            font-size: 1.5rem;
        }

        /* Mengatur ukuran teks pada perangkat mobile */
        .section-description, .card-title, .card-text {
            font-size: 0.875rem;
        }

        /* Mengatur ukuran card pada perangkat mobile */
        .bidang-card {
            margin-bottom: 1rem;
        }

        /* Memastikan tabel dapat digulir secara horizontal di perangkat kecil */
        .table-responsive {
            overflow-x: auto;
        }

        /* Menyederhanakan hero section pada perangkat kecil */
        .hero-section .hero-title {
            font-size: 1.25rem;
        }

        /* Mengubah ukuran gambar pada perangkat mobile */
        .hero-section img {
            width: 180px;
            height: 180px;
        }
    }
    .progress-container {
  position: relative;
  background-color: #a7a7a7;
  border-radius: 5px;
  overflow: hidden;
  height: 30px;
}

.progress-bar {
  height: 100%;
  background-color: #009dff;
  border-radius: 5px;
}

.progress-info {
  position: absolute;
  color: white;
  top: 50%;
  left: 0;
  right: 0;
  transform: translateY(-50%);
  padding: 0 10px;
  font-size: 14px;
  font-weight: bold;
}
.profile-header {
  text-align: center;
  margin-top: 20px;
}

.profile-header h3 {
  margin-bottom: 5px;
}

.profile-header span {
  font-size: 1rem;
  color: #666;
}


    </style>
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Asset/Gambar/logo.png" alt="#" width="60px" height="60px"
                    style="margin-left: 15px; margin-right: 10px;">
                <b>BBPOM MATARAM</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <?php
                    if ($status == "active" || $status == "done") {
                    ?>
                        <li class="nav-item me-3 dashboard">
                            <a class="nav-link" style="color: white;" href="tambah_absensi.php">
                                <i class="fas fa-calendar"></i>
                                Absen</a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($status == "active" || $status == "done") {
                    ?>
                        <li class="nav-item me-3 dashboard">
                            <a class="nav-link" style="color: white;" href="pkl.php">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="#" data-bs-toggle="modal"
                            data-bs-target="#notificationModal">
                            <div class="notification-icon">
                                <i class="fas fa-bell"></i>
                                <?php
                                $sql_count = "SELECT COUNT(*) AS count FROM notifikasi WHERE userid='$id' AND status='pkl'";
                                $result_count = mysqli_query($conn, $sql_count);
                                $row_count = mysqli_fetch_assoc($result_count);
                                $notification_count = $row_count['count'];
                                ?>
                                <span class="badge"><?php echo $notification_count; ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" style="color: white" href="#" data-bs-toggle="modal"
                            data-bs-target="#profileModal">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link text-nowrap" style="color: white" href="#" data-bs-toggle="modal"
                            data-bs-target="#logoutModal">
                            <i class="fas fa-power-off"></i> logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="profileForm" action="<?php echo $urlweb ?>/function/save_profile.php" method="POST">
                    <input type="hidden" name="redirect" value="pkl.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="profileName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="profileName" name="profileName"
                                value="<?php echo $nama; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="profileEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="profileEmail" name="profileEmail"
                                value="<?php echo $email; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="profilePhone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="profilePhone" name="profilePhone"
                                value="<?php echo $no_hp; ?>">
                        </div>
                        
                    </div>
                    <div class="modal-footer d-flex justify-content-around">
                        <button type="button" class="btn btn-primary"><a href="dashboardpkl.php"
                                style="text-decoration: none; color: white;">Profile</a></button>
                        <input type="submit" class="btn btn-primary" value="Save">
                        <a href="pkl_ResPw.php" class="btn btn-primary">Ubah Password</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Apakah Anda Yakin Ingin Keluar?</h5>
                </div>
                <div class="modal-footer d-flex justify-content-around">
                    <button type="button" class="btn btn-danger"><a href="logout.php"
                        style="text-decoration: none; color: white;">Iya</a></button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Notification Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group">
                        <?php
                        $sql3 = "SELECT * FROM notifikasi WHERE userid='$id' AND status='pkl'";
                        $result3 = mysqli_query($conn, $sql3);

                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            $saved_text = $row3['text'];
                            echo "<span class='list-group-item list-group-item-action mt-3 small-text'>" . nl2br($saved_text) . "</span>";
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-section ">
        <div class="container">
            <div class="row align-items-center" style="margin-top:5%">
                <div class="col-md-6 text-center">
                    <img src="Asset/Gambar/logo.png" alt="Hero Image" class="img-fluid" height="290px" width="290px">
                </div>
                <div class="col-md-6">
                    <h1 class="hero-title">Selamat Datang Di Siap Melayani</h1>
                    <p class="hero-description">Sistem Aplikasi Manajemen Layanan Publik Informasi</p>
                    <?php $sql2 = "SELECT * FROM pengajuan_pkl WHERE phone = '$no_hp'";
                    $result2 = mysqli_query($conn, $sql2);
                    if ($result2 && mysqli_num_rows($result2) == 0) {?>
                    <a href="pengajuan.php" class="btn btn-primary btn-cta text-nowrap">
                            <i class="fas fa-calendar"></i>
                            Lengkapi Data Diri
                    </a>
                    <?php } else { ?>
                        <a href="pkl_absensi.php" class="btn btn-primary btn-cta text-nowrap">
                            <i class="fas fa-calendar"></i>
                            REKAP ABSENSI
                        </a>
                        <?php $sql3 = "SELECT * FROM hasil_kuis WHERE nama = '$nama'";
                        $result3 = mysqli_query($conn, $sql3);
                        if ($result3 && mysqli_num_rows($result3) == 0){ ?>
                            <a href="pkl_kuis.php" class="btn btn-primary btn-cta text-nowrap ">
                                <i class="fas fa-calendar"></i>
                                Kerjakan Kuis
                            </a>
                        <?php } else { ?>
                            <a style="cursor:no-drop" class="btn btn-secondary btn-cta text-nowrap" disabled>
                            <i class="fas fa-calendar"></i>
                            Kuis Sudah Dikerjakan
                        </a>
                        <?php }  ?>
                    <?php }  ?>
                </div>
                
            </div>
        </div>
    </div>
    <div class="container" style="cursor:default;">
    <div class="row align-items-center">
    <div class="col-md-6">
        <div class="row mt-4">
                <div class="card bidang-card">
                        <div class="card-body">
                                <div class="text-center">
                                <label for="jam_masuk" style="font-size: 1.5rem;">Waktu Masuk</label><br>
                                <input type="text" id="jam_masuk" readonly 
                                   style="font-size: 1.5rem; border: none; background: transparent; text-align: center;" 
                                   value="<?php echo $waktu_masuk ? $waktu_masuk : ''; ?>"><br>
                                   <?php if($waktu_masuk == NULL){?>
                                    <a href="tambah_absensi.php?keterangan=Masuk" class="btn btn-primary" style="margin:auto">
                                    Absen Masuk
                                    </a>
                                   <?php } else { ?>
                                    <a  class="btn btn-primary" style="margin:auto; background-color:#6c757d; cursor:no-drop" disabled>
                                    Absen Berhasil
                                    </a>
                                   <?php } ?>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="row mt-4">
                    <div class="card bidang-card">
                        <di class="card-body">
                            <div class="text-center">
                            <label for="jam_masuk" style="font-size: 1.5rem;">Waktu Keluar</label><br>
                                <input type="text" id="jam_keluar" readonly 
                                   style="font-size: 1.5rem; border: none; background: transparent; text-align: center;" 
                                   value="<?php echo $waktu_keluar ? $waktu_keluar: ''; ?>"><br>
                                   <?php if($waktu_keluar == NULL){?>
                                    <a href="tambah_absensi.php?keterangan=Keluar" class="btn btn-primary" style="margin:auto">
                                    Absen Keluar
                                    </a>
                                   <?php } else { ?>
                                    <a  class="btn btn-primary" style="margin:auto; background-color:#6c757d; cursor:no-drop" disabled>
                                    Absen Berhasil
                                    </a>
                                   <?php } ?>
                                </div>
                        </div>
            </div>
        </div>
            <!-- Progres PKl -->
        <div class="card mt-4 mx-auto" style="max-width: 100%;margin-bottom:50px;">
            <h3 class='text-center mt-2'>Progres PKL</h3>
            <div class="card-body">
                <div class="progress-container">
                    <div class="progress-bar" style="width: <?php echo ($days_elapsed / $total_days) * 100; ?>%;">
                    </div>
                    <div class="progress-info d-flex justify-content-between">
                        <span>Start: <?php echo $start_date->format('Y-m-d'); ?></span>
                        <span><?php echo $status_pkl; ?></span>
                        <span>Finish: <?php echo $end_date->format('Y-m-d'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
    <?php $sql2 = "SELECT * FROM pengajuan_pkl WHERE phone = '$no_hp'";
    $result2 = mysqli_query($conn, $sql2);

    if ($result2 && mysqli_num_rows($result2) == 0) {
        ?>
    <div class="text-center mt-3">
        <h2 class="title">Posisi PKL Yang Tersedia</h2>
    </div>
    <div class="container mt-3 mb-5">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="bg-primary" style="vertical-align: middle; color: white;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Posisi</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Kuota</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql2 = "SELECT * FROM penempatan_pkl";
                    $result2 = mysqli_query($conn, $sql2);
                    $no = 1;
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo "<tr>";
                        echo "<td scope='row'>{$no}</td>";
                        echo "<td>{$row2['posisi']}</td>";
                        echo "<td>{$row2['deskripsi']}</td>";
                        echo "<td>{$row2['jurusan']}</td>";
                        echo "<td>{$row2['kuota']}</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    
    <div class="text-center">
        <h1 class="title">Dokumentasi</h1>
    </div>
    <div class="container my-5">
        <div class="text-center">
            <h2 class="section-title">Bidang PKL</h2>
            <p class="section-description">Berikut adalah beberapa bidang yang tersedia untuk PKL di BBPOM Mataram</p>
        </div>

        <div class="row mt-4">
            <?php
            $sql3 = "SELECT * FROM penempatan_pkl";
            $result3 = mysqli_query($conn, $sql3);

            while ($row3 = mysqli_fetch_assoc($result3)) {
                $posisi = $row3['posisi'];
                $deskripsi = $row3['deskripsi'];
                $gambar = $row3['gambar'];
            ?>

                <div class="col-md-4 pt-3">
                    <div class="card bidang-card">
                        <img src="<?php echo $urlweb; ?>/Asset/Gambar/<?php echo $gambar; ?>" class="card-img-top"
                            alt="Laboratorium">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $posisi ?></h5>
                            <p class="card-text"><?php echo $deskripsi ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
    <?php } ?>
        </div>


        <?php require_once('cs.php'); ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script>
            //Function to show notification
            function openNotif() {
                alert("Anda sudah melakukan pengajuan, mohon menunggu balasan atau hubungi admin.");
            }
        </script>
        <script>
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