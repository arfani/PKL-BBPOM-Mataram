-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 04:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `status` enum('hadir','izin','sakit') NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `foto` text NOT NULL,
  `foto_keluar` text DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `latitude_keluar` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `longitude_keluar` decimal(11,8) DEFAULT NULL,
  `waktu_masuk` time DEFAULT NULL,
  `waktu_keluar` time DEFAULT NULL,
  `durasi` time DEFAULT NULL,
  `kesimpulan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `nama`, `status`, `keterangan`, `tanggal`, `foto`, `foto_keluar`, `latitude`, `latitude_keluar`, `longitude`, `longitude_keluar`, `waktu_masuk`, `waktu_keluar`, `durasi`, `kesimpulan`) VALUES
(24, 12, 'bagas adinata', 'hadir', 'Masuk', '2024-11-06', 'pexels-ken123films-1796794.jpg', '', -8.58800000, 0.00000000, 116.11600000, 0.00000000, '14:38:24', NULL, NULL, NULL),
(27, 12, 'bagas adinata', 'hadir', 'Masuk', '2024-11-07', 'pexels-ken123films-1796794.jpg', 'pexels-nicole-avagliano-1132392-2236713.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:14:08', '08:14:15', '00:00:07', 'Waktu Kerja Kurang 8 jam 29 Menit'),
(33, 12, 'bagas adinata', 'hadir', 'Masuk', '2024-11-13', 'images (1).jfif', NULL, -8.58800000, NULL, 116.11600000, NULL, '09:57:30', NULL, NULL, NULL),
(34, 2, 'Ayu Ningsih', 'hadir', 'Masuk', '2024-11-22', '10mb-example-jpg.jpg', 'WhatsApp Image 2024-11-20 at 11.12.52.jpeg', -8.58300000, -8.58800000, 116.10300000, 116.11600000, '13:49:16', '13:52:40', '00:03:24', 'Waktu Kerja Kurang 8 jam 26 Menit'),
(36, 2, 'Ayu Ningsih', 'izin', NULL, '2024-11-29', '10mb-example-jpg.jpg', NULL, NULL, NULL, NULL, NULL, '09:34:38', NULL, NULL, 'asdwasdwasd'),
(37, 12, 'bagas adinata', 'hadir', 'Masuk', '2024-11-29', 'UNRAM-LOGO-FIX-STATUTA-.png', 'pexels-nicole-avagliano-1132392-2236713.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:43:06', '09:43:18', '00:00:12', 'Waktu Kerja Kurang 8 jam 29 Menit');

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
  `no_admin` varchar(20) NOT NULL,
  `no_cs` varchar(20) NOT NULL,
  `jenis` int(2) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `provider`, `api_key`, `private_key`, `merchant_code`, `no_admin`, `no_cs`, `jenis`, `status`) VALUES
(8, 'Fonnte', 'k+tx8CKuASyEbdz!cue+', '', '', '087871500533', '087871500533', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_kuis`
--

CREATE TABLE `hasil_kuis` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis_pertanyaan` varchar(255) DEFAULT NULL,
  `question_text` text DEFAULT NULL,
  `selected_option` char(1) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_kuis`
--

