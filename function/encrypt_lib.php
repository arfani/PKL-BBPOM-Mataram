<?php
// Kunci enkripsi (harus 32 karakter untuk AES-256-CBC)
define('ENCRYPTION_KEY', 'your_32_character_long_key_here'); // Ganti dengan kunci yang aman
define('ENCRYPTION_IV', 'your_16_byte_iv_here'); // Ganti dengan IV yang aman, 16 karakter

/**
 * Fungsi untuk mengenkripsi data
 *
 * @param string $data Data yang akan dienkripsi
 * @return string Data terenkripsi dalam format base64
 */
function encrypt_data($data)
{
    $key = ENCRYPTION_KEY;
    $iv = ENCRYPTION_IV;

    // Enkripsi data
    $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);

    if ($encrypted === false) {
        throw new Exception('Gagal mengenkripsi data.');
    }

    return $encrypted;
}

/**
 * Fungsi untuk mendekripsi data
 *
 * @param string $encrypted_data Data terenkripsi dalam format base64
 * @return string Data yang telah didekripsi
 */
function decrypt_data($encrypted_data)
{
    $key = ENCRYPTION_KEY;
    $iv = ENCRYPTION_IV;

    // Dekripsi data
    $decrypted = openssl_decrypt($encrypted_data, 'AES-256-CBC', $key, 0, $iv);

    if ($decrypted === false) {
        throw new Exception('Gagal mendekripsi data.');
    }

    return $decrypted;
}
?>
