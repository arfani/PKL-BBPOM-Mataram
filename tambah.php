<?php
session_start();
include('koneksi.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $posisi = $conn->real_escape_string($_POST['posisi']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $jurusan = $conn->real_escape_string($_POST['jurusan']);
    $kuota = intval($_POST['kuota']);

    $sql = "INSERT INTO penempatan_pkl (posisi, deskripsi, jurusan, kuota) VALUES ('$posisi', '$deskripsi', '$jurusan', $kuota)";
    if ($conn->query($sql) === TRUE) {
        header('Location: admin.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-3 mb-5">
        <h2>Tambah Data</h2>

        <form action="tambah.php" method="post">

            <div class="form-group">
                <label for="posisi">Posisi & Penempatan:</label>
                <input type="text" class="form-control" id="posisi" name="posisi" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="jurusan">Kualifikasi Jurusan:</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" required>
            </div>
            <div class="form-group">
                <label for="kuota">Kuota:</label>
                <input type="number" class="form-control" id="kuota" name="kuota" required>
            </div>
            <button type="submit" class="btn btn-success">Tambah</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>