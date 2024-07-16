<?php
include 'koneksi.php';

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT * FROM pengajuan_pkl WHERE 
        nama LIKE '%$search%' OR 
        email LIKE '%$search%' OR 
        phone LIKE '%$search%' OR 
        university LIKE '%$search%' OR 
        department LIKE '%$search%' OR 
        posisi LIKE '%$search%' OR 
        periode LIKE '%$search%' OR 
        status LIKE '%$search%'";

$result = mysqli_query($conn, $sql);
$no = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/custom2.css">
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px" style="margin-left: 15px;">
        <a class="navbar-brand mx-3 my-1" href="#">BBPOM MATARAM</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" id="searchInput" type="text" placeholder="Search"
            aria-label="Search" value="<?php echo htmlspecialchars($search); ?>">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="logout.php">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="admin.php">
                                <span data-feather="home"></span>
                                Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="admin_pkl.php">
                                <span data-feather="file"></span>
                                PKL
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_tamu.php">
                                <span data-feather="shopping-cart"></span>
                                Pengunjung
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_narasumber.php">
                                <span data-feather="users"></span>
                                Narasumber
                            </a>
                        </li>
                    </ul>
                </div>

            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h3 class="mb-2">Daftar Nama Pendaftar PKL</h3>
                <div class="container table-container mt-2">
                    <table class="table table-bordered table-striped table-hover text-center">
                        <thead class="table-dark" style="vertical-align: middle;">
                            <tr>
                                <th scope="col" rowspan="2">No</th>
                                <th scope="col" rowspan="2">Nama</th>
                                <th scope="col" rowspan="2">Email</th>
                                <th scope="col" rowspan="2">No HP</th>
                                <th scope="col" rowspan="2">Universitas</th>
                                <th scope="col" rowspan="2">Jurusan</th>
                                <th scope="col" rowspan="2">Posisi</th>
                                <th scope="col" rowspan="2">Periode</th>
                                <th scope="col" colspan="2">Persyaratan</th>
                                <th scope="col" rowspan="2">Status</th>
                                <th scope="col" rowspan="2" colspan="2">Surat Balasan</th>
                            </tr>
                            <tr>
                                <th scope="col">Surat Pengajuan</th>
                                <th scope="col">Proposal</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $surat = $row['surat'] ? "<a href='{$row['surat']}' class='btn btn-primary btn-sm' download>Download Surat</a>" : "Belum upload";
                                $proposal = $row['proposal'] ? "<a href='{$row['proposal']}' class='btn btn-primary btn-sm' download>Download Proposal</a>" : "Belum upload";
                                $status = $row['status'] ? $row['status'] : "
                        <form action='update_status.php' method='post'>
                            <input type='hidden' name='id' value='{$row['id_pengajuan']}'>
                            <button type='submit' name='status' value='Diterima' class='btn btn-success btn-sm'>Terima</button>
                            <button type='submit' name='status' value='Ditolak' class='btn btn-danger btn-sm'>Tolak</button>
                        </form>";

                                $suratBalasan = "";
                                if ($row['status'] == 'Diterima') {
                                    $suratBalasan = "
                            <form action='upload_surat_balasan.php' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='id' value='{$row['id_pengajuan']}'>
                                <input type='file' name='surat_balasan' class='form-control' required>
                                <button type='submit' class='btn btn-primary btn-sm mt-2'>Upload Surat Balasan</button>
                            </form>";
                                } elseif ($row['status'] == 'Ditolak') {
                                    $suratBalasan = "Maaf, Anda tidak diterima.";
                                }

                                echo "<tr>";
                                echo "<th scope='row'>{$no}</th>";
                                echo "<td>{$row['nama']}</td>";
                                echo "<td>{$row['email']}</td>";
                                echo "<td>{$row['phone']}</td>";
                                echo "<td>{$row['university']}</td>";
                                echo "<td>{$row['department']}</td>";
                                echo "<td>{$row['posisi']}</td>";
                                echo "<td>{$row['periode']}</td>";
                                echo "<td>{$surat}</td>";
                                echo "<td>{$proposal}</td>";
                                echo "<td>{$status}</td>";
                                echo "<td colspan='2'>{$suratBalasan}</td>";

                                echo "</tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXlK9jz0nEG/q1QAWJusZyW9L73L68cHwtMDtE3Ez+k8jLDutoxLSjiFo4La" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhG81vGOdnpG2z7mr6Lc5I6pR9lkv5IDZw4iDw0FKhp9K1MRf0xqY2yRgP/l" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Fungsi untuk melakukan pencarian tanpa reload halaman
        $('#searchInput').on('input', function() {
            var search = $(this).val().toLowerCase().trim();

            $.ajax({
                url: 'search_pkl.php', // Ganti dengan file PHP yang menangani pencarian
                type: 'GET',
                data: {
                    search: search
                },
                success: function(response) {
                    $('#tableBody').html(response);
                }
            });
        });
    });
    </script>
</body>

</html>