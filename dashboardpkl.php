<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <title>Dashboard PKL</title>
    <link rel="stylesheet" href="Asset/CSS/custom3.css">
    <style>
        .popup {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            z-index: 1000;
        }

        .popup.open-popup {
            display: block;
        }

        .popup a {
            margin-right: 10px;
        }

        .foto img {
            width: 300px;
            height: 300px;
            border-radius: 50%;

        }

        .profile-info {
            flex: 1;
        }

        .navbar-brand img {
            max-width: 100px;
        }

        @media (max-width: 768px) {
            .profile-info {
                text-align: center;
                margin-top: 20px;
            }

            .foto {
                width: 100%;
                text-align: center;
            }

            .foto img {
                margin: 0 auto;
            }

            .card-body {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <?php
    include 'koneksi.php';
    session_start();

    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        if ($id <= 100) {
            header('location: admin.php');
        } else if ($id > 300 && $id <= 600) {
            header('location: tamu.php');
        } else if ($id > 600 && $id <= 900) {
            header('location: narasumber.php');
        }
    }

    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM pkl where id ='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        $nama = $row['nama'];
        $no_hp = $row['no_hp'];
        $status = $row['status'];
        $foto = $row['foto'];
    } else {
        $email = "";
        $nama = "";
        $no_hp = "";
        header("Location: index.php");
    }
    ?>

    <!-- Side Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Asset/Gambar/logo.png" alt="#" width="30px" height="30px" style="margin-left: 15px; margin-right: 10px">
                <b>BBPOM MATARAM</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-1">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboardpkl.php"><i class='bx bxs-dashboard'></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="e_document.php"><i class='bx bx-book-bookmark'></i> E-Document</a>
                    </li>
                </ul>

                <img src="Asset/Gambar/icon.png" alt="" width="40px" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#profileModal">

            </div>
        </div>
    </nav>
    <!-- Side Bar -->

    <!-- Profile Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="profileForm" action="save_profile.php" method="POST">
                    <input type="hidden" name="redirect" value="dashboardpkl.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="profileName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="profileName" name="profileName" value="<?php echo $nama; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="profileEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="profileEmail" name="profileEmail" value="<?php echo $email; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="profilePhone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control" id="profilePhone" name="profilePhone" value="<?php echo $no_hp; ?>">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-around">
                        <button type="button" class="btn btn-danger"><a href="logout.php" style="text-decoration: none; color: white;">Logout</a></button>
                        <input type="submit" class="btn btn-primary" value="Save">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container mt-5">
        <!-- Data PKL -->
        <div class="card mt-4 mx-auto" style="max-width: 1000px;">
            <h3 class='text-center'>data lengkap pkl</h3>
            <div class="card-body d-flex flex-wrap align-items-center">
                <div class="foto d-flex flex-column me-3">
                    <img id="profile-picture" src="<?php echo $foto ?>" alt="Profile Picture" class="img-thumbnail mb-3">
                    <button class="btn btn-primary" onclick="editProfilePicture()">
                        <i class='bx bx-edit'></i> Edit
                    </button>
                </div>

                <form id="upload-form" action="upload.php" method="POST" enctype="multipart/form-data" style="display: none;">
                    <input type="file" id="file-input" name="profile_picture" accept="image/*" onchange="previewProfilePicture(event)">
                    <input type="hidden" name="user_id" value="<?php echo $id ?>">
                </form>

                <div class="profile-info">
                    <h3>Nama: <?php echo $nama ?></h3>
                    <p>Posisi: Intern</p>
                    <p>Universitas: Universitas ABC</p>
                    <p>Email: <?php echo $email ?></p>
                    <p class="fw-bold">Periode: 2024</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Content -->

    <script>
        function editProfilePicture() {
            // Buka file picker
            document.getElementById('file-input').click();
        }

        function previewProfilePicture(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-picture').src = e.target.result;
                }
                reader.readAsDataURL(file);

                // Submit form secara otomatis setelah memilih gambar
                document.getElementById('upload-form').submit();
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>