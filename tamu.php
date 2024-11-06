<?php
include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role != "tamu" && $role != "admin") {
        header('location:' . $urlweb . '/' . $role . '.php');
    }
} else {
    header("Location: " . $urlweb);
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    if ($role == "admin") {
        $email = "";
        $nama = "";
        $no_hp = "";
    } else {
        $sql = "SELECT * FROM users where id ='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $nama = $row['nama'];
        $no_hp = $row['no_hp'];
    }
} else {
    header("Location: " . $urlweb);
}
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
    <link rel="stylesheet" href="vendor\fontawesome\css\all.min.css">
    <link rel="stylesheet" href="Asset/CSS/style_pkl.css">
    <title>pkl</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .section-title {
            font-size: 2.5rem;
            color: #343a40;
            margin-bottom: 1rem;
        }

        .section-description {
            font-size: 1.25rem;
            color: #6c757d;
        }

        .bidang-card {
            border: 1px solid rgba(156, 156, 156, 0.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-img-top {
            border-radius: 10px;
            height: 200px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 1rem;
            color: #495057;
        }

        @media (max-width: 768px) {
            .card-title {
                font-size: 1.25rem;
            }

            .card-text {
                font-size: 0.875rem;
            }
        }
        .clock {
            font-size: 3rem;
            font-weight: bold;
            color: #333;
        }
        @media (max-width: 576px) {
        /* Mengatur ukuran judul pada perangkat mobile */
        .section-title {
            font-size: 1.5rem;
        }

        /* Mengatur ukuran teks pada perangkat mobile */
        .section-description, .card-title, .card-text {
            font-size: 0.875rem;
        }

        /* Mengatur ukuran card pada perangkat mobile */
        .bidang-card {
            margin-bottom: 1rem;
        }

        /* Memastikan tabel dapat digulir secara horizontal di perangkat kecil */
        .table-responsive {
            overflow-x: auto;
        }

        /* Menyederhanakan hero section pada perangkat kecil */
        .hero-section .hero-title {
            font-size: 1.25rem;
        }

        /* Mengubah ukuran gambar pada perangkat mobile */
        .hero-section img {
            width: 180px;
            height: 180px;
        }
    }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Asset/Gambar/logo.png" alt="#" width="60px" height="60px"
                    style="margin-left: 15px; margin-right: 10px;">
                <b>BBPOM MATARAM</b>
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
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

    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="title">Selamat datang di Portal Siap Melayani</h1>
                    <p class="hero-description">Balai Besar Pengawas Obat dan Makanan di Mataram</p>
                    <a href="tamu_pengajuan.php" class="btn btn-warning btn-cta">Ajukan Kunjungan ➔</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="Asset/Gambar/logo.png" alt="Hero Image" class="img-fluid" height="290px" width="290px">
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-3">
        <h2 class="title">Tabel kunjungan</h2>
    </div>

    <div class="container mt-3 mb-5">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="bg-primary" style="vertical-align: middle; color: white;">
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Instansi</th>
                    <th scope="col">Keperluan</th>
                    <th scope="col">Jumlah Peserta</th>
                    <th scope="col">Segmen Peserta</th>
                    <th scope="col">Tanggal Dan Jam</th>                            
                    <th scope="col">Surat Masuk</th>
                    <th scope="col">Surat Balasan</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql2 = "SELECT * FROM kunjungan";
                    $result2 = mysqli_query($conn, $sql2);
                    $no = 1;
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo "<tr>";
                        echo "<td scope='row'>{$no}</td>";
                        echo "<td>{$row2['no_hp']}</td>";
                        echo "<td>{$row2['instansi']}</td>";
                        echo "<td>{$row2['keperluan']}</td>";
                        echo "<td>{$row2['jumlah_peserta']}</td>";
                        echo "<td>{$row2['segmen_peserta']}</td>";
                        echo "<td>{$row2['tanggal']}/{$row2['jam']}</td>";
                        echo "<td>
                                <button class='btn btn-primary btn-open-pdf' data-pdf-path='{$row2['surat_masuk']}'>
                                    Lihat Surat Masuk
                                </button>
                                <a href='{$row2['surat_masuk']}' download='{$row2['surat_masuk']}' class='btn btn-secondary'>
                                    <i class='fas fa-download'></i>
                                </a>
                            </td>";
                        echo "<td>
                            <button class='btn btn-primary btn-open-pdf' data-pdf-path='{$row2['surat_balasan']}'>
                                Lihat Surat Balasan
                            </button>
                            <a href='path/to/surat/{$row2['surat_balasan']}' download='{$row2['surat_balasan']}' class='btn btn-secondary'>
                                <i class='fas fa-download'></i>
                            </a>
                          </td>";
                        echo "<td>{$row2['status_kunjungan']}</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Isi Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="pdfViewer" src="" width="100%" height="500px" style="border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
    <?php require_once('cs.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        // JavaScript untuk membuka PDF di tab baru
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".btn-open-pdf").forEach(button => {
                button.addEventListener("click", function () {
                    let pdfPath = this.getAttribute("data-pdf-path");

                    // Mengganti spasi dengan %20 untuk memastikan URL valid
                    pdfPath = pdfPath.replace(/ /g, "%20");

                    // Membuka PDF di tab baru dengan target _blank tanpa memicu unduhan
                    window.open(pdfPath, '_blank');
                });
            });
        });
    </script>
</body>

</html>