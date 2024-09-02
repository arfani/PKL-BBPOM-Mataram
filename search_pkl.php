<?php
include('koneksi.php');

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT * FROM pengajuan_pkl WHERE 
        nama LIKE '%$search%' OR 
        email LIKE '%$search%' OR 
        phone LIKE '%$search%' OR 
        university LIKE '%$search%' OR 
        department LIKE '%$search%' OR 
        posisi LIKE '%$search%' OR 
        periode LIKE '%$search%' OR 
        status LIKE '%$search%'";

$result = mysqli_query($conn, $sql);
$no = 1;

$output = '';

while ($row = mysqli_fetch_assoc($result)) {
    $tanggal_pengajuan = new DateTime($row['tanggal_pengajuan']);
    $tanggal_kadaluarsa = $tanggal_pengajuan->modify('+2 days');
    $now = new DateTime();
    $interval = $now->diff($tanggal_kadaluarsa);
    $waktuTersisa = $interval->invert ? 'Kadaluarsa' : sprintf('%02dh %02dm %02ds', $interval->h, $interval->i, $interval->s);


    $surat = $row['surat'] ? "<a href='{$row['surat']}' class='btn btn-primary btn-sm' download>Download Surat</a>" : "Belum upload";
    $proposal = $row['proposal'] ? "<a href='{$row['proposal']}' class='btn btn-primary btn-sm' download>Download Proposal</a>" : "Belum upload";
    $status = $row['status'] ? $row['status'] : "
<form action='update_status.php' method='post'>
<input type='hidden' name='id' value='{$row['id_pengajuan']}'>
<button type='submit' name='status' value='Diterima' class='btn btn-success btn-sm'>Terima</button>
<button type='button' name='status' value='Ditolak' class='btn btn-danger btn-sm reject-btn' data-id='{$row['id_pengajuan']}'>Tolak</button>
</form>";

    $suratBalasan = "";
    if ($row['status'] == 'Diterima') {
        $suratBalasan = "
<form action='upload_surat_balasan.php' method='post' enctype='multipart/form-data'>
    <input type='hidden' name='id' value='{$row['id_pengajuan']}'>
    <input type='file' name='surat_balasan' class='form-control' required>
    <button type='submit' class='btn btn-primary btn-sm mt-2'>Upload Surat Balasan</button>
</form>";
    } elseif ($row['status'] == 'Ditolak') {
        $suratBalasan = $row['surat_balasan'];
    }

    $output .= "<tr>";
    $output .= "<th scope='row'>{$no}</th>";
    $output .= "<td>{$row['nama']}</td>";
    $output .= "<td>{$row['email']}</td>";
    $output .= "<td>{$row['phone']}</td>";
    $output .= "<td>{$row['university']}</td>";
    $output .= "<td>{$row['department']}</td>";
    $output .= "<td class='text-nowrap'>{$row['posisi']}</td>";
    $output .= "<td class='text-nowrap'>{$row['periode']}</td>";
    $output .= "<td>{$surat}</td>";
    $output .= "<td>{$proposal}</td>";
    $output .= "<td>{$status}</td>";
    $output .= "<td colspan='2'>{$suratBalasan}</td>";
    if ($row['status'] == "" or $row['status'] == null) {
        $output .= "<td class='countdown-container' data-target='{$tanggal_kadaluarsa->format('Y-m-d H:i:s')}'>
<div class='countdown-item'>
<span class='hours'>00</span>
<label>Jam</label>
</div>
<div class='countdown-item'>
<span class='minutes'>00</span>
<label>Menit</label>
</div>
<div class='countdown-item'>
<span class='seconds'>00</span>
<label>Detik</label>
</div>
</td>";
    } else {
        $output .= "<td class='countdown-container expired'> Selesai </td>";
    }
    $output .= "</tr>";

    $no++;
}

echo $output;
