<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

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
            });
        </script>
        <a href="#" class="title">
            <span class="text">Informasi PKL/Magang</span>
        </a>
        <img src="../Asset/Gambar/profile.png" alt="Profile" width="25px" style="cursor: pointer;" onclick="openpopup()">
        <!-- POPUP -->
        <div class="popup" id="popup">
            <p>Apa Anda Yakin Ingin Logout?</p>
            <a href="logout.php">Iya</a>
            <a href="#" onclick="closepopup()">Tidak</a>
        </div>
        <script>
            const popup = document.getElementById("popup");

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
                <img src="../Asset/Gambar/sertifikat.png" alt="Surat Permohonan PKL">
                <h3>Surat Permohonan PKL</h3>
                <a href="path/to/SuratPermohonanPKL.docx" download>Download</a>
            </div>
            <div class="download-box">
                <img src="../Asset/Gambar/sertifikat.png" alt="Peraturan PKL">
                <h3>Peraturan PKL</h3>
                <a href="path/to/PeraturanPKL.docx" download>Download</a>
            </div>
            <div class="download-box">
                <img src="../Asset/Gambar/sertifikat.png" alt="Sertifikat">
                <h3>Sertifikat</h3>
                <a href="path/to/Sertifikat.docx" download>Download</a>
            </div>
            <div class="download-box">
                <img src="../Asset/Gambar/sertifikat.png" alt="Absensi">
                <h3>Absensi</h3>
                <a href="path/to/Absensi.docx" download>Download</a>
            </div>
        </div>
    </section>
</section>
<?php include 'footer.php'; ?>