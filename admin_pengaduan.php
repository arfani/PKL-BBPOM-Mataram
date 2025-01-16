<?php
session_start();
include('koneksi.php');

// Mengecek apakah permintaan foto dilakukan
if (isset($_GET['fetch_photo']) && isset($_GET['id']) && $_GET['type'] === 'foto') {
    $pengaduanId = intval($_GET['id']);

    
    // Query untuk mengambil foto dari pengaduan
    $sql = "SELECT foto FROM pengaduan WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pengaduanId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && !empty($row['foto'])) {
        $photoPath = 'Asset/Gambar/' . $row['foto'];
        echo json_encode(['status' => 'success', 'photoPath' => $photoPath]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Foto tidak ditemukan untuk pengaduan ini']);
    }

    exit;
}

// Query utama untuk menampilkan data pengaduan
$sql2 = "SELECT * FROM pengaduan ORDER BY tanggal DESC";
$result2 = $conn->query($sql2);
$no = 1;
// Handle pagination
$limit = 10; // Entries per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch `pengaduan` data with pagination
$sql2 = "SELECT * FROM pengaduan ORDER BY tanggal DESC LIMIT ?, ?";
$stmt = $conn->prepare($sql2);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result2 = $stmt->get_result();

// Count total rows for pagination
$total_sql = "SELECT COUNT(*) AS total FROM pengaduan";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

$no = $offset + 1;
?>
<?php 
if (isset($_POST['submit'])) {
    // Dapatkan data dari form
    $id = $_POST['id'];
    $keterangan = $_POST['keterangan'];

    // Pastikan input tidak kosong
    if (!empty($id) && !empty($keterangan)) {
        // Buat query untuk update data
        $sql = "UPDATE pengaduan SET keterangan = ? WHERE id = ?";
        
        // Persiapkan statement untuk menghindari SQL Injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $keterangan, $id);

        if ($stmt->execute()) {
            // Redirect ke halaman sebelumnya atau tampilkan pesan sukses
            echo "<script>alert('Keterangan berhasil diperbarui.'); window.location.href='admin_pengaduan.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui keterangan.'); window.location.href='admin_pengaduan.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('ID atau keterangan tidak boleh kosong.'); window.location.href='halaman_sebelumnya.php';</script>";
    }
}

$conn->close();
?>
<?php

// Check if the required data is available in the POST request
if (isset($_POST['status']) && isset($_POST['id'])) {
    // Get the status and ID from the form
    $status = $_POST['status'];
    $id = $_POST['id'];

    // Prepare an SQL statement to update the status in the database
    $sql = "UPDATE pengaduan SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters to prevent SQL injection
    $stmt->bind_param("si", $status, $id);

    // Execute the query and check for success
    if ($stmt->execute()) {
        echo "Status updated successfully!";
    } else {
        echo "Error updating status: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>

<?php
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']); // Menghindari XSS
    if ($_GET['status'] == 'success') {
        $alert = "<script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success', // Anda dapat mengubah menjadi 'error', 'warning', 'info', atau 'question'
                title: 'Pesan',
                text: '$message',
                showConfirmButton: false,
                timer: 3000 // Durasi notifikasi dalam milidetik
            });
        });
    </script>";
    } else {
        $alert = "<script type='text/javascript'>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error', // Anda dapat mengubah menjadi 'error', 'warning', 'info', atau 'question'
                title: 'Pesan',
                text: '$message',
                showConfirmButton: false,
                timer: 3000 // Durasi notifikasi dalam milidetik
            });
        });
    </script>";
    }

    echo $alert;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Asset/CSS/custom2.css">
    <style>
        /* Styling untuk tombol hapus */
