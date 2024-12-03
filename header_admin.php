<header class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow">
    <a class="navbar-brand" href="#">
        <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px"
            style="margin-left: 15px; margin-right: 10px">
        BBPOM MATARAM
    </a>
    
    <!-- Search and Sign Out for larger screens (md and above) -->
    <div class="d-none d-md-flex order-1 flex-grow-1">
        <form method="GET" action="" id="searchForm" class="d-flex me-auto">
            <input class="form-control w-100 me-2" type="text" name="search" placeholder="Search"
                aria-label="Search" id="searchInput"
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="btn btn-outline-secondary" type="submit" id="searchButton">
                <i class="bx bx-search"></i> <!-- Ikon pencarian dari Boxicons -->
            </button>
        </form>
        <a class="nav-link signout text-nowrap" style="color: white; padding-top: 20px; padding-left: 10px;"
            href="logout.php">Sign out</a>
    </div>

    <!-- Toggle button for mobile -->
    <button class="navbar-toggler d-md-none collapsed me-1" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar for mobile (sm and below) -->
    <div class="collapse navbar-collapse ms-3 d-md-none" id="navbarMenu">
        <form method="GET" action="" id="searchFormMobile" class="d-flex mb-2">
            <input class="form-control w-100 me-2" type="text" name="search" placeholder="Search"
                aria-label="Search" id="searchInputMobile"
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="btn btn-outline-secondary" type="submit" id="searchButtonMobile">
                <i class="bx bx-search"></i> <!-- Ikon pencarian dari Boxicons -->
            </button>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="admin.php">Overview</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="posisiDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Posisi Penempatan PKL
                </a>
                <ul class="dropdown-menu" aria-labelledby="posisiDropdown">
                    <li><a class="dropdown-item" href="admin_posisi.php">Lihat Posisi</a></li>
                    <li><a class="dropdown-item" href="admin_posisi_add.php">Tambah Posisi</a></li>
                </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link dropdown-toggle" href="#" id="pklDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    PKL
                </a>
                <ul class="dropdown-menu" aria-labelledby="pklDropdown">
                    <li><a class="dropdown-item" href="admin_pkl_absensi.php">Absensi</a></li>
                    <li><a class="dropdown-item" href="admin_pkl_posisi.php">Posisi</a></li>
                    <li><a class="dropdown-item" href="admin_pkl_kuis.php">Kuis</a></li>
                    <li><a class="dropdown-item" href="admin_pkl_statistik.php">Statistik</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pengaduanDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Pengaduan
                </a>
                <ul class="dropdown-menu" aria-labelledby="pengaduanDropdown">
                    <li><a class="dropdown-item" href="admin_pengaduan.php">Lihat Pengaduan</a></li>
                    <li><a class="dropdown-item" href="admin_pengaduan_statistik.php">Statistik Pengaduan</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_web.php">Setting Website</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: white; text-shadow: 
        -1px -1px 0 #000,  
         1px -1px 0 #000,
        -1px  1px 0 #000,
         1px  1px 0 #000; " href="logout.php">Sign out</a>
            </li>
        </ul>
    </div>
</header>
