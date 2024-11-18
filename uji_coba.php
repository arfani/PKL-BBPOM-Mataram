<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="Asset/CSS/uji_coba.css">
</head>
<body>
<div class="dropdown">
    <button onclick="toggleDropdown()" class="dropbtn">Pilih Opsi</button>
    <div id="dropdownMenu" class="dropdown-content">
        <a href="#">Opsi 1</a>
        <a href="#">Opsi 2</a>
        <a href="#">Opsi 3</a>
    </div>
</div>
<script>
    // Fungsi untuk menampilkan atau menyembunyikan dropdown saat diklik
    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdownMenu");
        dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
    }

    // Menutup dropdown jika diklik di luar area dropdown
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    }
</script>

</body>
</html>