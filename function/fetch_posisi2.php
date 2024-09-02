<?php
include('koneksi.php');

$id = $_GET['id'];
$sql = "SELECT * FROM penempatan_pkl";
$result = mysqli_query($conn, $sql);
$options = '';

while ($row = mysqli_fetch_assoc($result)) {
    $posisiItem = $row['posisi'];
    $posisiKuota = $row['kuota'];
    $options .= "
        <div class='form-check'>
            <input class='form-check-input' type='radio' name='positions' value='{$posisiItem}' id='position{$posisiItem}'>
            <label class='form-check-label' for='position{$posisiItem}'>
                {$posisiItem}  ->  kuota {$posisiKuota}
            </label>
        </div>
    ";
}

echo $options;
