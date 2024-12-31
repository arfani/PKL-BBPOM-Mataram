<?php 
include('koneksi.php');

$sql_0 = mysqli_query($conn, "SELECT * FROM `tb_seo` WHERE id = 1");
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
?>
<style>
    .whatsapp_float {
        position: fixed;
        bottom: 60px;
        right: 30px;
        z-index: 100;
        cursor: grab;
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .whatsapp-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .whatsapp-icon:hover {
        transform: scale(1.1);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.3);
    }

    .hidden {
        opacity: 0.3;
        transform: translateX(20%);
        right: 5;
        bottom: 5;
        cursor: pointer;
    }

    .hidden:hover {
        opacity: 1;
        transform: none;
    }

    @media (max-width: 768px) {
        #whatsapp_float {
            max-width: 70px;
            /* height: 50px; */
            right: 25px;
            bottom: 70px;
        }

        .hidden {
            opacity: 0.5;
            transform: translateX(15%);
            right: 25px;
            bottom: 70px;
            cursor: pointer;
        }

        .hidden:hover {
            opacity: 1;
            transform: none;
        }

        .whatsapp-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }
    }
</style>
<?php
$sql2 = "SELECT * FROM api where id = 8";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$no_cs = $row2['no_cs'];
$text = "halo, bpom";
?>
<!-- Floating WhatsApp Button -->
<div id="whatsapp_float" class="whatsapp_float d-flex flex-column text-center">
    <a id="whatsapp_link" href="https://wa.me/62<?php echo $no_cs ?>?text=<?php urlencode($text) ?>"
        target="_blank"><img src="<?php echo $urlweb ?>/Asset/Gambar/icon_wa.png" alt="WhatsApp Contact"
            class="whatsapp-icon"></a>
    <span class="text-muted"><b>Customer Service</b></span>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
            const whatsappFloat = document.getElementById('whatsapp_float');
            const whatsappLink = document.getElementById('whatsapp_link');
            let isDragging = false;
            let timeout;

            function resetTimer() {
                clearTimeout(timeout);
                timeout = setTimeout(hideButton, 5000); // 5 detik tidak ada aktivitas
            }

            function hideButton() {
                whatsappFloat.classList.add('hidden');
            }

            function showButton() {
                whatsappFloat.classList.remove('hidden');
            }


            // Reset timer pada setiap interaksi
            whatsappFloat.addEventListener('click', function(e) {
                    if (!isDragging) {
                        whatsappLink.click(); // Redirect to WhatsApp jika tidak sedang drag
                    }

                    resetTimer();
                }

            );

            // Inisialisasi timer
            resetTimer();
        }

    );
</script>