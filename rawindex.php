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
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="Asset/CSS/stylee.css">
    <link rel="stylesheet" href="Asset/CSS/custom3.css">
</head>

<body>

    <!-- navbar section   -->

    <header class="navbar-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php" style="font-size: 45px;">Siap Melayani</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#formasi">Formasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#dokumentasi">Dokumentasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#projects">Data PKL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pengaduan">Pengaduan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- hero section  -->

    <section id="home" class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 text-content">
                    <h1>Layanan Seputar PKL/Magang</h1>
                    <p>Kami Menyediakan Layanan Berupa Informasi Lengkap seputar Praktik Kerja Lapangan/Magang Di Balai Besar POM Mataram
                    </p>
                    
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <img src="Asset/Gambar/bpom.png" alt="" class="img-fluid" style="margin-left:60px;">
                </div>

            </div>
        </div>
    </section>

    <!-- services section  -->

    <section class="services-section" id="formasi">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-12 col-sm-12 services">

                    <div class="row row1">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="images/research.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title">Laboratorium Pangan</h4>
                                    <p class="card-text">Membantu Pekerjaan Di Laboratorium Pangan</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="images/brand.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title">Laboratorium Mikrobiologi</h4>
                                    <p class="card-text">Disini Ditulis Penjelasan</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row row2">

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="images/ux.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title">Laboratorium Teranakoko</h4>
                                    <p class="card-text">Disini Ditulis Penjelasan</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="images/app-development.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title">Informasi Komunikasi</h4>
                                    <p class="card-text">Disini Ditulis Penjelasan</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row row2" style="margin-top: 50px;">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="images/ux.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title">Tata Usaha</h4>
                                    <p class="card-text">Membantu Pekerjaan di Ruangan Tata Usaha</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <img src="images/app-development.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h4 class="card-title">Sertifikasi</h4>
                                    <p class="card-text">Disini Ditulis Penjelasan</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>

                <div class="col-lg-6 col-md-12 col-sm-12 text-content">
                    <h3>Formasi PKL/Magang</h3>
                    <h1>Kami Bisa Membantu Anda</h1>
                    <p style="margin-bottom:0px;">Menemukan Formasi Praktik Kerja Lapangan/magang Yang Sesuai Dengan Jurusan Dan Minat yang Anda Mau. <br><br> Cari Tau Lebih Lanjut</p>
                    <button class="btn" style="margin-top: 0px;">Klik Disini</button>
                </div>

            </div>
        </div>
    </section>

    <!-- project section  -->

    <section class="project-section" id="projects">
        <div class="container">
            <div class="row text">
                <div class="col-lg-6 col-md-12">
                    <h3>Data PKL</h3>
                    <h1>Data PKL</h1>
                    <hr>
                </div>
                <div class="col-lg-6 col-md-12">
                    <p>Diisi Penjelasan tentang Data PKL yang sedang berjalan (belum nemu bahasa yang bagus)</p>
                </div>
            </div>
            <div class="row project">

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card"style="height:300px;">
                        <br>
                        <div class="card-body">
                            <div class="text">
                                <div class="card-icon">😊</div>
                                <h2><?php echo $selesai_pkl; ?></h2>
                                <p>PKL Selesai</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card"style="height:300px;">
                        <br>
                        <div class="card-body">
                            <div class="text">
                                <div class="card-icon">📋</div>
                                <h2><?php echo $sedang_pkl; ?></h2>
                                <p>Sedang PKL</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card"style="height:300px;">
                        <br>
                        <div class="card-body">
                            <div class="text">
                                <div class="card-icon">🎧</div>
                                <h2><?php echo $pkl_batal; ?></h2>
                                <p>Batal</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card"style="height:300px;">
                        <br>
                        <div class="card-body">
                            <div class="text">
                                <div class="card-icon">👥</div>
                                <h2><?php echo $lowongan; ?></h2>
                                <p>Lowongan</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <br><br>    
    <!-- Dokumentasi section  -->

    <section id="dokumentasi">
    <div class="text-center">
        <h1 class="section-title" style="color:#1c456d;">Dokumentasi PKL BPOM</h1>
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
    </section>
    <!-- contact section  -->

    <section class="contact-section" id="pengaduan" style="margin-top:0px;">
        <div class="container">

            <div class="row gy-4">
                <h1 style="margin-bottom:0px;margin-top:0px;">Kritik dan Saran</h1>
                <div class="col-lg-6">

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Alamat</h3>
                                <p>A108 Adam Street,<br>New Delhi, 535022</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-telephone"></i>
                                <h3>Telephone</h3>
                                <p>Nomor Kantor<br>Nomor Admin</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-envelope"></i>
                                <h3>Email Kami</h3>
                                <p>Diisi Email Kantor<br>Diisi Email Admin</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bi bi-clock"></i>
                                <h3>Jam Buka</h3>
                                <p>Senin - Jumat<br>08.00 - 16:00</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 form">
                    <form action="contact.php" method="POST" class="php-email-form">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Nama Anda" required>
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Email Anda" required>
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message"
                                    required></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" name="submit">Kirim</button>
                            </div>

                        </div>
                    </form>

                </div>

            </div>

        </div>
    </section>

    <!-- footer section  -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <p class="logo"> Siap Melayani</p>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <ul class="d-flex">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Formasi</a></li>
                        <li><a href="#">Data PKL</a></li>
                        <li><a href="#">Dokumentasi</a></li>
                        <li><a href="#">Pengaduan</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-12 col-sm-12">
                    <p>&copy;2023_BragSpot</p>
                </div>

                <div class="col-lg-1 col-md-12 col-sm-12">
                    <!-- back to top  -->

                    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                            class="bi bi-arrow-up-short"></i></a>
                </div>

            </div>

        </div>

    </footer>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>