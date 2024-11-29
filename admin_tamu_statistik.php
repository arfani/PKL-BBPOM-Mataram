<?php
include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

// Check for `POST` request to fetch specific chart data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['subject'])) {
        $subject = $input['subject'];
        $chartData = [];

        // Fetch monthly data for the selected subject
        for ($i = 1; $i <= 12; $i++) {
            $sql = "SELECT COUNT(*) as jumlah FROM kunjungan WHERE keperluan = '$subject' AND MONTH(SUBSTRING_INDEX(tanggal, ' - ', 1)) = $i";
            $result = mysqli_query($conn, $sql);
            $chartData[] = mysqli_fetch_assoc($result)['jumlah'];
        }

        // Respond with JSON containing chart data
        echo json_encode(['success' => true, 'chartData' => $chartData]);
        exit;
    }
}
?>
<?php

$sql = "SELECT COUNT(*) as jumlah FROM kunjungan WHERE keperluan != NULL";
$result = mysqli_query($conn, $sql);
$jml_permohonan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah Pengaduan Obat
$sql = "SELECT COUNT(*) as jumlah FROM kunjungan WHERE keperluan = 'kunjungan'";
$result = mysqli_query($conn, $sql);
$jml_kunjungan = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah Pengaduan Obat Bahan Alam
$sql = "SELECT COUNT(*) as jumlah FROM kunjungan WHERE keperluan = 'narasumber'";
$result = mysqli_query($conn, $sql);
$jml_narasumber = mysqli_fetch_assoc($result)['jumlah'];

// Menghitung jumlah PKL per bulan dari kolom 'periode' pada tabel 'pengajuan_pkl'
$pengaduan_perbulan = [];
for ($i = 1; $i <= 12; $i++) {
    $sql = "SELECT COUNT(*) as jumlah FROM kunjungan WHERE MONTH(SUBSTRING_INDEX(tanggal, ' - ', 1)) = $i";
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
    <style>
        .card-section{
            cursor:default;
        }
        
        /* Hover style untuk memperbesar dan mengubah warna */
        .card:hover {
        background-color: #007bff; /* warna biru */
        transform: scale(1.05); /* memperbesar */
        color: #fff; /* Ubah teks menjadi putih */
        }

        /* Style untuk kartu yang tetap aktif setelah diklik */
        .card.active {
        background-color: #007bff; /* warna biru */
        transform: scale(1.05); /* memperbesar */
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
    </style>
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
                    <a class"nav-link" href="admin_pkl.php">PKL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_tamu.php">
                        Permohonan
                        <a class="nav-link" href="admin_pengaduan_kunjungan.php">
                            Kunjungan
                        </a>
                        
                        <a class="nav-link" href="admin_pengaduan_narasumber.php">
                            Narasumber
                        </a>
                        
                        <a class="nav-link active" href="admin_pengaduan_statistik.php">
                            Statistik
                        </a>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_pengaduan.php">
                        Pengaduan
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
                            <a class="nav-link" href="admin.php">
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
                            <a class="nav-link" aria-current="page" href="admin_tamu.php">
                                Permohonan
                                <a class="nav-link" aria-current="page" href="admin_tamu_kunjungan.php">
                                Kunjungan
                                </a>
                                <a class="nav-link" aria-current="page" href="admin_tamu_narasumber.php">
                                Narasumber
                                </a>
                                <a class="nav-link active" aria-current="page" href="admin_tamu_statistik.php">
                                Statistik
                                </a>
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
                </div>
            </div>
            <div class="col-md-9 ms-sm-auto col-lg-10 ">
                <div class="container mt-2">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Pengaduan</h3>
                    </div>

                    <!-- Card Section -->
                    <section class="card-section">
                    <div class="row my-4">
                        <div class="col-md-6" >
                            <div class="card p-2" data-subject="kunjungan">
                                <div class="card-icon">💊</div>
                                <h2><?php echo $jml_kunjungan; ?></h2>
                                <p>Obat</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card p-2" data-subject="narasumber">
                                <div class="card-icon">🍵</div>
                                <h2><?php echo $jml_narasumber; ?></h2>
                                <p>Obat Bahan Alam</p>
                            </div>
                        </div>
                    </section>
                    <!-- Chart Section -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="cards mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-line me-1"></i>
                                    Statistik Permohonan
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="cards mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Permohonan
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
                                    label: 'Jumlah Permohonan',
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
                                        min: 0,           // Set nilai minimum sumbu y
                                        max: 20,          // Set nilai maksimum sumbu y
                                        ticks: {
                                            stepSize: 2   // Set interval antar nilai di sumbu y
                                        }
                                    }
                                }
                            }
                        });

                        // Pie Chart
                        var ctx = document.getElementById('myPieChart').getContext('2d');
                        var myPieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Kunjungan', 'Narasumber'],
                                datasets: [{
                                    data: [
                                        <?php echo $jml_kunjungan; ?>,
                                        <?php echo $jml_narasumber; ?>,
                                    ],
                                    backgroundColor: ['#FF6384', '#36A2EB']
                                }]
                            }
                        });
                    </script>
                    <script>
                        // Default data from PHP (static)
                        const defaultData = [<?php echo implode(',', $pengaduan_perbulan); ?>];

                        document.querySelectorAll('.card').forEach(card => {
                            card.addEventListener('click', function () {
                                let subject = this.getAttribute('data-subject');

                                // Toggle active class on the card
                                if (this.classList.contains('active')) {
                                    this.classList.remove('active'); // Remove active class

                                    // Send default data to chart
                                    updateChart(defaultData);
                                } else {
                                    // Remove active class from all cards
                                    document.querySelectorAll('.card').forEach(c => c.classList.remove('active'));
                                    this.classList.add('active'); // Set current card as active

                                    // Fetch updated data for selected subject
                                    fetch(window.location.href, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({ subject: subject })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            updateChart(data.chartData); // Update chart with fetched data
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                                }
                            });
                        });

                        // Function to update the chart based on new data
                        function updateChart(chartData) {
                            myAreaChart.data.datasets[0].data = chartData;
                            myAreaChart.update();
                        }
                    </script>


</body>

</html>