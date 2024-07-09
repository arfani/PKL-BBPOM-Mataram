<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/custom.css">
    <title>pkl</title>
</head>

<body>
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="hero-title">Selamat datang di Portal Sistem Informasi Pengajuan PKL</h1>
                    <p class="hero-description">Balai Besar Pengawas Obat dan Makanan di Mataram</p>
                    <a href="pengajuan.php" class="btn btn-warning btn-cta">Ajukan ➔</a>
                </div>
                <div class="col-md-6">
                    <img src="Asset/Gambar/logo.png" alt="Hero Image" class="img-fluid" height="290px" width="290px">
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <h1 class="section-title">Dokumentasi</h1>
    </div>
    <div class="carousel-section mt-5">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <center>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="Asset/Gambar/beritaBalai-Besar-POM-di-Mataram-1719968430296.jpg" class="d-block" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="Asset/Gambar/beritaBalai-Besar-POM-di-Mataram-1720056460677.jpg" class="d-block" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="Asset/Gambar/beritaBalai-Besar-POM-di-Mataram-1720316256893.jpg" class="d-block" alt="...">
                        </div>
                    </div>
                </center>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="text-center mt-3">
        <h2 class="section-title">Posisi PKL Yang Tersedia</h2>
    </div>
    <div class="container mt-3 mb-5">
        <table class="table table-bordered table-striped table-hover text-center">
            <thead class="table-dark" style="vertical-align: middle;">
                <tr>
                    <th>#</th>
                    <th>Posisi & Penempatan</th>
                    <th>Deskripsi</th>
                    <th>Kualifikasi Jurusan</th>
                    <th>Periode PKL</th>
                    <th>Deadline Apply</th>
                    <th>Kuota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Kimia Obat</td>
                    <td>Membantu Pekerjaan di Lab Kimia Obat</td>
                    <td>Farmasi, Analis Farmasi, Kimia, Analis Kimia, Teknologi Kosmetik, SMK Analis Kimia, SMK Analis
                        Farmasi
                    </td>
                    <td>01 Aug 2024 - 31 Aug 2024</td>
                    <td>28 Jul 2024</td>
                    <td>2</td>
                    <td><button><a href="pengajuan.php">Apply</a></button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Kimia Kosmetik</td>
                    <td>Membantu Pekerjaan dibagian Lab Kimia Kosmetik</td>
                    <td>Farmasi, Analis Farmasi, Kimia, Analis Kimia, Teknologi Kosmetik, SMK Analis Kimia, SMK
                        Analis
                        Farmasi
                    </td>
                    <td>01 Aug 2024 - 31 Aug 2024</td>
                    <td>28 Jul 2024</td>
                    <td>2</td>
                    <td><button><a href="pengajuan.php">Apply</a></button></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Kimia OTSK</td>
                    <td>Membantu Pekerjaan di Lab Kimis OTSK</td>
                    <td>Farmasi, Analis Farmasi, Kimia, Analis Kimia, SMK Analis Kimia, SMK Analis Farmasi</td>
                    <td>01 Aug 2024 - 31 Aug 2024</td>
                    <td>28 Jul 2024</td>
                    <td>2</td>
                    <td><button><a href="pengajuan.php">Apply</a></button></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Kimia Pangan</td>
                    <td>Membantu Pekerjaan di Lab Kimia Pangan</td>
                    <td>Farmasi, Analis Farmasi, Teknologi Pangan, Teknologi Hasil Pertanian, Kimia, Analis Kimia,
                        SMK
                        Analis
                        Kimia, SMK Analis Farmasi</td>
                    <td>01 Aug 2024 - 31 Aug 2024</td>
                    <td>28 Jul 2024</td>
                    <td>2</td>
                    <td><button><a href="pengajuan.php">Apply</a></button></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Mikrobiologi</td>
                    <td>Membantu Pekerjaan di Lab Mikrobiologi</td>
                    <td>Biologi, Mikrobiologi, Biologi Molekuler</td>
                    <td>01 Aug 2024 - 31 Aug 2024</td>
                    <td>28 Jul 2024</td>
                    <td>2</td>
                    <td><button><a href="pengajuan.php">Apply</a></button></td>
                </tr>
            </tbody>
        </table>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>