INSERT INTO `hasil_kuis` (`id`, `nama`, `jenis_pertanyaan`, `question_text`, `selected_option`, `is_correct`, `created_at`) VALUES
(61, 'bagas adinata', 'pilihan_ganda', '', 'a', 0, '2024-11-28 07:06:03'),
(62, 'bagas adinata', 'pilihan_ganda', 'apa warna dari gajah', 'D', 0, '2024-11-28 07:06:03'),
(63, 'bagas adinata', 'pilihan_ganda', 'Apa warna buah Mangga', 'A', 1, '2024-11-28 07:06:03'),
(64, 'bagas adinata', 'pilihan_ganda', 'apakah warna dari cangkang telur', 'B', 0, '2024-11-28 07:06:03'),
(65, 'bagas adinata', 'pilihan_ganda', 'apapun', 'a', 0, '2024-11-28 07:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `kuis`
--

CREATE TABLE `kuis` (
  `id` int(11) NOT NULL,
  `posisi` varchar(50) DEFAULT NULL,
  `question_text` text DEFAULT NULL,
  `option_a` text DEFAULT NULL,
  `option_b` text DEFAULT NULL,
  `option_c` text DEFAULT NULL,
  `option_d` text DEFAULT NULL,
  `correct_option` text DEFAULT NULL,
  `jenis_pertanyaan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kuis`
--

INSERT INTO `kuis` (`id`, `posisi`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `jenis_pertanyaan`) VALUES
(14, 'Inforkom', 'apakah warna dari cangkang telur', 'putih', 'kuning', 'coklat', 'abu', 'C', 'pilihan_ganda'),
(15, 'Inforkom', 'apa warna dari gajah', 'coklat', 'kuning', 'Putih', 'abu', 'A', 'pilihan_ganda'),
(16, 'Inforkom', 'Apa warna buah Mangga', 'hijau', 'biru', 'kuning', 'merah', 'A', 'pilihan_ganda'),
(22, 'Inforkom', 'apapun', NULL, NULL, NULL, NULL, NULL, 'uraian');

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan`
--

CREATE TABLE `kunjungan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `instansi` varchar(100) DEFAULT NULL,
  `keperluan` text NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `segmen_peserta` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `surat_masuk` varchar(255) DEFAULT NULL,
  `surat_balasan` varchar(255) DEFAULT NULL,
  `status_kunjungan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`id`, `nama`, `no_hp`, `instansi`, `keperluan`, `jumlah_peserta`, `segmen_peserta`, `tanggal`, `jam`, `surat_masuk`, `surat_balasan`, `status_kunjungan`) VALUES
(5, 'bagas adinata', '087750292514', 'jaghajangangagas', 'narasumber', 24, 'Mahasiswa', '2024-11-11', '11:00:00', './Asset/Document/', './Asset/Document/kunjungan/surat_balasan_bagas adinata.pdf', ''),
(6, 'bagas adinata', '087750292514', 'jaghajangangagas', 'narasumber', 26, 'Mahasiswa', '2024-11-12', '11:00:00', './Asset/Document/surat_pengajuan_kunjungan bagas adinata.pdf', NULL, ''),
(7, 'bagas adinata', '087750292514', 'jaghajangangagas', 'narasumber', 28, 'Mahasiswa', '2024-11-12', '12:00:00', './Asset/Document/surat_pengajuan_kunjungan+bagas+adinata.pdf', NULL, ''),
(8, 'bagas adinata', '087750292514', 'Universitas Mataram', 'kunjungan', 30, 'Mahasiswa', '2024-11-21', '08:02:00', './Asset/Document/surat_pengajuan_kunjungan+bagas+adinata.pdf', NULL, '');

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
(29, 101, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(30, 102, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(32, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(33, 101, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(34, 104, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(35, 101, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(36, 604, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(37, 0, '<div style=\"text-align: justify;\">Posisi PKL Anda di BPOM Mataram sudah diubah.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(38, 0, '<div style=\"text-align: justify;\">Posisi PKL Anda di BPOM Mataram sudah diubah.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(39, 601, '<div style=\"text-align: justify;\">Posisi PKL Anda di BPOM Mataram sudah diubah.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(40, 601, '<div style=\"text-align: justify;\">Posisi PKL Anda di BPOM Mataram sudah diubah.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(41, 601, '<div style=\"text-align: justify;\">Posisi PKL Anda di BPOM Mataram sudah diubah.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(42, 601, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(43, 601, '<div style=\"text-align: justify;\">Posisi PKL Anda di BPOM Mataram sudah diubah.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(44, 602, 'Mohon Maaf Pengajuan PKL Anda di BPOM Mataram Belum Diterima<br>Dengan Alasan km jelek', 'pkl'),
(45, 602, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(46, 602, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(47, 607, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(49, 607, '<div style=\"text-align: justify;\">Selamat Pengajuan PKL Anda di BPOM Mataram sudah diterima.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboardpkl.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(50, 607, '<div style=\"text-align: justify;\">Posisi PKL Anda di BPOM Mataram sudah diubah.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(51, 607, '<div style=\"text-align: justify;\">Posisi PKL Anda di BPOM Mataram sudah diubah.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(52, 601, '<div style=\"text-align: justify;\">Posisi PKL Anda di BPOM Mataram sudah diubah.<br>Silakan mengunjungi dashboard PKL berikut untuk informasi lengkapnya.</div><div class=\"text-center mt-1\"><a href=\"dashboard_pkl_.php\" style=\"font-size: 12px; padding: 4px 7px; margin: 0px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;\">Dashboard PKL</a></div>', 'pkl'),
(53, 9, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(54, 9, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(55, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(56, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(57, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(58, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(59, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(60, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(61, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(62, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(63, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(64, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(65, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(66, 12, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl');

-- --------------------------------------------------------

--
-- Table structure for table `penempatan_pkl`
--

CREATE TABLE `penempatan_pkl` (
  `id` int(15) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `deskripsi` varchar(70) NOT NULL,
  `jurusan` text NOT NULL,
  `kuota` int(5) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penempatan_pkl`
--

INSERT INTO `penempatan_pkl` (`id`, `posisi`, `deskripsi`, `jurusan`, `kuota`, `gambar`) VALUES
(8, 'Inforkom', 'membantu pekerjaan di inforkom', 'Teknologi Informasi , Tekhnik Komputer', 3, ''),
(9, 'Penyidik', 'Membantu bidang penyidikan', 'Hukum, Teknologi', 2, ''),
(10, 'Tata Usaha', 'membantu Pekerjaan di tata Usaha', 'Informatika', 4, ''),
(11, 'kimia', 'coba coba', 'farmasi', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `subject` enum('obat','obat bahan alam','suplemen kesehatan','kosmetik','pangan olahan','lainnya') NOT NULL,
  `pesan` text NOT NULL,
  `foto_ktp` text DEFAULT NULL,
  `foto_pengaduan` text DEFAULT NULL,
  `jam` time NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `tanggal`, `nama`, `alamat`, `no_hp`, `subject`, `pesan`, `foto_ktp`, `foto_pengaduan`, `jam`, `status`, `keterangan`) VALUES
(1, '2024-11-08', 'bagas adinata', 'bagasadinata321@gmail.com', '', 'kosmetik', '2sdasdwasda', NULL, NULL, '10:00:10', NULL, NULL),
(2, '2024-11-08', 'bagas adinata', 'bagasadinata321@gmail.com', '', 'kosmetik', 'asdwasdwas', NULL, NULL, '10:07:46', NULL, NULL),
(3, '2024-11-08', 'Bagas Adinata', 'bagasadinata321@gmail.com', '', 'kosmetik', 'asdwasdwas', NULL, NULL, '10:08:31', NULL, NULL),
(4, '2024-11-08', 'bagas adinata', 'bagasadinata321@gmail.com', '', 'obat', 'asdwasdwasd', NULL, NULL, '10:26:12', NULL, NULL),
(5, '2024-11-08', 'bagas adinata', 'bagasadinata321@gmail.com', '', 'obat', 'asdwasd', NULL, NULL, '10:30:55', NULL, NULL),
(6, '2024-11-08', 'bagas adinata', 'bagasadinata321@gmail.com', '', 'obat', 'asdwasd', NULL, NULL, '10:33:39', NULL, NULL),
(7, '2024-11-08', 'Bagas Adinata', 'bagasadinata321@gmail.com', '087750292514', 'kosmetik', 'adwasdwasd', NULL, NULL, '14:57:45', NULL, NULL),
(8, '2024-11-15', 'bagas adinata', 'bagasadinata321@gmail.com', '087750292514', 'kosmetik', 'asdwadswasdwa', NULL, NULL, '09:17:26', 'diterima', NULL),
(9, '2024-11-15', 'bagas adinata', 'bagasadinata321@gmail.com', '087750292514', 'kosmetik', 'asdwasdwasdwadasdwasdwa', 'si inges (1).png', 'si solah (1).png', '09:54:40', 'ditolak', NULL),
(10, '2024-11-15', 'bagas adinata', 'jalanpendidikan', '087750292514', 'pangan olahan', 'anfjafajdnjagnasdmawsdwasdwasd', 'si inges (2).png', 'si solah (1).png', '13:33:33', NULL, NULL);

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
  `nim` varchar(50) DEFAULT NULL,
  `posisi` varchar(100) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `surat` varchar(70) NOT NULL,
  `proposal` varchar(70) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `surat_balasan` varchar(100) DEFAULT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `penempatan` varchar(50) DEFAULT NULL,
  `laporan_akhir` text DEFAULT NULL,
  `sertifikat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_pkl`
--

INSERT INTO `pengajuan_pkl` (`id_pengajuan`, `nama`, `email`, `phone`, `university`, `department`, `nim`, `posisi`, `periode`, `surat`, `proposal`, `status`, `surat_balasan`, `tanggal_pengajuan`, `penempatan`, `laporan_akhir`, `sertifikat`) VALUES
(11, 'wardin', 'wardin@gmail.com', '085338108858', 'Universitas Bumigora', 'Desain Komunikasi Visual', NULL, 'Kimia Kosmetik', '2024-08-08 - 2024-09-08', './Asset/Document/surat pengajuan_wardin.pdf', './Asset/Document/proposal_wardin.pdf', 'Ditolak', 'km jelek', '2024-08-02 01:47:09', '', '', ''),
(13, 'Ardha', 'ardha@gmail.com', '08555555554', 'Universitas Bumigora', 'Teknologi Informasi', NULL, 'Tata Usaha', '2024-08-01 - 2024-08-31', './Asset/Document/surat pengajuan_Ardha.pdf', './Asset/Document/proposal_Ardha.pdf', 'Diterima', './Asset/Document/surat_balasan_Ardha.pdf', '2024-08-06 00:21:09', 'Tata Usaha', '', ''),
(14, 'Mukhlis Wardin Juaini', 'mukhliswj@gmail.com', '082145554182', 'Universitas Bumigora', 'Teknologi Informasi', NULL, 'kimia', '2024-08-07 - 2024-08-13', './Asset/Document/surat_pengajuan_Mukhlis Wardin Juaini.pdf', './Asset/Document/proposal_Mukhlis Wardin Juaini.pdf', 'Diterima', './Asset/Document/surat_balasan_Mukhlis Wardin Juaini.pdf', '2024-08-06 03:47:22', 'Kimia OTSK', 'Asset/Document/laporan_Mukhlis Wardin Juainipdf', './Asset/certificates/sertifikat_MUKHLIS WARDIN JUAINI.pdf'),
(15, 'Ayu Ningsih', 'wardin@gmail.com', '085338108858', 'Universitas Bumigora', 'TI', NULL, 'Inforkom', '2024-08-01 - 2024-08-31', './Asset/Document/surat_pengajuan_Ayu Ningsih.pdf', './Asset/Document/proposal_Ayu Ningsih.pdf', 'Diterima', './Asset/Document/surat_balasan_Ayu Ningsih.pdf', '2024-08-12 04:39:28', 'Kimia Kosmetik', '', ''),
(16, 'Ayu Ningsih', 'ayu@gmail.com', '08214554182', 'Universitas Bumigora', 'Desain Komunikasi Visual', NULL, 'Inforkom', '2024-09-01 - 2024-09-30', './Asset/Document/surat_pengajuan_ayuni.pdf', './Asset/Document/proposal_ayuni.pdf', 'Diterima', './Asset/Document/surat_balasan_Ayu Ningsih.pdf', '2024-08-23 14:04:22', 'Inforkom', '', ''),
(28, 'bagas adinata', 'bagasadinata321@gmail.com', '087750292514', '', 'Informatika', 'F1D020011', 'Inforkom', '2024-09-30 - 2024-12-03', './Asset/Document/surat_pengajuan_bagas+adinata.pdf', './Asset/Document/proposal_bagas+adinata.pdf', 'Pending', NULL, '2024-11-27 03:33:11', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_seo`
--

CREATE TABLE `tb_seo` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'logo.png',
  `instansi` text NOT NULL,
  `keyword` text NOT NULL,
  `deskripsi` text NOT NULL,
  `template` int(11) NOT NULL,
  `warna` int(2) NOT NULL,
  `footer` int(2) NOT NULL,
  `urlweb` text NOT NULL,
  `user` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_seo`
--

INSERT INTO `tb_seo` (`id`, `image`, `instansi`, `keyword`, `deskripsi`, `template`, `warna`, `footer`, `urlweb`, `user`, `date`) VALUES
(1, 'logo_admin_20241801142644.png', 'Dragon Store', 'Top Up Game Murah, Joki Mobile Legend dan Layanan Booster Social Media, Instant 24 Jam, Mobile Legends, Diamond Mobile Legends, Free Fire, DM FF,  Mobile, PUBGM, Genshin Impact, CODM, Valorant, Wild Rift', 'Dragon Store Adalah Tempat Top Up Game Murah, Joki Mobile Legends dan Booster Media Yang Aman, Murah dan Terpercaya. Menyediakan Layanan Top Up Games, Joki Mobile Legends, Booster Social Media. Untuk Mempermudah Pembayaran Anda Disini Kami Juga Menyediakan Berbagai Macam Metode Pembayaran', 2, 3, 2, 'http://localhost/PKL-BBPOM-Mataram/', 'admin', '2024-01-17 20:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_slide`
--

CREATE TABLE `tb_slide` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `sort` int(11) NOT NULL,
  `user` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_slide`
--

INSERT INTO `tb_slide` (`id`, `image`, `deskripsi`, `sort`, `user`, `status`) VALUES
(31, 'slide_20240822014840.jpg', 'olahraga', 4, '', 1),
(29, 'slide_20240822013710.jpg', 'dragon store', 1, '', 1),
(30, 'slide_20240822014811.jpg', 'hhhhhhhh', 2, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `universitas` varchar(255) DEFAULT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `universitas`, `no_hp`, `password`, `status`, `foto`) VALUES
(1, 'Mukhlis Wardin Juaini', 'mukhliswj@gmail.com', NULL, '082145554182', '231221', 'done', 'Asset/Gambar/profile_Mukhlis Wardin Juaini.png'),
(2, 'Ayu Ningsih', 'wardin@gmail.com', NULL, '085338108858', '231221', 'done', 'Asset/Gambar/profile.png'),
(3, 'Ardha', 'ardha@gmail.com', NULL, '08555555554', '231221', 'done', 'Asset/Gambar/profile.png'),
(4, 'mukhlis wj', 'mukhliswardinjuaini@gmail.com', NULL, '082145554185', '231221', '', 'Asset/Gambar/profile.png'),
(5, 'Ayu Ningsih', 'ayu@gmail.com', NULL, '08214554182', '231221', 'active', 'Asset/Gambar/20240316_103510.png'),
(6, 'arda', 'arda@gmail.com', NULL, '0888888', '231221', 'active', 'Asset/Gambar/profile.png'),
(8, 'nama', 'email@gmail.com', NULL, '12345678', '231221', '', ''),
(12, 'bagas adinata', 'bagasadinata321@gmail.com', 'Universitas Mataram', '087750292514', '1234', 'active', 'Asset/Gambar/profile.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `hasil_kuis`
--
ALTER TABLE `hasil_kuis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuis`
--
ALTER TABLE `kuis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_hp` (`no_hp`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penempatan_pkl`
--
ALTER TABLE `penempatan_pkl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posisi` (`posisi`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_pkl`
--
ALTER TABLE `pengajuan_pkl`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `nama` (`nama`),
  ADD KEY `email` (`email`),
  ADD KEY `phone` (`phone`);

--
-- Indexes for table `tb_seo`
--
ALTER TABLE `tb_seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_slide`
--
ALTER TABLE `tb_slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_hp` (`no_hp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
-- AUTO_INCREMENT for table `hasil_kuis`
--
ALTER TABLE `hasil_kuis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `kuis`
--
ALTER TABLE `kuis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `penempatan_pkl`
--
ALTER TABLE `penempatan_pkl`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengajuan_pkl`
--
ALTER TABLE `pengajuan_pkl`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_seo`
--
ALTER TABLE `tb_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_slide`
--
ALTER TABLE `tb_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `kunjungan`
--
ALTER TABLE `kunjungan`
  ADD CONSTRAINT `kunjungan_ibfk_1` FOREIGN KEY (`no_hp`) REFERENCES `users` (`no_hp`) ON DELETE SET NULL;

--
-- Constraints for table `pengajuan_pkl`
--
ALTER TABLE `pengajuan_pkl`
  ADD CONSTRAINT `pengajuan_pkl_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_pkl_ibfk_2` FOREIGN KEY (`phone`) REFERENCES `users` (`no_hp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
