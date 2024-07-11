<?php
include 'koneksi.php';
session_start();

$email = $_SESSION['email'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
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
                    <th scope="col" rowspan="2">Surat Balasan</th>
                </tr>
                <tr>
                    <th scope="col">Surat Pengajuan</th>
                    <th scope="col">Proposal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM pengajuan_pkl WHERE email='$email'";
                $result = mysqli_query($conn, $sql);
                $no = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                    if($row['surat'])
                    echo "<tr>";
                    echo "<th scope='row'>{$no}</th>";
                    echo "<td>{$row['nama']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['phone']}</td>";
                    echo "<td>{$row['university']}</td>";
                    echo "<td>{$row['department']}</td>";
                    echo "<td>{$row['posisi']}</td>";
                    echo "<td>{$row['periode']}</td>";
                    echo "<td>{$row['surat']}</td>";
                    echo "<td>{$row['proposal']}</td>";
                    echo "<td></td>";
                    echo "</tr>";
                    $no++;
                }
                ?>

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>