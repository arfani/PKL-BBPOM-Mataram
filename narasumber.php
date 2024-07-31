<?php
include 'koneksi.php';
session_start();

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    if ($id <= 100) {
        header('location: admin.php');
    } else if ($id > 100 && $id <= 300) {
        header('location: pkl.php');
    } else if ($id > 300 && $id <= 600) {
        header('location: tamu.php');
    }
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM pkl where id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $nama = $row['nama'];
    $no_hp = $row['no_hp'];
} else {

    $email = "";
    $nama = "";
    $no_hp = "";
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Narasumber</title>
</head>

<body>
    <h1>Tampilan Narasumber</h1>
</body>

</html>