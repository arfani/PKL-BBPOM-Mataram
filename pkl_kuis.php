<?php
include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

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

?>
<?php

$message = '';


// Query untuk mengambil posisi
$sql = "SELECT posisi FROM pengajuan_pkl WHERE email = ? AND phone = ?";
$stmt = $conn->prepare($sql);

// Validasi query berhasil dipersiapkan
if (!$stmt) {
    die("Kesalahan SQL: " . $conn->error);
}

$stmt->bind_param("ss", $email, $no_hp);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row2 = $result->fetch_assoc();
    $posisi = $row2['posisi']; // Simpan nilai posisi ke variabel
} else {
    $message = 'Anda belum melengkapi data diri.';
}

// Tutup statement
$stmt->close();
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
    <link rel="stylesheet" href="Asset/CSS/style_kuis.css">

</head>

<body>
    
<?php if ($message): ?>
        <script>
            Swal.fire({
                title: 'Informasi',
                text: '<?php echo $message; ?>',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>
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
                        <a href="pkl_ResPw.php" class="btn btn-primary">Ubah Password</a>
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

    <div id="sidebar" class="sidebar col-md-3 col-lg-1 d-none d-md-block" style="box-shadow: 0 3px 3px black;">
        <div class="position-sticky pt-2 sidebar-sticky">
            <div id="countdown" style="font-size: 2rem; color: #fff;" class="text-center"></div>
        </div>
    </div>

    <div class=" px-md-0 main-content">
    <div class="container">
        
    <?php 
    // Ambil pertanyaan jenis pilihan ganda dari tabel `kuis`
    $query_ganda = "SELECT * FROM kuis WHERE posisi = '$posisi' AND jenis_pertanyaan = 'pilihan_ganda' ORDER BY RAND() LIMIT 10";
    $result_ganda = $conn->query($query_ganda);

    // Ambil pertanyaan jenis uraian dari tabel `kuis`
    $query_uraian = "SELECT * FROM kuis WHERE posisi = '$posisi' AND jenis_pertanyaan = 'uraian' ORDER BY RAND() LIMIT 2";
    $result_uraian = $conn->query($query_uraian);

    $no = 1;

    // Form untuk soal
    if ($result_ganda->num_rows > 0 || $result_uraian->num_rows > 0) {
        echo '<form id="quizForm" action="function/process_quiz.php" method="POST">';
        
        // Soal Pilihan Ganda
        if ($result_ganda->num_rows > 0) {
            while ($row_ganda = $result_ganda->fetch_assoc()) {
                echo "<div class='mb-3'>";
                echo "<h4>{$no}. {$row_ganda['question_text']}</h4>";
                echo "<input type='hidden' name='nama' value='$nama'>";
                echo "<input type='hidden' name='question_text_{$row_ganda['id']}' value='{$row_ganda['question_text']}'>";
                echo "<input type='radio' name='question_{$row_ganda['id']}' value='A'> {$row_ganda['option_a']}<br>";
                echo "<input type='radio' name='question_{$row_ganda['id']}' value='B'> {$row_ganda['option_b']}<br>";
                echo "<input type='radio' name='question_{$row_ganda['id']}' value='C'> {$row_ganda['option_c']}<br>";
                echo "<input type='radio' name='question_{$row_ganda['id']}' value='D'> {$row_ganda['option_d']}<br>";
                echo "<input type='hidden' name='jenis_pertanyaan_{$row_ganda['id']}' value='{$row_ganda['jenis_pertanyaan']}'>";
                echo "</div>";
                $no++;
            }
        } else {
            echo "<p>Tidak ada pertanyaan pilihan ganda.</p>";
        }

        // Soal Uraian
        // Soal Uraian
if ($result_uraian->num_rows > 0) {
    while ($row_uraian = $result_uraian->fetch_assoc()) {
        echo "<div class=''>";
        echo "<h4>{$no}. {$row_uraian['question_text']}</h4>";
        echo "<input type='hidden' name='nama' value='$nama'>";
        echo "<input type='hidden' name='question_text_{$row_uraian['id']}' value='{$row_uraian['question_text']}'>";
        
        // Textarea dengan ukuran yang lebih besar
        echo "<textarea name='question_{$row_uraian['id']}' class='form-control'  style='width:100%; resize: none; font-size: 1.1rem;' placeholder='Jawaban Anda'></textarea>";
        
        echo "<input type='hidden' name='jenis_pertanyaan_{$row_uraian['id']}' value='{$row_uraian['jenis_pertanyaan']}'>";
        echo "</div>";
        $no++;
    }
} else {
    echo "<p>Tidak ada pertanyaan uraian.</p>";
}


        // Tombol submit
        echo '<button class="btn btn-primary btn-cta text-nowrap mt-4" type="submit">Submit</button>';
        echo '</form>';
    } else {
        echo "Tidak ada pertanyaan yang tersedia.";
    }

    $conn->close();
    ?>

        
            </div>
            </div>
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Durasi hitung mundur dalam detik (30 menit)
        const countdownDuration = 10 * 60;

        // Fungsi untuk menghitung waktu mundur
        function startCountdown() {
            const now = Date.now();

            // Cek apakah waktu akhir sudah tersimpan di LocalStorage
            let endTime = localStorage.getItem("quizEndTime");

            if (!endTime) {
                // Jika belum ada waktu akhir, set waktu akhir
                endTime = now + countdownDuration * 1000; // Konversi ke milidetik
                localStorage.setItem("quizEndTime", endTime);
            }

            const timerInterval = setInterval(() => {
                const currentTime = Date.now();
                const timeLeft = Math.floor((endTime - currentTime) / 1000); // Hitung waktu tersisa dalam detik

                if (timeLeft > 0) {
                    // Hitung menit dan detik tersisa
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;

                    // Tampilkan waktu dengan format MM:SS
                    document.getElementById("countdown").textContent = 
                        `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                } else {
                    // Jika waktu habis
                    clearInterval(timerInterval);
                    alert("Waktu habis! Jawaban Anda akan diproses.");
                    localStorage.removeItem("quizEndTime"); // Hapus waktu akhir dari LocalStorage
                    document.getElementById("quizForm").submit(); // Submit formulir kuis
                }
            }, 1000);
        }

        // Jalankan hitungan mundur saat halaman dimuat
        document.addEventListener("DOMContentLoaded", () => {
            startCountdown();
        });

        // Gunakan Visibility API untuk mendeteksi perubahan tab
        document.addEventListener("visibilitychange", () => {
            if (document.visibilityState === "visible") {
                startCountdown(); // Sinkronkan ulang saat kembali ke tab
            }
        });
    </script>


</body>

</html>