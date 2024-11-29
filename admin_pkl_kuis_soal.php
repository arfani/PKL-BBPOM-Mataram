<?php
include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_GET['posisi'])) {
    $posisi = $_GET['posisi'];
} else {
    echo "Tidak ada posisi yang dipilih.";
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
    .question-list {
    margin: 20px 0;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
    }

    .question-item {
        margin-bottom: 15px;
        padding: 10px;
        border-bottom: 1px dashed #ccc;
    }

    .question-item:last-child {
        border-bottom: none;
    }

    .question-item h4 {
        font-size: 1.2em;
        color: #333;
    }

    .question-item ul {
        padding-left: 20px;
        list-style: disc;
    }

    .question-item ul li {
        margin-bottom: 5px;
    }

    .question-item p {
        font-weight: bold;
        color: #006400;
        margin-top: 10px;
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
                    <a class="nav-link" href="admin.php">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin_posisi.php">Posisi Penempatan PKL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="admin_pkl.php">
                        PKL
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_tamu.php">Kunjungan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_pengaduan.php">Pengaduan</a>
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
                            <a class="nav-link" aria-current="page" href="admin_posisi.php">
                                Posisi Penempatan PKL
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="admin_pkl.php" >
                                PKL
                                <a class="nav-link " href="admin_pkl_absensi.php" style="margin-left:5%">
                                    Absensi
                                </a>
                                <a class="nav-link " href="admin_pkl_statistik.php" style="margin-left:5%">
                                    statistik
                                </a>
                                <a class="nav-link" href="admin_pkl_posisi.php" style="margin-left:5%">
                                    Posisi Penempatan PKL
                                </a>
                                <a class="nav-link active" href="admin_pkl_kuis.php" style="margin-left:5%">
                                    Soal Kuis
                                </a>
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
        </div>
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-2">
                    <div class="text-center">
                        <h3 class="fw-bold">Soal Kuis Posisi <?php echo "$posisi"; ?></h3>
                    </div>
                    <div class="mb-3">
                        <a href="function/TambahSoalKuis.php" class="btn btn-success justify-content-start">Tambah Soal</a>
                        <button class="btn btn-danger" onclick="history.back()">Kembali</button>
                    </div>
                </div>
                <?php 
                    // Ambil 10 pertanyaan acak dari tabel `kuis`
                    $query = "SELECT * FROM kuis WHERE posisi = '$posisi'";
                    $result = $conn->query($query);
                    $no = 1;

                    if ($result->num_rows > 0) {
                        echo '<div class="question-list">';

                        while ($row3 = $result->fetch_assoc()) {
                            echo "<div class='question-item'>";
                            echo "<h4>{$no}. {$row3['question_text']}</h4>";
                            
                            // Menampilkan semua opsi jawaban
                            echo "<ul>";
                            echo "<li>A. {$row3['option_a']}</li>";
                            echo "<li>B. {$row3['option_b']}</li>";
                            echo "<li>C. {$row3['option_c']}</li>";
                            echo "<li>D. {$row3['option_d']}</li>";
                            echo "</ul>";

                            // Menampilkan jawaban yang benar
                            echo "<p><strong>Jawaban yang benar: </strong>{$row3['correct_option']}</p>";
                            echo "</div>";
                            $no++;
                        }

                        echo '</div>';
                    } else {
                        echo "<p>No questions available.</p>";
                        $message = "Tidak Ada Pertanyaan Yang Dibuat";
                    }

                    $conn->close();
                    ?>


        </div>
    </body>
</html>
            