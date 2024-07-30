<!-- Side Bar -->
<section id="sidebar">
    <img src="../Asset/Gambar/Reference 2.png" alt="Logo" style=" cursor: pointer; width: 200px; margin-top: 20px; margin-left: 10px;">
    <ul class="sidebar-menu">
        <li class="active">
            <a href="overview.php">
                <i class='bx bxs-dashboard'></i>
                <span class="title">Overview</span>
            </a>
        </li>
        <li>
            <a href="document.php">
                <i class='bx bx-book-bookmark'></i>
                <span class="title">E-Document</span>
            </a>
        </li>
        <li>
            <a href="logout.php">
                <i class='bx bx-log-out'></i>
                <span class="title">Log-Out</span>
            </a>
        </li>
    </ul>
    <script>
        const allSideMenu = document.querySelectorAll('#sidebar .sidebar-menu li a');

        allSideMenu.forEach(item => {
            const li = item.parentElement;

            item.addEventListener('click', function() {
                allSideMenu.forEach(i => {
                    i.parentElement.classList.remove('active');
                });
                li.classList.add('active');
            });
        });
    </script>
</section>
<!-- Side Bar -->