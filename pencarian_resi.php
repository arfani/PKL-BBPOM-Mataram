<?php 
include('koneksi.php');

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];


$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT * FROM kunjungan WHERE 
        kode_unik LIKE '%$search%'";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan PKL BPOM</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px"
                    style="margin-left: 15px; margin-right: 10px">
                <b>BBPOM MATARAM</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>        
        </div>
    </nav>
    <button type="button" class="btn btn-primary mt-4 ms-4" style="box-shadow: 0 3px 3px black;" onclick="history.back()">Kembali</button>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-9 col-md-6 col-lg-4">
            <div class="card">
                <div class="container mt-2 mb-2">
                    <h2 class="text-center mb-4">Pencarian Kode Unik</h2>
                    
                    <!-- Search Form -->
                    <form method="GET" action="" id="searchForm" class="d-flex">
                        <input class="form-control w-100 me-2" type="text" name="search" placeholder="Search"
                        aria-label="Search" id="searchInput"
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    
    <div class="container mt-3 mb-5">
    <?php if (!empty($search)) { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="bg-primary" style="vertical-align: middle; color: white;">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Instansi</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th>Surat Balasan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row2 = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td>{$row2['nama']}</td>";
                        echo "<td>{$row2['no_hp']}</td>";
                        echo "<td>{$row2['instansi']}</td>";
                        echo "<td>{$row2['keperluan']}</td>";
                        echo "<td>{$row2['tanggal']}</td>";
                        echo "<td>{$row2['jam']}</td>";
                        if ($row2['status_kunjungan'] == NULL) {
                            echo "<td>Pending</td>";
                            echo "<td>-</td>";
                        } else {
                            echo "<td>{$row2['status_kunjungan']}</td>";
                        
                        }
                        echo "</tr>";
                        $no++;
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <p class="text-center mt-4">Silakan masukkan kode unik
        </p>
    <?php } ?>
</div>

    <!-- Tambahkan JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>