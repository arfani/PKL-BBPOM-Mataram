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
    $alamat = $_POST['alamat'];
    $subject = $_POST['subject'];
    $pesan = $_POST['pesan'];
    $tanggal = date('Y-m-d');
    $jam = $_POST['jam'];
    $no_hp = $_POST['no_hp'];
    
    
    $foto_pengaduan = $_FILES['foto_pengaduan'];
    $foto_identitas = $_FILES['foto_identitas'];
    $foto_pengaduan_nama = NULL;
    $foto_identitas_nama = NULL;
    // Check jika ada file foto_pengaduan yang diunggah
    if (!empty($foto_pengaduan['name'])) {
        $target_dir = "Asset/Document/Pengaduan/Foto-Pendukung/";
        $foto_pengaduan_nama = basename($foto_pengaduan["name"]);
        $target_file_pengaduan = $target_dir . $foto_pengaduan_nama;
        move_uploaded_file($foto_pengaduan["tmp_name"], $target_file_pengaduan);
    }

    // Check jika ada file foto_identitas yang diunggah
    if (!empty($foto_identitas['name'])) {
        $target_dir = "Asset/Document/Pengaduan/Foto-Identitas/";
        $foto_identitas_nama = basename($foto_identitas["name"]);
        $target_file_identitas = $target_dir . $foto_identitas_nama;
        move_uploaded_file($foto_identitas["tmp_name"], $target_file_identitas);
    }

    // Query untuk menyimpan data, termasuk foto_pengaduan dan foto_identitas jika ada
    $sql = "INSERT INTO pengaduan (tanggal, nama, alamat, no_hp, subject, pesan,  foto_ktp, foto_pengaduan, jam) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $tanggal, $nama, $alamat, $no_hp, $subject, $pesan, $foto_identitas_nama, $foto_pengaduan_nama,  $jam);

    $result = $stmt->execute();

    if ($result) {
        if ($subject == 'Obat') {
            $angka_unik = '1';
        } else if ($subject == 'Obat Bahan Alam') {
            $angka_unik = '2';
        } else if ($subject == 'Pangan Olahan') {
            $angka_unik = '3';
        } else if ($subject == 'Kosmetik') {
            $angka_unik = '4';
        } else if ($subject == 'Suplemen Kesehatan') {
            $angka_unik = '5';
        } else if ($subject == 'Lainnya') {
            $angka_unik = '6';
        } 
        $last_id = mysqli_insert_id($conn);
    
        // Pastikan $last_id terdiri dari 3 digit
        $last_id = str_pad($last_id, 3, '0', STR_PAD_LEFT);
    
        // Ambil digit ke-5, ke-6, dan ke-7 dari nomor HP
        $digit_hp = substr($no_hp, 4, 3);
    
        // Ambil hari (DD) dari tanggal
        $day = date('d', strtotime($tanggal));
    
        // Gabungkan untuk membuat kode unik
        $kode_unik = $last_id . $digit_hp . $day . $angka_unik;
    
        // Update data dengan kode unik
        $update = mysqli_query($conn, "UPDATE pengaduan SET kode_unik = '$kode_unik' WHERE id = '$last_id'");
        if($update){
            header("Location: landing_page.php?kode_unik=$kode_unik&jenis=pengaduan");
            exit;
        } else {
            echo "<script>alert('Gagal memperbarui kode unik.');</script>";
        }
    } else {
        echo "<script>alert('Woops! Ada kesalahan saat menyimpan: " . $conn->error . "');</script>";
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
    <title>SIAP MELAYANI</title>
    
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
                            <a class="nav-link" href="#fitur">Fitur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#permohonan">Permohonan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pengaduan">Pengaduan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="hero-section p-0 mt-5 mb-5">
        <br><br>
        <div class="container mt-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    
                    <h1 class="hero-title">SIAP MELAYANI</h1>
                    <p class="hero-description">Sistem Aplikasi Manajemen Layanan Publik Informasi</p>
                    <a class="btn btn-primary mb-0" href="login.php">Login</a>
                    <div class="row align-item-center">
                    <div></div>
                        <img src="Asset/Gambar/si inges (1).png" alt="Hero Image" class="ms-5 p-0 mt-0 hero-section icon animated w-25 h-auto" style="background:transparent">
                        <img src="Asset/Gambar/si solah.png" alt="Hero Image" class="ms-5 p-0 mt-0 hero-section icon animated w-25 h-auto" style="background:transparent">
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="Asset/Gambar/Siap-Melayani-Logo.png" alt="Hero Image" class="hero-section logo animated p-0"
                    style="width:400px; height:auto; background:transparent">
                </div>
            </div>
            
        </div>
        <br><br>
    </div>
    
    <section class="fitur-section" id="fitur">
    <div class="vision-mission-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="section-title">Portal Layanan Informasi BBPOM di Mataram</h1>
                    <p>Merupakan website yang mengelola data Kunjungan, Pengajuan Narasumber dan Tempat Melakukan Pengajuan
                        online yang di kelola oleh BBPOM di Mataram dengan penjelasan sbb :</p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Fitur 1 : Pendaftaran Dan Monitoring PKL</h3>
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

<section id="pkl">
    <div class="contact-section p-0 ">
        <div class="container p-0">
            <div class="text-center p-0" >
                <h1 class="mt-0 mb-3">Data PKL</h1>
            </div>
        </div>
        <!-- Card Section -->
        <div class="row d-flex justify-content-center mb-4">
            <div class="col-md-2">
                <div class="card p-3">
                    <div class="card-icon">😊</div>
                    <h2><?php echo $selesai_pkl; ?></h2>
                    <p>PKL Selesai</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card p-3">
                    <div class="card-icon">📋</div>
                    <h2><?php echo $sedang_pkl; ?></h2>
                    <p>Sedang PKL</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card p-3">
                    <div class="card-icon">🎧</div>
                    <h2><?php echo $pkl_batal; ?></h2>
                    <p>Batal</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card p-3">
                    <div class="card-icon">👥</div>
                    <h2><?php echo $lowongan; ?></h2>
                    <p>Lowongan</p>
                </div>
            </div>
        </div>
        <div class="w-75 mx-auto p-3 ps-0">
            <a href="register.php" class="btn btn-primary">Daftar Sekarang</a>
        </div>
    </div>
        
        <div class="table-responsive d-flex justify-content-center">
            <table class="table table-bordered table-striped table-hover w-75">
                <thead class="table text-center align-middle" style="background-color: skyblue;">
                    <?php                      
                    $sql = "SELECT * FROM penempatan_pkl ";
                    $result = mysqli_query($conn, $sql);
                    ?>
                    <tr>
                        <th>#</th>
                        <th>Posisi & Penempatan</th>
                        <th>Deskripsi</th>
                        <th>Kualifikasi Jurusan</th>
                        <th>Kuota Tersedia</th>
                    </tr>
                </thead>
                <tbody>
    
                    <?php
                    $no = 1;
                    while ($row2 = mysqli_fetch_assoc($result)) {
                        
                        $sql3 = "SELECT COUNT(*) as jumlah FROM pengajuan_pkl WHERE  posisi = '{$row2['posisi']}' AND status = 'Diterima'";
                        $result2 = mysqli_query($conn, $sql3);
                        $aktif = mysqli_fetch_assoc($result2)['jumlah'] ?? 0;
                        $tersedia = $row2['kuota'] - $aktif;

                        echo "<tr>";
                        echo "<td class='text-center align-middle'>{$no}</td>";
                        echo "<td class='text-center align-middle'>{$row2['posisi']}</td>";
                        echo "<td>{$row2['deskripsi']}</td>";
                        echo "<td class='align-middle'>{$row2['jurusan']}</td>";
                        
                        echo "<td class='text-center align-middle'>{$tersedia}</td>";
                        echo "</tr>";
                        $no++;
                    }
                    
                    ?>
                </tbody>
            </table>
            
        </section>
        <section>
            <div class="contact-section p-0 mt-5">
                <div class="container p-0">
                    <div class="text-center p-0" >
                        <h1 class="mt-0 mb-3">Jadwal Kegiatan Terdekat</h1>
                    </div>
                </div>
                <div class="w-75 mx-auto p-3 ps-0">
                    <a href="pencarian_resi.php" class="btn btn-primary ms-2"><i class="fas fa-search"></i> Pencarian</a>
                    <a href="tamu_pengajuan.php" class="btn btn-primary">Buat Permohonan</a>
                </div>
                <div class="table-responsive d-flex justify-content-center">
                    <table class="table table-bordered table-striped table-hover w-75">
                        <thead class="table text-center align-middle" style="background-color: skyblue;">
                            <?php                      
                    $sql = "SELECT *, DATE_FORMAT(tanggal, '%d-%m-%Y') AS formatted_tanggal 
                            FROM kunjungan 
                            WHERE tanggal >= CURDATE() 
                            ORDER BY tanggal ASC 
                            LIMIT 6";
                    $result = mysqli_query($conn, $sql);

                    ?>
                    <tr>
                        <th>#</th>
                        <th>Instansi</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row3 = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td>{$row3['instansi']}</td>";
                        echo "<td>{$row3['keperluan']}</td>";
                        echo "<td class='text-center align-middle'>{$row3['formatted_tanggal']}</td>";
                        echo "<td class='text-center align-middle'>" . date('H:i', strtotime($row3['jam'])) . "</td>";
                        echo "</tr>";
                        $no++;
                        }
                    
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
    <section class="pengaduan-section" id="pengaduan">
    <div class="contact-section">
        <div class="container">
            <div class="row mg-4 mb-0" style="margin-bottom:0">
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
                    
                <form action="" method="POST" enctype="multipart/form-data" class="php-email-form">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
                        </div>

                        <div class="col-md-12">
                            <label style="color:#1c456d">Foto Kartu Identitas</label>
                            <label style="color:darkgray">(Kerahasiaan Terjamin, hanya digunakan untuk persyaratan pengaduan)</label>
                            <input type="file" class="form-control" name="foto_identitas" placeholder="Foto Identitas" required>
                        </div>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP" required>
                        </div>

                        <div class="col-md-6">
                            <select class="form-control" id="subject" name="subject" required>
                                <option value="" disabled selected hidden>Pilih Kategori</option>
                                <option value="Obat">Obat</option>
                                <option value="Obat Bahan Alam">Obat Bahan Alam</option>
                                <option value="Pangan Olahan">Pangan Olahan</option>
                                <option value="Kosmetik">Kosmetik</option>
                                <option value="Suplemen Kesehatan">Suplemen kesehatan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="pesan" rows="5" placeholder="Detail Pengaduan" required></textarea>
                        </div>
                        
                        <div class="col-md-12">
                            <label style="color:#1c456e">Dokumen Tambahan (Opsional)</label>
                            <input type="file" class="form-control" name="foto_pengaduan" placeholder="Foto Pengaduan">
                        </div>

                        <input type="hidden" id="jam" name="jam">
                        <input type="hidden" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>">

                        <div class="col-md-12 text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Kirim Pengaduan</button>
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
            function updateClock() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                document.getElementById('jam').value = `${hours}:${minutes}:${seconds}`;
            }

            setInterval(updateClock, 1000);
            updateClock();
        });
    </script>

    <?php require_once('cs.php'); ?>
</body>
<footer class="bg-dark text-white text-center py-2" style="bottom:0">
        <p>Copyright &copy; 2023 BPOM. All rights reserved.</p>
    </footer>

</html>