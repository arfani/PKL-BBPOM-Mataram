<?php
require_once('koneksi.php');


$deskripsi = $_POST['deskripsi'];
$nama = $_POST['nama2'];
$posID = $_POST['posID'];

$tipe_gambar = array('image/jpg', 'image/jpeg', 'image/bmp', 'image/x-png', 'image/png', 'image/gif');
$ukuran = $_FILES['image']['size'];
$tipe = $_FILES['image']['type'];
$error = $_FILES['image']['error'];
$gbr = $_FILES['image']['name'];
$explode = explode('.', $gbr);
$extensi  = $explode[count($explode) - 1];
$newname = 'image_' . $nama . '.' . $extensi;
$upload_dir = "../Asset/Gambar/";

if ($_FILES['image']['size'] <= 5120000) {
    if ($gbr !== "" && $error == 0) {
        if (in_array(strtolower($tipe), $tipe_gambar)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
            $query = mysqli_query($conn, "UPDATE `penempatan_pkl` SET `gambar` = '$newname', `deskripsi` = '$deskripsi' WHERE id = '$posID'");
            header('location:../admin_web.php?id=' . $posID . '&notif2=1');
        } else {
            header('location:../admin_web.php?id=' . $posID . '&notif2=3');
        }
    } else {
        $query = mysqli_query($conn, "UPDATE `tb_slide` SET `deskripsi` = '$deskripsi' WHERE id = '$posID'");
        header('location:../admin_web.php?id=' . $posID . '&notif=1');
    }
} else if ($_FILES['image']['size'] >= 5120000 || $_FILES['image']['size'] == 0) {
    header('location:../admin_web.php?id=' . $posID . '&notif2=2');
}