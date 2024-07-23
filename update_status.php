<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];


    $sql = "UPDATE pengajuan_pkl SET status='$status' WHERE id_pengajuan='$id'";;

    if (mysqli_query($conn, $sql)) {

        $cek = mysqli_query($conn, "SELECT * FROM `pengajuan_pkl` WHERE id_pengajuan = '$id'");
        $ce = mysqli_fetch_array($cek);
        $no_hp = $ce['phone'];

        $sql5 = mysqli_query($conn, "UPDATE pkl SET status='active' WHERE no_hp='$no_hp'");

        $cekid = mysqli_query($conn, "SELECT * FROM `pkl` WHERE no_hp = '$no_hp'");
        $cid = mysqli_fetch_array($cekid);
        $userid = $cid['id'];

        $text = '<div style="text-align: justify;">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class="text-center mt-1"><a href="dashboard_pkl_.php" style="font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Dashboard PKL</a></div>';
        $notif = mysqli_query($conn, "INSERT INTO notifikasi (userid, text, status) VALUES ('$userid', '$text', 'pkl')");

        $cekFonnte = mysqli_query($conn, "SELECT * FROM `api` WHERE id = 8");
        $cf = mysqli_fetch_array($cekFonnte);

        if ($cf['status'] == 1) {
            $content = '*Selamat, Pengajuan PKL Anda di BBPOM Mataram sudah diterima.*
Silakan mengunjungi dashboard PKL Anda di sini:
https://bpom.com/pkl/Dashboard/';

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
        header('Location: admin_pkl.php');
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: admin_pkl.php');
}
