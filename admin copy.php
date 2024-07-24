<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/custom2.css">
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
            <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px" style="margin-left: 15px; margin-right: 10px">
            BBPOM MATARAM
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="logout.php">Sign out</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="admin.php">
                                <span data-feather="home"></span>
                                Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_pkl.php">
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

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                            <span data-feather="calendar"></span>
                            This week
                        </button>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="myLineChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>

                <div class="container mt-4">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Penempatan PKL</h3>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <a href="tambah.php" class="btn btn-success">Tambah Data</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Posisi & Penempatan</th>
                                    <th>Deskripsi</th>
                                    <th>Kualifikasi Jurusan</th>
                                    <th>Kuota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- PHP loop to fetch data -->
                                <?php
                                include 'koneksi.php';
                                $sql2 = "SELECT * FROM penempatan_pkl";
                                $result2 = mysqli_query($conn, $sql2);
                                $no = 1;
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    echo "<tr>";
                                    echo "<td>{$no}</td>";
                                    echo "<td>{$row2['posisi']}</td>";
                                    echo "<td>{$row2['deskripsi']}</td>";
                                    echo "<td>{$row2['jurusan']}</td>";
                                    echo "<td>{$row2['kuota']}</td>";
                                    echo "<td>
                                            <form action='edit.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='{$row2['id']}'>
                                                <button type='submit' name='action' value='edit' class='btn btn-warning btn-sm'>Edit</button>
                                            </form>
                                            <form action='actions.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='{$row2['id']}'>
                                                <button type='submit' name='action' value='delete' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</button>
                                            </form>
                                        </td>";
                                    echo "</tr>";
                                    $no++;
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
    </script>
    <script>
        var ctx = document.getElementById('myLineChart').getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Earnings',
                    data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxP = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
                labels: ['Direct', 'Social', 'Referral'],
                datasets: [{
                    data: [55, 25, 20],
                    backgroundColor: ['#007bff', '#28a745', '#dc3545'],
                    hoverBackgroundColor: ['#0056b3', '#218838', '#c82333']
                }]
            },
            options: {
                responsive: true,
            }
        });
    </script>
</body>

</html>