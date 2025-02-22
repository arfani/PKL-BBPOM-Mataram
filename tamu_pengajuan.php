<?php
include('koneksi.php');


$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

if (isset($_POST['kirim'])) {
    $nama = $_POST['name'];
    $no_hp = $_POST['phone'];
    $instansi = $_POST['instansi'];
    $keperluan = $_POST['keperluan'];
    $jml_peserta = $_POST['jumlah_peserta'];
    $sgm_peserta = $_POST['segmen_peserta'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $surat = $_FILES['surat_masuk']['name'];
    $sumber_surat = $_FILES['surat_masuk']['tmp_name'];
    $folder = './Asset/Document/';
    $surat_nama = 'surat_pengajuan_kunjungan+' . $nama . '.pdf';
    $processedFileName = str_replace(' ', '+', $surat_nama);
    $surat_path = $folder . $processedFileName;

    if (!file_exists($surat_path)) {
        move_uploaded_file($sumber_surat, $surat_path);
    }

    $insert = mysqli_query($conn, "INSERT INTO kunjungan (nama,  
        no_hp,  keperluan, instansi, jumlah_peserta, segmen_peserta, tanggal, jam, surat_masuk) 
        VALUES ('$nama',  '$no_hp', '$keperluan', '$instansi', '$jml_peserta', '$sgm_peserta', 
        '$tanggal', '$jam', '$surat_path')");
    if ($insert) {
        if ($keperluan == 'Kunjungan') {
            $angka_unik = '1';
        } else if ($keperluan == 'Narasumber') {
            $angka_unik = '2';
        } else {
            $angka_unik = '3';
        }
        $last_id = mysqli_insert_id($conn);
    
        $last_id = str_pad($last_id, 3, '0', STR_PAD_LEFT);
    
        $digit_hp = substr($no_hp, 4, 3);
    
        $day = date('d', strtotime($tanggal));
    
        $kode_unik = $last_id . $digit_hp . $day . $angka_unik;
    
        $update = mysqli_query($conn, "UPDATE kunjungan SET kode_unik = '$kode_unik' WHERE id = '$last_id'");
    
        if ($update) {
            header("Location: landing_page.php?kode_unik=$kode_unik&jenis=kunjungan");
            exit;
        } else {
            echo "<script>alert('Gagal memperbarui kode unik.');</script>";
        }
        $text = 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin';

    } else {
        echo "Gagal memasukkan data, silakan cek kembali.";
    }
}
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
    <title>Form Pengajuan PKL BPOM</title>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px"
                    style="margin-left: 15px; margin-right: 10px">
                <b>BBPOM MATARAM</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
        </div>
    </nav>

    <button type="button" class="btn btn-primary mt-4 ms-4" style="box-shadow: 0 3px 3px black;" onclick="history.back()">Kembali</button>
    <div class="container mb-3">
        <div class="form-container">
            <h2 class="form-header text-center">Form Pengajuan Kunjungan / Narasumber BBPOM</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap :</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon :</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nomor Whatsapp"
                        required>
                </div>
                <div class="mb-3">
                    <label for="keperluan" class="form-label">Keperluan:</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="keperluan" id="keperluan-kunjungan" value="Kunjungan" required>
                            <label class="form-check-label" for="keperluan-kunjungan">
                                Kunjungan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="keperluan" id="keperluan-narasumber" value="Narasumber">
                            <label class="form-check-label" for="keperluan-narasumber">
                                Narasumber
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="keperluan" id="keperluan-lainnya" value="Lainnya">
                            <label class="form-check-label" for="keperluan-lainnya">
                                Lainnya
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="instansi" class="form-label">Instansi :</label>
                    <input type="text" class="form-control" id="instansi" name="instansi"
                        placeholder="Masukkan Nama Instansi Anda" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_peserta" class="form-label">Jumlah Peserta :</label>
                    <input type="text" class="form-control" id="jumlah_peserta" name="jumlah_peserta"
                        placeholder="Angka Saja" required>
                </div>
                <div class="mb-3">
                    <label for="nim" class="form-label">Segmen Peserta :</label>
                    <input type="text" class="form-control" id="segmen_peserta" name="segmen_peserta"
                        placeholder="Segmen Peserta Anda" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal">Tanggal Rencana Kunjungan :</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal"  required>
                </div>
                <div class="mb-3">
                    <label for="tanggal">Masukkan Waktu Mulai Kunjungan :</label>
                    <input type="time" class="form-control" id="jam" name="jam"  required>
                </div> 
                <div class="mb-3">
                    <label for="surat" class="form-label">Upload Surat Kunjungan (.pdf) :</label>
                    <input class="form-control" type="file" id="surat_masuk" name="surat_masuk" required>
                </div>
                <button type="submit" class="btn btn-primary w-25" name="kirim">Kirim Permohonan</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php require_once('cs.php'); ?>

</body>

</html>