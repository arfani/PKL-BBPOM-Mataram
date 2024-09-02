<?php
include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    header('location:' . $urlweb . '/' . $role . '.php');
}

// Menghitung jumlah lowongan (total kuota di tabel penempatan_pkl)
$sql = "SELECT SUM(kuota) as jumlah FROM penempatan_pkl";
$result = mysqli_query($conn, $sql);
$lowongan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL batal
$sql = "SELECT COUNT(*) as jumlah FROM users WHERE status = 'failed'";
$result = mysqli_query($conn, $sql);
$pkl_batal = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL sedang
$sql = "SELECT COUNT(*) as jumlah FROM users WHERE status = 'active'";
$result = mysqli_query($conn, $sql);
$sedang_pkl = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL selesai
$sql = "SELECT COUNT(*) as jumlah FROM users WHERE status = 'done'";
$result = mysqli_query($conn, $sql);
$selesai_pkl = mysqli_fetch_assoc($result)['jumlah'];

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="Asset/CSS/custom3.css">
    <title>pkl</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="hero-title">Selamat datang di Portal Sapu Jagad BPOM</h1>
                    <p class="hero-description">Balai Besar Pengawas Obat dan Makanan di Mataram</p>
                    <a href="login.php" class="btn btn-warning btn-cta">Mulai ➔</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="Asset/Gambar/logo.png" alt="Hero Image" class="img-fluid" height="290px" width="290px">
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <h1 class="section-title">Dokumentasi PKL BPOM</h1>
    </div>

    <div class="carousel-section mt-5">
        <div class="container-fluid">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-wrap="true">
                <div class="carousel-indicators">
                    <?php
                    $sql_2 = mysqli_query($conn, "SELECT * FROM `tb_slide` ORDER BY sort ASC LIMIT 7");
                    $no = 0;
                    while ($s2 = mysqli_fetch_array($sql_2)) {
                        $active = $no === 0 ? 'active' : '';
                        echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $no . '" class="' . $active . '" aria-current="true" aria-label="Slide ' . ($no + 1) . '" id="btn-carousel"></button>';
                        $no++;
                    }
                    ?>
                </div>
                <center>
                    <div class="carousel-inner">
                        <?php
                        $no = 0;
                        mysqli_data_seek($sql_2, 0); // Reset result pointer to start
                        while ($s2 = mysqli_fetch_array($sql_2)) {
                            $active = $no === 0 ? 'active' : '';
                            echo '
                        <div class="carousel-item ' . $active . '">
                            <img src="' . $urlweb . '/Asset/Gambar/' . $s2['image'] . '" alt="' . $s2['deskripsi'] . '" style="border-radius: 10px;">
                        </div>';
                            $no++;
                        }
                        ?>
                    </div>
                </center>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>


    <div class="vision-mission-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="section-title">Portal Sapu Jagad BPOM</h2>
                    <p>Merupakan website yang mengelola data PKL online, Kunjungan online, serta Pengajuan Narasumber
                        online yang di kelola oleh BBPOM di Mataram dengan penjelasan sbb :</p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Fitur 1: Pusat PKL Online</h3>
                    <p class="description">
                        Fitur ini dirancang untuk memudahkan mahasiswa dan institusi pendidikan dalam mengelola
                        pengajuan, monitoring, dan penyelesaian PKL secara online. Semua proses dilakukan secara
                        transparan dan terintegrasi, mulai dari pendaftaran hingga pengajuan laporan akhir.
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Fitur 2: Kunjungan Online</h3>
                    <p class="description">
                        Melalui fitur ini, berbagai pihak dapat mengajukan kunjungan ke Balai Besar POM secara online.
                        Sistem ini memastikan bahwa proses kunjungan dapat diatur dengan efisien, sehingga memberikan
                        pengalaman yang optimal bagi para pengunjung.
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Fitur 3: Pengajuan Narasumber Online</h3>
                    <p class="description">
                        Fitur ini menyediakan platform untuk mengajukan permohonan narasumber dari BPOM dalam berbagai
                        kegiatan seperti seminar, workshop, atau pelatihan. Dengan layanan ini, proses pengajuan dan
                        persetujuan dapat dilakukan dengan cepat dan mudah.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-2">
        <div class="text-center">
            <h3 class="fw-bold">Data PKL</h3>
        </div>

        <!-- Card Section -->
        <div class="row my-4">
            <div class="col-md-3">
                <div class="card p-3">
                    <div class="card-icon">😊</div>
                    <h2><?php echo $selesai_pkl; ?></h2>
                    <p>PKL Selesai</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <div class="card-icon">📋</div>
                    <h2><?php echo $sedang_pkl; ?></h2>
                    <p>Sedang PKL</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <div class="card-icon">🎧</div>
                    <h2><?php echo $pkl_batal; ?></h2>
                    <p>Batal</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <div class="card-icon">👥</div>
                    <h2><?php echo $lowongan; ?></h2>
                    <p>Lowongan</p>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var carousel = document.querySelector('#carouselExampleIndicators');
        var nextButton = carousel.querySelector('.carousel-control-next');
        var prevButton = carousel.querySelector('.carousel-control-prev');

        carousel.addEventListener('slid.bs.carousel', function(event) {
            // Check if it's the last slide
            if (event.to === event.relatedTarget.length - 1) {
                nextButton.classList.add('disabled'); // Disable Next button
            } else {
                nextButton.classList.remove('disabled'); // Enable Next button
            }

            // Check if it's the first slide
            if (event.to === 0) {
                prevButton.classList.add('disabled'); // Disable Prev button
            } else {
                prevButton.classList.remove('disabled'); // Enable Prev button
            }
        });
    });
    </script>
    <?php require_once('cs.php'); ?>
</body>

</html>