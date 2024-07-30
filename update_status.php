<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $positions = $_POST['positions'];

    // Kurangi kuota posisi yang dipilih
    $updateQuota = "UPDATE penempatan_pkl SET kuota = kuota - 1 WHERE posisi='$positions'";
    if (!mysqli_query($conn, $updateQuota)) {
        echo "Error updating quota: " . mysqli_error($conn);
        exit();
    }

    // Update status pengajuan
    $sql = "UPDATE pengajuan_pkl SET status='Diterima' WHERE id_pengajuan='$id'";
    if (!mysqli_query($conn, $sql)) {
        echo "Error updating status: " . mysqli_error($conn);
        exit();
    }

    $cek = mysqli_query($conn, "SELECT * FROM `pengajuan_pkl` WHERE id_pengajuan = '$id'");
    $ce = mysqli_fetch_array($cek);
    $no_hp = $ce['phone'];

    $sql5 = "UPDATE pkl SET status='active' WHERE no_hp='$no_hp'";
    if (!mysqli_query($conn, $sql5)) {
        echo "Error updating PKL status: " . mysqli_error($conn);
        exit();
    }

    $cekid = mysqli_query($conn, "SELECT * FROM `pkl` WHERE no_hp = '$no_hp'");
    $cid = mysqli_fetch_array($cekid);
    $userid = $cid['id'];

    $text = '<div style="text-align: justify;">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class="text-center mt-1"><a href="dashboard_pkl_.php" style="font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Dashboard PKL</a></div>';
    $notif = "INSERT INTO notifikasi (userid, text, status) VALUES ('$userid', '$text', 'pkl')";
    if (!mysqli_query($conn, $notif)) {
        echo "Error inserting notification: " . mysqli_error($conn);
        exit();
    }

    $cekFonnte = mysqli_query($conn, "SELECT * FROM `api` WHERE id = 8");
    $cf = mysqli_fetch_array($cekFonnte);

    if ($cf['status'] == 1) {
        $content = '*Selamat, Pengajuan PKL Anda di BBPOM Mataram sudah diterima di bagian*
         
*--> ' . $positions . ' <--*

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

    mysqli_close($conn);
    // header('Location: admin_pkl.php');
    exit();
}
