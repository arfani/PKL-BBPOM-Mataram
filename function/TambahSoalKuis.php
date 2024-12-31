<?php
session_start();
include('../koneksi.php'); // Pastikan sudah terhubung dengan database

$message = '';
// Cek apakah form sudah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $question_text = $_POST['question_text'];
    $posisi = $_POST['posisi'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];
    $jenis_pertanyaan = $_POST['jenis_pertanyaan']; 

    if($jenis_pertanyaan == 'uraian'){
        
    $sql = "INSERT INTO kuis (question_text, posisi,  jenis_pertanyaan) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $question_text, $posisi,  $jenis_pertanyaan);
    } else{
    // Masukkan data ke database
    $sql = "INSERT INTO kuis (question_text, posisi, option_a, option_b, option_c, option_d, correct_option, jenis_pertanyaan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $question_text, $posisi, $option_a, $option_b, $option_c, $option_d, $correct_option, $jenis_pertanyaan);
    }
    if ($stmt->execute()) {
        $message = 'Soal Berhasil Ditambahkan';
    } else {
        $message = 'Gagal menambahkan soal. Silakan coba lagi.';
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
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
    <div class="container mt-1">
        <h1 class="mb-4 text-center">Tambah Soal Kuis</h1>
        <button class="btn btn-danger" onclick="history.back()">Kembali</button>
        <form method="POST" action="">
            <!-- Pertanyaan -->
            <div class="form-group">
                <label for="question_text"><strong>Pertanyaan</strong></label>
                <textarea class="form-control" id="question_text" name="question_text" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="posisi">Posisi</label>
                <select class="form-control" id="posisi" name="posisi">
                    <?php
                    // Koneksi ke database

                    
                    // Query untuk mengambil semua posisi dari tabel `penempatan_pkl`
                    $query = "SELECT DISTINCT posisi FROM penempatan_pkl";
                    $result = $conn->query($query);
                    
                    // Periksa apakah ada data di tabel
                    if ($result->num_rows > 0) {
                        // Loop untuk menampilkan setiap posisi sebagai opsi dropdown
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['posisi']}'>{$row['posisi']}</option>";
                        }
                    } else {
                        // Jika tidak ada data, tambahkan opsi default
                        echo "<option value=''>Tidak Ada Posisi</option>";
                    }

                    // Tutup koneksi database
                    $conn->close();
                    ?>
                </select>
            </div>

            <!-- Pilih Tipe Soal -->
            <div class="form-group">
                <label for="jenis_pertanyaan">Tipe Soal</label>
                <select class="form-control" id="jenis_pertanyaan" name="jenis_pertanyaan" onchange="toggleQuestionType()" required>
                    <option value="pilihan_ganda">Pilihan Ganda</option>
                    <option value="uraian">Uraian</option>
                </select>
            </div>


            <!-- Pilihan Jawaban -->
            <div id="multiple_choice_options">
                <div class="form-group">
                    <label for="option_a">Pilihan A</label>
                    <input type="text" class="form-control" id="option_a" name="option_a">
                </div>
                <div class="form-group">
                    <label for="option_b">Pilihan B</label>
                    <input type="text" class="form-control" id="option_b" name="option_b">
                </div>
                <div class="form-group">
                    <label for="option_c">Pilihan C</label>
                    <input type="text" class="form-control" id="option_c" name="option_c">
                </div>
                <div class="form-group">
                    <label for="option_d">Pilihan D</label>
                    <input type="text" class="form-control" id="option_d" name="option_d">
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
            </div>

            <!-- Jawaban Uraian -->
            

            <button type="submit" class="btn btn-primary">Tambah Soal</button>
        </form>
    </div>
    <script>
        function toggleQuestionType() {
            const questionType = document.getElementById("jenis_pertanyaan").value;
            const multipleChoiceOptions = document.getElementById("multiple_choice_options");
            const essayAnswerOption = document.getElementById("essay_answer_option");

            if (questionType === "pilihan_ganda") {
                // Tampilkan opsi pilihan ganda, sembunyikan opsi uraian
                multipleChoiceOptions.style.display = "block";
                essayAnswerOption.style.display = "none";
            } else if (questionType === "uraian") {
                // Tampilkan opsi uraian, sembunyikan opsi pilihan ganda
                multipleChoiceOptions.style.display = "none";
                essayAnswerOption.style.display = "block";
            }
        }

        // Set default state
        toggleQuestionType();
    </script>
</body>
</html>
