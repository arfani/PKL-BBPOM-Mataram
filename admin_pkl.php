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
$message = "";
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

$sql3 = "SELECT * FROM pengajuan_pkl WHERE 
        nama LIKE '%$search%' OR 
        email LIKE '%$search%' OR 
        phone LIKE '%$search%' OR 
        university LIKE '%$search%' OR 
        department LIKE '%$search%' OR 
        posisi LIKE '%$search%' OR 
        periode LIKE '%$search%' OR 
        status LIKE '%$search%'";

$result3 = mysqli_query($conn, $sql3);
$no = 1;
$no2 = 1;
$no3 = 1;

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
    <style>
        /* Progress Bar */
        .progress-container {
            position: relative;
            background-color: #a7a7a7;
            border-radius: 5px;
            height: 20px;
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #009dff;
            border-radius: 5px;
        }

        .progress-info {
            position: absolute;
            color: black;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            padding: 0 10px;
            font-size: 9px;
            font-weight: bold;
        }
    </style>

</head>

<body>
    
<?php include 'header_admin.php'; ?>

    <div class="container-fluid">
        <div class="row">
            
        <?php include('sidebar_admin.php'); ?>

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
                                    $laporanAkhir = $row['laporan_akhir'] ? "<a href='{$row['laporan_akhir']}' class='btn btn-primary btn-sm' download>Download Laporan</a>" : "Belum upload";
                                    $proposal = $row['proposal'] ? "<a href='{$row['proposal']}' class='btn btn-primary btn-sm' download>Download Proposal</a>" : "Belum upload";
                                    
                                    $status = $row['status'] ? $row['status'] == 'Pending': "
