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
                    <a class="nav-link" aria-current="page" href="admin_pkl.php">
                        PKL
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin_tamu.php">Kunjungan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_narasumber.php">Pengaduan</a>
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
                            <a class="nav-link active" aria-current="page" href="admin_tamu.php">
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

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-3">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Rencana Kunjungan Realtime</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table" style="background-color: skyblue;">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
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
                                echo "<td>{$row2['nama']}</td>";
                                echo "<td>{$row2['no_hp']}</td>";
                                echo "<td>{$row2['instansi']}</td>";
                                echo "<td>{$row2['keperluan']}</td>";
                                echo "<td>{$row2['jumlah_peserta']}</td>";
                                echo "<td>{$row2['segmen_peserta']}</td>";
                                echo "<td>{$row2['tanggal']} / {$row2['jam']}</td>";

                                // Tombol untuk membuka PDF dan mengunduh file surat_masuk
                                echo "<td>
                                        <button class='btn btn-primary btn-open-pdf' data-pdf-path='{$row2['surat_masuk']}'>
                                            Lihat Surat Masuk
                                        </button>
                                        <a href='{$row2['surat_masuk']}' download='{$row2['surat_masuk']}' class='btn btn-secondary'>
                                            <i class='fas fa-download'></i>
                                        </a>
                                    </td>";

                                // Tombol untuk membuka PDF dan mengunduh file surat_balasan
                                echo "<td>";
                                    if (empty($row2['surat_balasan'])) {
                                        // Tombol untuk mengunggah file jika belum ada file
                                        echo "
                                            <form action='function/update_balasan_tamu.php' method='POST' enctype='multipart/form-data'>
                                            <input type='file' name='surat_balasan' id='surat_balasan' required>
                                            <input type='hidden' name='id' id='id' value='{$row2['id']}'>
                                            <input type='hidden' name='nama' id='nama' value='{$row2['nama']}'  >
                                            <button type='submit' name='submit' class='btn btn-primary'>Unggah</button>
                                            </form>";
                                    } else {
                                        // Tombol untuk menampilkan file jika sudah ada file
                                        echo "
                                            <button class='btn btn-primary btn-open-pdf' data-bs-toggle='modal' data-bs-target='#viewModal' data-pdf-path='{$row2['surat_balasan']}'>
                                                Lihat Surat Balasan
                                            </button>
                                            <a href='{$row2['surat_balasan']}' download='{$row2['surat_balasan']}' class='btn btn-secondary'>
                                                <i class='fas fa-download'></i>
                                            </a>";
                                    }
                                    echo "</td>";

                                echo "<td>
                                </td>";
                                
                                echo "</tr>";
                                $no++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Modal untuk upload file -->
                <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadModalLabel">Unggah Surat Balasan</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="function/update_balasan_tamu.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="file" name="surat_balasan" id="surat_balasan" required>
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="nama" id="nama">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Unggah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Untuk Menampilkan PDF-->
                <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel">Lihat Surat Balasan</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <iframe src="" id="pdfViewer" width="100%" height="500px"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".btn-upload-pdf").forEach(button => {
                button.addEventListener("click", function () {
                    const id = this.getAttribute("data-id");
                    const nama = this.getAttribute("data-nama");
                    document.getElementById("modal_id").value = id;
                    document.getElementById("modal_nama").value = nama;
                });
            });
        });
    </script>
</body>

</html>