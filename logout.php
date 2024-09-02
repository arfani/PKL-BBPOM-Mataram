<?php
include('koneksi.php');
session_start();
session_destroy();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

header("Location: " . $urlweb);
