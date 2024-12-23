<style>
.nav-item {
    border-bottom: 1px solid #ddd; /* Garis bawah */
    padding-bottom: 5px; /* Ruang di bawah item */
    margin-bottom: 5px; /* Ruang antar item */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15); /* Bayangan ringan */
    border-radius: 4px; /* Sudut melengkung */
     /* Latar belakang putih */
}

.nav-item:last-child {
    border-bottom: none; /* Hilangkan garis untuk item terakhir */
}

.nav-item .nav-link.active {
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.1); /* Bayangan lebih tegas */
    background-color: #e9ecef; /* Latar belakang abu terang untuk active */
    border-left: 4px solid #007bff; /* Tambahkan garis warna pada sisi kiri */
    color: #007bff; /* Warna teks aktif */
    font-weight: bold; /* Teks tebal untuk penekanan */
    border-radius: 4px; /* Sudut melengkung */
}


</style>
<div id="sidebar" class="sidebar col-md-3 col-lg-2 d-none d-md-block">
    <div class="position-sticky pt-2 sidebar-sticky">
        <ul class="nav flex-column">
            <?php
            // Tentukan halaman aktif berdasarkan URL
            $current_page = basename($_SERVER['PHP_SELF']);

            // Data menu dengan sub-menu
            $nav_items = [
                [
                    'title' => 'OVERVIEW',
                    'link' => 'admin.php',
                    'active' => ($current_page == 'admin.php'),
                    'submenu' => []
                ],
                [
                    'title' => 'PKL',
                    'link' => '#',
                    'active' => ($current_page == 'admin_pkl.php'||$current_page == 'admin_pkl_absensi.php'
                    ||$current_page == 'admin_pkl_kuis.php'||$current_page == 'admin_pkl_posisi.php'||$current_page == 'admin_pkl_statistik.php'),
                    'submenu' => [
                        ['title' => 'Peserta PKL', 'link' => 'admin_pkl.php'],
                        ['title' => 'Absensi', 'link' => 'admin_pkl_absensi.php'],
                        ['title' => 'Posisi', 'link' => 'admin_pkl_posisi.php'],
                        ['title' => 'Kuis', 'link' => 'admin_pkl_kuis.php'],
                        ['title' => 'Statistik', 'link' => 'admin_pkl_statistik.php'],
                    ]
                ],
                [
                    'title' => 'PERMOHONAN',
                    'link' => 'admin_tamu.php',
                    'active' => ($current_page == 'admin_tamu.php'||$current_page == 'admin_tamu_statistik.php'),
                    'submenu' => [
                        ['title' => 'Permohonan', 'link' => 'admin_tamu.php'],
                        ['title' => 'Statistik', 'link' => 'admin_tamu_statistik.php'],
                    ]
                ],
                [
                    'title' => 'PENGADUAN',
                    'link' => '#',
                    'active' => ($current_page == 'admin_pengaduan.php' || $current_page == 'admin_pengaduan_statistik.php'),
                    'submenu' => [
                        ['title' => 'Laporan Pengaduan', 'link' => 'admin_pengaduan.php'],
                        ['title' => 'Statistik', 'link' => 'admin_pengaduan_statistik.php'],
                    ]
                ],
                [
                    'title' => 'SETTING',
                    'link' => 'admin_web.php',
                    'active' => ($current_page == 'admin_web.php'),
                    'submenu' => []
                ]
            ];
            ?>

            <?php foreach ($nav_items as $index => $item): ?>
                <li class="nav-item">
                    <a 
                        class="nav-link <?php echo $item['active'] ? 'active' : ''; ?>" 
                        href="<?php echo !empty($item['submenu']) ? '#' : $item['link']; ?>" 
                        <?php if (!empty($item['submenu'])): ?>
                            data-bs-toggle="collapse" 
                            data-bs-target="#submenu-<?php echo $index; ?>" 
                            aria-expanded="<?php echo $item['active'] ? 'true' : 'false'; ?>" 
                            aria-controls="submenu-<?php echo $index; ?>"
                        <?php endif; ?>
                    >
                        <?php echo $item['title']; ?>
                    </a>

                    <?php if (!empty($item['submenu'])): ?>
                        <ul 
                            id="submenu-<?php echo $index; ?>" 
                            class="collapse list-unstyled <?php echo $item['active'] ? 'show' : ''; ?>"
                        >
                            <?php foreach ($item['submenu'] as $submenu): ?>
                                <li>
                                    <a 
                                        class="nav-link sub-item <?php echo $current_page == basename($submenu['link']) ? 'active' : ''; ?>" 
                                        href="<?php echo $submenu['link']; ?>"
                                    >
                                        <?php echo $submenu['title']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
