-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2024 at 03:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mypkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `no_hp`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '082145554182', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id` int(11) NOT NULL,
  `provider` text NOT NULL,
  `api_key` text NOT NULL,
  `private_key` text NOT NULL,
  `merchant_code` text NOT NULL,
  `jenis` int(2) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `provider`, `api_key`, `private_key`, `merchant_code`, `jenis`, `status`) VALUES
(8, 'Fonnte', 'mrWcDKjDNeHiARkM9oAk', '', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `narasumber`
--

CREATE TABLE `narasumber` (
  `id` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `narasumber`
--

INSERT INTO `narasumber` (`id`, `nama`, `email`, `no_hp`, `password`) VALUES
(601, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `text` text NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `userid`, `text`, `status`) VALUES
(1, 1, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(4, 1, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 11px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(9, 0, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 10px; padding: 3px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(10, 1, 'Mohon Maaf Pengajuan PKL Anda di BPOM Mataram Belum Diterima<br>Dengan Alasan proposal mu salah', 'pkl'),
(11, 1, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(12, 1, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(13, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(14, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(15, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(16, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(17, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(18, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(19, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(20, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(21, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(22, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(23, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(24, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(25, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(26, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(27, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(28, 101, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(29, 101, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl');

-- --------------------------------------------------------

--
-- Table structure for table `penempatan_pkl`
--

CREATE TABLE `penempatan_pkl` (
  `id` int(15) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `deskripsi` varchar(70) NOT NULL,
  `jurusan` text NOT NULL,
  `kuota` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penempatan_pkl`
--

INSERT INTO `penempatan_pkl` (`id`, `posisi`, `deskripsi`, `jurusan`, `kuota`) VALUES
(2, 'Tata Usaha', 'Membantu Pekerjaan di Ruangan Tata Usaha', 'Teknologi Informasi, Desain Komunikasi Visual, Multimedia', 4),
(3, 'Kimia Obat', 'Membantu Pekerjaan di Lab Kimia Obat', 'Farmasi,Analis Farmasi,Kimia,Analis Kimia,Teknologi Kosmetik,SMK Analis Kimia,SMK Analis Farmas, Teknologi Informasi', 2),
(4, 'Kimia Kosmetik', 'Membantu Pekerjaan di Lab Kimia Kosmetik', 'Farmasi,Analis Farmasi,Kimia,Analis Kimia,Teknologi Kosmetik,SMK Analis Kimia,SMK Analis Farmas, Teknologi Informasi', 5),
(5, 'Kimia OTSK', 'Membantu Pekerjaan di Lab Kimia OTSK', 'Farmasi,Analis Farmasi,Kimia,Analis Kimia,Teknologi Kosmetik,SMK Analis Kimia,SMK Analis Farmas, Teknologi Informasi', 3),
(6, 'Kimia Pangan', 'Membantu Pekerjaan di Lab Kimia Pangan', 'Farmasi,Analis Farmasi,Kimia,Analis Kimia,Teknologi Kosmetik,SMK Analis Kimia,SMK Analis Farmas, Teknologi Informasi', 2),
(8, 'inforkom', 'membantu pekerjaan di inforkom', 'Teknologi Informasi , Tekhnik Komputer', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_pkl`
--

CREATE TABLE `pengajuan_pkl` (
  `id_pengajuan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `university` varchar(35) NOT NULL,
  `department` varchar(50) NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `surat` varchar(70) NOT NULL,
  `proposal` varchar(70) NOT NULL,
  `status` varchar(30) NOT NULL,
  `surat_balasan` varchar(100) NOT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_pkl`
--

INSERT INTO `pengajuan_pkl` (`id_pengajuan`, `nama`, `email`, `phone`, `university`, `department`, `posisi`, `periode`, `surat`, `proposal`, `status`, `surat_balasan`, `tanggal_pengajuan`) VALUES
(3, 'mukhlis', 'mukhlis@gmail.com', '082145554182', 'ubg', 'ti', 'Kimia Obat, Kimia Kosmetik, Kimia OTSK', '3 Bulan', '1719829679.pdf', 'Salinan DOKUMEN TEKNIS MSIB Batch 6 (18).pdf', '', '', '2024-07-22 02:30:43'),
(4, 'mukhlis', 'mukhlis@gmail.com', '082145554182', 'ubgg', 'tii', 'Kimia Obat', '2 Bulan', './Asset/Document/Rekomendasi Hosting.pdf', './Asset/Document/1719829679.pdf', '', '', '2024-07-22 02:30:43'),
(5, 'Mukhlis Wardin Juaini', 'mukhlis@gmail.com', '082145554182', 'Bumigora', 'TI', 'Tata Usaha', '2024-07-23 - 2024-07-31', './Asset/Document/199-MUKHLIS WARDIN JUAINI.pdf', './Asset/Document/struk_INV1230046PAS.pdf', 'Diterima', '', '2024-07-15 02:30:43'),
(6, 'Mukhlis Wardin Juaini', 'mukhlis@gmail.com', '082145554182', 'Universitas Bumigora', 'Teknologi Informasi', 'Tata Usaha, Kimia Pangan', '2024-08-01 - 2024-08-31', './Asset/Document/struk_INV1230046PAS.pdf', './Asset/Document/struk_INV1356902PAY.pdf', '', '', '2024-07-29 16:00:00'),
(9, 'Mukhlis Wardin Juaini', 'mukhlis@gmail.com', '082145554182', 'Universitas Bumigora', 'Teknologi Informasi', 'Kimia Kosmetik', '2024-08-01 - 2024-08-31', './Asset/Document/', './Asset/Document/proposal_Mukhlis Wardin Juaini.pdf', '', '', '2024-07-30 08:31:48'),
(10, 'Mukhlis Wardin Juaini', 'mukhlis@gmail.com', '082145554182', 'Universitas Bumigora', 'Teknologi Informasi', 'Tata Usaha, Kimia Obat, Kimia Kosmetik, Kimia OTSK, Kimia Pangan', '2024-09-01 - 2024-09-01', './Asset/Document/surat pengajuan_Mukhlis Wardin Juaini.pdf', './Asset/Document/proposal_Mukhlis Wardin Juaini.pdf', '', '', '2024-07-30 08:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `pkl`
--

CREATE TABLE `pkl` (
  `id` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `foto` text NOT NULL DEFAULT 'Asset/Gambar/profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pkl`
--

INSERT INTO `pkl` (`id`, `nama`, `email`, `no_hp`, `password`, `status`, `foto`) VALUES
(101, 'Mukhlis Wardin Juaini', 'mukhlis@gmail.com', '085338108858', '231221', 'active', 'Asset/Gambar/logo.jpg'),
(102, 'wardin', 'wardin@gmail.com', '085338108858', '231221', '', 'Asset/Gambar/profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `id` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`id`, `nama`, `email`, `no_hp`, `password`) VALUES
(303, '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `narasumber`
--
ALTER TABLE `narasumber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penempatan_pkl`
--
ALTER TABLE `penempatan_pkl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_pkl`
--
ALTER TABLE `pengajuan_pkl`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `pkl`
--
ALTER TABLE `pkl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `narasumber`
--
ALTER TABLE `narasumber`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=602;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penempatan_pkl`
--
ALTER TABLE `penempatan_pkl`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengajuan_pkl`
--
ALTER TABLE `pengajuan_pkl`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pkl`
--
ALTER TABLE `pkl`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
