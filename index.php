<?php
include('koneksi.php');
session_start();

// Ambil URL web dari database
$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

// Redirect berdasarkan role user
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    header('location:' . $urlweb . '/' . $role . '.php');
}

// Menghitung jumlah PKL data untuk ditampilkan
$sql = "SELECT SUM(kuota) as jumlah FROM penempatan_pkl";
$result = mysqli_query($conn, $sql);
$lowongan = mysqli_fetch_assoc($result)['jumlah'] ?? 0;

$sql = "SELECT COUNT(*) as jumlah FROM users WHERE status = 'failed'";
$result = mysqli_query($conn, $sql);
$pkl_batal = mysqli_fetch_assoc($result)['jumlah'] ?? 0;

$sql = "SELECT COUNT(*) as jumlah FROM users WHERE status = 'active'";
$result = mysqli_query($conn, $sql);
$sedang_pkl = mysqli_fetch_assoc($result)['jumlah'] ?? 0;

$sql = "SELECT COUNT(*) as jumlah FROM users WHERE status = 'done'";
$result = mysqli_query($conn, $sql);
$selesai_pkl = mysqli_fetch_assoc($result)['jumlah'] ?? 0;

$message = "";



$sql2 = "SELECT * FROM api where id = 8";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$no_cs = $row2['no_cs'];
// Pemrosesan form pengaduan
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $pesan = $_POST['pesan'];
    $tanggal = date('Y-m-d');
    $jam = $_POST['jam'];
    $foto = $_FILES['foto_pengaduan'];
    $no_hp = $_POST['no_hp'];
    $foto_nama = NULL;

    // Check jika ada file foto yang diunggah
    if (!empty($foto['name'])) {
        $target_dir = "Asset/Gambar/";
        $foto_nama = basename($foto["name"]);
        $target_file = $target_dir . $foto_nama;
        move_uploaded_file($foto["tmp_name"], $target_file);
    }

    // Query berdasarkan ada/tidaknya file foto yang diunggah
    if ($foto_nama) {
        // Jika ada foto, simpan data beserta path foto
        $sql = "INSERT INTO pengaduan (nama, email, no_hp, subject, pesan, foto_pengaduan, tanggal, jam) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $nama, $email, $no_hp, $subject, $pesan, $foto_nama, $tanggal, $jam);
    } else {
        // Jika tidak ada foto, simpan data tanpa kolom foto_pengaduan
        $sql = "INSERT INTO pengaduan (nama, email, no_hp, subject, pesan, tanggal, jam) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $nama, $email, $no_hp, $subject, $pesan, $tanggal, $jam);
    }

    $result = $stmt->execute();

    if ($result) {
        // Pesan berhasil
        $message = "Pengaduan telah dikirim.";

        // Format pesan untuk WhatsApp
        $whatsappMessage = urlencode("Halo Balai Besar POM Di Mataram, Saya $nama, ingin membuat Pengajuan tentang $subject\nMohon Bantuannya!!");

        // Arahkan ke WhatsApp
        $whatsappUrl = "https://api.whatsapp.com/send?phone=$no_cs&text=" . $whatsappMessage;
        header("Location: $whatsappUrl");
        exit;
    } else {
        // Pesan error
        $message = "Woops! Ada kesalahan saat menyimpan: " . $conn->error;
    }
}

// Tampilkan notifikasi menggunakan SweetAlert
if (!empty($message)) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Pesan',
                text: '$message',
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="Asset/CSS/index.css">
    <title>pkl</title>
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

