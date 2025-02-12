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

    if (!empty($foto_pengaduan['name'])) {
        $target_dir = "Asset/Document/Pengaduan/Foto-Pendukung/";
        $foto_pengaduan_nama = basename($foto_pengaduan["name"]);
        $target_file_pengaduan = $target_dir . $foto_pengaduan_nama;
        move_uploaded_file($foto_pengaduan["tmp_name"], $target_file_pengaduan);
    }

    if (!empty($foto_identitas['name'])) {
        $target_dir = "Asset/Document/Pengaduan/Foto-Identitas/";
        $foto_identitas_nama = basename($foto_identitas["name"]);
        $target_file_identitas = $target_dir . $foto_identitas_nama;
        move_uploaded_file($foto_identitas["tmp_name"], $target_file_identitas);
    }

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
    
        $last_id = str_pad($last_id, 3, '0', STR_PAD_LEFT);
    
        $digit_hp = substr($no_hp, 4, 3);
    
        $day = date('d', strtotime($tanggal));
    
        $kode_unik = $last_id . $digit_hp . $day . $angka_unik;
    
        $update = mysqli_query($conn, "UPDATE pengaduan SET kode_unik = '$kode_unik' WHERE id = '$last_id'");
        if($update){
            header("Location: landing_page.php?kode_unik=$kode_unik&jenis=pengaduan");
            exit;
        } else {
            echo "<script>console.log('$update');</script>";
        }
    } else {
        echo "<script>console.log('Woops! Ada kesalahan saat menyimpan: " . $conn->error . "');</script>";
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
    <title>SIap Melayani</title>
    <link rel="stylesheet" href="Asset/CSS/uji_coba.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <nav class="navbar">
                <img src="Asset/Gambar/bpom.png" alt="Logo" class="logo">
            <h1>SIAP MELAYANI</h1>
            <ul>
            <li><a class="nav-link" href="#home-section">Home</a></li>
            <li><a class="nav-link" href="#PKL">PKL</a></li>
            <li><a class="nav-link" href="#permohonan">Permohonan</a></li>
            <li><a class="nav-link" href="#pengaduan">Pengaduan</a></li>
        </ul>
    </nav>
    <div class="hitam"></div>
    <section id="home-section">
        <div class="main-home">
            <div class="row1">
                <h1>SIAP MELAYANI</h1>
                <p>Sistem Aplikasi Layanan Manajemen Informasi</p>
                <a href="login.php"><button>Login</button></a>
                <div class="icon">
                    <img src="Asset/Gambar/si inges (1).png" alt="Si Inges">
                    <img src="Asset/Gambar/si solah (1).png" alt="Si Solah">
                </div>
            </div>
            <div class="row2">
                <img src="Asset/Gambar/Siap-Melayani-Logo.png" alt="Logo Siap Melayani">
            </div>
        </div>
        
    </section>
    
    <section id="fitur">
        <div class="fitur-title">
            <div class="garis"></div>
            <h1>Portal Layanan Informasi BBPOM di Mataram</h1>
            <p>Merupakan website yang mengelola data PKL online, Kunjungan online, serta Pengajuan Narasumber
                online yang di kelola oleh <strong>BBPOM di Mataram</strong></p>
        </div>
        
        <div class="isi-fitur">
        <div class="kartu-grup">
            <div class="kartu">
                <img src="Asset/Gambar/Fitur-PKL.jpeg" alt="PKL">
                <div class="layer"></div>
                <div class="info">
                <h1>Pendaftaran Dan Monitoring PKL</h1>
                <p>
                    Pengelolaan PKL meliputi proses permohonan, penerimaan 
                    peserta, serta monitoring jalannya PKL, baik reguler 
                    maupun MBKM, guna memastikan kelancaran dan transparansi 
                    pelaksanaan program.
                </p>
                <a href="register.php"><button>Daftar</button></a>
                </div>
            </div>
            <div class="kartu">
                <img src="Asset/Gambar/Fitur-Kunjungan.jpeg" alt="Kunjungan">
                <div class="layer"></div>
                <div class="info">
                <h1>Permohonan Kunjungan</h1>
                <p>
                    Pengajuan permohonan kunjungan ke BBPOM Mataram dapat 
                    dipantau status permohonan, jadwal tersedia, dan konfirmasi 
                    penerimaan melalui sistem yang disediakan untuk kemudahan akses.
                </p>
                <a href="tamu_pengajuan.php"><button>Buat Permohonan</button></a>
                </div>
            </div>
            <div class="kartu">
                <img src="Asset/Gambar/Fitur_Narasumber.jpeg" alt="Narasumber">
                <div class="layer"></div>
                <div class="info">
                <h1>Permohonan Narasumber</h1>
                <p>
                    Permohonan narasumber untuk kegiatan di tempat pemohon dapat 
                    diajukan dan dipantau statusnya, termasuk informasi siapa 
                    narasumber yang akan dihadirkan dan jadwal kegiatan.
                </p>
                <a href="tamu_pengajuan.php"><button>Buat Permohonan</button></a>
             </div>
            </div>
        </div>
        </div>
    </section>
    <section id="PKL">
        <div>
        <div class="fitur-title">
            <div class="garis" style="margin-top:20px;"></div>
                <h1 style="margin-top:10px">Data PKL</h1>
            </div>
            <div class="card-group" style="margin-top: 30px">
                <div id="selesai" class="card" style="border: 2px solid teal;">
                    <h2>✅</h2>
                    <h1><?php echo "$selesai_pkl"; ?></h1>
                    <p>PKL Selesai</p>
                </div>
                <div id="sedang" class="card" style="border: 2px solid orange;">
                    <h2>📔</h2>
                    <h1><?php echo "$sedang_pkl"; ?></h1>
                    <p>Sedang PKL</p>
                </div>
                <div id="batal" class="card" style="border: 2px solid lightcoral;">
                    <h2>❌</h2>   
                    <h1><?php echo "$pkl_batal"; ?></h1>
                    <p>Batal/Ditolak</p>
                </div>
                <div id="lowongan" class="card" style="border: 2px solid grey;">
                    <h2>🧾</h2>
                    <h1><?php echo "$lowongan"; ?></h1>
                    <p>Lowongan</p>
                </div>
            </div>
        </div>
        <div class="table-container">
            <a href="register.php"><button class="btn-daftar">DAFTAR</button></a>
            <table class="styled-table">
                <thead>
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
                    $sql = "SELECT * FROM penempatan_pkl ";
                    $result = mysqli_query($conn, $sql);
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
        </div>
    </section>
    <section id="permohonan">
        <div class="fitur-title">
            <div class="garis"></div>
            <h1>Jadwal Undangan BBPOM Mataram</h1>
            <p>Kalender dibawah ini merupakan jadwal kegiatan <strong>BBPOM Mataram</strong> bulan ini</p>
        </div>
        
        <div class="calendar-container">
            <?php
            $sql = "SELECT tanggal, keperluan, jam, instansi FROM kunjungan";
            $result = $conn->query($sql);
            
            $kunjungan = [];
            
            // Simpan data dalam array
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $kunjungan[] = $row;
                }
            }
            // Konversi data ke JSON dan kirimkan ke JavaScript
            echo "<script>const kunjunganData = " . json_encode($kunjungan) . ";</script>";            
            ?>
            <h1 id="month-year"></h1>
            <table class="calendar">
            <thead>
                <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                </tr>
            </thead>
            <tbody id="calendar-body">
                <!-- Kalender akan di-generate oleh JavaScript -->
            </tbody>
            </table>
            <div class="kegiatan-container">
                <a href="tamu_pengajuan.php"><button><i class="fas fa-paper-plane"></i> Buat Pengajuan Kegiatan</button></a>
                <a href="pencarian_resi.php"><button><i class="fas fa-search"></i> Pencarian Kegiatan</button></a>
            </div>
        </div>
    </section>
    <section id="pengaduan">
        <div class="fitur-title">
            <div class="garis"></div>
            <h1>Pengaduan</h1>
        </div>
        <div class="pengaduan">
            <div class="pengaduan-row1">
                <div class="card">
                    <h2><i class="fas fa-map-pin"></i></h2>
                    <h3>Alamat</h3>
                    <p>Jl. Catur Warga,<br>Mataram Timur, Kec. Mataram,<br>Kota Mataram,<br>Nusa Tenggara Barat</p>
                </div>
                <div class="card">
                    <h2><i class="fas fa-phone"></i><h2>
                    <h3>Telephone</h3>
                    <p>(0370) 621926</p>
                </div>
                <div class="card">
                    <h2><i class="fas fa-envelope"></i></h2>
                    <h3>Email</h3>
                    <p>bpom_mtrm@yahoo.com</p>
                </div>
                <div class="card">
                    <h2><i class="fas fa-clock"></i></h2>
                    <h3>Jam Buka</h3>
                    <p>Senin - Jumat<br>08.00 - 16:00</p>
                </div>
            </div>
            <div class="form-wrapper">
        <form class="custom-form" method="POST" action="" enctype="multipart/form-data">
            <h1>Formulir Pengaduan</h1>

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text"  placeholder="Masukkan nama lengkap Anda" name="nama">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="alamat" name="alamat" placeholder="Masukkan Alamat Anda">
            </div>
            <div class="form-group">
                <label for="no_hp">Nomor Whatsapp</label>
                <input name="no_hp" type="number" placeholder="Masukkan Nomor Anda">
            </div>
            <div class="form-group">
                <label style="color:#1c456d">Foto Kartu Identitas</label>
                <label class="hide" style="color:darkgray;">(Kerahasiaan Terjamin, hanya digunakan untuk persyaratan pengaduan)</label>
                <input type="file" class="form-control" name="foto_identitas" placeholder="Foto Identitas" required>
            </div>
            <div class="form-group">
                <label for="subject">Jenis Pengaduan</label>
                <select name="subject" id="subject">
                    <option value="" disabled selected hidden>Pilih Kategori</option>
                    <option value="Obat">Obat</option>
                    <option value="Obat Bahan Alam">Obat Bahan Alam</option>
                    <option value="Pangan Olahan">Pangan Olahan</option>
                    <option value="Kosmetik">Kosmetik</option>
                    <option value="Suplemen Kesehatan">Suplemen kesehatan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pesan">Detail Pengaduan</label>
                <textarea name="pesan" id="Pesan" rows="4" placeholder="Berikan Keterangan Tentang Hal Yang Diadukan"></textarea>
            </div>
            <div class="form-group">
                <label style="color:#1c456e">Dokumen Tambahan (Opsional)</label>
                <input type="file" class="form-control" name="foto_pengaduan" placeholder="Foto Pengaduan">
            </div>
            <input type="hidden" id="jam" name="jam">
            <input type="hidden" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
            <button name="submit" type="submit" class="submit-btn">Kirim</button>
        </form>
    </div>
        </div>
    </section>
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
    document.addEventListener("DOMContentLoaded", function () {
        const calendarBody = document.getElementById("calendar-body");
        const monthYear = document.getElementById("month-year");

        const months = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Augustus", "September", "Oktober", "November", "Desember"
        ];

        const today = new Date();
        const currentMonth = today.getMonth();
        const currentYear = today.getFullYear();

        // Update judul bulan dan tahun
        monthYear.textContent = `${months[currentMonth]} ${currentYear}`;

        // Generate kalender dengan data
        function generateCalendar(month, year) {
            calendarBody.innerHTML = "";

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            let date = 1;

            for (let i = 0; i < 6; i++) {
            const row = document.createElement("tr");

            for (let j = 0; j < 7; j++) {
                const cell = document.createElement("td");

                if (i === 0 && j < firstDay) {
                cell.classList.add("empty");
                } else if (date > daysInMonth) {
                cell.classList.add("empty");
                } else {
                const fullDate = `${year}-${String(month + 1).padStart(2, "0")}-${String(date).padStart(2, "0")}`;
                cell.textContent = date;

                // Periksa apakah tanggal ada di data kunjungan
                const kunjungan = kunjunganData.filter(item => item.tanggal === fullDate);

                if (kunjungan.length > 0) {
                    cell.classList.add("scheduled");

                    // Tambahkan tooltip untuk setiap jadwal
                    kunjungan.forEach(item => {
                    const tooltip = document.createElement("div");
                    tooltip.classList.add("tooltip");
                    tooltip.textContent = `Keperluan: ${item.keperluan}, Jam: ${item.jam}`;
                    cell.appendChild(tooltip);
                    });
                }

                date++;
                }

                row.appendChild(cell);
            }

            calendarBody.appendChild(row);
            }
        }

        generateCalendar(currentMonth, currentYear);
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const intro = document.getElementById("intro");
        const content = document.getElementsByTagName("body");

        // Tunggu animasi selesai (3 detik sesuai durasi animasi CSS)
        setTimeout(() => {
            intro.style.display = "none"; // Sembunyikan intro
            content.style.display = "block"; // Tampilkan konten utama
        }, 5000);
        });
    </script>
</body>
</html>