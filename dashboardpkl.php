<?php
// Pastikan sesi sudah dimulai

include ('koneksi.php');
session_start(); // Pastikan config.php berisi koneksi database

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Menginisialisasi variabel dari tabel users dengan nilai default jika tidak ada data
    $email = $row['email'] ?? '';
    $nama = $row['nama'] ?? '';
    $no_hp = $row['no_hp'] ?? '';
    $status = $row['status'] ?? '';
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
                $status_pkl = "$days_elapsed hari berjalan";
            }
        } else {
            // Jika periode kosong
            $status_pkl = "Periode PKL tidak tersedia";
            $days_elapsed = 0;
            $total_days = 0;
            $days_left = 0;
        }
    } else {
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
     
} else {
    $email = "";
    $nama = "";
    $no_hp = "";
    header("Location: index.php");
}

$tahun = date('Y');

if ($status_pkl == "PKL Sudah Selesai") {
    if ($status == "active") {
        $updateStatus = "UPDATE users SET status = 'done' WHERE id='$id'";
        if (!mysqli_query($conn, $updateStatus)) {
            echo "Error updating quota: " . mysqli_error($conn);
            exit();
        }
        $updateQuota = mysqli_query($conn, "UPDATE penempatan_pkl SET kuota = kuota + 1 WHERE posisi= '$penempatan'");
        if (!$updateQuota) {
            echo "Error updating initial quota: " . mysqli_error($conn);
            exit();
        }
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <title>Dashboard PKL</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="Asset/CSS/style3.css">
    <link rel="stylesheet" href="Asset/CSS/stylee2.css">

    <style>
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
                                <i class="fa fa-calendar"></i>
                                Absen</a>
                        </li>
                    <?php } ?>
                    <?php
                    if ($status == "active" || $status == "done") {
                    ?>
                        <li class="nav-item me-3 dashboard">
                            <a class="nav-link" style="color: white;" href="pkl.php">
                                <i class="fa fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="#" data-bs-toggle="modal"
                            data-bs-target="#notificationModal">
                            <div class="notification-icon">
                                <i class="fa fa-bell"></i>
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
                            <i class="fa fa-user"></i> Profile
                        </a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link text-nowrap" style="color: white" href="#" data-bs-toggle="modal"
                            data-bs-target="#logoutModal">
                            <i class="fa fa-power-off"></i> logout
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    </div><br>

    <button type="button" class="btn btn-primary mt-3 ms-4" style="box-shadow: 0 3px 3px black;"><a href="pkl.php"
            style="color:white; text-decoration: none;">Kembali</a></button>

    <div class="container mt-2">
        <!-- Data PKL -->
        <div class="card mt-4 mx-auto" style="max-width: 1000px;">
            <h3 class='text-center mt-3'>Data Lengkap PKL</h3>
            <div class="card-body d-flex justify-content-between flex-wrap align-items-center mx-auto profile">
                <div class="foto d-flex flex-column">
                    <img id="profile-picture" src="<?php echo $foto ?>" alt="Profile Picture" class="img-fluid mb-3">
                    <button class="btn btn-primary mb-3" onclick="editProfilePicture()">
                        <i class='bx bx-edit'></i> Edit
                    </button>
                </div>
                <div class="profile-info mx-3 my-3">
                    <div class="header-profile mb-4">
                        <h3><b><?php echo $nama ?></b></h3>
                        <span><i class='bx bxs-user'></i> Posisi / Bidang: <b><?php echo $penempatan ?></b>
                        </span>
                    </div>
                    <p><i class='bx bxs-graduation'></i> Universitas: <?php echo $universitas ?></p>
                    <p><i class='bx bxs-book'></i> Jurusan: <?php echo $jurusan ?></p>
                    <p><i class='bx bxs-phone'></i> No Hp: <?php echo $no_hp ?></p>
                    <p><i class='bx bxs-envelope'></i> Email: <?php echo $email ?></p>

                    <div class="d-flex flex-column">
                        <?php if ($status_pkl == "PKL Sudah Selesai") { ?>
                        <!-- Button untuk Upload Laporan Akhir -->
                        <button class="btn btn-success mb-2" onclick="uploadLaporanAkhir()">
                            <i class='bx bx-upload'></i> Upload Laporan Akhir
                        </button>
                        <?php } ?>

                        <a class="btn btn-success" 
                            href="https://chat.whatsapp.com/DbJLFRzH6ayLSREEGwDrZU">
                            <i class='bx bxl-whatsapp'></i> Gabung Grup WA
                        </a>
                        <?php if($status_pkl == "Data pengajuan PKL tidak ditemukan"){ ?>
                        <a class="btn btn-primary" href="pengajuan.php" style="margin-top:10px">
                            <i class="bx bxs-pencil"></i> lengkapi Data Diri
                        </a>
                            <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <form id="upload-form" action="<?php echo $urlweb ?>/function/upload.php" method="POST"
        enctype="multipart/form-data" style="display: none;">
        <input type="file" id="file-input" name="profile_picture" accept="image/*"
            onchange="previewProfilePicture(event)">
        <input type="hidden" name="user_id" value="<?php echo $id ?>">
    </form>
    <form id="uploadLaporanForm" action="<?php echo $urlweb ?>/function/upload_laporan.php" method="POST"
        enctype="multipart/form-data" style="display:none;">
        <!-- <div class="form-group"> -->
        <!-- <label for="laporanAkhir">Unggah Laporan Akhir PKL:</label> -->
        <input type="file" name="laporanAkhir" id="laporaninput" class="form-control" onchange="submitLaporan(event)">
        <input type="hidden" name="user_id" value="<?php echo $id ?>">
        <!-- </div> -->
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <!-- Progress Card -->
    <div class="card mt-4 mx-auto" style="max-width: 1000px;">
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


    <!-- E-Document Section -->
    <div class="container my-2">
        <h2 class="text-center mt-1">Berkas Perlengkapan</h2>
        <div class="download-container mt-3">
            <div class="download-box" style="border-color: #007bff;">
                <i class='bx bxs-file-doc bx-lg' style="color: #007bff;"></i>
                <h3>Pakta Integritas Mahasiswa</h3>
                <a href="Asset/Document/PAKTA INTEGRITAS MAHASISWA PKL.docx" download
                    style="background-color: #007bff;">Download</a>
            </div>
            <?php if (!empty($surat_balasan)) : ?>
            <div class="download-box" style="border-color: #28a745;">
                <i class='bx bxs-envelope bx-lg' style="color: #28a745;"></i>
                <h3>Surat Balasan</h3>
                <a href="<?php echo $surat_balasan ?>" download style="background-color: #28a745;">Download</a>
            </div>
            <?php endif; ?>
            <?php if ($laporanAkhir != null) {
                if ($sertifikat != null) {
            ?>
            <div class="download-box" style="border-color: #ffc107;">
                <i class='bx bxs-certification bx-lg' style="color: #ffc107;"></i>
                <h3>Sertifikat</h3>
                <a href="<?php echo $sertifikat ?>" style="background-color: #ffc107;">Download</a>
            </div>
            <?php } else { ?>
            <div class="download-box" style="border-color: #ffc107;">
                <i class='bx bxs-certification bx-lg' style="color: #ffc107;"></i>
                <h3>Sertifikat</h3>
                <a href="#" data-bs-toggle="modal" data-bs-target="#certificateModal"
                    style="background-color: #ffc107;">Download</a>
            </div>
            <?php }
            } ?>
            <div class="download-box" style="border-color: #c20e;">
                <i class='bx bxs-book-bookmark bx-lg' style="color: #c20e;"></i>
                <h3>Peraturan PKL</h3>
                <a href="path/to/PeraturanPKL.docx" download style="background-color: #c20e;">Download</a>
            </div>
            <div class="download-box" style="border-color: #17a2b8;">
                <i class='bx bxs-calendar bx-lg' style="color: #17a2b8;"></i>
                <h3>Absensi</h3>
                <a href="pkl_absensi.php" style="background-color: #17a2b8;">Absen</a>
            </div>
        </div>
    </div>



    <!-- Footer Section -->
    <footer class="bg-primary text-white text-center pt-4 mt-4">
        <div class="container">
            <h5 class="text-uppercase mb-4">Follow Us</h5>
            <div class="d-flex justify-content-center social-icons mb-4">
                <a href="https://www.facebook.com/bpom.mataram" target="_blank" class="text-white mx-3"><i
                        class='bx bxl-facebook-circle bx-lg bx-tada'></i></a>
                <a href="https://twitter.com/bpommataram" target="_blank" class="text-white mx-3"><i -
                        class='bx bxl-twitter bx-lg bx-tada'></i></a>
                <a href="https://www.instagram.com/bpom.mataram/" target="_blank" class="text-white mx-3"><i
                        class='bx bxl-instagram bx-lg bx-tada'></i></a>
                <a href="https://www.youtube.com/@BBPOMMataram" target="_blank" class="text-white mx-3"><i
                        class='bx bxl-youtube bx-lg bx-tada'></i></a>
            </div>
        </div>
        <div class="text-center py-2" style="background-color: rgba(0, 0, 0, 0.2);">
            &copy; <?php echo $tahun ?> BBPOM Mataram
        </div>

    </footer>
    <!-- FontAwesome Script -->
    <?php require_once('cs.php'); ?>
    <script>
    function editProfilePicture() {
        // Buka file picker
        document.getElementById('file-input').click();
    }

    function previewProfilePicture(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-picture').src = e.target.result;
            }
            reader.readAsDataURL(file);

            // Submit form secara otomatis setelah memilih gambar
            document.getElementById('upload-form').submit();
        }
    }

    function uploadLaporanAkhir() {
        document.getElementById('laporaninput').click();

    }

    function submitLaporan(event) {
        event.preventDefault(); // Prevent the default form submission
        const fileInput = document.getElementById('laporaninput');

        // Check if a file is selected
        if (fileInput.files.length > 0) {
            document.getElementById('uploadLaporanForm').submit(); // Submit the form
        } else {
            alert('Please select a file to upload.');
        }
    }
    </script>


    <script src=" https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>