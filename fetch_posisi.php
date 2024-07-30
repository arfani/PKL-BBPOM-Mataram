<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT posisi FROM pengajuan_pkl WHERE id_pengajuan = $id";
$result = mysqli_query($conn, $sql);
$options = '';

$row = mysqli_fetch_assoc($result);

$posisiList = explode(',', $row['posisi']);
foreach ($posisiList as $posisiItem) {
    $options .= "
        <div class='form-check'>
            <input class='form-check-input' type='radio' name='positions' value='{$posisiItem}' id='position{$posisiItem}'>
            <label class='form-check-label' for='position{$posisiItem}'>
                {$posisiItem}
            </label>
        </div>
    ";
}

echo $options;
