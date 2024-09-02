<?php
include('koneksi.php');
session_start();
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

$sql2 = "SELECT * FROM pengajuan_pkl WHERE 
        nama LIKE '%$search%' OR 
        email LIKE '%$search%' OR 
        phone LIKE '%$search%' OR 
        university LIKE '%$search%' OR 
        department LIKE '%$search%' OR 
        posisi LIKE '%$search%' OR 
        periode LIKE '%$search%' OR 
        status LIKE '%$search%'";

$result2 = mysqli_query($conn, $sql2);
$no = 1;
$no2 = 1;
?>
<?php

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
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
<html lang="id">

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
        <a class=" navbar-brand" href="#">
            <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px"
                style="margin-left: 15px; margin-right: 10px">
            BBPOM MATARAM
        </a>
        <form method="GET" action="" id="searchForm" class="order-1">
            <input class="form-control w-10 order-1" type="text" name="search" placeholder="Search" aria-label="Search"
                id="searchInput" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="btn btn-outline-secondary d-none" type="submit" id="searchButton">
                <i class="bx bx-search"></i> <!-- Ikon pencarian dari Boxicons -->
            </button>
        </form>
        <div class="navbar-nav order-3 text-nowrap">
            <div class="nav-item">
                <a class="nav-link px-3 signout" style="color: white" href="logout.php">Sign out</a>
            </div>
        </div>
        <button class="navbar-toggler d-md-none collapsed me-1" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-3" id="navbarMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                    <a class="nav-link active" aria-current="page" href="admin_pkl.php">
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
                            <a class="nav-link active" aria-current="page" href="admin_pkl.php">
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
                    </ul>
                </div>
            </div>

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-2">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Pendaftar PKL</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table" style="vertical-align: middle; background-color: skyblue;">
                                <tr>
                                    <th scope="col" rowspan="2">No</th>
                                    <th scope="col" rowspan="2">Nama</th>
                                    <th scope="col" rowspan="2">Email</th>
                                    <th scope="col" rowspan="2">No HP</th>
                                    <th scope="col" rowspan="2">Universitas</th>
                                    <th scope="col" rowspan="2">Jurusan</th>
                                    <th scope="col" colspan="2">Persyaratan</th>
                                    <th scope="col" rowspan="2">Laporan Akhir</th>
                                    <!-- <th scope="col" rowspan="2">Status</th>
                                <th scope="col" rowspan="2" colspan="2">Surat Balasan</th>
                                <th scope="col" rowspan="2">Tanggal Pengajuan</th>
                                <th scope="col" rowspan="2">Waktu Tersisa</th> -->
                                </tr>
                                <tr>
                                    <th scope="col">Surat Pengajuan</th>
                                    <th scope="col">Proposal</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $tanggal_pengajuan = new DateTime($row['tanggal_pengajuan']);
                                    $tanggal_kadaluarsa = $tanggal_pengajuan->modify('+2 days');
                                    $now = new DateTime();
                                    $interval = $now->diff($tanggal_kadaluarsa);
                                    $waktuTersisa = $interval->invert ? 'Kadaluarsa' : sprintf('%02dh %02dm %02ds', $interval->h, $interval->i, $interval->s);

                                    $surat = $row['surat'] ? "<a href='{$row['surat']}' class='btn btn-primary btn-sm' download>Download Surat</a>" : "Belum upload";
                                    $proposal = $row['proposal'] ? "<a href='{$row['proposal']}' class='btn btn-primary btn-sm' download>Download Proposal</a>" : "Belum upload";
                                    $status = $row['status'] ? $row['status'] : "
