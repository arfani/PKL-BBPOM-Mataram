<?php
session_start();
include('koneksi.php'); // Pastikan sudah terhubung dengan database

// Cek apakah form sudah dikirim
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $question_text = $_POST['question_text'];
    $posisi = $_POST['posisi'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

    // Masukkan data ke database
    $sql = "INSERT INTO kuis (posisi, question_text, option_a, option_b, option_c, option_d, correct_option) VALUES (?,?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $posisi, $question_text, $option_a, $option_b, $option_c, $option_d, $correct_option);
    
    if (isset($stmt)) {
        $result = $stmt->execute();

        if ($result) {
            $message = "Soal Berhasil Ditambahkan.";
            $header = ("location : buat_soal.php");
        } else {
            $message = "Gagal Menambahkan Soal: " . $conn->error;
        }
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Soal Kuis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Soal Kuis</h2>
        <?php if ($message): ?>
        <script>
            Swal.fire({
                title: 'Informasi',
                text: '<?php echo $message; ?>',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        </script>
        <?php endif; ?>
        <form method="POST" action="">
        <div class="form-group">
                <label for="posisi">Posisi</label>
                <select name="posisi" id="posisi" class="form-control" required>
                    <?php $sql2 = "SELECT * FROM penempatan_pkl";
                    $result2 = mysqli_query($conn, $sql2);
                    $no = 1;
                    
                    // Menampilkan data absensi
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo "<option value='{$row2['posisi']}'>{$row2['posisi']}</option>";
                        $no++;
                    }
                    ?>
                    
                </select>
                
            </div>
            <div class="form-group">
                <label for="question_text">Pertanyaan</label>
                <textarea class="form-control" id="question_text" name="question_text" required></textarea>
            </div>
            <div class="form-group">
                <label for="option_a">Pilihan A</label>
                <input type="text" class="form-control" id="option_a" name="option_a" required>
            </div>
            <div class="form-group">
                <label for="option_b">Pilihan B</label>
                <input type="text" class="form-control" id="option_b" name="option_b" required>
            </div>
            <div class="form-group">
                <label for="option_c">Pilihan C</label>
                <input type="text" class="form-control" id="option_c" name="option_c" required>
            </div>
            <div class="form-group">
                <label for="option_d">Pilihan D</label>
                <input type="text" class="form-control" id="option_d" name="option_d" required>
            </div>
            <div class="form-group">
                <label for="correct_option">Jawaban Benar</label>
                <select class="form-control" id="correct_option" name="correct_option" required>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Tambah Soal</button>
        </form>
    </div>
</body>
</html>