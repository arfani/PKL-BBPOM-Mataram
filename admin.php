<?php
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/admin.css">
    <title>Dashboard Admin</title>
</head>

<body>
    <h1>Tampilan Admin</h1>

    <div class="container mt-5">
        <table class="table table-bordered table-striped table-hover text-center">
            <thead class="table-dark" style="vertical-align: middle;">
                <tr>
                    <th scope="col" rowspan="2">No</th>
                    <th scope="col" rowspan="2">Nama</th>
                    <th scope="col" rowspan="2">No HP</th>
                    <th scope="col" rowspan="2">Posisi dan Tempat Penempatan yang Dipilih</th>
                    <th scope="col" colspan="3">Persyaratan</th>
                    <th scope="col" rowspan="2">Surat Balasan</th>
                </tr>
                <tr>
                    <th scope="col">Data 1</th>
                    <th scope="col">Data 2</th>
                    <th scope="col">Data 3</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM pkl";
                $result = mysqli_query($conn, $sql);
                $sql = "SELECT * FROM pkl";
                $result = mysqli_query($conn, $sql);
                $no = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<th scope='row'>{$no}</th>";
                    echo "<td>{$row['nama']}</td>";
                    echo "<td>{$row['no_hp']}</td>";
                    echo "<td>{$row['posisi_tempat']}</td>";
                    echo "<td>{$row['data1']}</td>";
                    echo "<td>{$row['data2']}</td>";
                    echo "<td>{$row['data3']}</td>";
                    echo "<td>{$row['surat_balasan']}</td>";
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>