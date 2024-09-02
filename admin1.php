<?php
include('koneksi.php');
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/admin.css">
    <title>Dashboard Admin</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>Tampilan Admin</h1>

    <div class="container mt-5">
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
                    <th scope="col" rowspan="2">Surat Balasan</th>
                </tr>
                <tr>
                    <th scope="col">Surat Pengajuan</th>
                    <th scope="col">Proposal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM pengajuan_pkl";
                $result = mysqli_query($conn, $sql);
                $no = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['surat'] != null && $row['proposal'] != null) {
                        $surat = $row['surat'] ? "<a href='{$row['surat']}' class='btn btn-primary' download>Download Surat</a>" : "Belum upload";
                        $proposal = $row['proposal'] ? "<a href='{$row['proposal']}' class='btn btn-primary' download>Download Proposal</a>" : "Belum upload";
                        $status = $row['status'] ? $row['status'] : "
                        <form action='update_status.php' method='post'>
                            <input type='hidden' name='id' value='{$row['id_pengajuan']}'>
                            <button type='submit' name='status' value='Diterima' class='btn btn-success'>Terima</button>
                            <button type='submit' name='status' value='Ditolak' class='btn btn-danger'>Tolak</button>
                        </form>";

                        $suratBalasan = "";
                        if ($row['status'] == 'Diterima') {
                            $suratBalasan = "
                            <form action='upload_surat_balasan.php' method='post' enctype='multipart/form-data'>
                                <input type='hidden' name='id' value='{$row['id_pengajuan']}'>
                                <input type='file' name='surat_balasan' class='form-control' required>
                                <button type='submit' class='btn btn-primary mt-2'>Upload Surat Balasan</button>
                            </form>";
                        } elseif ($row['status'] == 'Ditolak') {
                            $suratBalasan = "Maaf, Anda tidak diterima.";
                        }
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
                    echo "<td>{$suratBalasan}</td>";
                    echo "</tr>";
                    $no++;
                }
                ?>

            </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <div class="text-center">
            <h2 class="fw-bold">Data PKL Realtime</h2>
        </div>
        <div class="d-flex justify-content-center mt-4 flex-wrap">
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/000000/happy.png" alt="Icon Selesai">
                    </div>
                    <h3 class="text-primary">21</h3>
                    <p class="text-muted">PKL Selesai</p>
                </div>
            </div>
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/FFA500/report-card.png" alt="Icon Sedang PKL">
                    </div>
                    <h3 class="text-primary">5</h3>
                    <p class="text-muted">Sedang PKL</p>
                </div>
            </div>
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/32CD32/customer-support.png" alt="Icon Batal">
                    </div>
                    <h3 class="text-primary">3</h3>
                    <p class="text-muted">Batal</p>
                </div>
            </div>
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/DC143C/conference.png" alt="Icon Lowongan">
                    </div>
                    <h3 class="text-primary">4</h3>
                    <p class="text-muted">Lowongan</p>
                </div>
            </div>
        </div>
    </div>

    buat tabel disini

    <div class="container mt-5">
        <div class="text-center">
            <h2 class="fw-bold">Data Pengunjung Realtime</h2>
        </div>
        <div class="d-flex justify-content-center mt-4 flex-wrap">
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/000000/happy.png" alt="Icon Selesai">
                    </div>
                    <h3 class="text-primary">21</h3>
                    <p class="text-muted">PKL Selesai</p>
                </div>
            </div>
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/FFA500/report-card.png" alt="Icon Sedang PKL">
                    </div>
                    <h3 class="text-primary">5</h3>
                    <p class="text-muted">Sedang PKL</p>
                </div>
            </div>
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/32CD32/customer-support.png" alt="Icon Batal">
                    </div>
                    <h3 class="text-primary">3</h3>
                    <p class="text-muted">Batal</p>
                </div>
            </div>
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/DC143C/conference.png" alt="Icon Lowongan">
                    </div>
                    <h3 class="text-primary">4</h3>
                    <p class="text-muted">Lowongan</p>
                </div>
            </div>
        </div>
    </div>

    buat tabel disini

    <div class="container mt-5">
        <div class="text-center">
            <h2 class="fw-bold">Data Narasumber Realtime</h2>
        </div>
        <div class="d-flex justify-content-center mt-4 flex-wrap">
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/000000/happy.png" alt="Icon Selesai">
                    </div>
                    <h3 class="text-primary">21</h3>
                    <p class="text-muted">PKL Selesai</p>
                </div>
            </div>
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/FFA500/report-card.png" alt="Icon Sedang PKL">
                    </div>
                    <h3 class="text-primary">5</h3>
                    <p class="text-muted">Sedang PKL</p>
                </div>
            </div>
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/32CD32/customer-support.png" alt="Icon Batal">
                    </div>
                    <h3 class="text-primary">3</h3>
                    <p class="text-muted">Batal</p>
                </div>
            </div>
            <div class="card text-center shadow-sm p-3 mb-5 bg-white rounded mx-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="icon mb-2">
                        <img src="https://img.icons8.com/ios-filled/50/DC143C/conference.png" alt="Icon Lowongan">
                    </div>
                    <h3 class="text-primary">4</h3>
                    <p class="text-muted">Lowongan</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>