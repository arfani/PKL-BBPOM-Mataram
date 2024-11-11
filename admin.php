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

// Menghitung jumlah PKL per bulan dari kolom 'periode' pada tabel 'pengajuan_pkl'
$pkl_perbulan = [];
for ($i = 1; $i <= 12; $i++) {
    $sql = "SELECT COUNT(*) as jumlah FROM pengajuan_pkl WHERE MONTH(SUBSTRING_INDEX(periode, ' - ', 1)) = $i";
    $result = mysqli_query($conn, $sql);
    $pkl_perbulan[$i] = mysqli_fetch_assoc($result)['jumlah'];
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
    <link rel="stylesheet" href="Asset/CSS/custom2.css">

</head>

<body>
    <header class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand" href="#">
            <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px"
                style="margin-left: 15px; margin-right: 10px">
            BBPOM MATARAM
        </a>
        <!-- Search and Sign Out for larger screens (md and above) -->
        <div class="d-none d-md-flex order-1 flex-grow-1">
            <form method="GET" action="" id="searchForm" class="d-flex me-auto">
                <input class="form-control w-100 me-2" type="text" name="search" placeholder="Search"
                    aria-label="Search" id="searchInput"
                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button class="btn btn-outline-secondary" type="submit" id="searchButton">
                    <i class="bx bx-search"></i> <!-- Ikon pencarian dari Boxicons -->
                </button>
            </form>
            <a class="nav-link signout text-nowrap" style="color: white; padding-top: 20px; padding-left: 10px;"
                href="logout.php">Sign out</a>
        </div>

        <!-- Toggle button for mobile -->
        <button class="navbar-toggler d-md-none collapsed me-1" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar for mobile (sm and below) -->
        <div class="collapse navbar-collapse ms-3 d-md-none" id="navbarMenu">
            <form method="GET" action="" id="searchFormMobile" class="d-flex mb-2">
                <input class="form-control w-100 me-2" type="text" name="search" placeholder="Search"
                    aria-label="Search" id="searchInputMobile"
                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button class="btn btn-outline-secondary" type="submit" id="searchButtonMobile">
                    <i class="bx bx-search"></i> <!-- Ikon pencarian dari Boxicons -->
                </button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="admin.php">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_posisi.php">Posisi Penempatan PKL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_pkl.php">PKL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_tamu.php">Kunjungan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_narasumber.php">Narasumber</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_web.php">Setting Website</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: white; text-shadow: 
        -1px -1px 0 #000,  
         1px -1px 0 #000,
        -1px  1px 0 #000,
         1px  1px 0 #000; " href="logout.php">Sign out</a>
                </li>
            </ul>
        </div>
    </header>



    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="sidebar col-md-3 col-lg-2 d-none d-md-block">
                <div class="position-sticky pt-2 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="admin.php">
                                Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_posisi.php">
                                Posisi Penempatan PKL
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_pkl.php">
                                PKL
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_tamu.php">
                                Kunjungan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_narasumber.php">
                                Narasumber
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_pengaduan.php">
                                Pengaduan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_web.php">
                                Setting Website
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Overview</h1>
                </div>
            </div>
            <div class="col-md-9 ms-sm-auto col-lg-10 ">
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

                    <!-- Chart Section -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-line me-1"></i>
                                    Data PKL
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    PKL
                                </div>
                                <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                        crossorigin="anonymous">
                    </script>
                    <script>
                        // Bar Chart
                        var ctx = document.getElementById('myAreaChart').getContext('2d');
                        var myAreaChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                                    'Nov', 'Dec'
                                ],
                                datasets: [{
                                    label: 'Jumlah PKL',
                                    data: [
                                        <?php
                                        foreach ($pkl_perbulan as $jumlah) {
                                            echo $jumlah . ', ';
                                        }
                                        ?>
                                    ],
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });

                        // Pie Chart
                        var ctx = document.getElementById('myPieChart').getContext('2d');
                        var myPieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Selesai', 'Sedang PKL', 'Batal', 'Lowongan'],
                                datasets: [{
                                    data: [
                                        <?php echo $selesai_pkl; ?>,
                                        <?php echo $sedang_pkl; ?>,
                                        <?php echo $pkl_batal; ?>,
                                        <?php echo $lowongan; ?>
                                    ],
                                    backgroundColor: ['#007bff', '#ffc107', '#dc3545', '#28a745']
                                }]
                            }
                        });
                    </script>

</body>

</html>