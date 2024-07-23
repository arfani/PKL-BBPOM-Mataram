<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);

    $sql = "UPDATE pengajuan_pkl SET status='Ditolak', surat_balasan='$reason' WHERE id_pengajuan='$id'";

    if (mysqli_query($conn, $sql)) {

        $cek = mysqli_query($conn, "SELECT * FROM `pengajuan_pkl` WHERE id_pengajuan = '$id'");
        $ce = mysqli_fetch_array($cek);
        $no_hp = $ce['phone'];

        $cekid = mysqli_query($conn, "SELECT * FROM `pkl` WHERE no_hp = $no_hp");
        $cid = mysqli_fetch_array($cekid);
        $userid = $cid['id'];


        $text = 'Mohon Maaf Pengajuan PKL Anda di BPOM Mataram Belum Diterima<br>Dengan Alasan ' . $reason;
        $notif = mysqli_query($conn, "INSERT INTO notifikasi (userid, text, status) VALUES ('$userid', '$text', 'pkl')");

        $cekFonnte = mysqli_query($conn, "SELECT * FROM `api` WHERE id = 8");
        $cf = mysqli_fetch_array($cekFonnte);

        if ($cf['status'] == 1) {
            $content = '*Mohon Maaf Pengajuan PKL Anda di BBPOM Mataram Belum Diterima*
            
Dengan Alasan : 
' . $reason . '';

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.fonnte.com/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    'target' => $no_hp,
                    'message' => $content,
                    'countryCode' => '62'
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: " . $cf['api_key']
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            sleep(1);
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