<button type='button' class='btn btn-success btn-sm accept-btn' data-id='{$row['id_pengajuan']}'>Terima</button>
<button type='button' class='btn btn-danger btn-sm reject-btn' data-id='{$row['id_pengajuan']}'>Tolak</button>
";

                                    $suratBalasan = "";
                                    if ($row['status'] == 'Diterima') {
                                        if ($row['surat_balasan']) {
                                            $suratBalasan = "Sudah diupload";
                                        } else {
                                            $suratBalasan = "
                            <form action='upload_surat_balasan.php' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='id' value='{$row['id_pengajuan']}'>
                                <input type='file' name='surat_balasan' class='form-control' required>
                                <button type='submit' class='btn btn-primary btn-sm mt-2'>Upload Surat Balasan</button>
                            </form>";
                                        }
                                    } elseif ($row['status'] == 'Ditolak') {
                                        $suratBalasan = $row['surat_balasan'];
                                    }

                                    echo "<tr>";
                                    echo "<th scope='row'>{$no}</th>";
                                    echo "<td class='text-nowrap'>{$row['nama']}</td>";
                                    echo "<td>{$row['email']}</td>";
                                    echo "<td>{$row['phone']}</td>";
                                    echo "<td>{$row['university']}</td>";
                                    echo "<td>{$row['department']}</td>";
                                    echo "<td>{$surat}</td>";
                                    echo "<td>{$proposal}</td>";
                                    echo "<td>{$row['laporan_akhir']}</td>";
                                    //                             echo "<td>{$status}</td>";
                                    //                             echo "<td colspan='2'>{$suratBalasan}</td>";
                                    //                             echo "<td>{$row['tanggal_pengajuan']}</td>";
                                    //                             if ($row['status'] == "" or $row['status'] == null) {
                                    //                                 echo "<td class='countdown-container' data-target='{$tanggal_kadaluarsa->format('Y-m-d H:i:s')}'>
                                    //     <div class='countdown-item'>
                                    //         <span class='hours'>00</span>
                                    //         <label>Jam</label>
                                    //     </div>
                                    //     <div class='countdown-item'>
                                    //         <span class='minutes'>00</span>
                                    //         <label>Menit</label>
                                    //     </div>
                                    //     <div class='countdown-item'>
                                    //         <span class='seconds'>00</span>
                                    //         <label>Detik</label>
                                    //     </div>
                                    //   </td>";
                                    //                             } else {
                                    //                                 echo "<td class='countdown-container expired'> Selesai </td>";
                                    echo "</tr>";
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table" style="vertical-align: middle; background-color: skyblue">
                                <tr>
                                    <th scope="col" rowspan="2">No</th>
                                    <th scope="col" rowspan="2">Nama</th>

                                    <th scope="col" rowspan="2">Posisi</th>
                                    <th scope="col" rowspan="2">Periode</th>


                                    <th scope="col" rowspan="2">Tanggal Pengajuan</th>
                                    <th scope="col" rowspan="2">Waktu Tersisa</th>
                                    <th scope="col" rowspan="2">Status</th>
                                    <th scope="col" rowspan="2" colspan="2">Surat Balasan</th>
                                </tr>
                                <!-- <tr>
                                <th scope="col">Surat Pengajuan</th>
                                <th scope="col">Proposal</th>
                            </tr> -->
                            </thead>
                            <tbody id="tableBody">
                                <?php
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    $tanggal_pengajuan = new DateTime($row['tanggal_pengajuan']);
                                    $tanggal_kadaluarsa = $tanggal_pengajuan->modify('+2 days');
                                    $now = new DateTime();
                                    $interval = $now->diff($tanggal_kadaluarsa);
                                    $waktuTersisa = $interval->invert ? 'Kadaluarsa' : sprintf('%02dh %02dm %02ds', $interval->h, $interval->i, $interval->s);

                                    $surat = $row['surat'] ? "<a href='{$row['surat']}' class='btn btn-primary btn-sm' download>Download Surat</a>" : "Belum upload";
                                    $proposal = $row['proposal'] ? "<a href='{$row['proposal']}' class='btn btn-primary btn-sm' download>Download Proposal</a>" : "Belum upload";
                                    $status = $row['status'] ? $row['status'] : "
