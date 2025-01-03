<?php
session_start();
include('koneksi.php');

// Mengecek apakah permintaan foto dilakukan
if (isset($_GET['fetch_photo']) && isset($_GET['id']) && isset($_GET['type'])) {
    $attendanceId = intval($_GET['id']);
    $type = $_GET['type']; // 'foto' atau 'foto_keluar'

    // Query untuk mengambil foto atau foto_keluar dari absensi
    $sql = "SELECT $type FROM absensi WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $attendanceId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && !empty($row[$type])) {
        $photoPath = 'Asset/Gambar/' . $row[$type];
        echo json_encode(['status' => 'success', 'photoPath' => $photoPath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Foto tidak ditemukan untuk absensi ini']);
    }

    exit;
}

// Logika utama absensi
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : date('Y-m-d');
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
    <style>
        .question-item {
        margin-bottom: 15px;
        padding: 10px;
        border-bottom: 1px dashed #ccc;
    }
    </style>
    <?php include 'header_admin.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            
        <?php include('sidebar_admin.php'); ?>

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-3">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Absensi PKL</h3>
                    </div>
                    
                    <div class="container mt-4" style="width: 20%; margin-left: 0;">
                    <!-- Form untuk memilih tanggal -->
                        <form action="" method="post" class="form-inline my-3">
                        <label for="tanggal" class="mr-2">Pilih Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control mr-2" value="<?php echo $tanggal; ?>" required><br>
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
                                <th>Foto Masuk</th>
                                <th>Lat & Long<br>Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Foto Keluar</th>
                                <th>Lat & Long<br>keluar</th>
                                <th>Total Jam Kerja</th>
                                <th>Kesimpulan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    echo "<tr>";
                                    echo "<td scope='row'>{$no}</td>";
                                    echo "<td>{$row2['tanggal']}</td>";
                                    echo "<td>{$row2['nama']}</td>";
                                    echo "<td>{$row2['status']}</td>";
                                
                                    // Periksa apakah status adalah "izin"
                                    if (strtolower($row2['status']) === 'izin') {
                                        // Kolom kesimpulan dengan tombol untuk modal
                                        $modal_id = "modal_kesimpulan_" . $no; // ID unik untuk setiap modal
                                        echo "<td></td>"; // Kosongkan kolom lainnya
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td></td>";
                                        echo "<td><button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#{$modal_id}'>Lihat Kesimpulan</button></td>";
                                
                                        // Modal untuk kesimpulan
                                        echo "
                                        <div class='modal fade' id='{$modal_id}' tabindex='-1' aria-labelledby='modalLabel_{$modal_id}' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                            <h5 class='modal-title' id='modalLabel_{$modal_id}'>Keterangan Izin : <strong>{$row2['nama']}</strong></h5>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        
                                                        <div class='question-item'>
                                                            <p>{$row2['kesimpulan']}</p>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                    } else {
                                        // Data untuk status selain "izin"
                                        echo "<td>{$row2['waktu_masuk']}</td>";
                                        // Tombol untuk foto masuk
                                        echo "<td><button class='btn btn-primary btn-view-photo' data-id='{$row2['id']}' data-name='{$row2['nama']}' data-type='foto'>Lihat Foto</button></td>";
                                        $formatted_latitude = number_format($row2['latitude'], 3);
                                        $formatted_longitude = number_format($row2['longitude'], 3);
                                        echo "<td>Lat: $formatted_latitude<br>Long: $formatted_longitude</td>";
                                
                                        // Kolom untuk jam keluar dan foto keluar
                                        if ($row2['waktu_keluar'] != NULL) {
                                            echo "<td>{$row2['waktu_keluar']}</td>";
                                            // Tombol untuk foto keluar
                                            echo "<td><button class='btn btn-primary btn-view-photo' data-id='{$row2['id']}' data-name='{$row2['nama']}' data-type='foto_keluar'>Lihat Foto</button></td>";
                                            $formatted_latitude2 = number_format($row2['latitude_keluar'], 3);
                                            $formatted_longitude2 = number_format($row2['longitude_keluar'], 3);
                                            echo "<td>Lat: $formatted_latitude2<br>Long: $formatted_longitude2</td>";
                                            echo "<td>{$row2['durasi']}</td>";
                                            echo "<td>{$row2['kesimpulan']}</td>";
                                        } else {
                                            echo "<td>-</td>";
                                            echo "<td>-</td>";
                                            echo "<td>-</td>";
                                            echo "<td>-</td>";
                                            echo "<td>-</td>";
                                        }
                                    }
                                
                                    echo "</tr>";
                                    $no++;
                                }
                                
                                ?>
                            </tbody>
                        </table>
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
    <form method="POST" action="function/download_data.php" class="mb-3 text-center">
        <label for="month">Select Month:</label>
        <input type="month" id="month" name="month" required>
        <button type="submit" class="btn btn-success">Download Data</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".btn-view-photo").forEach(button => {
            button.addEventListener("click", function () {
                const attendanceId = this.getAttribute("data-id");
                const userName = this.getAttribute("data-name");
                const photoType = this.getAttribute("data-type");

                document.getElementById("photoUserName").innerText = `Nama: ${userName}`;

                // Mengambil foto menggunakan ID absensi dan jenis foto (foto masuk atau keluar)
                fetch(`<?php echo $_SERVER['PHP_SELF']; ?>?fetch_photo=true&id=${attendanceId}&type=${photoType}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Memperbarui sumber gambar pada modal
                            document.getElementById("absensiPhoto").src = data.photoPath;
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