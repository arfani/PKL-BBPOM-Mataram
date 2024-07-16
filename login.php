<?php

include 'koneksi.php';
session_start();
error_reporting(0);


if (isset($_POST['submit'])) {
    $input = $_POST['email_nohp'];
    $password = ($_POST['password']);
    $role = $_POST['role'];
    if (strpos($input, '@') !== false) {
        $email = $input;
        $sql = "SELECT * FROM $role WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            header("Location: $role.php");
        } else {
            echo "<script>alert('Woops! Email Atau Password anda Salah.')</script>";
        }
    } else {
        $nohp = $input;
        $sql = "SELECT * FROM $role WHERE no_hp='$nohp' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            header("Location: $role.php");
        } else {
            echo "<script>alert('Woops! No Hp Atau Password anda Salah.')</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="Asset/CSS/style.css">
    <!-- logo web -->
    <link rel="icon" href="Aset/Gambar/logo.png" type="image/x-icon">
    <title>PKL-BBPOM-MATARAM</title>
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="text" placeholder="Email / No HP" name="email_nohp" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group select-container">
                <select name="role" required>
                    <option value="" disabled selected>Pilih Tipe Login</option>
                    <option value="pkl">Pendaftar PKL</option>
                    <option value="tamu">Pengunjung</option>
                    <option value="narasumber">Narasumber</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Belum Memilki akun? <a href="register.php">Daftar Disini</a>.</p>
        </form>
    </div>
</body>

</html>