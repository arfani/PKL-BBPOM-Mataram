<?php
include 'koneksi.php';
session_start(); // Pastikan sesi sudah dimulai

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id ='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    $nama = $row['nama'];
    $no_hp = $row['no_hp'];
    $universitas = $row['universitas'];
} else {
    // Jika tidak ada sesi aktif, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

$correct_answers = 0;

// Proses jawaban kuis yang dikirimkan
foreach ($_POST as $question_key => $selected_option) {
    // Hanya proses jika merupakan kunci soal
    if (strpos($question_key, 'question_') === 0) {
        $question_id = str_replace('question_', '', $question_key);
        
        // Ambil teks soal dari input tersembunyi
        $question_text_key = "question_text_$question_id";
        $question_text = isset($_POST[$question_text_key]) ? $_POST[$question_text_key] : '';
        
        // Ambil jenis pertanyaan dari input tersembunyi
        $jenis_pertanyaan_key = "jenis_pertanyaan_$question_id";
        $jenis_pertanyaan = isset($_POST[$jenis_pertanyaan_key]) ? $_POST[$jenis_pertanyaan_key] : '';
        
        if($jenis_pertanyaan = 'pilihan_ganda'){
            // Ambil jawaban benar dari tabel `kuis`
            $query = "SELECT correct_option FROM kuis WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $question_id);
            $stmt->execute();
            $stmt->bind_result($correct_option);
            $stmt->fetch();
            $stmt->close();

            // Tentukan apakah jawaban benar
            $is_correct = ($selected_option === $correct_option) ? 1 : 0;
            if ($is_correct) {
                $correct_answers++;
            }

            // Cek apakah jawaban untuk pertanyaan ini sudah ada di `hasil_kuis` untuk user ini
            $checkQuery = "SELECT id FROM hasil_kuis WHERE nama = ? AND question_text = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param("ss", $nama, $question_text);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows === 0) {
                // Jika belum ada, masukkan jawaban ke database
                $insertQuery = "INSERT INTO hasil_kuis (nama, jenis_pertanyaan, question_text, selected_option, is_correct) VALUES (?, ?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bind_param("ssssi", $nama, $jenis_pertanyaan, $question_text, $selected_option, $is_correct);
                $insertStmt->execute();
                $insertStmt->close();
            }
        } else {
            $insertQuery = "INSERT INTO hasil_kuis (nama, jenis_pertanyaan, question_text) VALUES ( ?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bind_param("ssssi", $nama, $jenis_pertanyaan, $question_text);
                $insertStmt->execute();
                $insertStmt->close();
        }

        $checkStmt->close();
    }
}

// Setelah penyimpanan selesai, arahkan ke halaman pkl.php
$conn->close();
header("Location: ../pkl.php");
exit();
?>