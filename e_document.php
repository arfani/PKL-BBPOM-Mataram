<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- CSS -->
    <title>Dashboard PKL</title>
    <link rel="stylesheet" href="Asset/CSS/style3.css">

</head>

<body>
    <!-- Side Bar -->
    <section id="sidebar">
        <img src="Asset/Gambar/Reference 2.png" alt=""
            style=" cursor: pointer; width: 200px; margin-top: 20px; margin-left: 10px;">
        <ul class="sidebar-menu">
            <li>
                <a href="dashboardpkl.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="title">Profile</span>
                </a>
            </li>
            <li class='active'>
                <a href="e_document.php">
                    <i class='bx bx-book-bookmark'></i>
                    <span class="title">E-Document</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="title">Log-Out</span>
                </a>
            </li>
        </ul>

    </section>
    <!-- Side Bar -->
    <!-- Content -->
    <section id="content">
        <!-- Nav -->
        <nav>
            <i class='bx bx-menu'></i>
            <script>
            const menuBar = document.querySelector('#content nav .bx.bx-menu');
            const sidebar = document.getElementById('sidebar');

            menuBar.addEventListener('click', function() {
                sidebar.classList.toggle('hide');
            })
            </script>
            <a href="#" class="tittle">
                <span class="text">Informasi PKL/Magang</span>
            </a>
            <img src="Asset/Gambar/profile.png" alt="" width="25px" style="cursor: pointer;" onclick="openpopup()">
            <!-- POPUP -->
            <div class="popup" id="popup">
                <p>Apa Anda Yakin Ingin Logout </p>
                <a href="#" onclick="closepopup()">Iya</a>
                <a href="#" onclick="closepopup()">Tidak</a>
            </div>
            <script>
            const popup = document.getElementById("popup")

            function openpopup() {
                popup.classList.add("open-popup");
            }

            function closepopup() {
                popup.classList.remove("open-popup");
            }
            </script>
            <!-- POPUP -->
        </nav>
        <!-- Nav -->

        <!-- E-Document Section -->
        <section id="document" class="document-section">
            <h2>Berkas Persyaratan</h2>
            <div class="download-container">
                <div class="download-box">
                    <img src="Asset/Gambar/sertifikat.png" alt="Surat Permohonan PKL">
                    <h3>Pakta Integritas Mahasiswa</h3>
                    <a href="./Asset/Document/PAKTA INTEGRITAS MAHASISWA PKL.docx" download>Download</a>
                </div>
                <div class="download-box">
                    <img src="Asset/Gambar/sertifikat.png" alt="Peraturan PKL">
                    <h3>Peraturan PKL</h3>
                    <a href="path/to/PeraturanPKL.docx" download>Download</a>
                </div>
                <div class="download-box">
                    <img src="Asset/Gambar/sertifikat.png" alt="Sertifikat">
                    <h3>Sertifikat</h3>
                    <a href="path/to/Sertifikat.docx" download>Download</a>
                </div>
                <div class="download-box">
                    <img src="Asset/Gambar/sertifikat.png" alt="Absensi">
                    <h3>Absensi</h3>
                    <a href="path/to/Absensi.docx" download>Download</a>
                </div>
            </div>
        </section>
        <!-- E-Document Section -->

    </section>
    <!-- Content -->
</body>

</html>