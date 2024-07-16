<?php
session_start();
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['profileName'];
    $email = $_POST['profileEmail'];
    $no_hp = $_POST['profilePhone'];
    $user_id = $_SESSION['id'];

    $sql = "UPDATE pkl SET nama='$nama', email='$email', no_hp='$no_hp' WHERE id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        $response = [
            'status' => 'success',
            'message' => 'Profil berhasil disimpan.'
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Gagal menyimpan profil: ' . $e->getMessage()
        ];
        echo json_encode($response);
    }

    mysqli_close($conn);
    header('Location: pkl.php');
}
