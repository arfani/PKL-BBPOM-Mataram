<?php
include 'koneksi.php';
error_reporting(0);
session_start();

if (isset($_SESSION['username'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM $role WHERE email='$email' OR no_hp='$no_hp'";
    $result = mysqli_query($conn, $sql);
    if (!$result->num_rows > 0) {
        $sql = "INSERT INTO $role (nama, email, no_hp, password)
                    VALUES ('$nama', '$email', '$no_hp', '$password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Wow! Pendaftaran Berhasil.')</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Woops! Ada Kesalahan.')</script>";
        }
    } else {
        echo "<script>alert('Woops! Email atau No hp Sudah Terdaftar.')</script>";
    }
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
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group select-container">
                <select name="role" required>
                    <option value="" disabled selected>Pilih Jenis Pendaftaran</option>
                    <option value="pkl">Pendaftar PKL</option>
                    <option value="tamu">Pengunjung</option>
                    <option value="narasumber">Narasumber</option>
                </select>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Sudah Memiliki Akun? <a href="login.php">Login Disini</a>.</p>
        </form>
    </div>
</body>

</html>