<?php 
include('koneksi.php');

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_GET['kode_unik'])) {
    $kode_unik = $_GET['kode_unik']; // Simpan ke dalam variabel
    $jenis = $_GET['jenis'];
} else {
    $kode_unik = null; // Beri nilai null jika tidak ada kode_unik di URL
}

$sql = "SELECT * FROM $jenis WHERE kode_unik = '$kode_unik'";
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
    <link rel="stylesheet" href="Asset/CSS/landing_page.css">
</head>
<body>
    <style>
        body{
    background: url(Asset/Gambar/landing-page2.jpg)
    no-repeat center center fixed;
    margin:0;
    padding:0;
}
.card{
    background: rgba(255,255,255,0.3);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

    </style>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="z-index:1">
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
    if ($result6 && $jenis === 'pengaduan') {
        while ($row = mysqli_fetch_assoc($result6)) {
    ?>
    <div class="card position-absolute top-50 start-50 translate-middle" style="width: 18rem;">
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-body-secondary text-center">Pengaduan <?php echo "{$row['subject']}"; ?></h6>
            <h1 class="card-title text-center text-primary" ><?php echo "{$row['kode_unik']}"; ?></h1>
            <div id="copySuccess" class="text-center" style="display: block; color:lightblue;">
                Kode berhasil disalin!
            </div>
            <div class="text-center mt-2 mb-2">
                <button id="copyButton" class="btn btn-outline-primary">
                    Salin
                </button>
            </div>
            <p class="card-text">Pengaduan <?php echo "{$row['subject']}"; ?> 
            anda berhasil dibuat, silahkan menghubungi Admin Dibawah ini, 
            kode di atas merupakan kode unik yang digunakan untuk melihat perkembangan Pengaduan anda</p>
            <a href="cs.php" class="btn btn-success">WA Admin</a>
            <a href="pencarian_resi.php?jenis=<?php echo $jenis ?>" class="btn btn-primary">Pencarian Resi</a>
        </div>
    </div>
        <?php 
        }
    } else if ($result6 && $jenis === 'kunjungan'){
        ?>
    <div class="card position-absolute top-50 start-50 translate-middle" style="width: 18rem;">
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-body-secondary text-center">Permohonan <?php echo "{$row['keperluan']}"; ?></h6>
            <h1 class="card-title text-center text-primary" ><?php echo "{$row['kode_unik']}"; ?></h1>
            <div id="copySuccess" class="text-center mt-2" style="display: block; color:lightblue;">
                Kode berhasil disalin!
            </div>
            <div class="text-center mt-3">
                <button id="copyButton" class="btn btn-outline-primary">
                    Salin
                </button>
            </div>
            <p class="card-text">Permohonan <?php echo "{$row['keperluan']}"; ?> anda berhasil dibuat, silahkan menghubungi Admin Dibawah ini, kode di atas merupakan kode unik yang digunakan untuk melihat perkembangan Permohonan anda</p>
            <a href="cs.php" class="btn btn-success">WA Admin</a>
            <a href="pencarian_resi_kunjungan.php" class="btn btn-primary">Pencarian Resi</a>
        </div>
    </div>
        <?php
    }
    ?>
    <?php require('cs.php') ?>
    <script>
        // JavaScript untuk menyalin kode unik ke clipboard
        document.getElementById('copyButton').addEventListener('click', function() {
            // Ambil teks dari elemen kode unik
            const kodeUnik = "<?php echo $kode_unik; ?>";

            // Gunakan Clipboard API untuk menyalin
            navigator.clipboard.writeText(kodeUnik).then(() => {
                // Tampilkan pesan sukses
                const successMessage = document.getElementById('copySuccess');
                successMessage.style.color = 'green';

                // Sembunyikan pesan setelah 2 detik
                setTimeout(() => {
                    successMessage.style.color = 'lightblue';
                }, 2000);
            }).catch(err => {
                console.error('Gagal menyalin teks:', err);
            });
        });
    </script>
</body>
</html>