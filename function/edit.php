<?php
session_start();
include("koneksi.php");

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = intval($_POST['id']);
    $sql = "SELECT * FROM penempatan_pkl WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = intval($_POST['id']);
    $posisi = $conn->real_escape_string($_POST['posisi']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $jurusan = $conn->real_escape_string($_POST['jurusan']);
    $kuota = intval($_POST['kuota']);

    $sql = "UPDATE penempatan_pkl SET posisi='$posisi', deskripsi='$deskripsi', jurusan='$jurusan', kuota=$kuota WHERE
id=$id";
    if ($conn->query($sql) === TRUE) {
        header('Location: ' . $urlweb . '/admin_posisi.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


<?php
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']); // Menghindari XSS
    if ($_GET['status'] == 'success') {
        $alert = "<script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success', // Anda dapat mengubah menjadi 'error', 'warning', 'info', atau 'question'
                title: 'Pesan',
                text: '$message',
                showConfirmButton: false,
                timer: 3000 // Durasi notifikasi dalam milidetik
            });
        });
    </script>";
    } else {
        $alert = "<script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error', // Anda dapat mengubah menjadi 'error', 'warning', 'info', atau 'question'
                title: 'Pesan',
                text: '$message',
                showConfirmButton: false,
                timer: 3000 // Durasi notifikasi dalam milidetik
            });
        });
    </script>";
    }

    echo $alert;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-3 mb-5">
        <h2>Edit Data</h2>
        <form action="<?php echo $urlweb ?>/function/edit.php" method="post">

            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <div class="form-group">
                <label for="posisi">Posisi & Penempatan:</label>
                <input type="text" class="form-control" id="posisi" name="posisi" value="<?php echo $data['posisi']; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi"
                    required><?php echo $data['deskripsi']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="jurusan">Kualifikasi Jurusan:</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan"
                    value="<?php echo $data['jurusan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="kuota">Kuota:</label>
                <input type="number" class="form-control" id="kuota" name="kuota" value="<?php echo $data['kuota']; ?>"
                    required>
            </div>
            <button type="submit" name="action" value="update" class="btn btn-warning">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>