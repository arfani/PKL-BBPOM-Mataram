<?php
session_start();
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = intval($_POST['id']);
    if ($_POST['action'] === 'delete') {
        $sql = "DELETE FROM penempatan_pkl WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            header('Location: admin.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
