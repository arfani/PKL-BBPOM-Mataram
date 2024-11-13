<?php
session_start();
include('koneksi.php');

// Mengecek apakah permintaan foto dilakukan
if (isset($_GET['fetch_photo']) && isset($_GET['id']) && $_GET['type'] === 'foto') {
    $pengaduanId = intval($_GET['id']);

    // Query untuk mengambil foto dari pengaduan
    $sql = "SELECT foto FROM pengaduan WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pengaduanId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && !empty($row['foto'])) {
        $photoPath = 'Asset/Gambar/' . $row['foto'];
        echo json_encode(['status' => 'success', 'photoPath' => $photoPath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Foto tidak ditemukan untuk pengaduan ini']);
    }

    exit;
}

// Query utama untuk menampilkan data pengaduan
$sql2 = "SELECT * FROM pengaduan ORDER BY tanggal DESC";
$result2 = $conn->query($sql2);
$no = 1;
// Handle pagination
$limit = 20; // Entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch `pengaduan` data with pagination
$sql2 = "SELECT * FROM pengaduan ORDER BY tanggal DESC LIMIT ?, ?";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result2 = $stmt->get_result();

// Count total rows for pagination
$total_sql = "SELECT COUNT(*) AS total FROM pengaduan";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

$no = $offset + 1;
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
                        <a class="nav-link" href="admin_absensi.php">
                            Absensi
                        </a>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_tamu.php">Kunjungan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="admin_pengaduan.php">Pengaduan</a>
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
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="admin_pengaduan.php">
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
                        <h3 class="fw-bold">Data Pengaduan</h3>
                    </div>

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table" style="background-color: skyblue;">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Subject</th>
                                    <th>Pesan</th>
                                    <th>Foto</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
                                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($row['pesan']); ?></td>
                                        <!-- Display image if available -->
                                        <td>
                                            <?php if (!empty($row['foto'])) : ?>
                                                <img src="Asset/Gambar/<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto Pengaduan" class="img-thumbnail" style="width: 100px;">
                                            <?php else : ?>
                                                Tidak ada foto
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
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
                        <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="photoModalLabel">Foto Absensi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img id="absensiPhoto" src="" alt="Foto Absensi" class="img-fluid">
                                        <p id="photoUserName" class="mt-2"></p>
                                    </div>
                                </div>
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
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".btn-view-photo").forEach(button => {
            button.addEventListener("click", function () {
                const pengaduanId = this.getAttribute("data-id");
                const userName = this.getAttribute("data-name");

                document.getElementById("photoUserName").innerText = `Nama: ${userName}`;

                // Mengambil foto menggunakan ID pengaduan
                fetch(`<?php echo $_SERVER['PHP_SELF']; ?>?fetch_photo=true&id=${pengaduanId}&type=foto`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Memperbarui sumber gambar pada modal
                            document.getElementById("pengaduanPhoto").src = data.photoPath;
                            new bootstrap.Modal(document.getElementById("photoModal")).show();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message,
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: 'Gagal memuat foto. Silakan coba lagi.',
                        });
                        console.error('Error fetching photo:', error);
                    });
            });
        });
    });
    </script>
</body>

</html>