<?php 
include('koneksi.php');

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];


if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Menginisialisasi variabel dari tabel users dengan nilai default jika tidak ada data
    $email = $row['email'] ?? '';
    $nama = $row['nama'] ?? '';
    $no_hp = $row['no_hp'] ?? '';
    $status = $row['status'] ?? '';
    $foto = $row['foto'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan PKL BPOM</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

    
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px"
                    style="margin-left: 15px; margin-right: 10px">
                <b>BBPOM MATARAM</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
        </div>
    </nav>
    <button type="button" class="btn btn-primary mt-4 ms-4" style="box-shadow: 0 3px 3px black;" onclick="history.back()">Kembali</button>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-9 col-md-6 col-lg-4">
                <div class="card">
                    <div class="container mt-2 mb-2">
                        <h2 class="text-center mb-4">Reset Password</h2>
                        
                        <!-- Search Form -->
                        <form method="POST" action="function/update_password.php" class="d-flex flex-column">
                            <input type="hidden" name="id" value="<?php $id; ?>">
                            <div class="form-group mb-3">
                                <label for="password">Password Baru</label>
                                <div class="input-group">
                                    <input id="password" class="form-control" type="password" name="password" placeholder="Password Baru">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('password', 'toggleIcon1')">
                                        <i id="toggleIcon1" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="confirm_password">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input id="confirm_password" class="form-control" type="password" name="konfirmasi_password" placeholder="Konfirmasi Password">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('confirm_password', 'toggleIcon2')">
                                        <i id="toggleIcon2" class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Simpan Password</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function togglePasswordVisibility(inputId, iconId) {
        const passwordField = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.add("fa-eye");       // Hapus ikon outline
            toggleIcon.classList.remove("fa-eye-slash");   // Tambahkan ikon solid
        } else {
            passwordField.type = "password";
            toggleIcon.classList.add("fa-eye-slash"); // Hapus ikon solid
            toggleIcon.classList.remove("fa-eye");          // Tambahkan ikon outline
        }
    }
</script>

</body>
</html>