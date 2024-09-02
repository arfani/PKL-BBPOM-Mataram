<?php
include('koneksi.php');
error_reporting(0);
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    header('location:' . $urlweb . '/' . $role . '.php');
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' OR no_hp='$no_hp'";
    $result = mysqli_query($conn, $sql);

    if (!$result->num_rows > 0) {
        $sql = "INSERT INTO users (nama, email, no_hp, password, foto)
                    VALUES ('$nama', '$email', '$no_hp', '$password', 'Asset/Gambar/profile.png')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('Wow! Pendaftaran Berhasil.')</script>";
            echo "<script>window.location.href = '$urlweb/login.php';</script>";
        } else {
            echo "<script>alert('Woops! Ada Kesalahan.')</script>";
        }
    } else {
        echo "<script>alert('Woops! Email atau No hp Sudah Terdaftar.')</script>";
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="Asset/CSS/style.css">
    <title>Register Form</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Pendaftaran Akun</p>
            <div class="input-group">
                <input type="text" placeholder="Nama Lengkap" name="nama" value="<?php echo $nama; ?>" required>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="No Handphone" name="no_hp" value="<?php echo $no_hp; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>"
                    required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Sudah Memiliki Akun? <a href="login.php">Login Disini</a>.</p>
        </form>
    </div>

    <?php require_once('cs.php'); ?>
</body>

</html>