<button type='button' class='btn btn-success btn-sm accept-btn' data-id='{$row['id_pengajuan']}'>Terima</button>
<button type='button' class='btn btn-danger btn-sm reject-btn' data-id='{$row['id_pengajuan']}'>Tolak</button>
";

                                    $suratBalasan = "";
                                    if ($row['status'] == 'Diterima') {
                                        if ($row['surat_balasan']) {
                                            $suratBalasan = "Sudah diupload";
                                        } else {
                                            $suratBalasan = "
                            <form action='upload_surat_balasan.php' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='id' value='{$row['id_pengajuan']}'>
                                <input type='file' name='surat_balasan' class='form-control' required>
                                <button type='submit' class='btn btn-primary btn-sm mt-2'>Upload Surat Balasan</button>
                            </form>";
                                        }
                                    } elseif ($row['status'] == 'Ditolak') {
                                        $suratBalasan = $row['surat_balasan'];
                                    }

                                    echo "<tr>";
                                    echo "<th scope='row'>{$no2}</th>";
                                    echo "<td class='text-nowrap'>{$row['nama']}</td>";
                                    echo "<td class='text-wrap'>{$row['posisi']}</td>";
                                    echo "<td class='text-nowrap'>{$row['periode']}</td>";
                                    // echo "<td>{$surat}</td>";
                                    // echo "<td>{$proposal}</td>";

                                    echo "<td>{$row['tanggal_pengajuan']}</td>";
                                    if ($row['status'] == "" or $row['status'] == null) {
                                        echo "<td class='countdown-container' data-target='{$tanggal_kadaluarsa->format('Y-m-d H:i:s')}'>
        <div class='countdown-item'>
            <span class='hours'>00</span>
            <label>Jam</label>
        </div>
        <div class='countdown-item'>
            <span class='minutes'>00</span>
            <label>Menit</label>
        </div>
        <div class='countdown-item'>
            <span class='seconds'>00</span>
            <label>Detik</label>
        </div>
      </td>";
                                    } else {
                                        echo "<td class='countdown-container expired'> Selesai </td>";
                                    }
                                    echo "<td>{$status}</td>";
                                    echo "<td colspan='2'>{$suratBalasan}</td>";
                                    echo "</tr>";
                                    $no2++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Penerimaan -->
        <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="acceptModalLabel">Pilih Posisi Penerimaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="acceptForm" action="<?php echo $urlweb ?>/function/update_status.php" method="post">
                            <input type="hidden" name="id" id="acceptId">
                            <div id="posisi"></div>
                            <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Penolakan -->
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="rejectForm" action="<?php echo $urlweb ?>/function/update_balasan.php" method="post">
                            <input type="hidden" name="id" id="rejectId">
                            <div class="mb-3">
                                <label for="rejectReason" class="form-label">Masukkan Alasan:</label>
                                <textarea id="rejectReason" name="reason" class="form-control" rows="3"
                                    required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.accept-btn').on('click', function() {
                    var id = $(this).data('id');
                    $('#acceptId').val(id);

                    // Fetch available positions and their quotas
                    $.ajax({
                        url: 'fetch_posisi.php',
                        type: 'GET',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $('#posisi').html(response);
                            $('#acceptModal').modal('show');
                        }
                    });
                });

                $('#acceptForm').on('submit', function(event) {
                    event.preventDefault();
                    var formData = $(this).serialize();

                    $.ajax({
                        url: 'update_status.php',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            alert("Penerimaan berhasil.");
                            location.reload();
                        },
                        error: function() {
                            alert("Ada masalah.");
                        }
                    });
                });

                function addBusinessDays(date, daysToAdd) {
                    let result = new Date(date);
                    let daysAdded = 0;

                    while (daysAdded < daysToAdd) {
                        result.setDate(result.getDate() + 1);

                        // 0 = Sunday, 6 = Saturday
                        if (result.getDay() !== 0 && result.getDay() !== 6) {
                            daysAdded++;
                        }
                    }

                    return result;
                }

                function updateCountdown() {
                    $('.countdown-container').each(function() {
                        var targetDate = $(this).data('target');
                        var submissionDate = new Date(targetDate);

                        // If the submission date is Saturday or Sunday, start from the next Monday
                        if (submissionDate.getDay() === 6) { // Saturday
                            submissionDate.setDate(submissionDate.getDate() + 2);
                        } else if (submissionDate.getDay() === 0) { // Sunday
                            submissionDate.setDate(submissionDate.getDate() + 1);
                        }

                        submissionDate.setHours(0, 0, 0, 0);
                        var target = addBusinessDays(submissionDate, 1);
                        var now = new Date();
                        var diff = target - now;

                        if (diff <= 0) {
                            $(this).addClass('expired');
                            $(this).find('.countdown-item span').text('00');

                        } else {
                            var hours = Math.floor(diff / (1000 * 60 * 60));
                            var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((diff % (1000 * 60)) / 1000);

                            hours = hours < 10 ? '0' + hours : hours;
                            minutes = minutes < 10 ? '0' + minutes : minutes;
                            seconds = seconds < 10 ? '0' + seconds : seconds;

                            $(this).find('.hours').text(hours);
                            $(this).find('.minutes').text(minutes);
                            $(this).find('.seconds').text(seconds);
                        }
                    });
                }

                updateCountdown();
                setInterval(updateCountdown, 1000);


                $('.reject-btn').on('click', function() {
                    var id = $(this).data('id');
                    var reason = prompt("Masukkan alasan penolakan:");

                    if (reason != null && reason != "") {
                        $.ajax({
                            url: 'update_balasan.php',
                            type: 'POST',
                            data: {
                                id: id,
                                reason: reason
                            },
                            success: function(response) {
                                alert("Alasan penolakan sukses dikirim.");
                                location.reload();
                            },
                            error: function() {
                                alert("ada masalah.");
                            }
                        });
                    } else {
                        alert("Alasan penolakan tidak boleh kosong.");
                    }
                });

                $('#searchInput').on('input', function() {
                    var search = $(this).val().toLowerCase().trim();

                    $.ajax({
                        url: 'search_pkl.php',
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