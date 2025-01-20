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
if (isset($_GET['status'])) {
    
    // Simpan nilai parameter 'status' ke dalam variabel
    $status = $_GET['status'];
    // Gunakan nilai variabel untuk logika lebih lanjut
    if ($status === 'success') {
        echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'File Berhasil Diunggah',
                    showConfirmButton: true
                });
            });
        </script>";
    } else {
        echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Reset Password',
                        text: 'Gagal Mereset Password',
                        showConfirmButton: true
                    });
                });
            </script>";
    }
} else {
    echo "No status provided in the URL.";
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
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/custom2.css">
</head>

<body>
<?php include 'header_admin.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            
        <?php include('sidebar_admin.php'); ?>

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-3">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Rencana Kunjungan dan Narasumber</h3>
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
                            $sql2 = "SELECT * FROM kunjungan ";
                            $result2 = mysqli_query($conn, $sql2);
                            $no = 1;
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $status = $row2['status_kunjungan'] =='Diterima' || $row2['status_kunjungan'] == 'Ditolak' ? $row2['status_kunjungan'] : "
                                    <form action='function/update_kunjungan.php' method='POST'>
                                        <input type='hidden' name='id' value='" . htmlspecialchars($row2['id']) . "'>
                                        <button type='submit' name='status' value='Diterima' class='btn btn-success'>Diterima</button>
                                        <button type='submit' name='status' value='Ditolak' class='btn btn-danger'>Ditolak</button>
                                    </form>";
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
                                            <a href='{$row2['surat_balasan']}' download='{$row2['surat_balasan']}' class='btn btn-secondary'>
                                            <i class='fas fa-download'></i>
                                        </a>
                                                
                                            ";
                                    }
                                    echo "</td>";

                                
                                    echo "<td>{$status}</td>";
                                
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