<?php

include('koneksi.php');
session_start();
error_reporting(0);

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    header('location:' . $urlweb . '/' . $role . '.php');
}

if (isset($_POST['submit'])) {
    $input = $_POST['email_nohp'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Escape input untuk mencegah SQL Injection
    $input = mysqli_real_escape_string($conn, $input);

    // Cek apakah input adalah email atau nomor HP
    if (strpos($input, '@') !== false) {
        $field = 'email';
    } else {
        $field = 'no_hp';
    }

    // Tentukan tabel berdasarkan role
    $table = ($role === "admin") ? "admin" : "users";

    // Query untuk mengambil data berdasarkan email atau no_hp
    $sql = "SELECT * FROM $table WHERE $field = '$input'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password']; // Ambil hashed password dari database

        // Verifikasi password
        if (password_verify($password, $hashedPassword)) {
            // Login berhasil
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $role;

            // Redirect ke halaman berdasarkan role
            header("Location: $role.php");
            exit();
        } else {
            // Password salah
            echo "<script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Login Gagal',
                            text: 'Email dan Password Tidak Cocok',
                            showConfirmButton: true
                        });
                    });
                </script>";
        }
    } else {
        // Email atau nomor HP tidak ditemukan
        echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Login Gagal',
                        text: 'Email atau Nomor HP Tidak Ditemukan',
                        showConfirmButton: true
                    });
                });
            </script>";
    }
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
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="Asset/CSS/style.css">
    <!-- logo web -->
    <link rel="icon" href="Aset/Gambar/logo.png" type="image/x-icon">
    <title>PKL-BBPOM-MATARAM</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group" style="border-radius:20px">
                <input type="text" placeholder="Email / No HP" name="email_nohp" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" id="password"
                    value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="mb-2 ms-2">
                <input type="checkbox" id="showPassword"> <label for="showPassword">Lihat Password</label>
            </div>
            <div class="input-group select-container">
                <select name="role" required>
                    <option value="" disabled selected>Tujuan :</option>
                    <option value="pkl">PKL</option>
                    <option value="tamu">Permohonan Kunjungan atau Narasumber</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Belum Memilki akun? <a href="register.php">Daftar Disini</a>.</p>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#showPassword').change(function() {
            var passwordField = $('#password');
            var fieldType = passwordField.attr('type');
            if ($(this).is(':checked')) {
                passwordField.attr('type', 'text');
            } else {
                passwordField.attr('type', 'password');
            }
        });
    });
    </script>
    <?php require_once('cs.php'); ?>
</body>

</html>