<button type='button' class='btn btn-success btn-sm accept-btn' data-id='{$row['id_pengajuan']}'>Terima</button>
<button type='button' class='btn btn-danger btn-sm reject-btn' data-id='{$row['id_pengajuan']}'>Tolak</button>
";

                                    $suratBalasan = "";
                                    if ($row['status'] == 'Diterima') {
                                        if ($row['surat_balasan']) {
                                            $suratBalasan = "Sudah diupload";
                                        } else {
                                            $suratBalasan = "
                            <form action='function/upload_surat_balasan.php' method='post' enctype='multipart/form-data'>
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
                                    echo "<td>{$laporanAkhir}</td>";
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

                                    <th scope="col" rowspan="2">Posisi Yang Diajukan</th>
                                    <th scope="col" rowspan="2">Periode</th>

                                    <th scope="col" rowspan="2">Tanggal Pengajuan</th>
                                    <th scope="col" rowspan="2">Waktu Tersisa</th>
                                    <th scope="col" rowspan="2">Status</th>
                                    <th scope="col" rowspan="2" colspan="2">Surat Balasan</th>
                                </tr>

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
                                    $status = $row['status'] =='Diterima' || $row['status'] == 'Ditolak' ? $row['status'] : "
<button type='button' class='btn btn-success btn-sm accept-btn' data-id='{$row['id_pengajuan']}'>Terima</button>
<button type='button' class='btn btn-danger btn-sm reject-btn' data-id='{$row['id_pengajuan']}'>Tolak</button>
";

                                    $suratBalasan = "";
                                    if ($row['status'] == 'Diterima') {
                                        if ($row['surat_balasan']) {
                                            $suratBalasan = "Sudah diupload";
                                        } else {
                                            $suratBalasan = "
                            <form action='function/upload_surat_balasan.php' method='post' enctype='multipart/form-data'>
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

                                    echo "<td>{$row['tanggal_pengajuan']}</td>";
                                    if ($row['status'] == 'Pending') {
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

                    <div class="text-center">
                        <h3 class="fw-bold">Data Progress PKL</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table" style="vertical-align: middle; background-color: skyblue;">
                                <tr>
                                    <th scope="col" rowspan="2">No</th>
                                    <th scope="col" rowspan="2">Nama</th>
                                    <th scope="col" rowspan="2">Posisi Penempatan</th>
                                    <th scope="col" rowspan="2">Progress</th>
                                    <th scope="col" rowspan="2">Ubah Posisi</th>
                                    <th scope="col" rowspan="2">Sertifikat</th>
                                    <th scope="col" rowspan="2">Absensi</th>
                                </tr>

                            </thead>
                            <tbody id="tableBody">
                                <?php
                                while ($row = mysqli_fetch_assoc($result3)) {
                                    $periode = $row['periode'];
                                    $status = $row['status'];
                                    $sertifikat = $row['sertifikat'] ? "<a href='{$row['sertifikat']}' class='btn btn-primary btn-sm' download>Download Sertifikat</a>" : "Belum Buat";
                                    list($start_date, $end_date) = explode(' - ', $periode);
                                    $current_date = new DateTime();
                                    $start_date = new DateTime($start_date);
                                    $end_date = new DateTime($end_date);

                                    if ($current_date < $start_date) {
                                        $days_elapsed = 0;
                                        $total_days = $start_date->diff($end_date)->days;
                                        $days_left = $total_days;
                                        $status_pkl = "Belum Mulai";
                                    } else if ($current_date > $end_date) {
                                        $days_elapsed = $start_date->diff($end_date)->days;
                                        $total_days = $start_date->diff($end_date)->days;
                                        $days_left = 0;
                                        $status_pkl = "PKL Sudah Selesai";
                                    } else {
                                        $days_elapsed = $start_date->diff($current_date)->days;
                                        $total_days = $start_date->diff($end_date)->days;
                                        $days_left = $total_days - $days_elapsed;
                                        $status_pkl = "$days_elapsed hari berjalan";
                                    }
                                    $progress_percentage = ($days_elapsed / $total_days) * 100;

                                    echo "<tr>";
                                    echo "<th scope='row'>{$no3}</th>";
                                    echo "<td class='text-nowrap'>{$row['nama']}</td>";
                                    if ($status == "Diterima") {
                                        echo "<td>{$row['penempatan']}</td>";
                                    } else {
                                        echo "<td>Ditolak</td>";
                                    }
                                    if ($status == "Diterima") {
                                        echo "<td class='text-nowrap'>
                        <div class='progress-container'>
                            <div class='progress-bar' style='width: {$progress_percentage}%;'></div>
                            <div class='progress-info d-flex justify-content-between'>
                                <span> </span>
                                <span>{$status_pkl}</span>
                                <span> </span>
                            </div>
                        </div>
                                    </td>";
                                    } else {
                                        echo "<td>Ditolak</td>";
                                    }
                                    if ($status == "Diterima") {
                                        if ($status_pkl == "PKL Sudah Selesai") {
                                            echo "<td>PKL Selesai</td>";
                                        } else {
                                            echo "<td class='text-nowrap'>
<button type='button' class='btn btn-success btn-sm change-btn' data-id='{$row['id_pengajuan']}'>Ubah posisi</button>
                                    </td>";
                                        }
                                    } else {
                                        echo "<td>Ditolak</td>";
                                    }
                                    if ($status == "Ditolak") {
                                        echo "<td>Ditolak</td>";
                                        echo "<td>-</td>";
                                        
                                    } else {
                                        echo "<td class='text-nowrap'>{$sertifikat}</td>";
                                        echo "<td class='text-nowrap'>
                                                <form action='function/DownloadAbsensi.php' method='POST'>
                                                    <input type='hidden' name='nama' value='{$row['nama']}'>
                                                    <button type='submit' class='btn btn-primary'>
                                                        <i class='fas fa-cloud-download-alt'></i> Unduh Sekarang
                                                    </button>
                                                </form>
                                            </td>";
                                        
                                    }

                                    echo "</tr>";
                                    $no3++;
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
                        <h5 class="modal-title" id="acceptModalLabel">Pilih Posisi Penempatan</h5>
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

        <!-- Modal Ubah Posisi -->
        <div class="modal fade" id="changeModal" tabindex="-1" aria-labelledby="changeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeModalLabel">Pilih Posisi Penempatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="changeForm" action="<?php echo $urlweb ?>/function/update_posisi.php" method="post">
                            <input type="hidden" name="id" id="changeId">
                            <div id="posisi2"></div>
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
                        url: '<?php echo $urlweb ?>/function/fetch_posisi.php',
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

                $('.change-btn').on('click', function() {
                    var id = $(this).data('id');
                    $('#changeId').val(id);
                    console.log(id);
                    // Fetch available positions and their quotas
                    $.ajax({
                        url: '<?php echo $urlweb ?>/function/fetch_posisi2.php',
                        type: 'GET',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            $('#posisi2').html(response);
                            $('#changeModal').modal('show');
                        }
                    });
                });

                $('#acceptForm').on('submit', function(event) {
                    event.preventDefault();
                    var formData = $(this).serialize();

                    $.ajax({
                        url: '<?php echo $urlweb ?>/function/update_status.php',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Status Berhasil Diperbarui',
                                icon: 'succes',
                                confirmButtonText: 'OK'
                            });
                            location.reload();
                        },
                        error: function() {
                            alert("Ada masalah.");
                        }
                    });
                });

                $('#changeForm').on('submit', function(event) {
                    event.preventDefault();
                    var formData = $(this).serialize();

                    $.ajax({
                        url: '<?php echo $urlweb ?>/function/update_posisi.php',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            alert("Perubahan berhasil.");
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
                            url: '<?php echo $urlweb ?>/function/update_balasan.php',
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


                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('searchInput');
                    const searchForm = document.getElementById('searchForm');

                    searchInput.addEventListener('input', function() {
                        searchForm.submit(); // Kirim form secara otomatis saat input berubah
                    });
                });


            });
        </script>


</body>

</html>