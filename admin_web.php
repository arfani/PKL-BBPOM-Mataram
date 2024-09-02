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
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
</head>

<body>
    <header class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand" href="#">
            <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px"
                style="margin-left: 15px; margin-right: 10px">
            BBPOM MATARAM
        </a>
        <!-- Search and Sign Out for larger screens (md and above) -->
        <div class="d-none d-md-flex order-1 flex-grow-1">
            <form method="GET" action="" id="searchForm" class="d-flex me-auto">
                <input class="form-control w-100 me-2" type="text" name="search" placeholder="Search"
                    aria-label="Search" id="searchInput"
                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button class="btn btn-outline-secondary" type="submit" id="searchButton">
                    <i class="bx bx-search"></i> <!-- Ikon pencarian dari Boxicons -->
                </button>
            </form>
            <a class="nav-link signout text-nowrap" style="color: white; padding-top: 20px; padding-left: 10px;"
                href="logout.php">Sign out</a>
        </div>

        <!-- Toggle button for mobile -->
        <button class="navbar-toggler d-md-none collapsed me-1" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar for mobile (sm and below) -->
        <div class="collapse navbar-collapse ms-3 d-md-none" id="navbarMenu">
            <form method="GET" action="" id="searchFormMobile" class="d-flex mb-2">
                <input class="form-control w-100 me-2" type="text" name="search" placeholder="Search"
                    aria-label="Search" id="searchInputMobile"
                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button class="btn btn-outline-secondary" type="submit" id="searchButtonMobile">
                    <i class="bx bx-search"></i> <!-- Ikon pencarian dari Boxicons -->
                </button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_posisi.php">Posisi Penempatan PKL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_pkl.php">PKL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_tamu.php">Kunjungan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_narasumber.php">Narasumber</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="admin_web.php">Setting Website</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: white; text-shadow: 
        -1px -1px 0 #000,  
         1px -1px 0 #000,
        -1px  1px 0 #000,
         1px  1px 0 #000; " href="logout.php">Sign out</a>
                </li>
            </ul>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div id="sidebar" class="sidebar col-md-3 col-lg-2 d-none d-md-block">
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
                            <a class="nav-link" href="admin_tamu.php">
                                Kunjungan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_narasumber.php">
                                Narasumber
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="admin_posisi.php">
                                Setting Website
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-2">
                    <div class="text-center">
                        <h3 class="fw-bold">Atur Slide</h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    error_reporting(0);
                                    if (!empty($_GET['notif'])) {
                                        if ($_GET['notif'] == 1) {
                                            echo '
                              <div class="alert alert-success d-flex align-items-center" role="alert">
                                <span class="alert-icon text-success me-2">
                                  <i class="ti ti-check ti-xs"></i>
                                </span>
                                <span><strong>Well Done!</strong> Slide Show Saved!</span>
                              </div>
                            ';
                                        }
                                        if ($_GET['notif'] == 2) {
                                            echo '
                              <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <span class="alert-icon text-warning me-2">
                                  <i class="ti ti-bell ti-xs"></i>
                                </span>
                                <span><strong>Warning!</strong> Max Image Size 2MB!</span>
                              </div>
                            ';
                                        }
                                        if ($_GET['notif'] == 3) {
                                            echo '
                              <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <span class="alert-icon text-warning me-2">
                                  <i class="ti ti-bell ti-xs"></i>
                                </span>
                                <span><strong>Warning!</strong> Only JPG atau PNG!</span>
                              </div>
                            ';
                                        }
                                    }
                                    if (isset($_GET['catID'])) {
                                        $catID = $_GET['catID'];
                                        $sql_2 = mysqli_query($conn, "SELECT * FROM `tb_slide` WHERE id = '$catID'");
                                        $s2 = mysqli_fetch_array($sql_2);
                                    }
                                    ?>
                                    <form role="form" action="<?php echo $urlweb; ?>/function/add-slide.php"
                                        method="post" enctype="multipart/form-data">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Upload Image :</label>
                                            <input type="file" name="image" class="form-control">
                                            <span>JPG or PNG</span><br>
                                            <?php if (isset($_GET['catID'])) { ?>
                                                <img src="<?php echo $urlweb; ?>/Asset/Gambar/<?php echo $s2['image']; ?>"
                                                    class="img-fluid">
                                            <?php } ?>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Slide Text :</label>
                                            <input class="form-control" type="text" name="deskripsi" value="<?php if (isset($_GET['catID'])) {
                                                                                                                echo $s2['deskripsi'];
                                                                                                            } ?>">
                                            <input class="form-control" type="hidden" name="postID" value="<?php if (isset($_GET['catID'])) {
                                                                                                                echo $s2['id'];
                                                                                                            } ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Sort Order :</label>
                                            <input class="form-control" type="text" name="sort" value="<?php if (isset($_GET['catID'])) {
                                                                                                            echo $s2['sort'];
                                                                                                        } ?>">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Status :</label>
                                            <select name="status" class="form-control">
                                                <option value="1" <?php if (isset($_GET['catID'])) {
                                                                        if ($s2['status'] == 1) {
                                                                            echo 'selected = selected';
                                                                        }
                                                                    } ?>>
                                                    Active</option>
                                                <option value="0" <?php if (isset($_GET['catID'])) {
                                                                        if ($s2['status'] == 0) {
                                                                            echo 'selected = selected';
                                                                        }
                                                                    } ?>>
                                                    Not Active</option>
                                            </select>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Publish</button>
                                        <a href="<?php echo $urlweb; ?>/admin_web.php" class="btn btn-light">Cancel</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <!-- Invoice List Table -->
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <table id="default-datatable" class="invoice-list-table table border-top">
                                        <thead>
                                            <tr class="bg-info">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Sort</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_1 = mysqli_query($conn, "SELECT * FROM `tb_slide` ORDER BY id ASC");
                                            $no = 0;
                                            while ($s1 = mysqli_fetch_array($sql_1)) {
                                                $no++;
                                                $idkategori = $s1['id'];
                                            ?>
                                                <tr>
                                                    <td class="text-center"
                                                        style="vertical-align: middle; font-size: 14px;"><?php echo $no; ?>
                                                    </td>
                                                    <td class="text-center"
                                                        style="vertical-align: middle; white-space: normal; font-size: 14px;">
                                                        <img src="<?php echo $urlweb; ?>/Asset/Gambar/<?php echo $s1['image']; ?>"
                                                            style="display: block; margin: 0 auto; width: 250px; height: auto; max-width: 150px; max-height: 100px;">
                                                    </td>
                                                    <td class="text-center"
                                                        style="vertical-align: middle; white-space: normal; font-size: 14px;">
                                                        <?php echo $s1['sort']; ?></td>
                                                    <td class="text-center"
                                                        style="vertical-align: middle; white-space: normal; font-size: 14px;">
                                                        <?php if ($s1['status'] == 0) {
                                                            echo 'Unpublished';
                                                        } else {
                                                            echo 'Published';
                                                        } ?>
                                                    </td>
                                                    <td class="text-center"
                                                        style="vertical-align: middle; font-size: 14px;">
                                                        <a href="<?php echo $urlweb; ?>/admin_web.php?catID=<?php echo $s1['id']; ?>"
                                                            class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                                        <a href="<?php echo $urlweb; ?>/function/del-slide.php?id=<?php echo $s1['id']; ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure want remove this data?');"><i
                                                                class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-2">
                    <div class="text-center">
                        <h3 class="fw-bold">Atur Bidang</h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    error_reporting(0);
                                    if (!empty($_GET['notif2'])) {
                                        if ($_GET['notif2'] == 1) {
                                            echo '
                              <div class="alert alert-success d-flex align-items-center" role="alert">
                                <span class="alert-icon text-success me-2">
                                  <i class="ti ti-check ti-xs"></i>
                                </span>
                                <span><strong>Well Done!</strong> Penempatan berhasil diubah!</span>
                              </div>
                            ';
                                        }
                                        if ($_GET['notif2'] == 2) {
                                            echo '
                              <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <span class="alert-icon text-warning me-2">
                                  <i class="ti ti-bell ti-xs"></i>
                                </span>
                                <span><strong>Warning!</strong> Max Image Size 5MB!</span>
                              </div>
                            ';
                                        }
                                        if ($_GET['notif2'] == 3) {
                                            echo '
                              <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <span class="alert-icon text-warning me-2">
                                  <i class="ti ti-bell ti-xs"></i>
                                </span>
                                <span><strong>Warning!</strong> Only JPG atau PNG!</span>
                              </div>
                            ';
                                        }
                                    }
                                    if (isset($_GET['id'])) {
                                        $posID = $_GET['id'];
                                        $sql_3 = mysqli_query($conn, "SELECT * FROM `penempatan_pkl` WHERE id = '$posID'");
                                        $s3 = mysqli_fetch_array($sql_3);

                                    ?>
                                        <form role="form" action="<?php echo $urlweb; ?>/function/update_penempatan.php"
                                            method="post" enctype="multipart/form-data">
                                            <div class="form-group mb-2">
                                                <label class="form-label">Upload Image :</label>
                                                <input type="file" name="image" class="form-control">
                                                <span>JPG or PNG</span><br>
                                                <img src="<?php echo $urlweb; ?>/Asset/Gambar/<?php echo $s3['gambar']; ?>"
                                                    class="img-fluid">

                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label">Nama :</label>
                                                <input class="form-control disabled" type="text" name="nama"
                                                    value="<?php echo $s3['posisi']; ?>" disabled>
                                                <input class="form-control" type="hidden" name="nama2"
                                                    value="<?php echo $s3['posisi']; ?>">
                                                <input class="form-control" type="hidden" name="posID"
                                                    value="<?php echo $s3['id']; ?>">
                                                <small class="form-text text-muted">!!! tidak bisa diubah disini</small>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label">Deskripsi :</label>
                                                <input class="form-control" type="text" name="deskripsi"
                                                    value="<?php echo $s3['deskripsi']; ?>">
                                            </div>

                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                            <a href="<?php echo $urlweb; ?>/admin_web.php" class="btn btn-light">Cancel</a>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <!-- Invoice List Table -->
                            <div class="card">
                                <div class="card-datatable table-responsive">
                                    <table id="default-datatable" class="invoice-list-table table border-top">
                                        <thead>
                                            <tr class="bg-info">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Gambar</th>
                                                <th class="text-center">Deskripsi</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_2 = mysqli_query($conn, "SELECT * FROM `penempatan_pkl` ORDER BY id ASC");
                                            $no2 = 0;
                                            while ($s2 = mysqli_fetch_array($sql_2)) {
                                                $no2++;
                                                $id = $s2['id'];
                                            ?>
                                                <tr>
                                                    <td class="text-center"
                                                        style="vertical-align: middle; font-size: 14px;"><?php echo $no2; ?>
                                                    </td>
                                                    <td class="text-center"
                                                        style="vertical-align: middle; white-space: normal; font-size: 14px;">
                                                        <?php echo $s2['posisi']; ?></td>
                                                    <td class="text-center"
                                                        style="vertical-align: middle; white-space: normal; font-size: 14px;">
                                                        <img src="<?php echo $urlweb; ?>/Asset/Gambar/<?php echo $s2['gambar']; ?>"
                                                            style="display: block; margin: 0 auto; width: 250px; height: auto; max-width: 150px; max-height: 100px;">
                                                    </td>
                                                    <td class="text-center"
                                                        style="vertical-align: middle; white-space: normal; font-size: 14px;">
                                                        <?php echo $s2['deskripsi']; ?></td>

                                                    <td class="text-center"
                                                        style="vertical-align: middle; font-size: 14px;">
                                                        <a href="<?php echo $urlweb; ?>/admin_web.php?id=<?php echo $id; ?>"
                                                            class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                                        <a href="<?php echo $urlweb; ?>/function/del-penempatan.php?id=<?php echo $id; ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure want remove this data?');"><i
                                                                class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
            </script>

</body>

</html>