<?php
include 'koneksi.php';
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM pkl where id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $nama = $row['nama'];
    $no_hp = $row['no_hp'];
} else {
    $email = "";
    $nama = "";
    $no_hp = "";
}

if (isset($_POST['kirim'])) {
    $university = $_POST['university'];
    $department = $_POST['department'];
    $posisi = implode(', ', $_POST['posisi']);
    $periode = $_POST['periode1'] . ' - ' . $_POST['periode2'];
    $surat = $_FILES['surat']['name'];
    $sumber_surat = $_FILES['surat']['tmp_name'];
    $proposal = $_FILES['proposal']['name'];
    $sumber_proposal = $_FILES['proposal']['tmp_name'];
    $folder = './Asset/Document/';
    $surat_path = $folder . $surat;
    $proposal_path = $folder . $proposal;
    move_uploaded_file($sumber_surat, $folder . $surat);
    move_uploaded_file($sumber_proposal, $folder . $proposal);
    $insert = mysqli_query($conn, "INSERT INTO pengajuan_pkl (nama, email, phone, university, department, posisi, periode, surat, proposal) VALUES ('$nama', '$email', '$no_hp', '$university', '$department', '$posisi', '$periode', '$surat_path', '$proposal_path')");
    if ($insert) {

        $text = 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin';
        $notif = mysqli_query($conn, "INSERT INTO notifikasi (userid, text, status) VALUES ('$id', '$text', 'pkl')");

        $cekFonnte = mysqli_query($conn, "SELECT * FROM `api` WHERE id = 8");
        $cf = mysqli_fetch_array($cekFonnte);
        $no = '082145554182';
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
                    'target' => $no,
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

        header("Location: pkl.php");
        exit();
    } else {
        echo "Gagal memasukkan data, silakan cek kembali.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan PKL BPOM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group input {
            flex: 1;
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px" style="margin-left: 15px; margin-right: 10px">
                <b>BBPOM MATARAM</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                            <i class="fas fa-user"></i> Profile
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
                <form id="profileForm" action="save_profile.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="profileName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="profileName" name="profileName" value="<?php echo $nama; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="profileEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="profileEmail" name="profileEmail" value="<?php echo $email; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="profilePhone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="profilePhone" name="profilePhone" value="<?php echo $no_hp; ?>">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-around">
                        <button type="button" class="btn btn-danger"><a href="logout.php" style="text-decoration: none; color: white;">Logout</a></button>
                        <input type="submit" class="btn btn-primary" value="Save">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-danger mt-4 ms-4" style="box-shadow: 0 3px 3px black;"><a href="pkl.php" style="color:white; text-decoration: none;">Kembali</a></button>
    <div class="container">
        <div class="form-container">
            <h2 class="form-header">Form Pengajuan PKL BPOM</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap :</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $nama ?>" placeholder="<?php echo $nama ?>" disabled>
                    <span class="text-muted"><i class="fas fa-circle-info"></i>
                        <small class="ms-1">ubah data di profile</small>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $email; ?>" value="<?php echo $email; ?>" disabled>
                    <span class="text-muted"><i class="fas fa-circle-info"></i>
                        <small class="ms-1">ubah data di profile</small>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon :</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="<?php echo $no_hp; ?>" value="<?php echo $no_hp; ?>" disabled>
                    <span class="text-muted"><i class="fas fa-circle-info"></i>
                        <small class="ms-1">ubah data di profile</small>
                    </span>
                </div>
                <div class="mb-3">
                    <label for="university" class="form-label">Universitas :</label>
                    <input type="text" class="form-control" id="university" name="university" placeholder="Masukkan nama universitas Anda" required>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Jurusan :</label>
                    <input type="text" class="form-control" id="department" name="department" placeholder="Masukkan jurusan Anda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Posisi Penempatan : </label>
                    <?php
                    $sql2 = "SELECT * FROM penempatan_pkl";
                    $result2 = mysqli_query($conn, $sql2);
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                    ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="posisi[]" value="<?php echo $row2['posisi']; ?>" id="<?php echo $row2['posisi']; ?>">
                            <label class="form-check-label" for="<?php echo $row2['posisi']; ?>">
                                <span style="font-weight: 600;"><?php echo $row2['posisi']; ?></span>
                                <span class="text-muted ms-2" style="font-size: 0.9em;">(kuota tersedia:
                                    <?php echo $row2['kuota']; ?> orang)</span>
                            </label>
                        </div>
                    <?php
                    }
                    ?>

                </div>
                <div class="mb-3">
                    <label for="periode" class="form-label">Rencana Priode PKL :</label>
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
</body>

</html>