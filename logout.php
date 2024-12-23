<?php
include('koneksi.php');
session_start();

// Kosongkan semua variabel sesi
$_SESSION = [];

// Hapus cookie sesi jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan sesi
session_destroy();

// Ambil URL tujuan dari database

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
mysqli_close($conn);

// Validasi URL tujuan
if (!filter_var($urlweb, FILTER_VALIDATE_URL)) {
    die("URL tidak valid.");
}

// Arahkan ulang ke halaman utama
header("Location: " . $urlweb);
exit;
?>
