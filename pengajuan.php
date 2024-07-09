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
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <h2 class="form-header">Form Pengajuan PKL BPOM</h2>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukkan nama lengkap Anda" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-control" id="phone" placeholder="Masukkan nomor telepon Anda"
                        required>
                </div>
                <div class="mb-3">
                    <label for="university" class="form-label">Universitas</label>
                    <input type="text" class="form-control" id="university" placeholder="Masukkan nama universitas Anda"
                        required>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="department" placeholder="Masukkan jurusan Anda"
                        required>
                </div>
                <div class="mb-3">
                    <label for="document" class="form-label">Upload Dokumen</label>
                    <input class="form-control" type="file" id="document" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Kirim Pengajuan</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>