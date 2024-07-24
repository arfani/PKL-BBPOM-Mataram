<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/custom2.css">
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h2 {
            font-size: 2.5rem;
            margin: 0;
        }

        .card .card-icon {
            font-size: 3rem;
            color: #777;
        }
    </style>
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand" href="#">
            <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px" style="margin-left: 15px; margin-right: 10px">
            BBPOM MATARAM
        </a>

        <input class="form-control form-control-dark w-10 order-1" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav order-3 text-nowrap">
            <div class="nav-item">
                <a class="nav-link px-3" href="logout.php">Sign out</a>
            </div>
        </div>
        <button class="navbar-toggler d-md-none collapsed me-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-3" id="navbarMenu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="admin.php">
                        Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_posisi.php">
                        Posisi Penempatan PKL
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_pkl.php">
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
            <div id="sidebar" class="sidebar col-md-3 col-lg-2 bg-light d-none d-md-block">
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
                            <a class="nav-link" href="admin_pkl.php">
                                PKL
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="admin_tamu.php">
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

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Overview</h1>
                </div>
            </div>
            <div class="col-md-9 ms-sm-auto col-lg-10 ">
                <div class="container mt-2">
                    <div class="text-center">
                        <h3 class="fw-bold">Data PKL</h3>
                    </div>

                    <!-- Card Section -->
                    <div class="row my-4">
                        <div class="col-md-3">
                            <div class="card p-3">
                                <div class="card-icon">😊</div>
                                <h2>21</h2>
                                <p>PKL Selesai</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3">
                                <div class="card-icon">📋</div>
                                <h2>5</h2>
                                <p>Sedang PKL</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3">
                                <div class="card-icon">🎧</div>
                                <h2>3</h2>
                                <p>Batal</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-3">
                                <div class="card-icon">👥</div>
                                <h2>4</h2>
                                <p>Lowongan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Section -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-line me-1"></i>
                                    Data PKL
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    PKL
                                </div>
                                <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
                    </script>
                    <script>
                        // Bar Chart
                        var ctx = document.getElementById('myAreaChart').getContext('2d');
                        var myAreaChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                                    'Nov', 'Dec'
                                ],
                                datasets: [{
                                    label: 'Jumlah PKL',
                                    data: [0, 10, 5, 2, 20, 30, 45, 60, 75, 90, 105, 120],
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });

                        // Pie Chart
                        var ctx = document.getElementById('myPieChart').getContext('2d');
                        var myPieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Selesai', 'Sedang PKL', 'Batal', 'Lowongan'],
                                datasets: [{
                                    data: [21, 5, 3, 4],
                                    backgroundColor: ['#007bff', '#ffc107', '#dc3545', '#28a745']
                                }]
                            }
                        });
                    </script>
</body>

</html>