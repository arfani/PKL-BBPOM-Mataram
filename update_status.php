<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE pengajuan_pkl SET status='$status' WHERE id_pengajuan='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: admin_pkl.php');
}
