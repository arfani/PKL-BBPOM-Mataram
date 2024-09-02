<?php
include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role != "pkl" && $role != "admin") {
        header('location:' . $urlweb . '/' . $role . '.php');
    }
} else {
    header("Location: " . $urlweb);
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    if ($role == "admin") {
        $email = "";
        $nama = "";
        $no_hp = "";
        $status = "";
    } else {
        $sql = "SELECT * FROM users where id ='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $nama = $row['nama'];
        $no_hp = $row['no_hp'];
        $status = $row['status'];
    }
} else {
    $email = "";
    $nama = "";
    $no_hp = "";
    header("Location: index.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor\fontawesome\css\all.min.css">
    <link rel="stylesheet" href="Asset/CSS/style_pkl.css">
    <title>pkl</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .section-title {
            font-size: 2.5rem;
            color: #343a40;
            margin-bottom: 1rem;
        }

        .section-description {
            font-size: 1.25rem;
            color: #6c757d;
        }

        .bidang-card {
            border: 1px solid rgba(156, 156, 156, 0.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .bidang-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            border-radius: 10px;
            height: 200px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 1rem;
            color: #495057;
        }

        @media (max-width: 768px) {
            .card-title {
                font-size: 1.25rem;
            }

            .card-text {
                font-size: 0.875rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Asset/Gambar/logo.png" alt="#" width="35px" height="35px"
                    style="margin-left: 15px; margin-right: 10px">
                <b>BBPOM MATARAM</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    if ($status == "active" || $status == "done") {
                    ?>
                        <li class="nav-item me-3 dashboard">
                            <a class="nav-link" style="color: white;" href="dashboardpkl.php">
                                <i class="fas fa-home"></i>
                                Dashboard
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" href="#" data-bs-toggle="modal"
                            data-bs-target="#notificationModal">
                            <div class="notification-icon">
                                <i class="fas fa-bell"></i>
                                <?php
                                $sql_count = "SELECT COUNT(*) AS count FROM notifikasi WHERE userid='$id' AND status='pkl'";
                                $result_count = mysqli_query($conn, $sql_count);
                                $row_count = mysqli_fetch_assoc($result_count);
                                $notification_count = $row_count['count'];
                                ?>
                                <span class="badge"><?php echo $notification_count; ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap" style="color: white" href="#" data-bs-toggle="modal"
                            data-bs-target="#profileModal">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="profileForm" action="<?php echo $urlweb ?>/function/save_profile.php" method="POST">
                    <input type="hidden" name="redirect" value="pkl.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="profileName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="profileName" name="profileName"
                                value="<?php echo $nama; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="profileEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="profileEmail" name="profileEmail"
                                value="<?php echo $email; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="profilePhone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="profilePhone" name="profilePhone"
                                value="<?php echo $no_hp; ?>">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-around">
                        <button type="button" class="btn btn-danger"><a href="logout.php"
                                style="text-decoration: none; color: white;">Logout</a></button>
                        <input type="submit" class="btn btn-primary" value="Save">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notification Modal -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group">
                        <?php
                        $sql3 = "SELECT * FROM notifikasi WHERE userid='$id' AND status='pkl'";
                        $result3 = mysqli_query($conn, $sql3);

                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            $saved_text = $row3['text'];
                            echo "<span class='list-group-item list-group-item-action mt-3 small-text'>" . nl2br($saved_text) . "</span>";
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="hero-title">Selamat datang di Portal Sapu Jagad PKL</h1>
                    <p class="hero-description">Balai Besar Pengawas Obat dan Makanan di Mataram</p>
                    <a href="pengajuan.php" class="btn btn-warning btn-cta">Ajukan ➔</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="Asset/Gambar/logo.png" alt="Hero Image" class="img-fluid" height="290px" width="290px">
                </div>
            </div>
        </div>
    </div>


    <div class="text-center mt-3">
        <h2 class="title">Posisi PKL Yang Tersedia</h2>
    </div>
    <div class="container mt-3 mb-5">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="bg-primary" style="vertical-align: middle; color: white;">
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
                    <?php
                    $sql2 = "SELECT * FROM penempatan_pkl";
                    $result2 = mysqli_query($conn, $sql2);
                    $no = 1;
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo "<tr>";
                        echo "<td scope='row'>{$no}</td>";
                        echo "<td>{$row2['posisi']}</td>";
                        echo "<td>{$row2['deskripsi']}</td>";
                        echo "<td>{$row2['jurusan']}</td>";
                        echo "<td>{$row2['kuota']}</td>";
                        if ($status == "active") {
                            echo "<td><a href='dashboard.php' class='btn btn-primary'>Apply</a></td>";
                        } else if ($status == "pending") {
                            echo "<td><a href='#' onclick='openNotif()' class='btn btn-primary'>Apply</a></td>";
                        } else {
                            echo "<td><a href='pengajuan.php' class='btn btn-primary'>Apply</a></td>";
                        }

                        echo "</tr>";
                        $no++;
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        <h1 class="title">Dokumentasi</h1>
    </div>
    <div class="container my-5">
        <div class="text-center">
            <h2 class="section-title">Bidang PKL</h2>
            <p class="section-description">Berikut adalah beberapa bidang yang tersedia untuk PKL di BBPOM Mataram</p>
        </div>

        <div class="row mt-4">
            <?php
            $sql3 = "SELECT * FROM penempatan_pkl";
            $result3 = mysqli_query($conn, $sql3);

            while ($row3 = mysqli_fetch_assoc($result3)) {
                $posisi = $row3['posisi'];
                $deskripsi = $row3['deskripsi'];
                $gambar = $row3['gambar'];
            ?>

                <div class="col-md-4 pt-3">
                    <div class="card bidang-card">
                        <img src="<?php echo $urlweb; ?>/Asset/Gambar/<?php echo $gambar; ?>" class="card-img-top"
                            alt="Laboratorium">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $posisi ?></h5>
                            <p class="card-text"><?php echo $deskripsi ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>


        <?php require_once('cs.php'); ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script>
            //Function to show notification
            function openNotif() {
                alert("Anda sudah melakukan pengajuan, mohon menunggu balasan atau hubungi admin.");
            }
        </script>

</body>

</html>