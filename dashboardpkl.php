<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <!-- CSS -->
    <title>Dashboard PKL</title>
    <link rel="stylesheet" href="Asset/CSS/style3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .profile-card {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .profile-card img {
        width: 200px;
        height: 200px;
        border-radius: 10px;
        margin-right: 20px;
    }

    .profile-card .profile-info {
        flex: 1;
    }

    .profile-card h3 {
        margin: 10px 0;
    }

    .profile-card p {
        margin: 5px 0;
        font-size: 16px;
    }

    .profile-card .period {
        margin-top: 10px;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .profile-card {
            flex-direction: column;
            text-align: center;
        }

        .profile-card img {
            margin: 0 auto 20px;
        }
    }

    .sidebar-menu {
        list-style-type: none;
        padding: 0;

    }

    .sidebar-menu li {
        margin: 10px 0;
    }

    .sidebar-menu a {
        text-decoration: none;
        color: inherit;
    }

    .sidebar-menu a:hover {
        text-decoration: none;
        color: inherit;
    }
    </style>
</head>

<body>
    <!-- Side Bar -->
    <section id="sidebar">
        <img src="Asset/Gambar/Reference 2.png" alt=""
            style=" cursor: pointer; width: 200px; margin-top: 20px; margin-left: 10px;">
        <ul class="sidebar-menu">
            <li class="active">
                <a href="dashboardpkl.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="title">Profile</span>
                </a>
            </li>
            <li>
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
            <a href="#" class="tittle" style="text-decoration: none">
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
        <section id="overview" class="document-section">

            <h2>Data PKL</h2>
            <div class="card-container px-3">
                <div class="profile-card">
                    <img src="Asset/Gambar/profile.png" alt="Profile Picture">
                    <div class="profile-info">
                        <h3>Nama: John Doe</h3>
                        <p>Posisi: Intern</p>
                        <p>Universitas: Universitas ABC</p>
                        <p>Email: johndoe@example.com</p>
                        <p class="period">Periode: 2024</p>
                    </div>
                </div>
                <!-- Tambahkan card lainnya disini -->
            </div>
        </section>
    </section>
    <!-- Content -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>