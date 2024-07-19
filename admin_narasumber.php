<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/custom2.css">
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px" style="margin-left: 15px;">
        <a class="navbar-brand mx-3 my-1" href="#">BBPOM MATARAM</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
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
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="admin.php">
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
                            <a class="nav-link active" href="admin_narasumber.php">
                                <span data-feather="users"></span>
                                Narasumber
                            </a>
                        </li>
                    </ul>
                </div>

            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">

                <div class="container mt-3">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Narasumber Realtime</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Bidang</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Replace with PHP loop to populate data -->
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>johndoe@example.com</td>
                                    <td>Kesehatan</td>
                                    <td>Aktif</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>janesmith@example.com</td>
                                    <td>Pangan</td>
                                    <td>Nonaktif</td>
                                </tr>
                                <!-- End of PHP loop -->
                            </tbody>
                        </table>
                    </div>
                </div>


            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXlK9jz0nEG/q1QAWJusZyW9L73L68cHwtMDtE3Ez+k8jLDutoxLSjiFo4La" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhG81vGOdnpG2z7mr6Lc5I6pR9lkv5IDZw4iDw0FKhp9K1MRf0xqY2yRgP/l" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>