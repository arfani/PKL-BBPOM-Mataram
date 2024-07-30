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
        <img src="Asset/Gambar/logo.png" alt="" class="head"
            style=" cursor: pointer; width: 120px; margin-top: 20px; margin-left: 10px;">
        <ul class="sidebar-menu">
            <li class="active">
                <a href="#overview">
                    <i class='bx bxs-dashboard'></i>
                    <span class="title">Overview</span>
                </a>
            </li>
            <li>
                <a href="#document">
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
        <script>
        const allSideMenu = document.querySelectorAll('#sidebar .sidebar-menu li a');

        allSideMenu.forEach(item => {
            const li = item.parentElement;

            item.addEventListener('click', function() {
                allSideMenu.forEach(i => {
                    i.parentElement.classList.remove('active');
                })
                li.classList.add('active');
            })
        });
        </script>
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
                <a href="index.html" onclick="closepopup()">Iya</a>
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
            <!-- POPUP -->-
        </nav>
        <!-- Nav -->

        <!-- E-Document Section -->
        <section id="document" class="document-section">
            <h2>Berkas Persyaratan</h2>
            <div class="download-container">
                <div class="download-box">
                    <img src="Asset/Gambar/icon1.png" alt="Surat Permohonan PKL">
                    <h3>Surat Permohonan PKL</h3>
                    <a href="path/to/SuratPermohonanPKL.docx" download>Download</a>
                </div>
                <div class="download-box">
                    <img src="Asset/Gambar/icon2.png" alt="Peraturan PKL">
                    <h3>Peraturan PKL</h3>
                    <a href="path/to/PeraturanPKL.docx" download>Download</a>
                </div>
                <div class="download-box">
                    <img src="Asset/Gambar/icon3.png" alt="Sertifikat">
                    <h3>Sertifikat</h3>
                    <a href="path/to/Sertifikat.docx" download>Download</a>
                </div>
                <div class="download-box">
                    <img src="Asset/Gambar/icon4.png" alt="Absensi">
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