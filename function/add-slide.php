<?php
require_once('koneksi.php');


$deskripsi = $_POST['deskripsi'];
$sort = $_POST['sort'];
$catID = $_POST['postID'];
$status = $_POST['status'];
$join_date = date('Y-m-d');
$kode = date('YmdHis');
$tipe_gambar = array('image/jpg', 'image/jpeg', 'image/bmp', 'image/x-png', 'image/png', 'image/gif');
$gbr = $_FILES['image']['name'];
$ukuran = $_FILES['image']['size'];
$tipe = $_FILES['image']['type'];
$error = $_FILES['image']['error'];
$explode = explode('.', $gbr);
$extensi  = $explode[count($explode) - 1];
$newname = 'slide_' . $kode . '.' . $extensi;
$upload_dir = "../Asset/Gambar/";
if ($catID == '') {
    if ($_FILES['image']['size'] <= 2048000) {
        if ($gbr !== "" && $error == 0) {
            if (in_array(strtolower($tipe), $tipe_gambar)) {
                move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                $query = mysqli_query($conn, "INSERT INTO `tb_slide` (`image`, `deskripsi`, `sort`, `user`, `status`) VALUES ('$newname', '$deskripsi', '$sort', '$users', '$status')") or die(mysqli_error($conn));
                header('location:../admin_web.php?notif=1');
            } else {
                header('location:../admin_web.php?notif=3');
            }
        } else {
            header('location:../admin_web.php?notif=4');
        }
    } else if ($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0) {
        header('location:../admin_web.php?notif=2');
    }
} else {
    if ($_FILES['image']['size'] <= 2048000) {
        if ($gbr !== "" && $error == 0) {
            if (in_array(strtolower($tipe), $tipe_gambar)) {
                move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                $query = mysqli_query($conn, "UPDATE `tb_slide` SET `image` = '$newname', `deskripsi` = '$deskripsi', `sort` = '$sort' WHERE id = '$catID'");
                header('location:../admin_web.php?catID=' . $catID . '&notif=1');
            } else {
                header('location:../admin_web.php?catID=' . $catID . '&notif=3');
            }
        } else {
            $query = mysqli_query($conn, "UPDATE `tb_slide` SET `deskripsi` = '$deskripsi', `sort` = '$sort' WHERE id = '$catID'");
            header('location:../admin_web.php?catID=' . $catID . '&notif=1');
        }
    } else if ($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0) {
        header('location:../admin_web.php?catID=' . $catID . '&notif=2');
    }
}