<body>
    <header class="navbar-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">

                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#dokumentasi">Dokumentasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#fitur">Fitur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pengaduan">Pengaduan</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="hero-section">
    <br><br>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    
                    <h1 class="hero-title">Siap Melayani </h1>
                    <p class="hero-description">Sistem Aplikasi Manajemen Layanan Publik Infokom</p>
                    <a href="login.php" class="btn btn-warning btn-cta " style="width:35%;">Login ➔</a>
                    
                </div>
                <div class="col-md-6 text-center">
                    <img src="Asset/Gambar/logo.png" alt="Hero Image" class="hero-section animated">
                </div>
            </div>
        </div>
        <br>
        <br><br><br>
    </div>
    
    <section class="dokumentasi-section" id="dokumentasi">
    <div class="text-center">
        <h1>Dokumentasi PKL BPOM</h1>
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

    <section class="fitur-section" id="fitur">
    <div class="vision-mission-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="section-title">Portal Sapu Jagad BPOM</h1>
                    <p>Merupakan website yang mengelola data PKL online, Kunjungan online, serta Pengajuan Narasumber
                        online yang di kelola oleh BBPOM di Mataram dengan penjelasan sbb :</p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Fitur 1 : Pusat PKL Online</h3>
                    <p class="description">
                    Pengelolaan PKL meliputi proses permohonan, penerimaan 
                    peserta, serta monitoring jalannya PKL, baik reguler 
                    maupun MBKM, guna memastikan kelancaran dan transparansi 
                    pelaksanaan program.
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Fitur 2 : Permohonan Kunjungan</h3>
                    <p class="description">
                    Pengajuan permohonan kunjungan ke BBPOM Mataram dapat 
                    dipantau status permohonan, jadwal tersedia, dan konfirmasi 
                    penerimaan melalui sistem yang disediakan untuk kemudahan akses.
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Fitur 3 : Permohonan Narasumber</h3>
                    <p class="description">
                    Permohonan narasumber untuk kegiatan di tempat pemohon dapat 
                    diajukan dan dipantau statusnya, termasuk informasi siapa 
                    narasumber yang akan dihadirkan dan jadwal kegiatan.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </section>


    <div class="contact-section" style="margin-bottom:0;margin-top:0">
        <div class="container" style="margin-bottom:0;margin-top:0">
            <div class="row mg-4" style="margin-bottom:0;margin-top:0">
                <h1 style="margin-bottom:0;margin-top:0">Data PKL</h1>
            </div>
        </div>
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

    <section class="pengaduan-section" id="pengaduan">
    <div class="contact-section">
        <div class="container">
            <div class="row mg-4" style="margin-bottom:0">
                <h1>Pengaduan</h1>
                <div class="col-lg-6">

                    <div class="row gy-4">
                        <div class="col-md-6 text-center">
                            <div class="info-box">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Alamat</h3>
                                <p>-----<br>------</p>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="info-box">
                                <i class="bi bi-telephone"></i>
                                <h3>Telephone</h3>
                                <p>Nomor Kantor</p>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="info-box">
                                <i class="bi bi-envelope"></i>
                                <h3>Email Kami</h3>
                                <p >Diisi Email Kantor</p>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="info-box">
                                <i class="bi bi-clock"></i>
                                <h3>Jam Buka</h3>
                                <p>Senin - Jumat<br>08.00 - 16:00</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 form" style="margin-top:0">
                    
                    <form action="" method="POST" class="php-email-form">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Email Anda" required>
                            </div>
                            
                            <div class="col-md-6 ">
                                <input type="no_hp" class="form-control" name="no_hp" placeholder="Nomor HP" required>
                            </div>

                            <div class="col-md-6">
                            <select class="form-control" id="subject" name="subject" required>
                                <option value="" disabled selected hidden>Select an option</option>
                                <option value="obat">obat</option>
                                <option value="kosmetik">kosmetik</option>
                                <option value="makanan">makanan</option>
                            </select>
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="pesan" rows="5" placeholder="Pesan"
                                    required></textarea>
                            </div>
                            <div class="col-md-12">
                                <label style="color:#1c456d">Masukkan Foto (Optional)</label>
                                <input type="file" class="form-control" name="foto_pengaduan" placeholder="Subject">
                            </div>
                            
                            
                                <input type="hidden" id="jam" name="jam">
                                <input type="hidden" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
                            
                            <?php
                            $sql2 = "SELECT * FROM api where id = 8";
                            $result2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            $no_cs = $row2['no_cs'];
                            $text = "halo, bpom";
                            ?>
                            <div class="col-md-12 text-center">
                                <a href="https://wa.me/62<?php echo $no_cs ?>?text=<?php urlencode($text) ?>"><button type="submit" name="submit">Send Message</button></a>
                                
                            </div>

                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
    
    </section>
    
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
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const currentTime = `${hours}:${minutes}:${seconds}`;


        // Simpan waktu di kolom tersembunyi untuk dikirim ke server
        document.getElementById('jam').value = currentTime;
    }

    // Perbarui jam setiap detik
    setInterval(updateClock, 1000);
    updateClock(); // Panggil sekali saat halaman pertama kali dimuat
    </script>
    <?php require_once('cs.php'); ?>
</body>
<footer class="bg-dark text-white text-center py-2" style="bottom:0">
        <p>Copyright &copy; 2023 BPOM. All rights reserved.</p>
    </footer>

</html>