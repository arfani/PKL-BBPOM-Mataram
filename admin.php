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
<?php include 'header_admin.php'; ?>

    <div class="container-fluid">
        <div class="row">
            
        <?php include('sidebar_admin.php'); ?>

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


                    

</body>

</html>