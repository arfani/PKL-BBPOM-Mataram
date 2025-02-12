<?php
include('koneksi.php');

$id = $_GET['id'];
$sql = "SELECT * FROM penempatan_pkl";
$result = mysqli_query($conn, $sql);
$options = '';

while ($row = mysqli_fetch_assoc($result)) {
    $posisiItem = $row['posisi'];
    $posisiKuota = $row['kuota'];

    $sql = "SELECT COUNT(*) as jumlah FROM pengajuan_pkl WHERE status = 'Diterima' AND posisi = '$posisiItem'";
    $result1 = mysqli_query($conn, $sql);
    $sedang_pkl = mysqli_fetch_assoc($result1)['jumlah'] ?? 0;

    $kosong = $posisiKuota - $sedang_pkl;
    $options .= "
        <div class='form-check'>
            <input class='form-check-input' type='radio' name='positions' value='{$posisiItem}' id='position{$posisiItem}'>
            <label class='form-check-label' for='position{$posisiItem}'>
                {$posisiItem}  ->  kuota {$kosong}
            </label>
        </div>
    ";
}

echo $options;
