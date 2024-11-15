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
?>
<?php
$sql = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE nama != NULL";
$result = mysqli_query($conn, $sql);
$jml_pengaduan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah Pengaduan Obat
$sql = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE subject = 'obat'";
$result = mysqli_query($conn, $sql);
$jml_obat = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah Pengaduan Obat Bahan Alam
$sql = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE subject = 'obat bahan alam'";
$result = mysqli_query($conn, $sql);
$jml_obat_bahan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah Suplemen Kesehatan
$sql = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE subject = 'suplemen kesehatan'";
$result = mysqli_query($conn, $sql);
$jml_sup_kesehatan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah Pengaduan Kosmetik
$sql = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE subject = 'kosmetik'";
$result = mysqli_query($conn, $sql);
$jml_kosmetik = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL selesai
$sql = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE subject = 'pangan olahan'";
$result = mysqli_query($conn, $sql);
$jml_pangan_olahan = mysqli_fetch_assoc($result)['jumlah'];

//menghitung Jumlah Pengaduan 'Lainnya'
$sql = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE subject = 'lainnya'";
$result = mysqli_query($conn, $sql);
$jml_lainnya = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL per bulan dari kolom 'periode' pada tabel 'pengajuan_pkl'
$pengaduan_perbulan = [];
for ($i = 1; $i <= 12; $i++) {
    $sql = "SELECT COUNT(*) as jumlah FROM pengaduan WHERE MONTH(SUBSTRING_INDEX(tanggal, ' - ', 1)) = $i";
    $result = mysqli_query($conn, $sql);
    $pengaduan_perbulan[$i] = mysqli_fetch_assoc($result)['jumlah'];
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
                    <a class="nav-link" aria-current="page" href="admin.php">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_posisi.php">Posisi Penempatan PKL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_pkl.php">PKL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_tamu.php">Permohonan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_pengaduan.php">
                        Narasumber
                        <a class="nav-link active" href="admin_pengaduan_statistik.php">
                            Statistik
                        </a>
                    </a>
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
                            <a class="nav-link" aria-current="page" href="admin.php">
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
                                Permohonan
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="admin_pengaduan.php">
                                Pengaduan
                                <a class="nav-link active" href="admin_pengaduan_statistik.php">
                                    Statistik
                                </a>
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
                        <h3 class="fw-bold">Data Pengaduan</h3>
                    </div>

                    <!-- Card Section -->
                    <div class="row my-4">
                        <div class="col-md-2">
                            <div class="card p-2">
                                <div class="card-icon">💊</div>
                                <h2><?php echo $jml_obat; ?></h2>
                                <p>Obat</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card p-2">
                                <div class="card-icon">🍵</div>
                                <h2><?php echo $jml_obat_bahan; ?></h2>
                                <p>Obat Bahan Alam</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card p-2">
                                <div class="card-icon">🧴</div>
                                <h2><?php echo $jml_sup_kesehatan; ?></h2>
                                <p>Suplemen Kesehatan</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card p-2">
                                <div class="card-icon">💄</div>
                                <h2><?php echo $jml_kosmetik; ?></h2>
                                <p>Kosmetik</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card p-2">
                                <div class="card-icon">🍞</div>
                                <h2><?php echo $jml_pangan_olahan; ?></h2>
                                <p>Pangan Olahan</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card p-2">
                                <div class="card-icon">📋</div>
                                <h2><?php echo $jml_lainnya; ?></h2>
                                <p>Lainnya</p>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Section -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-line me-1"></i>
                                    Statistik Pengaduan
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Pengaduan
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
                                    label: 'Jumlah Pengaduan',
                                    data: [
                                        <?php
                                        foreach ($pengaduan_perbulan as $jumlah) {
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
                                labels: ['Obat', 'Obat Bahan Alam', 'Suplemen Kesehatan', 'Kosmetik', 'Pangan Olahan', 'Lainnya'],
                                datasets: [{
                                    data: [
                                        <?php echo $jml_obat; ?>,
                                        <?php echo $jml_obat_bahan; ?>,
                                        <?php echo $jml_sup_kesehatan; ?>,
                                        <?php echo $jml_kosmetik; ?>,
                                        <?php echo $jml_pangan_olahan; ?>,
                                        <?php echo $jml_lainnya; ?>
                                    ],
                                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#8BC34A','#9966FF', '#FF9F40']
                                }]
                            }
                        });
                    </script>

</body>

</html>