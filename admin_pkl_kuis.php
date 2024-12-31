<?php
include('koneksi.php');
session_start();
$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role != "admin") {
        header('location:' . $urlweb . '/' . $role . '.php');
    }
} else {
    header("Location: " . $urlweb);
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT * FROM penempatan_pkl WHERE 
        posisi LIKE '%$search%' OR 
        deskripsi LIKE '%$search%' OR 
        jurusan LIKE '%$search%' OR 
        kuota LIKE '%$search%'";

$result = mysqli_query($conn, $sql);
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
    <title>Admin Dashboard</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/custom2.css">
</head>

<body>
<style>
        .card{
            cursor:default;
        }
        
        /* Hover style untuk memperbesar dan mengubah warna */
        .card:hover {
        background-color: #007bff; /* warna biru */
        transform: scale(1.05); /* memperbesar */
        color: #fff; /* Ubah teks menjadi putih */
        }
            
        .card-wrapper {
            display: flex;
            flex-wrap: wrap; /* Elemen akan turun ke baris baru jika melebihi batas */
            gap: 1rem; /* Jarak antar elemen */
        }

        .card {
            flex: 0 0 calc(33.333% - 1rem); /* 33.333% untuk memastikan 3 elemen per baris */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
            padding: 1rem;
            text-align: center;
        }
                    
        /* Style untuk kartu yang tetap aktif setelah diklik */
        .card.active {
        background-color: #007bff; /* warna biru */
        transform: scale(1.15); /* memperbesar */
        color: #fff; /* Ubah teks menjadi putih */
        }

        .card h2 {
        font-size: 2.5rem;
        margin: 0;
        color: inherit; /* Agar warna h2 berubah sesuai konteks */
        }

        .card .card-icon {
        font-size: 3rem;
        color: inherit; /* Agar warna ikon berubah sesuai konteks */
        }


        .card .card-icon {
        font-size: 3rem;
        color: #777;
        }
        .cards {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        }
        /* Untuk layar dengan lebar maksimum 768px (tablet dan handphone) */
        @media (max-width: 768px) {
            .card-wrapper {
                flex-direction: row; /* Atur elemen dalam kolom */
                align-items: center;   /* Pusatkan elemen */
                gap: 1rem;             /* Jarak antar elemen tetap */
            }

            .card {
                flex: 0 0 100%;         /* Kartu mengambil lebar penuh */
                padding: 1rem;         /* Tambahkan ruang di dalam kartu */
                transform: scale(1);   /* Hindari pembesaran default */
            }

            .card:hover {
                transform: scale(1.02); /* Efek hover sedikit untuk layar kecil */
            }

            .card h2 {
                font-size: 1.8rem;      /* Ukuran font lebih kecil */
            }

            .card .card-icon {
                font-size: 2.5rem;      /* Ukuran ikon lebih kecil */
            }
        }

        /* Untuk layar dengan lebar maksimum 480px (handphone kecil) */
        @media (max-width: 480px) {
            .card-wrapper {
                gap: 0.5rem;            /* Kurangi jarak antar elemen */
            }

            .card {
                padding: 0.8rem;        /* Kurangi padding di dalam kartu */
            }

            .card h2 {
                font-size: 1.5rem;      /* Ukuran font lebih kecil */
            }

            .card .card-icon {
                font-size: 2rem;        /* Ukuran ikon lebih kecil */
            }
        }

    </style>
    
    <?php include 'header_admin.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
        <?php include('sidebar_admin.php'); ?>

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-2">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Penempatan PKL</h3>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <a href="function/TambahSoalKuis.php" class="btn btn-success">Tambah Soal</a>
                        <a href="admin_pkl_kuis_hasil.php" class="btn btn-primary">Lihat Hasil Kuis</a>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                    </div>
                                  
                    <div class="container">
                        <div class="card-wrapper">
                            <?php
                            $no = 1;
                            while ($row2 = mysqli_fetch_assoc($result)) { ?>
                                <div class="card" style="cursor: pointer;" onclick="goToPage('<?php echo $row2['posisi']; ?>')">
                                    <div class="card-icon">📋</div>
                                    <h2><?php echo "{$row2['posisi']}"; ?></h2>
                                </div>
                                
                            <?php
                                $no++;
                            }
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
        <script>
            $(document).ready(function() {
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('searchInput');
                    const searchForm = document.getElementById('searchForm');

                    searchInput.addEventListener('input', function() {
                        searchForm.submit(); // Kirim form secara otomatis saat input berubah
                    });
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script>
            // Fungsi untuk navigasi ke halaman baru dengan parameter posisi
            function goToPage(posisi) {
                // Navigasi ke page tujuan dengan query parameter
                window.location.href = `admin_pkl_kuis_soal.php?posisi=${encodeURIComponent(posisi)}`;
            }
        </script>

</body>

</html>