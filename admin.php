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

$no = 1;
// Handle pagination
$limit = 10; // Entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch `pengaduan` data with pagination
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$sql2 = "SELECT * FROM users WHERE 
        nama LIKE '%$search%' OR 
        email LIKE '%$search%' OR 
        universitas LIKE '%$search%' OR 
        no_hp LIKE '%$search%' LIMIT ?, ?";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result2 = $stmt->get_result();

// Count total rows for pagination
$total_sql = "SELECT COUNT(*) AS total FROM users";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

$no = $offset + 1;

$sql = "SELECT SUM(kuota) as jumlah FROM penempatan_pkl";
$result = mysqli_query($conn, $sql);
$lowongan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL batal
$sql = "SELECT COUNT(*) as jumlah FROM kunjungan WHERE keperluan = 'kunjungan'";
$result = mysqli_query($conn, $sql);
$jml_kunjungan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL sedang
$sql = "SELECT COUNT(*) as jumlah FROM kunjungan WHERE keperluan = 'narasumber'";
$result = mysqli_query($conn, $sql);
$jml_narasumber = mysqli_fetch_assoc($result)['jumlah'];

$total_permohonan = $jml_kunjungan + $jml_narasumber;
// Menghitung jumlah lowongan (total kuota di tabel penempatan_pkl)
$sql = "SELECT SUM(kuota) as jumlah FROM penempatan_pkl";
$result = mysqli_query($conn, $sql);
$lowongan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL batal
$sql = "SELECT COUNT(*) as jumlah FROM kunjungan WHERE nama != 'NULL'";
$result = mysqli_query($conn, $sql);
$permohonan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL sedang
$sql = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE nama != 'NULL'";
$result = mysqli_query($conn, $sql);
$pengaduan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL selesai
$sql = "SELECT COUNT(*) as jumlah FROM users WHERE status = 'active'";
$result = mysqli_query($conn, $sql);
$sedang_pkl = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL per bulan dari kolom 'periode' pada tabel 'pengajuan_pkl'
$pkl_perbulan = [];
for ($i = 1; $i <= 12; $i++) {
    $sql = "SELECT COUNT(*) as jumlah FROM pengajuan_pkl WHERE MONTH(SUBSTRING_INDEX(periode, ' - ', 1)) = $i";
    $result = mysqli_query($conn, $sql);
    $pkl_perbulan[$i] = mysqli_fetch_assoc($result)['jumlah'];
}
?>
<?php
// Periksa apakah parameter 'status' ada di URL
if (isset($_GET['status'])) {
    
    // Simpan nilai parameter 'status' ke dalam variabel
    $status = $_GET['status'];
    // Gunakan nilai variabel untuk logika lebih lanjut
    if ($status === 'success') {
        echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Reset Password',
                    text: 'Seluruh Password Berhasil Di-Reset',
                    showConfirmButton: true
                });
            });
        </script>";
    } else if ($status === 'berhasil'){
        echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Reset Password',
                    text: 'Password Berhasil Diganti',
                    showConfirmButton: true
                });
            });
        </script>";
    } else {
        echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Reset Password',
                        text: 'Gagal Mereset Password',
                        showConfirmButton: true
                    });
                });
            </script>";
    }
} else {
    echo "No status provided in the URL.";
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
    <title>Admin Dashboard</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/custom4.css">

</head>

<body>
    <style>
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

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                </div>
            </div>
            <div class="col-md-9 ms-sm-auto col-lg-10 ">
                <div class="container mt-2">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Akun Siap Melayani</h3>
                    </div>
                    
                    <div class="table-responsive">
                        <form method="POST" action="function/reset_all_pw.php">
                            <button type="kirim" class="btn btn-danger mb-2" name="updatePasswords" onclick="return confirm('Are you sure you want to update all passwords?');">
                                Reset All Passwords
                            </button>
                        </form>
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table" style="background-color: skyblue;">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor HP</th>
                                    <th>Universitas</th>
                                    <th>Reset Password</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $no = 1;
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    echo "<tr>";
                                    echo "<td>{$no}</td>";
                                    echo "<td>{$row2['nama']}</td>";
                                    echo "<td>{$row2['email']}</td>";
                                    echo "<td>{$row2['no_hp']}</td>";
                                    echo "<td>{$row2['universitas']}</td>";
                                    echo "<td>
                                        <form action='function/reset_password.php' method='POST'>
                                            <input type='hidden' name='nama' value='{$row2['nama']}'>
                                            <input type='hidden' name='user_id' value='{$row2['id']}'>
                                            <button type='submit' class='btn btn-warning btn-sm'>Reset Password</button>
                                        </form>
                                    </td>";
                                    echo "
                                        <td>
                                            <button 
                                                type='button' 
                                                class='btn btn-warning btn-sm btn-upload-pdf' 
                                                data-bs-toggle='modal' 
                                                data-bs-target='#unduhSertifikatModal' 
                                                data-id='{$row2['id']}' 
                                                data-nama='{$row2['nama']}'>
                                                Unduh Sertifikat
                                            </button>
                                        </td>
                                    ";
                                    echo "</tr>";
                                    $no++;
                                }
                                $conn->close();
                                ?>
                            </tbody>
                            <div class="modal fade" id="unduhSertifikatModal" tabindex="-1" aria-labelledby="unduhSertifikatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="function/unduh_sertif.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="unduhSertifikatModalLabel">Konfirmasi Unduh Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input Nama -->
                    <div class="mb-3">
                        <label for="modal_nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="modal_nama" name="nama" readonly>
                    </div>

                    <!-- Input User ID -->
                    <div class="mb-3">
                        <label for="modal_id" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="modal_id" name="user_id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modal_id" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="modal_no_surat" name="no_surat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Unduh</button>
                </div>
            </form>
        </div>
    </div>
