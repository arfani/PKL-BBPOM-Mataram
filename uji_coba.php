<?php 

include('koneksi.php');
session_start();

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];

$nama = "";
$hasil = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $conn->real_escape_string($_POST['search']);
    $query = "SELECT * FROM pengaduan WHERE nama LIKE '%$nama%'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $hasil[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>follow me on github alqsdeuss :D</title>
    <link rel="stylesheet" href="Asset/CSS/uji_coba.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>
    <div id="gradient-canvas"></div>
    <header>
    <b>BBPOM MATARAM</b>
        <h1>Masukkan Kode Unik</h1>
        <div class="search-container">
            <form method="POST" action="" id="searchForm">
                <input type="text" id="searchInput" name="search" placeholder="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit" id="searchButton">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <p id="error-message" class="hidden">there is no movie with that name</p>
    </header>
    <body>
      <div class="container" style="margin-top: 10%;">  
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <?php if (count($hasil) > 0): ?>
            <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover text-center">
        <thead class="table" style="vertical-align: middle; background-color: navy">
            <tr>
                <th>ID</th>
                <th>Nama</th>
            <th>Tanggal Pengaduan</th>
            <th>Deskripsi</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($hasil as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo htmlspecialchars($row['no_hp']); ?></td>
                <td><?php echo htmlspecialchars($row['subject']); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php else: ?>
    <p class="no-result">Tidak ada hasil untuk pencarian dengan nama "<?php echo htmlspecialchars($nama); ?>"</p>
    <?php endif; ?>
    <?php endif; ?>
    </div>
</body>
    <footer>
        <p class="footer-text">© website build by alqsdeuss</p>
    </footer>

    <script src="cfind.movie.js"></script>
</body>
</html>
            