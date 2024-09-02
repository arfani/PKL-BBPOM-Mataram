<?php
include('koneksi.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $positions = mysqli_real_escape_string($conn, $_POST['positions']);

    // Ambil data pengajuan
    $cekpos = mysqli_query($conn, "SELECT * FROM `pengajuan_pkl` WHERE id_pengajuan = '$id'");
    if (!$cekpos) {
        echo "Error fetching data: " . mysqli_error($conn);
        exit();
    }
    $cp = mysqli_fetch_array($cekpos);
    $posawal = $cp['penempatan'];
    $no_hp = $cp['phone'];

    // Tambah kuota posisi awal
    $updateQuota = mysqli_query($conn, "UPDATE penempatan_pkl SET kuota = kuota + 1 WHERE posisi= '$posawal'");
    if (!$updateQuota) {
        echo "Error updating initial quota: " . mysqli_error($conn);
        exit();
    }

    // Kurangi kuota posisi baru
    $updateQuota2 = mysqli_query($conn, "UPDATE penempatan_pkl SET kuota = kuota - 1 WHERE posisi= '$positions'");
    if (!$updateQuota2) {
        echo "Error updating new quota: " . mysqli_error($conn);
        exit();
    }

    // Update status pengajuan
    $sql = "UPDATE pengajuan_pkl SET penempatan= '$positions' WHERE id_pengajuan='$id'";
    if (!mysqli_query($conn, $sql)) {
        echo "Error updating status: " . mysqli_error($conn);
        exit();
    }

    // Cek id pengguna
    $cekid = mysqli_query($conn, "SELECT * FROM `pkl` WHERE no_hp = '$no_hp'");
    if (!$cekid) {
        echo "Error fetching user data: " . mysqli_error($conn);
        exit();
    }
    $cid = mysqli_fetch_array($cekid);
    $userid = $cid['id'];

    // Tambahkan notifikasi
    $text = '<div style="text-align: justify;">Posisi PKL Anda di BPOM Mataram sudah diubah.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class="text-center mt-1"><a href="dashboard_pkl_.php" style="font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Dashboard PKL</a></div>';
    $notif = "INSERT INTO notifikasi (userid, text, status) VALUES ('$userid', '$text', 'pkl')";
    if (!mysqli_query($conn, $notif)) {
        echo "Error inserting notification: " . mysqli_error($conn);
        exit();
    }

    // Kirim pesan melalui Fonnte jika diaktifkan
    $cekFonnte = mysqli_query($conn, "SELECT * FROM `api` WHERE id = 8");
    if (!$cekFonnte) {
        echo "Error fetching API data: " . mysqli_error($conn);
        exit();
    }
    $cf = mysqli_fetch_array($cekFonnte);

    if ($cf['status'] == 1) {
        $content = '*Posisi PKL Anda di BBPOM Mataram sudah diubah ke bagian*
         
*--> ' . $positions . ' <--*

Silakan mengunjungi dashboard PKL Anda di sini:
' . $urlweb . '/dashboardpkl.php';

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
