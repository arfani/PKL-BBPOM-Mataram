<?php
include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

$message = '';
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role != "pkl") {
        header('location:' . $urlweb . '/' . $role . '.php');
    }
} else {
    header("Location: " . $urlweb);
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users where id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $nama = $row['nama'];
    $no_hp = $row['no_hp'];
    $universitas = $row['universitas'];
} else {
    $email = "";
    $nama = "";
    $no_hp = "";
}

if (isset($_POST['kirim'])) {
    $department = $_POST['department'];
    $nim = $_POST['nim'];
    $status = $_POST['status'];
    $posisi = implode(', ', $_POST['posisi']);
    $periode = $_POST['periode1'] . ' - ' . $_POST['periode2'];
    $surat = $_FILES['surat']['name'];
    $sumber_surat = $_FILES['surat']['tmp_name'];
    $proposal = $_FILES['proposal']['name'];
    $sumber_proposal = $_FILES['proposal']['tmp_name'];
    $folder = './Asset/Document/';
    $surat_nama = 'surat pengajuan_' . $nama . '.pdf';
    $proposal_nama = 'proposal_' . $nama . '.pdf';
    $surat_nama = 'surat_pengajuan_' . $nama . '.pdf';
    $proposal_nama = 'proposal_' . $nama . '.pdf';
    $processedFileName = str_replace(' ', '+', $surat_nama);
    $processedFileName2 = str_replace(' ', '+', $proposal_nama);
    $surat_path = $folder . $processedFileName;
    $proposal_path = $folder . $processedFileName2;

    if (!file_exists($surat_path)) {
        move_uploaded_file($sumber_surat, $surat_path);
    }
    if (!file_exists($proposal_path)) {
        move_uploaded_file($sumber_proposal, $proposal_path);
    }

    $insert = mysqli_query($conn, "INSERT INTO pengajuan_pkl (nama, email, phone, university, department, posisi, periode, surat, proposal, status, nim) 
    VALUES ('$nama', '$email', '$no_hp', '$universitas', '$department', '$posisi', '$periode', '$surat_path', '$proposal_path','$status', '$nim')");
    if ($insert) {
        
        $message = 'Selamat Pengajuan Anda Berhasil Dikirim, Silahkan Menunggu Konfirmasi Dari Admin';
        $text = 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin';
        $notif = mysqli_query($conn, "INSERT INTO notifikasi (userid, text, status) VALUES ('$id', '$text', 'pkl')");
        $update = mysqli_query($conn, "UPDATE users SET status = 'active' WHERE id='$id'");

        $cekFonnte = mysqli_query($conn, "SELECT * FROM `api` WHERE id = 8");
        $cf = mysqli_fetch_array($cekFonnte);
        $no_admin = $cf['no_admin'];
        $no = '087871500533';
        if ($cf['status'] == 1) {
            $content = '*Pengajuan PKL BBPOM :*
                           
*Nama :* ' . $nama . '
*Universitas :* ' . $university . '
*Posisi :* ' . $posisi . '
*Selama :* ' . $periode;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.fonnte.com/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    'target' => $no_admin,
                    'message' => $content,
                    'countryCode' => '62'
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $cf['api_key']
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            sleep(1);
        }

        header("Location: " . $urlweb . "/pkl.php");
        exit();
    } else {
        echo "Gagal memasukkan data, silakan cek kembali.";
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
    <title>Form Pengajuan PKL BPOM</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px"
                    style="margin-left: 15px; margin-right: 10px">
                <b>BBPOM MATARAM</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    if ($row['status'] == "active") {
                    ?>
                    <li class="nav-item mx-3">
                        <a class="nav-link" style="color: white;" href="pkl.php">
                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"
                            style="color : white">
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
                    <input type="hidden" name="redirect" value="pengajuan.php">
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

    <button type="button" class="btn btn-primary mt-4 ms-4 mb-3" style="box-shadow: 0 3px 3px black;"><a href="pkl.php"
            style="color:white; text-decoration: none;">Kembali</a></button>
    <div class="container">
        <div class="form-container">
            <h2 class="form-header text-center">Form Pengajuan PKL BPOM</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap :</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $nama ?>"
                        placeholder="<?php echo $nama ?>" disabled>
                    <span class="text-muted"><i class="fas fa-circle-info"></i>
                        <small class="ms-1">ubah data di profile</small>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $email; ?>"
                        value="<?php echo $email; ?>" disabled>
                    <span class="text-muted"><i class="fas fa-circle-info"></i>
                        <small class="ms-1">ubah data di profile</small>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon :</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="<?php echo $no_hp; ?>"
                        value="<?php echo $no_hp; ?>" disabled>
                    <span class="text-muted"><i class="fas fa-circle-info"></i>
                        <small class="ms-1">ubah data di profile</small>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="universitas" class="form-label">Universitas :</label>
                    <input type="text" class="form-control" id="universitas" name="universitas"
                        placeholder="<?php echo $universitas; ?>" value="<?php echo $universitas; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Jurusan :</label>
                    <input type="text" class="form-control" id="department" name="department"
                        placeholder="Masukkan jurusan Anda" required>
                </div>
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM :</label>
                    <input type="text" class="form-control" id="nim" name="nim"
                        placeholder="Nomor Induk Mahasiswa" required>
                </div>
                <div class="mb-3">
                    <input type="hidden" id="status" name="status" value="Pending" required>
                </div>
                <div class="mb-3">  
                    <label class="form-label">Posisi Penempatan : </label>
                    <?php
                    $sql2 = "SELECT * FROM penempatan_pkl";
                    $result2 = mysqli_query($conn, $sql2);
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $disabled = $row2['kuota'] <= 0 ? 'disabled' : '';
                    ?>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="posisi[]"
                            value="<?php echo $row2['posisi']; ?>" id="<?php echo $row2['posisi']; ?>"
                            <?php echo $disabled; ?>>
                        <label class="form-check-label" for="<?php echo $row2['posisi']; ?>">
                            <span style="font-weight: 600;"><?php echo $row2['posisi']; ?></span>
                            <span class="text-muted ms-2" style="font-size: 0.9em;">(kuota tersedia:
                                <?php echo $row2['kuota']; ?> orang)</span>
                        </label>
                    </div>
                    <?php
                    }
                    ?>

                <div class="mb-3">
                    <label for="periode" class="form-label">Rencana Periode PKL :</label>
                    <div class="input-group">
                        <input type="date" class="form-control me-2" id="periode1" name="periode1" required>
                        <label for="periode" class="form-label"> - </label>
                        <input type="date" class="form-control ms-2" id="periode2" name="periode2" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="surat" class="form-label">Upload Surat Pengajuan Dari Kampus :</label>
                    <input class="form-control" type="file" id="surat" name="surat" required>
                </div>
                <div class="mb-3">
                    <label for="proposal" class="form-label">Upload Proposal :</label>
                    <input class="form-control" type="file" id="proposal" name="proposal" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="kirim">Kirim Pengajuan</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php require_once('cs.php'); ?>

</body>

</html>