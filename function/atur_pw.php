<?php
session_start();
include '../koneksi.php'; // Sesuaikan dengan path ke file koneksi Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $new_pw = $_POST['new_pw'];

    // Query update langsung tanpa bind parameter
    $sql = "UPDATE admin 
            SET reset_pw = '$new_pw'
            WHERE id = 1";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin_web.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
