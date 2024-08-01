<?php
include 'koneksi.php';
session_start();

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    if ($id <= 100) {
        header('location: admin.php');
    } else if ($id > 300 && $id <= 600) {
        header('location: tamu.php');
    } else if ($id > 600 && $id <= 900) {
        header('location: narasumber.php');
    }
}

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
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="Asset/CSS/style3.css">
    <title>Dashboard PKL</title>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Asset/Gambar/logo.png" alt="BBPOM MATARAM" width="30" height="30">
                <b>BBPOM MATARAM</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-1">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboardpkl.php"><i class='bx bxs-dashboard'></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="e_document.php"><i class='bx bx-book-bookmark'></i> E-Document</a>
                    </li>
                </ul>
                <img src="Asset/Gambar/icon.png" alt="Profile" width="40" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#profileModal">
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
                    <input type="hidden" name="redirect" value="e_document.php">
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

    <!-- E-Document Section -->
    <div class="container mb-2">
        <h2 class="text-center mt-1">Berkas Persyaratan</h2>
        <div class="download-container mt-3">
            <div class="download-box">
                <img src="Asset/Gambar/sertifikat.png" alt="Surat Permohonan PKL">
                <h3>Pakta Integritas Mahasiswa</h3>
                <a href="Asset/Document/PAKTA INTEGRITAS MAHASISWA PKL.docx" download>Download</a>
            </div>
            <div class="download-box">
                <img src="Asset/Gambar/sertifikat.png" alt="Peraturan PKL">
                <h3>Peraturan PKL</h3>
                <a href="path/to/PeraturanPKL.docx" download>Download</a>
            </div>
            <div class="download-box">
                <img src="Asset/Gambar/sertifikat.png" alt="Sertifikat">
                <h3>Sertifikat</h3>
                <a href="certificate.php">Download</a>
            </div>
            <div class="download-box">
                <img src="Asset/Gambar/sertifikat.png" alt="Absensi">
                <h3>Absensi</h3>
                <a href="path/to/Absensi.docx" download>Download</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>