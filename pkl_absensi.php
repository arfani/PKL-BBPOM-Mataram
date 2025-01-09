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

$message = '';
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $tanggal_hari_ini = date('Y-m-d');

    if ($role == "admin") {
        $email = "";
        $nama = "";
        $no_hp = "";
        $status = "";
    } else {
        $sql = "SELECT * FROM users where id ='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $nama = $row['nama'];
        $no_hp = $row['no_hp'];
        $status = $row['status'];

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
        body {
    background: #f7f9fc;
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

.download-container {
    margin: 50px 20px; /* Margin lebih kecil untuk HP */
}

.header-title {
    font-size: 2rem; /* Ukuran font lebih kecil untuk layar HP */
    font-weight: bold;
    color: #343a40;
    text-align: center;
}

.download-card {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    transition: transform 0.3s;
    padding: 15px; /* Padding lebih kecil untuk HP */
    text-align: center;
    background: white;
}

.download-card:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.btn-download {
    background: #007bff;
    color: white;
    border-radius: 25px;
    padding: 10px 15px; /* Padding lebih kecil untuk HP */
    font-size: 1rem; /* Ukuran font lebih kecil untuk HP */
    transition: background-color 0.3s;
    border: none;
    text-decoration: none;
    display: inline-block;
}

.btn-download:hover {
    background: #0056b3;
    color: white;
}

.icon-circle {
    width: 80px; /* Ukuran ikon lebih kecil untuk HP */
    height: 80px;
    background: #007bff;
    color: white;
    font-size: 2rem; /* Ukuran font ikon lebih kecil untuk HP */
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    margin: 15px auto;
}

.download-message {
    font-size: 1rem; /* Ukuran font lebih kecil untuk HP */
    color: #6c757d;
    margin: 10px 0;
}

/* Media Query untuk layar dengan lebar maksimum 768px (HP dan tablet kecil) */
@media (max-width: 768px) {
    .header-title {
        font-size: 1.8rem;
    }

    .download-card {
        padding: 10px;
        margin: 0 auto;
    }

    .btn-download {
        font-size: 0.9rem;
        padding: 8px 12px;
    }

    .icon-circle {
        width: 70px;
        height: 70px;
        font-size: 1.5rem;
    }

    .download-message {
        font-size: 0.9rem;
    }
}

/* Media Query untuk layar dengan lebar maksimum 480px (HP kecil) */
@media (max-width: 480px) {
    .header-title {
        font-size: 1.5rem;
    }

    .download-card {
        padding: 8px;
    }

    .btn-download {
        font-size: 0.8rem;
        padding: 6px 10px;
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        font-size: 1.2rem;
    }

    .download-message {
        font-size: 0.8rem;
    }
}

    </style>
    <style>
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
    </style>
    </head>

    <body>
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
                            <a class="nav-link" style="color: white;" href="absensi_pkl.php">
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
    <br><br><br><br>
    <div class="text-center mt-3">
        <h2 class="title">Rekap Absensi <?php echo htmlspecialchars($nama) ?></h2>
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

        </div>
    </div>

    <div class="container mt-3 mb-5">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="bg-primary" style="vertical-align: middle; color: white;">
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Total Jam Kerja</th>
                        <th>Kesimpulan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ambil ID user dari session
                    $id_user = $_SESSION['id'];
                    
                    $batas_waktu = '08:31:00';
                    // Query untuk mengambil data absensi hanya untuk pengguna yang sedang login
                    // Tambahkan klausa ORDER BY tanggal DESC untuk mengurutkan berdasarkan tanggal terbaru
                    $sql2 = "SELECT * FROM absensi WHERE user_id = '$id_user' ORDER BY tanggal DESC";
                    $result2 = mysqli_query($conn, $sql2);
                    
                    $no = 1;
                    
                    // Menampilkan data absensi
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        if($row2['status'] === "hadir"){
                            echo "<tr>";
                            echo "<td scope='row'>{$no}</td>";
                            echo "<td>{$row2['tanggal']}</td>";
                            echo "<td>{$row2['status']}</td>";
                            echo "<td>{$row2['waktu_masuk']}</td>";
                             if ($row2['waktu_keluar'] != NULL) {
                                echo "<td>{$row2['waktu_keluar']}</td>";
                                echo "<td>{$row2['durasi']}</td>";
                                echo "<td>{$row2['kesimpulan']}</td>";
                                
                            } else {
                                echo "<td>-</td>";
                                echo "<td>-</td>";
                                echo "<td>-</td>";
                            }
                            echo "</tr>";
                            } else if (strtolower($row2['status'] === "izin" || $row2['status'] = 'izin')){
                                echo "<tr>";
                                echo "<td scope='row'>{$no}</td>";
                                echo "<td>{$row2['tanggal']}</td>";
                                echo "<td>{$row2['status']}</td>";
                                echo "<td>{$row2['waktu_masuk']}</td>";
                                echo "<td>-</td>";
                                echo "<td>-</td>";
                                echo "<td>{$row2['kesimpulan']}</td>";
                            } else {
                            
                            echo "</tr>";
                        }
                            $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    

    <div class="container download-container">
    <h1 class="header-title">Download Absensi</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="download-card">
                <div class="icon-circle">
                    <i class="fas fa-download"></i>
                </div>
                <p class="download-message">
                    Data Absensi Anda Dapat Diunduh
                </p>
                <form action="function/DownloadAbsensi.php" method="POST">
                    <input type="hidden" name="nama" value="<?php echo htmlspecialchars($nama) ?>">
                    <button type="submit" class="btn btn-download">
                        <i class="fas fa-cloud-download-alt"></i> Unduh Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('searchInput');
                    const searchForm = document.getElementById('searchForm');

                    searchInput.addEventListener('input', function() {
                        searchForm.submit(); // Kirim form secara otomatis saat input berubah
                    });
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
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
        <?php
        // Pastikan variabel $message sudah didefinisikan sebelumnya
        if (isset($message) && !empty($message)) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Informasi',
                        text: '" . addslashes($message) . "',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                });
            </script>";
        }
        ?>
</body>

</html>