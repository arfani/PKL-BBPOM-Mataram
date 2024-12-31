<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Assets/Gambar/Siap-Melayani-Logo.png" type="image/png" sizes="32x32">
    <title>Manual Calendar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<style>
        .card {
            cursor: default;
            position: relative; /* Dibutuhkan untuk pengaturan elemen absolut di dalam kartu */
            overflow: hidden; /* Agar elemen tidak keluar dari batas kartu */
            background:url(..\Gambar\ngetes.jpeg);
            transition: all 0.3s ease-in-out;
        }


        .card::before {
            content: "";
            position: absolute;
            bottom: -100%; /* Awalnya gradasi tersembunyi di bawah kartu */
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 123, 255, 0.8); /* Warna gradasi dari biru ke biru muda */
            transition: bottom 0.4s ease-in-out; /* Efek transisi saat hover */
            z-index: 2; /* Letakkan di belakang konten */
        }

        .card:hover::before {
            bottom: 0; /* Gradasi muncul sepenuhnya dari bawah ke atas */
        }

        .card p {
            position: absolute;
            bottom: 25%;
            left: 45%; /* Ubah posisi kiri untuk memperlebar area */
            width: 80%; /* Tetapkan lebar area */
            transform: translateX(-50%);
            font-size: 1rem;
            color: black;
            opacity: 0; /* Awalnya tersembunyi */
            transition: opacity 0.4s ease-in-out; /* Efek transisi pada opacity */
            z-index: 2; /* Letakkan di atas gradasi */
        }

        .card:hover p {
            opacity: 1; /* Tampilkan paragraf saat hover */
        }
        

        .card h3 {
            position: relative; /* Agar tetap berada di atas gradasi */
            z-index: 2; /* Letakkan di atas gradasi */
            transition: color 0.4s ease-in-out;
            color:black;
            margin-top:10px;
        }
        .card:hover h3{
            color:white;
        }
        .card img {
            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
            position: relative; /* Agar tetap berada di atas gradasi */
            z-index: 1; /* Letakkan di atas gradasi */
            transition: transform 0.3s ease-in-out;
            width:325px;
            height:260px;
            left:0;
            top:0%;
        }


        .card-wrapper {
            display: flex;
            flex-wrap: wrap; /* Elemen akan turun ke baris baru jika melebihi batas */
            gap: 1rem; /* Jarak antar elemen */
        }

        .card {
            flex: 0 0 calc(33.333% - 1rem); /* 33.333% untuk memastikan 3 elemen per baris */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border: 1px solid orange;
            padding: 1rem;
            
        }

        /* Untuk layar dengan lebar maksimum 768px (tablet dan handphone) */
        @media (max-width: 768px) {
            .card-wrapper {
                flex-direction: column; /* Atur elemen dalam kolom */
                align-items: center;   /* Pusatkan elemen */
                gap: 1rem;             /* Jarak antar elemen tetap */
            }

            .card {
                flex: 0 0 100%;         /* Kartu mengambil lebar penuh */
                padding: 1rem;         /* Tambahkan ruang di dalam kartu */
                transform: scale(1);   /* Hindari pembesaran default */
            }

            .card:hover {
                transform: scale(1.02); /* Efek hover sedikit untuk layar kecil */
            }

            .card h2 {
                font-size: 1.8rem;      /* Ukuran font lebih kecil */
            }

            .card img {
                font-size: 2.5rem;      /* Ukuran ikon lebih kecil */
            }
        }

        /* Untuk layar dengan lebar maksimum 480px (handphone kecil) */
        @media (max-width: 480px) {
            .card-wrapper {
                gap: 0.5rem;            /* Kurangi jarak antar elemen */
            }

            .card {
                padding: 0.8rem;        /* Kurangi padding di dalam kartu */
            }

            .card h2 {
                font-size: 1.5rem;      /* Ukuran font lebih kecil */
            }

            .card img {
                font-size: 2rem;        /* Ukuran ikon lebih kecil */
            }
        }
    </style>
<section class="fitur-section" id="fitur">
    <div class="vision-mission-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="section-title">Portal Layanan Informasi BBPOM di Mataram</h1>
                    <p>Merupakan website yang mengelola data PKL online, Kunjungan online, serta Pengajuan Narasumber
                        online yang di kelola oleh BBPOM di Mataram dengan penjelasan sbb :</p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Fitur 1 : Pendaftaran Dan Monitoring PKL</h3>
                    <p class="description">
                    Pengelolaan PKL meliputi proses permohonan, penerimaan 
                    peserta, serta monitoring jalannya PKL, baik reguler 
                    maupun MBKM, guna memastikan kelancaran dan transparansi 
                    pelaksanaan program.
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Fitur 2 : Permohonan Kunjungan</h3>
                    <p class="description">
                    Pengajuan permohonan kunjungan ke BBPOM Mataram dapat 
                    dipantau status permohonan, jadwal tersedia, dan konfirmasi 
                    penerimaan melalui sistem yang disediakan untuk kemudahan akses.
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 class="title">Fitur 3 : Permohonan Narasumber</h3>
                    <p class="description">
                    Permohonan narasumber untuk kegiatan di tempat pemohon dapat 
                    diajukan dan dipantau statusnya, termasuk informasi siapa 
                    narasumber yang akan dihadirkan dan jadwal kegiatan.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </section>
        <div class="container mb-3">
            <div class="card-wrapper">
                <div class="card" style="cursor: pointer;" >
                    <h3>Pendaftaran Dan Monitoring PKL</h3>
                    <img src="Asset/Gambar/ngetes.jpeg" alt="icon">
                    <p>
                    Pengelolaan PKL meliputi proses permohonan, penerimaan 
                    peserta, serta monitoring jalannya PKL, baik reguler 
                    maupun MBKM, guna memastikan kelancaran dan transparansi 
                    pelaksanaan program.
                    </p>
                </div>
                <div class="card" style="cursor: pointer;" >
                    <div class="card-icon">📋</div>
                    <h2></h2>
                    <p>Lainnya</p>
                </div>
                <div class="card" style="cursor: pointer;" >
                    <div class="card-icon">📋</div>
                    <h2></h2>
                    <p>Lainnya</p>
                </div>
            </div>
        
    </div>
</body>
</html>
