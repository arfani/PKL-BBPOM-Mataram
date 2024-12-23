<?php
include('koneksi.php');
session_start();
$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role != "admin") {
        header('location:' . $urlweb . '/' . $role . '.php');
    }
} else {
    header("Location: " . $urlweb);
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT * FROM penempatan_pkl WHERE 
        posisi LIKE '%$search%' OR 
        deskripsi LIKE '%$search%' OR 
        jurusan LIKE '%$search%' OR 
        kuota LIKE '%$search%'";

$result = mysqli_query($conn, $sql);
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
        .card{
            cursor:default;
        }
        
        /* Hover style untuk memperbesar dan mengubah warna */
        .card:hover {
        background-color: #007bff; /* warna biru */
        transform: scale(1.05); /* memperbesar */
        color: #fff; /* Ubah teks menjadi putih */
        }
            
        .card-wrapper {
            display: flex;
            flex-wrap: wrap; /* Elemen akan turun ke baris baru jika melebihi batas */
            gap: 1rem; /* Jarak antar elemen */
        }

        .card {
            flex: 0 0 calc(33.333% - 1rem); /* 33.333% untuk memastikan 3 elemen per baris */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border: 1px solid #ddd;
            padding: 1rem;
            text-align: center;
        }
                    
        /* Style untuk kartu yang tetap aktif setelah diklik */
        .card.active {
        background-color: #007bff; /* warna biru */
        transform: scale(1.15); /* memperbesar */
        color: #fff; /* Ubah teks menjadi putih */
        }

        .card h2 {
        font-size: 2.5rem;
        margin: 0;
        color: inherit; /* Agar warna h2 berubah sesuai konteks */
        }

        .card .card-icon {
        font-size: 3rem;
        color: inherit; /* Agar warna ikon berubah sesuai konteks */
        }


        .card .card-icon {
        font-size: 3rem;
        color: #777;
        }
        .cards {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        }
    </style>
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
        color: black;
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
                        <h3 class="fw-bold">Data Penempatan PKL</h3>
                    </div>
                    <div class="d-flex justify-content-start mb-3">
                        <a href="function/TambahSoalKuis.php" class="btn btn-success">Tambah Soal</a>
                        <button class="btn btn-danger" onclick="history.back()" style="margin-left:1%">Kembali</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table" style="background-color: skyblue;">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Universitas</th>
                                    <th>Posisi</th>
                                    <th>Jumlah Benar</th>
                                    <th>Score</th>
                                    <th>Lihat Jawaban Uraian</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
$sql2 = "
    SELECT pengajuan_pkl.*, users.universitas 
    FROM pengajuan_pkl 
    LEFT JOIN users 
    ON pengajuan_pkl.nama = users.nama
    WHERE pengajuan_pkl.status = 'Pending' OR pengajuan_pkl.status = 'Diterima'
";
$result2 = mysqli_query($conn, $sql2);
$no = 1;

while ($row2 = mysqli_fetch_assoc($result2)) {
    $nilai = 0;
    $sql = "SELECT COUNT(*) as jumlah FROM hasil_kuis WHERE nama = '{$row2['nama']}' AND is_correct = 1";
    $result = mysqli_query($conn, $sql);
    $nilai = mysqli_fetch_assoc($result)['jumlah'] ?? 0;

    // Buat ID modal unik berdasarkan nama dan nomor urut
    $modal_ganda_id = "modal_ganda_" . $no;
    $modal_uraian_id = "modal_uraian_" . $no;

    echo "<tr>";
    echo "<td>{$no}</td>";
    echo "<td>{$row2['nama']}</td>";
    echo "<td>{$row2['universitas']}</td>";
    echo "<td>{$row2['posisi']}</td>";
    echo "<td>{$nilai}</td>";
    echo "<td>-</td>";
    echo "<td><button class='btn btn-secondary btn-sm' data-bs-toggle='modal' data-bs-target='#{$modal_uraian_id}'>Lihat</button></td>";
    echo "<td>
            <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#{$modal_ganda_id}'>Lihat Detail</button>
            
          </td>";
    echo "</tr>";
?>
<!-- Modal untuk Hasil Pilihan Ganda -->
<div class="modal fade" id="<?php echo $modal_ganda_id; ?>" tabindex="-1" aria-labelledby="modalLabel_<?php echo $modal_ganda_id; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel_<?php echo $modal_ganda_id; ?>">Hasil Pilihan Ganda: <?php echo $row2['nama']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // Ambil hasil jawaban pilihan ganda
                $query = "SELECT hk.question_text, hk.selected_option, k.correct_option, k.option_a, k.option_b, k.option_c, k.option_d 
                          FROM hasil_kuis hk
                          INNER JOIN kuis k ON hk.question_text = k.question_text
                          WHERE hk.nama = '{$row2['nama']}' AND k.jenis_pertanyaan = 'pilihan_ganda'";
                $result3 = $conn->query($query);
                $no_question = 1;

                if ($result3->num_rows > 0) {
                    echo '<div class="question-list">';

                    while ($row3 = $result3->fetch_assoc()) {
                        $color_class = $row3['selected_option'] === $row3['correct_option'] ? 'text-success' : 'text-danger';
                        echo "<div class='question-item'>";
                        echo "<h4>{$no_question}. {$row3['question_text']}</h4>";

                        // Menampilkan semua opsi jawaban
                        echo "<ul>";
                        echo "<li>A. {$row3['option_a']}</li>";
                        echo "<li>B. {$row3['option_b']}</li>";
                        echo "<li>C. {$row3['option_c']}</li>";
                        echo "<li>D. {$row3['option_d']}</li>";
                        echo "</ul>";

                        // Menampilkan jawaban pengguna dan jawaban yang benar
                        echo "<p>Jawaban Anda: <strong><span class='{$color_class}'>{$row3['selected_option']}</span></strong></p>";
                        echo "<p>Jawaban Benar: <strong><span class='text-success'>{$row3['correct_option']}</span></strong></p>";
                        echo "</div>";
                        $no_question++;
                    }

                    echo '</div>';
                } else {
                    echo "<h1 class='text-center'>Tidak Ada Jawaban Pilihan Ganda</h1>";
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Hasil Uraian -->
<div class="modal fade" id="<?php echo $modal_uraian_id; ?>" tabindex="-1" aria-labelledby="modalLabel_<?php echo $modal_uraian_id; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel_<?php echo $modal_uraian_id; ?>">Hasil Uraian: <?php echo $row2['nama']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                // Ambil hasil jawaban uraian
                $query = "SELECT hk.question_text, hk.selected_option 
                          FROM hasil_kuis hk
                          INNER JOIN kuis k ON hk.question_text = k.question_text
                          WHERE hk.nama = '{$row2['nama']}' AND k.jenis_pertanyaan = 'uraian'";
                $result4 = $conn->query($query);
                $no_question = 1;

                if ($result4->num_rows > 0) {
                    echo '<div class="question-list">';

                    while ($row4 = $result4->fetch_assoc()) {
                        echo "<div class='question-item'>";
                        echo "<h4>{$no_question}. {$row4['question_text']}</h4>";
                        echo "<p><strong>Jawaban Anda:</strong> {$row4['selected_option']}</p>";
                        echo "</div>";
                        $no_question++;
                    }

                    echo '</div>';
                } else {
                    echo "<h1 class='text-center'>Tidak Ada Jawaban Uraian</h1>";
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php
    $no++;
}
?>

                            </tbody>

                        </table>
                    </div>
                    
                </div>
            </div>
        </div>        
    </div>
        <script>
            $(document).ready(function() {
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('searchInput');
                    const searchForm = document.getElementById('searchForm');

                    searchInput.addEventListener('input', function() {
                        searchForm.submit(); // Kirim form secara otomatis saat input berubah
                    });
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script>
            // Fungsi untuk navigasi ke halaman baru dengan parameter posisi
            function goToPage(posisi) {
                // Navigasi ke page tujuan dengan query parameter
                window.location.href = `admin_pkl_kuis_soal.php?posisi=${encodeURIComponent(posisi)}`;
            }
        </script>

</body>

</html>