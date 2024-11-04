<?php
session_start();
include('koneksi.php');

// Ambil tanggal dari form jika ada, atau gunakan tanggal hari ini
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : date('Y-m-d');

// Query untuk mengambil data absensi seluruh user pada tanggal tertentu
$sql2 = "SELECT * FROM absensi WHERE tanggal = ? ORDER BY tanggal DESC";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("s", $tanggal);
$stmt->execute();
$result2 = $stmt->get_result();

$batas_waktu = '08:31:00';
$no = 1;
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
                    <a class="nav-link" href="admin.php">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_posisi.php">Posisi Penempatan PKL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_pkl.php">PKL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="admin_tamu.php">Kunjungan</a>
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
                                <a class="nav-link active" href="admin_absensi.php" style="margin-left:5%">
                                Absensi
                                </a>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="admin_tamu.php">
                                Kunjungan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_narasumber.php">
                                Narasumber
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

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-3">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Pengunjung Realtime</h3>
                    </div>
                    
                    <div class="container mt-4" style="width: 20%; margin-left: 0;">
                    <!-- Form untuk memilih tanggal -->
                        <form action="" method="post" class="form-inline my-3">
                        <label for="tanggal" class="mr-2">Pilih Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control mr-2" value="<?php echo $tanggal; ?>" required>
                        <button type="submit" name="filter_tanggal" class="btn btn-primary" style="margin-top:5%;">Tampilkan Absensi</button>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table" style="background-color: skyblue;">
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Total Jam Kerja</th>
                                <th>Kesimpulan</th>
                            </tr>
                            </thead>
                            <tbody>
                                <!-- Replace with PHP loop to populate data -->
                                <?php
                                // Menampilkan data absensi
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    echo "<tr>";
                                    echo "<td scope='row'>{$no}</td>";
                                    echo "<td>{$row2['tanggal']}</td>";
                                    echo "<td>{$row2['nama']}</td>";
                                    echo "<td>{$row2['status']}</td>";
                                    echo "<td>{$row2['waktu_masuk']}</td>";
                                    if ($row2['waktu_keluar'] != NULL) {
                                        echo "<td>{$row2['waktu_keluar']}</td>";
                                        echo "<td>{$row2['durasi']}</td>";
                    
                                        // Cek apakah durasi memenuhi batas waktu atau tidak
                                        if ($row2['durasi'] < $batas_waktu) {
                                            $durasi = new DateTime($row2['durasi']);
                                            $batas = new DateTime($batas_waktu);
                                            $selisih = $durasi->diff($batas);
                                            if ($selisih->h > 0){
                                                echo "<td>Waktu Kerja Kurang {$selisih->h} jam {$selisih->i} Menit</td>";
                                            } else {
                                                echo "<td>Waktu Kerja Kurang {$selisih->i} Menit</td>";
                                            }
                                        } else {
                                            echo "<td>Waktu Kerja Sudah cukup</td>";
                                        }
                                    } else {
                                        echo "<td>-</td>";
                                        echo "<td>-</td>";
                                        echo "<td>-</td>";
                                    }
                                    echo "</tr>";
                                    $no++;
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>