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
<style>
.card:hover {
        background-color: unset; /* warna biru */
        transform: unset; /* memperbesar */
        color: unset; /* Ubah teks menjadi putih */
        }

        /* Style untuk kartu yang tetap aktif setelah diklik */
        .card.active {
        background-color: unset; /* warna biru */
        transform: unset; /* memperbesar */
        color: unset; /* Ubah teks menjadi putih */
        }
</style>

<?php include 'header_admin.php'; ?>
    
    <div class="container-fluid">
        <div class="row">
            
        <?php include('sidebar_admin.php'); ?>

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
                            <div class="card mt-2 mb-5">
                                <div class="card-body">
                                    <h5>Atur Reset Password</h5>
                                    <form role="form" action="<?php echo $urlweb; ?>/function/atur_pw.php" method="post" enctype="multipart/form-data" onsubmit="return validatePassword()">
                                        <!-- Input untuk Password Lama -->
                                        <?php                                                         
                                        $sql_1 = mysqli_query($conn, "SELECT * FROM `admin` WHERE id = 1");
                                        $s1 = mysqli_fetch_array($sql_1);
                                        $reset_pw = $s1['reset_pw'];
                                        ?>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="curr_pw">Password Lama</label>
                                          <input class="form-control" type="text" name="curr_pw" id="curr_pw" 
                                          placeholder="<?php echo $reset_pw; ?>" value="<?php echo $reset_pw; ?>" disabled>
                                        </div>

                                        <!-- Input untuk Password Baru -->
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="new_pw">Password Baru</label>
                                            <input class="form-control" type="text" name="new_pw" id="new_pw" placeholder="Masukkan password baru" required>
                                        </div>

                                        <!-- Input untuk Konfirmasi Password Baru -->
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="confirm_pw">Konfirmasi Password Baru</label>
                                            <input class="form-control" type="text" name="confirm_pw" id="confirm_pw" placeholder="Konfirmasi password baru" required>
                                        </div>

                                        <!-- Tombol Submit -->
                                        <div class="d-flex justify-content-between">
                                            <button type="submit" name="submit" class="btn btn-primary">Ubah Password</button>
                                            <a href="<?php echo $urlweb; ?>/admin_web.php" class="btn btn-light">Batal</a>
                                        </div>
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

            

            <script>
                // Validasi frontend: pastikan password baru dan konfirmasi cocok
                function validatePassword() {
                    const newPassword = document.getElementById('new_pw').value;
                    const confirmPassword = document.getElementById('confirm_pw').value;

                    if (newPassword !== confirmPassword) {
                        alert("Password baru dan konfirmasi password tidak cocok!");
                        return false;
                    }
                    return true;
                }
            </script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
            </script>

</body>

</html>