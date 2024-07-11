<?php
include 'koneksi.php';
session_start();
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM pkl where email ='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama'];
    $no_hp = $row['no_hp'];
}

if (isset($_POST['kirim'])) {
    $university = $_POST['university'];
    $department = $_POST['department'];
    $posisi = implode(', ', $_POST['posisi']);
    $periode = $_POST['periode'] . ' ' . $_POST['satuan'];
    $surat = $_FILES['surat']['name'];
    $sumber_surat = $_FILES['surat']['tmp_name'];
    $proposal = $_FILES['proposal']['name'];
    $sumber_proposal = $_FILES['proposal']['tmp_name'];
    $folder = './Asset/Document/';
    $surat_path = $folder . $surat;
    $proposal_path = $folder . $proposal;
    move_uploaded_file($sumber_surat, $folder . $surat);
    move_uploaded_file($sumber_proposal, $folder . $proposal);
    $insert = mysqli_query($conn, "INSERT INTO pengajuan_pkl (nama, email, phone, university, department, posisi, periode, surat, proposal) VALUES ('$nama', '$email', '$no_hp', '$university', '$department', '$posisi', '$periode', '$surat_path', '$proposal_path')");
    if ($insert) {
        header("Location: pkl.php");
        exit();
    } else {
        echo "Gagal memasukkan data, silakan cek kembali.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengajuan PKL BPOM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group input {
            flex: 1;
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="formn-container">
            <h2 class="form-header">Form Pengajuan PKL BPOM</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $nama ?>" placeholder="<?php echo $nama ?>" disabled>
                </div>
                <div class=" mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="<?php echo $email; ?>" value="<?php echo $email; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="<?php echo $no_hp; ?>" value="<?php echo $no_hp; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="university" class="form-label">Universitas</label>
                    <input type="text" class="form-control" id="university" name="university" placeholder="Masukkan nama universitas Anda" required>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="department" name="department" placeholder="Masukkan jurusan Anda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Posisi Penempatan : </label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="posisi[]" value="Kimia Obat" id="kimiaObat">
                        <label class="form-check-label" for="kimiaObat">Kimia Obat</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="posisi[]" value="Kimia Kosmetik" id="kimiaKosmetik">
                        <label class="form-check-label" for="kimiaKosmetik">Kimia Kosmetik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="posisi[]" value="Kimia OTSK" id="kimiaOTSK">
                        <label class="form-check-label" for="kimiaOTSK">Kimia OTSK</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="posisi[]" value="Kimia Pangan" id="kimiaPangan">
                        <label class="form-check-label" for="kimiaPangan">Kimia Pangan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="posisi[]" value="Mikrobiologi" id="mikrobiologi">
                        <label class="form-check-label" for="mikrobiologi">Mikrobiologi</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="periode" class="form-label">Rencana Priode PKL</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="periode" name="periode" placeholder="Masukkan periode" required>
                        <select name="satuan" id="satuan" class="form-control" required>
                            <option value="Minggu">Mingguan</option>
                            <option value="Bulan">Bulanan</option>
                            <option value="Tahun">Tahunan</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="surat" class="form-label">Upload Surat Pengajuan Dari Kampus</label>
                    <input class="form-control" type="file" id="surat" name="surat" required>
                </div>
                <div class="mb-3">
                    <label for="proposal" class="form-label">Upload Proposal</label>
                    <input class="form-control" type="file" id="proposal" name="proposal" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="kirim">Kirim Pengajuan</button>


            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>