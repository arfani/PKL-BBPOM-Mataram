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
                        <span data-feather="home"></span> Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_pkl.php">
                        <span data-feather="file"></span> PKL
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_tamu.php">
                        <span data-feather="shopping-cart"></span> Pengunjung
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_narasumber.php">
                        <span data-feather="users"></span> Narasumber
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="sidebar col-md-3 col-lg-2 d-md-block bg-light">
                <div class="position-sticky pt-2 sidebar-sticky">
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
            </div>
        </div>

        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <div class="container mt-2">
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
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>