<?php
session_start();
require('koneksi.php'); // File koneksi database


// Periksa apakah user sudah login dan nilai nama dikirimkan
$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];


// Ambil nama dari POST
$userName = $_POST['nama'];
echo "$userName"
?>
