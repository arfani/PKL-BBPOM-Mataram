<?php
require_once('koneksi.php');
$id = $_GET['postID'];
$status = $_GET['status'];
if ($status == 0) {
	$statusnya = 1;
} else if ($status == 1) {
	$statusnya = 0;
}
$query = mysqli_query($conn, "UPDATE `tb_slide` SET status = '$statusnya' WHERE id = '$id'");
header('location:../admin_web.php');