</div>

                        </table>
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                <?php if ($page > 1): ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                                <?php endif; ?>
                                
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <?php if ($page < $total_pages): ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
            
                    <!-- Card Section -->
                    <div class="row my-4">
                        <div class="col-md-4" >
                            <div class="card p-3">
                                <div class="card-icon">😊</div>
                                <h2><?php echo $sedang_pkl; ?></h2>
                                <p class="card-title">PKL</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div onclick="toggleDropdown()" class="card p-3">
                            <div class="card-icon">🎧</div>
                            <h2><?php echo $permohonan; ?></h2>
                            <p class="card-title">Permohonan</p>
                            <div id="dropdownMenu" class="dropdown-content">
                                <a href="admin_tamu_kunjungan.php">
                                <div class="cards">
                                    <p class="cards-title">Kunjungan</p>
                                </div>
                                </a>
                                <a class="link" href="admin_tamu_narasumber.php">
                                <div class="cards">
                                    <p class="cards-title">Narasumber</p>
                                </div>
                                </a>
                                <a href="admin_tamu_statistik.php">
                                <div class="cards">
                                    <p class="cards-title">Statistik</p>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-4">
                            <div class="card p-3">
                                <div class="card-icon">🎧</div>
                                <h2><?php echo $pengaduan; ?></h2>
                                <p class="card-title">Pengaduan</p>
                            </div>
                        </div>

                    </div>

                    <!-- Chart Section -->
                    

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                        crossorigin="anonymous">
                    </script>
                    <script>
    let dropdownOpen = false;

    // Function to toggle dropdown on click
    function toggleDropdown() {
        dropdownOpen = !dropdownOpen;
        updateDropdown();
    }

    // Function to show/hide dropdown based on hover or click
    function updateDropdown() {
        const dropdownMenu = document.getElementById("dropdownMenu");
        if (dropdownOpen) {
            dropdownMenu.style.display = "block";
        } else {
            dropdownMenu.style.display = "none";
        }
    }

    // Show dropdown on hover
    document.querySelector(".card").addEventListener("mouseenter", function() {
        dropdownOpen = true;
        updateDropdown();
    });

    // Hide dropdown when not hovered and not clicked
    document.querySelector(".card").addEventListener("mouseleave", function() {
        if (!dropdownOpen) {
            updateDropdown();
        }
    });

    // Close dropdown if clicking outside of it
    window.onclick = function(event) {
        if (!event.target.closest('.card')) {
            dropdownOpen = false;
            updateDropdown();
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-upload-pdf").forEach(button => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const nama = this.getAttribute("data-nama");
            document.getElementById("modal_id").value = id;
            document.getElementById("modal_nama").value = nama;
            document.getElementById("modal_no_surat").value = no_surat;
        });
    });
});

</script>

                    

</body>

</html>