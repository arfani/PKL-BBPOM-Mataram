<?php
include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_GET['posisi'])) {
    $posisi = $_GET['posisi'];
} else {
    echo "Tidak ada posisi yang dipilih.";
}
$message = '';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/custom2.css">
</head>

<body>
<style>
    .question-list {
    margin: 20px 0;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
    }

    .question-item {
        margin-bottom: 15px;
        padding: 10px;
        border-bottom: 1px dashed #ccc;
    }

    .question-item:last-child {
        border-bottom: none;
    }

    .question-item h4 {
        font-size: 1.2em;
        color: #333;
    }

    .question-item ul {
        padding-left: 20px;
        list-style: disc;
    }

    .question-item ul li {
        margin-bottom: 5px;
    }

    .question-item p {
        font-weight: bold;
        color: #006400;
        margin-top: 10px;
    }
    </style>
    
    <?php include 'header_admin.php'; ?>

    <div class="container-fluid">
        <div class="row">
            
        <?php include('sidebar_admin.php'); ?>

        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-2">
                    <div class="text-center">
                        <h3 class="fw-bold">Soal Kuis Posisi <?php echo "$posisi"; ?></h3>
                    </div>
                    <div class="mb-3">
                        <a href="function/TambahSoalKuis.php" class="btn btn-success justify-content-start">Tambah Soal</a>
                        <button class="btn btn-danger" onclick="history.back()">Kembali</button>
                    </div>
                </div>
                <?php 
                
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
                    $delete_id = $_POST['delete_id'];
                
                    // Pastikan id tidak kosong dan valid
                    if (!empty($delete_id)) {
                        $delete_query = "DELETE FROM kuis WHERE id = ?";
                        $stmt = $conn->prepare($delete_query);
                        $stmt->bind_param('i', $delete_id);
                        
                        if ($stmt->execute()) {
                            $message = 'Soal Berhasil Dihapus';
                            echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Pesan',
                                        text: '$message',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                });
                            </script>";
                            $message = '';
                            
                        } else {
                            $message = 'Terjadi Kesalahan Saat Menghapus Data';
                            echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'danger',
                                        title: 'Pesan',
                                        text: '$message',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                });
                            </script>";
                            $message = '';
                            }
                        $stmt->close();
                    } else {
                        echo "<div class='alert alert-warning'>ID tidak valid.</div>";
                    }
                }
                    // Ambil 10 pertanyaan acak dari tabel `kuis`
                    $query = "SELECT * FROM kuis WHERE posisi = '$posisi'";
                    $result = $conn->query($query);
                    $no = 1;

                    if ($result->num_rows > 0) {
                        echo '<div class="question-list">';

                        while ($row3 = $result->fetch_assoc()) {
                            // Tombol hapus di sebelah kanan atas
                            echo "<form action='' method='POST' class='d-flex justify-content-end'>";
                            echo "<input type='hidden' name='delete_id' value='{$row3['id']}'>";
                            echo "<button type='submit' name='delete' class='btn btn-danger'>Hapus</button>";
                            echo "</form>";

                            echo "<div class='question-item'>";
                            echo "<h4>{$no}. {$row3['question_text']}</h4>";
                            if($row3['jenis_pertanyaan'] === 'pilihan_ganda'){

                                // Menampilkan semua opsi jawaban
                                echo "<ul>";
                                echo "<li>A. {$row3['option_a']}</li>";
                                echo "<li>B. {$row3['option_b']}</li>";
                                echo "<li>C. {$row3['option_c']}</li>";
                                echo "<li>D. {$row3['option_d']}</li>";
                                echo "</ul>";
                                
                                // Menampilkan jawaban yang benar
                                echo "<p><strong>Jawaban yang benar: </strong>{$row3['correct_option']}</p>";
                            }
                            echo "</div>";
                            $no++;
                            
                        }

                        echo '</div>';
                    } else {
                        echo "<p>No questions available.</p>";
                        $message = "Tidak Ada Pertanyaan Yang Dibuat";
                    }

                    $conn->close();
                    ?>


        </div>
    </body>
</html>
            