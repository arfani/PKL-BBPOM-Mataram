<?php
require_once('koneksi.php');
$id = $_GET['id'];
$query = mysqli_query($conn, "DELETE FROM `tb_slide` WHERE id = '$id'");
header('location:../admin_web.php');