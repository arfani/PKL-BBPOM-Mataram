<?php 
include('koneksi.php');

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_GET['kode_unik'])) {
    $kode_unik = $_GET['kode_unik']; // Simpan ke dalam variabel
} else {
    $kode_unik = null; // Beri nilai null jika tidak ada kode_unik di URL
}

$sql = "SELECT * FROM kunjungan WHERE kode_unik = '$kode_unik'";
$result6 = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan PKL BPOM</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

    
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
            
        </div>
    </nav>
    <button type="button" class="btn btn-primary mt-4 ms-4" style="box-shadow: 0 3px 3px black;" onclick="history.back()">Kembali</button>
    <?php 
    if ($result6) {
        while ($row = mysqli_fetch_assoc($result6)) {
    ?>
    <div class="card position-absolute top-50 start-50 translate-middle" style="width: 18rem;">
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-body-secondary text-center">Permohonan <?php echo "{$row['keperluan']}"; ?></h6>
            <h1 class="card-title text-center text-primary" ><?php echo "{$row['kode_unik']}"; ?></h1>
            <p class="card-text">Permohonan <?php echo "{$row['keperluan']}"; ?> anda berhasil dibuat, silahkan menghubungi Admin Dibawah ini, kode di atas merupakan kode unik yang digunakan untuk melihat perkembangan Permohonan anda</p>
            <a href="cs.php" class="btn btn-success">WA Admin</a>
            <a href="pencarian_resi.php" class="btn btn-primary">Pencarian Resi</a>
        </div>
    </div>
        <?php 
        }
    } else {
        ?>
    <div class="card position-absolute top-50 start-50 translate-middle" style="width: 18rem;">
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
            <h3 class="card-title text-center text-danger">Gagal</h3>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="cs.php" class="card-link">Card link</a>
        </div>
    </div>
        <?php
    }
    ?>
    <?php require('cs.php') ?>
</body>
</html>