.delete-btn {
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.delete-btn:hover {
    background-color: #c82333; /* Warna merah lebih gelap saat hover */
    color: #fff;
}

/* Pastikan kontainer data-item memiliki posisi relatif untuk tombol */
.data-item {
    position: relative;
}

    </style>
</head>

<body>
<?php include 'header_admin.php'; ?>

    <div class="container-fluid">
        <div class="row">
        <?php include('sidebar_admin.php'); ?>


            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="container mt-3">
                    <div class="text-center">
                        <h3 class="fw-bold">Data Pengaduan</h3>
                    </div>

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped table-hover text-center">
                            <thead class="table" style="background-color: skyblue;">
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>No. HP</th>
                                    <th>Alamat</th>
                                    <th>Komoditas</th>
                                    <th>Informasi Pengaduan</th>
                                    <th>Foto Identitas</th>
                                    <th>Foto Tambahan</th>
                                    <th>History</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
                                    
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
                                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($row['pesan']); ?></td>
                                        <!-- Button for Foto KTP -->
                                        <td>
                                            <?php if (!empty($row['foto_ktp'])) : ?>
                                                <button class="btn btn-primary btn-view-photo" 
                                                        data-photo-src="Asset/Document/Pengaduan/Foto-Identitas/<?php echo htmlspecialchars($row['foto_ktp']); ?>" 
                                                        data-user-name="<?php echo htmlspecialchars($row['nama']); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            <?php else : ?>
                                                Tidak ada foto
                                            <?php endif; ?>
                                        </td>
                                        
                                        
                                        <!-- Button for Foto Pengaduan -->
                                        <td>
                                            <?php if (!empty($row['foto_pengaduan'])) : ?>
                                                <button class="btn btn-primary btn-view-photo" 
                                                        data-photo-src="Asset/Document/Pengaduan/Foto-Pendukung/<?php echo htmlspecialchars($row['foto_pengaduan']); ?>" 
                                                        data-user-name="<?php echo htmlspecialchars($row['nama']); ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            <?php else : ?>
                                                Tidak ada foto
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#historyModal"
                                            data-kode_unik="<?php echo "{$row['kode_unik']}"; ?>"
                                            data-nama="<?php echo "{$row['nama']}"; ?>"
                                            data-subject="<?php echo "{$row['subject']}"; ?>"
                                            data-no_hp="<?php echo "{$row['no_hp']}"; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        </td>
                                        <td>
                                                <button 
                                                type="submit"
                                                class="btn btn-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal"
                                                data-id="<?php echo "{$row['id']}"; ?>"  
                                                data-keperluan="<?php echo "{$row['subject']}"; ?>"
                                                data-kode_unik="<?php echo "{$row['kode_unik']}"; ?>">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        
                                        </td>
                                        
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        

                        <!-- Pagination -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                <?php if ($page > 1): ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a></li>
                                <?php endif; ?>
                                
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <?php if ($page < $total_pages): ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <!-- Photo Modal -->
                        <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="photoModalLabel">Foto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img id="absensiPhoto" src="" alt="Foto" class="img-fluid">
                                        <p id="photoUserName" class="mt-2"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">History</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                <!-- Data yang diambil dari button -->
                                        <p><strong>Kode Unik:</strong> <span id="modal-kode_unik"></span></p>
                                        <p><strong>Nama:</strong> <span id="modal-nama"></span></p>
                                        <p><strong>Subject:</strong> <span id="modal-subject"></span></p>
                                        <p><strong>No HP:</strong> <span id="modal-no_hp"></span></p>
                                        <h5>Riwayat</h5>
                                        <div id="modal-data-list">
                                            <!-- Data tambahan akan dimasukkan di sini -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Pengisian Keterangan -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modalForm" action="function/tambah_history.php" method="POST">
                    <!-- Input Hidden untuk ID -->
                    <input type="hidden" name="id" id="hidden-id">

                    <!-- Input Hidden untuk Keperluan -->
                    <input type="hidden" name="keperluan" id="hidden-keperluan">
                    <input type="hidden" name="kode_unik" id="hidden-kode_unik">

                    <!-- Tampilkan Keperluan -->
                    <div class="mb-3">
                        <label for="display-keperluan" class="form-label">Subject</label>
                        <input id="display-keperluan" class="form-control" rows="3" disabled></input>
                    </div>
                    <div class="mb-3">
                        <label for="display-kode_unik" class="form-label">Kode Unik</label>
                        <input id="display-kode_unik" class="form-control" rows="3" disabled></input>
                    </div>
                    <div class="mb-3">
                        <label for="display-kode_unik" class="form-label">Nama Petugas</label>
                        <input id="display-kode_unik" class="form-control" rows="3"></input>
                    </div>
                    <!-- Input untuk Keterangan -->
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="5" class="form-control" placeholder="Masukkan keterangan Anda di sini..."></textarea>
                    </div>

                    <!-- Radio Buttons -->
                    <div class="mt-3">
                        <label class="form-label">Pilih Status:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="terima" value="Terima">
                            <label class="form-check-label" for="terima">Terima</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="tolak" value="Tolak">
                            <label class="form-check-label" for="tolak">Tolak</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="tindaklanjuti" value="Tindaklanjuti">
                            <label class="form-check-label" for="tolak">Tindaklanjuti</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="selesai" value="Selesai">
                            <label class="form-check-label" for="tolak">Selesai</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="submitModal">Simpan</button>
            </div>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        // Saat modal ditampilkan
    var exampleModal = document.getElementById('editModal');
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button yang memicu modal
        var button = event.relatedTarget;

        // Ambil data-id dan data-keperluan dari button
        var id = button.getAttribute('data-id');
        var keperluan = button.getAttribute('data-keperluan');
        var kodeUnik = button.getAttribute('data-kode_unik');

        // Masukkan data-id dan data-keperluan ke input hidden di modal
        document.getElementById('hidden-id').value = id;
        document.getElementById('hidden-keperluan').value = keperluan;
        document.getElementById('hidden-kode_unik').value = kodeUnik;

        // Tampilkan keperluan di textarea yang tidak dapat diedit
        document.getElementById('display-keperluan').value = keperluan;
        document.getElementById('display-kode_unik').value = kodeUnik;
    });

    // Tombol Simpan di modal
    document.getElementById('submitModal').addEventListener('click', function () {
        var form = document.getElementById('modalForm');
        var formData = new FormData(form);
        fetch('function/tambah_history.php', {
        method: 'POST',
        body: formData,
        })
        .then(response => response.text())
        .then(result => {
            alert(result); // Tampilkan hasil dari PHP
        })
        .catch(error => {
            console.error('Error:', error);
        });

        // Tampilkan data untuk debugging
        console.log('ID:', formData.get('id'));
        console.log('Keperluan:', formData.get('keperluan'));
        console.log('Keterangan:', formData.get('keterangan'));
        
        console.log('Kode_unik:', formData.get('kode_unik'));
        console.log('Status:', formData.get('status'));

        // Tambahkan logika pengiriman data ke server (AJAX atau form submit)
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('[data-bs-target="#historyModal"]');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                // Ambil data dari atribut tombol
                const kodeUnik = button.getAttribute('data-kode_unik');
                const nama = button.getAttribute('data-nama');
                const subject = button.getAttribute('data-subject');
                const noHp = button.getAttribute('data-no_hp');

                // Masukkan data dari tombol ke elemen modal
                document.getElementById('modal-kode_unik').textContent = kodeUnik;
                document.getElementById('modal-nama').textContent = nama;
                document.getElementById('modal-subject').textContent = subject;
                document.getElementById('modal-no_hp').textContent = noHp;

                // AJAX untuk mengambil data tambahan dari server
                fetch('function/ambil_history.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `kode_unik=${kodeUnik}`
                })
                .then(response => response.json())
                .then(data => {
                    const dataContainer = document.getElementById('modal-data-list');
                    dataContainer.innerHTML = ''; // Kosongkan kontainer sebelumnya

                    if (data.success) {
                        // Jika data ditemukan, tampilkan semua data
                        data.data.forEach(item => {
                            const itemHTML = `
                                <div class="border p-2 mb-2 position-relative rounded">
                                    <p><strong>Tanggal   : </strong> ${item.tanggal}</p>
                                    <p><strong>Status    : </strong> ${item.status}</p>
                                    <p><strong>Keterangan: </strong> ${item.keterangan}</p>
                                    <button class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 delete-btn" 
                                        data-kode_unik="${item.kode_unik}" 
                                        data-status="${item.status}">
                                        Hapus
                                    </button>
                                </div>
                            `;
                            
                            dataContainer.innerHTML += itemHTML;
                        });
                    } else {
                        // Jika tidak ada data
                        dataContainer.innerHTML = '<p>Data tidak ditemukan</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
    document.addEventListener('click', function (e) {
    if (e.target.classList.contains('delete-btn')) {
        // Ambil kode unik dan status dari atribut tombol
        const kodeUnik = e.target.getAttribute('data-kode_unik');
        const status = e.target.getAttribute('data-status');

        // Konfirmasi penghapusan
        if (confirm(`Apakah Anda yakin ingin menghapus data dengan Kode Unik: ${kodeUnik} dan Status: ${status}?`)) {
            // Kirim permintaan ke server untuk menghapus data
            fetch('function/delete_history.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `kode_unik=${kodeUnik}&status=${status}`
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hapus elemen dari DOM jika berhasil
                        e.target.closest('.data-item').remove();
                        alert('Data berhasil dihapus!');
                    } else {
                        alert('Gagal menghapus data: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data.');
                });
        }
    }
});
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = new bootstrap.Modal(document.getElementById('photoModal'));
        const absensiPhoto = document.getElementById('absensiPhoto');
        const photoUserName = document.getElementById('photoUserName');

        // Event listener untuk tombol lihat foto
        document.querySelectorAll('.btn-view-photo').forEach(button => {
            button.addEventListener('click', function() {
                const photoSrc = button.getAttribute('data-photo-src');
                const userName = button.getAttribute('data-user-name');
                
                absensiPhoto.src = photoSrc; // Set foto di modal
                photoUserName.textContent = userName; // Set nama pengguna di modal
                
                modal.show(); // Tampilkan modal
            });
        });
    });
</script>
</body>

</html>