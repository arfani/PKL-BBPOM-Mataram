-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 08:00 AM
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
-- Database: `bbpo_pkl`
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
(22, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-06', 'IMG_20241106_080516_691.jpg', NULL, -8.58781700, NULL, 116.11604630, NULL, '12:07:42', NULL, NULL, NULL),
(23, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-06', 'WhatsApp Image 2024-09-24 at 15.57.41_c055dfb2.jpg', NULL, -8.57711560, NULL, 116.12337560, NULL, '12:10:39', NULL, NULL, NULL),
(24, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-06', '17308677208351805825081942702294.jpg', NULL, -8.58782090, NULL, 116.11606170, NULL, '12:36:02', NULL, NULL, NULL),
(25, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-06', '17308681197603706332078041573116.jpg', NULL, -8.58780630, NULL, 116.11603510, NULL, '12:42:34', NULL, NULL, NULL),
(26, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-06', 'CamScanner 30-10-2024 15.09_10 (1).jpg', NULL, -8.58781390, NULL, 116.11605320, NULL, '12:50:40', NULL, NULL, NULL),
(27, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-06', '17308691720138164800871067560910.jpg', NULL, -8.58783820, NULL, 116.11658960, NULL, '13:01:10', NULL, NULL, NULL),
(28, 20, 'Sara Paulina Baransano', 'hadir', 'Masuk', '2024-11-06', 'image.jpg', NULL, -8.58771512, NULL, 116.11612776, NULL, '14:04:28', NULL, NULL, NULL),
(29, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-11-06', '17308766435934238892380079254193.jpg', NULL, -8.58789260, NULL, 116.11611400, NULL, '15:04:26', NULL, NULL, NULL),
(30, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-11-06', '17308768077245040940601948166458.jpg', NULL, -8.58781230, NULL, 116.11599580, NULL, '15:07:01', NULL, NULL, NULL),
(31, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-06', 'IMG_8268.jpeg', NULL, -8.58774549, NULL, 116.11623864, NULL, '16:14:39', NULL, NULL, NULL),
(32, 10, 'bagas adinata', 'hadir', 'Masuk', '2024-11-06', 'IMG-20241106-WA0015.jpg', NULL, -8.55855856, NULL, 116.10370924, NULL, '19:50:36', NULL, NULL, NULL),
(33, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-11-07', '17309376331417720672447292956138.jpg', '17309686230437352879826531583674.jpg', -8.58780820, -8.58800000, 116.11602000, 116.11600000, '08:00:48', '16:37:30', '08:36:42', 'Waktu Kerja Sudah cukup'),
(34, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-07', 'IMG_20241107_075954_456.jpg', 'IMG-20241107-WA0065.jpg', -8.58781740, -8.58800000, 116.11605170, 116.11600000, '08:01:08', '16:35:21', '08:34:13', 'Waktu Kerja Sudah cukup'),
(35, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-07', '1000192681.jpg', '1000192858.jpg', -8.58782250, -8.58800000, 116.11605700, 116.11600000, '08:02:45', '16:37:07', '08:34:22', 'Waktu Kerja Sudah cukup'),
(36, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-07', '17309377884776098181501266609373.jpg', '17309693894114057146171710534980.jpg', -8.58780880, -8.58800000, 116.11606170, 116.11600000, '08:03:34', '16:50:15', '08:46:41', 'Waktu Kerja Sudah cukup'),
(37, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-07', '17309379050594889618207149401541.jpg', NULL, -8.58782470, NULL, 116.11600410, NULL, '08:05:15', NULL, NULL, NULL),
(38, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-07', 'image.jpg', 'image.jpg', -8.58774547, -8.58800000, 116.11623842, 116.11600000, '08:07:06', '16:41:43', '08:34:37', 'Waktu Kerja Sudah cukup'),
(39, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-07', 'image.jpg', 'image.jpg', -8.58763263, -8.58800000, 116.11584096, 116.11600000, '08:08:28', '16:39:01', '08:30:33', 'Waktu Kerja Sudah cukup'),
(40, 10, 'bagas adinata', 'hadir', 'Masuk', '2024-11-07', '17309391215891109470070798429835.jpg', '17309668261624669135579876546551.jpg', -8.59459459, -8.59500000, 116.11472293, 116.11500000, '08:27:57', '16:07:22', '07:39:25', 'Waktu Kerja Kurang 50 Menit'),
(41, 20, 'Sara Paulina Baransano', 'hadir', 'Masuk', '2024-11-07', 'image.jpg', NULL, -8.58761925, NULL, 116.11591044, NULL, '08:52:48', NULL, NULL, NULL),
(42, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-07', '17309406135383799931360128829692.jpg', '17309693722484438408217411975752.jpg', -8.58752280, -8.59800000, 116.11551780, 116.12900000, '08:50:31', '16:49:58', '07:59:27', 'Waktu Kerja Kurang 30 Menit'),
(43, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-11-07', '17309409463412283670234032387466.jpg', '17309687039844295579655612247552.jpg', -8.58779270, -8.58800000, 116.11569020, 116.11600000, '08:55:57', '16:38:35', '07:42:38', 'Waktu Kerja Kurang 47 Menit'),
(44, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-11-07', 'IMG-20241107-WA0000.jpg', NULL, -8.58782020, NULL, 116.11607420, NULL, '12:51:57', NULL, NULL, NULL),
(45, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-08', 'IMG_20241108_084412_086.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:44:20', NULL, NULL, NULL),
(46, 20, 'Sara Paulina Baransano', 'hadir', 'Masuk', '2024-11-08', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:44:40', NULL, NULL, NULL),
(47, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-08', '1000193082.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:44:48', NULL, NULL, NULL),
(48, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-08', '17310267034706330920665640344943.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:45:23', NULL, NULL, NULL),
(49, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-08', '1731026785155427104602223926314.jpg', NULL, -8.60300000, NULL, 116.13800000, NULL, '08:46:37', NULL, NULL, NULL),
(50, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-08', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:50:07', NULL, NULL, NULL),
(51, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-08', '1731027355013424955599396234600.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:56:06', NULL, NULL, NULL),
(52, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-11-08', '17310285882893974230838983929988.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '09:16:39', NULL, NULL, NULL),
(53, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-12', 'IMG_20241108_154638_119.webp', 'IMG_20241108_155011_080.webp', -8.60300000, -8.60300000, 116.13800000, 116.13800000, '17:02:15', '17:02:38', '00:00:23', 'Waktu Kerja Kurang 8 jam 29 Menit'),
(54, 10, 'bagas adinata', 'hadir', 'Masuk', '2024-11-12', '17314067072022796014261502103663.jpg', '17314067712162482990694153516736.jpg', -8.56700000, -8.56700000, 116.10700000, 116.10700000, '18:18:33', '18:19:38', '00:01:05', 'Waktu Kerja Kurang 8 jam 28 Menit'),
(55, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-12', 'IMG_8399.jpeg', 'b5a46015-8e50-4fa7-823b-a749cfd9315d.jpeg', -8.58600000, -8.58600000, 116.11300000, 116.11300000, '19:01:55', '19:02:46', '00:00:51', 'Waktu Kerja Kurang 8 jam 29 Menit'),
(56, 20, 'Sara Paulina Baransano', 'hadir', 'Masuk', '2024-11-12', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:20:13', NULL, NULL, NULL),
(57, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-12', '17314552740357720969528657194947.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:48:17', NULL, NULL, NULL),
(58, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-12', '17314553960448048743115375860601.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:50:07', NULL, NULL, NULL),
(59, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-13', 'IMG_20241112_075240_714.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:04:32', NULL, NULL, NULL),
(60, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-13', 'IMG-20241113-WA0001.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:05:20', NULL, NULL, NULL),
(61, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-13', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:06:50', NULL, NULL, NULL),
(62, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-11-13', '17314564992797394997621535990509.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:08:28', NULL, NULL, NULL),
(63, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-11-13', '1731456578584291435736633712127.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:09:50', NULL, NULL, NULL),
(64, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-13', 'IMG_20241108_155011_080.webp', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:24:28', NULL, NULL, NULL),
(65, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-13', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:39:32', NULL, NULL, NULL),
(66, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-15', '1000195065.jpg', '1000194504.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:40:17', '16:02:50', '07:22:33', 'Waktu Kerja Kurang 1 jam 7 Menit'),
(67, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-15', 'IMG-20241115-WA0001.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:41:35', NULL, NULL, NULL),
(68, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-15', 'IMG_20241115_084421_340.jpg', 'IMG_20241115_084421_340.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:44:40', '16:02:36', '07:17:56', 'Waktu Kerja Kurang 1 jam 12 Menit'),
(69, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-15', 'IMG_20241108_155011_080.webp', 'IMG_20241108_154638_119.webp', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:41:47', '16:00:12', '07:18:25', 'Waktu Kerja Kurang 1 jam 11 Menit'),
(70, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-15', '17316316517392576729846096997388.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:47:42', NULL, NULL, NULL),
(71, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-15', '17316318274853792047165105179486.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:50:36', NULL, NULL, NULL),
(72, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-17', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:57:22', NULL, NULL, NULL),
(73, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-18', '17318879459684622638377961360905.jpg', '17319185458686718839988397915267.jpg', -8.60300000, -8.58800000, 116.13800000, 116.11600000, '07:59:41', '16:29:25', '08:29:44', 'Waktu Kerja Kurang 0 Menit'),
(74, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-18', '1000195064.jpg', '1000196710.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:04:18', '16:31:27', '08:27:09', 'Waktu Kerja Kurang 2 Menit'),
(75, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-18', 'IMG-20241118-WA0001.jpg', 'IMG-20241118-WA0010.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:03', '16:31:59', '08:26:56', 'Waktu Kerja Kurang 3 Menit'),
(76, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-11-18', '1731888321910474520701822803172.jpg', '17319192247325432213659593453791.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:35', '16:40:39', '08:35:04', 'Waktu Kerja Sudah cukup'),
(77, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-11-18', '17318883819176305735945158955895.jpg', '17319192143292616313129906312486.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:06:42', '16:40:38', '08:33:56', 'Waktu Kerja Sudah cukup'),
(78, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-18', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:11:39', '16:33:31', '08:21:52', 'Waktu Kerja Kurang 8 Menit'),
(79, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-18', '1000196546.jpg', 'IMG_20241118_081321_729.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:11:42', '16:33:04', '08:21:22', 'Waktu Kerja Kurang 8 Menit'),
(80, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-18', '17318899537116230973240793516860.jpg', '17319187614682575624413353514735.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:32:43', '16:32:55', '08:00:12', 'Waktu Kerja Kurang 29 Menit'),
(81, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-11-18', 'IMG20241118093638.jpg', 'IMG20241118164158.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:37:29', '16:44:58', '07:07:29', 'Waktu Kerja Kurang 1 jam 22 Menit'),
(82, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-11-18', '17318939705978967044924837700495.jpg', '17319196615894596482884143888394.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:39:59', '16:48:00', '07:08:01', 'Waktu Kerja Kurang 1 jam 21 Menit'),
(83, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-18', '17319189500187108699483707119471.jpg', '17319190342115886084031681202889.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '16:35:59', '16:37:25', '00:01:26', 'Waktu Kerja Kurang 8 jam 28 Menit'),
(84, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-18', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:55:53', NULL, NULL, NULL),
(85, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-19', 'IMG_8621.jpeg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:00:27', '16:34:02', '08:33:35', 'Waktu Kerja Sudah cukup'),
(86, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-19', '17319745822541112908987171590735.jpg', '17320051161976373588128933320248.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:03:17', '16:32:17', '08:29:00', 'Waktu Kerja Kurang 1 Menit'),
(87, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-19', '17319747153551868809745861463896.jpg', '1732005257708232720848928778562.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:24', '16:34:34', '08:29:10', 'Waktu Kerja Kurang 0 Menit'),
(88, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-19', '1000195064.jpg', '1000196710.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:06:14', '16:31:30', '08:25:16', 'Waktu Kerja Kurang 4 Menit'),
(89, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-19', 'IMG_20241119_080622_625.jpg', 'IMG_20241119_080622_625.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:06:28', '16:34:36', '08:28:08', 'Waktu Kerja Kurang 1 Menit'),
(90, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-19', 'IMG-20241119-WA0001.jpg', 'IMG-20241119-WA0003.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:14:35', '16:31:36', '08:17:01', 'Waktu Kerja Kurang 12 Menit'),
(91, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-11-19', '17319752689022948287507163450395.jpg', 'IMG_20241119_162148_740.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:14:46', '16:32:30', '08:17:44', 'Waktu Kerja Kurang 12 Menit'),
(92, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-11-19', '17319753738584556979215557031083.jpg', '17320056545398506292072196708745.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:16:32', '16:41:15', '08:24:43', 'Waktu Kerja Kurang 5 Menit'),
(93, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-11-19', 'IMG20241119081734.jpg', '17320059955944491232091029127104.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:24:40', '16:47:05', '08:22:25', 'Waktu Kerja Kurang 7 Menit'),
(94, 10, 'bagas adinata', 'hadir', 'Masuk', '2024-11-19', 'WhatsApp Image 2024-11-19 at 07.50.11.jpeg', '17320056250631430415050290227828.jpg', -8.58800000, -8.59500000, 116.11600000, 116.11500000, '07:50:59', '16:40:34', '08:49:35', 'Waktu Kerja Sudah cukup'),
(95, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-11-19', 'IMG20241119091324.jpg', 'IMG20241119164609.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:14:39', '16:47:57', '07:33:18', 'Waktu Kerja Kurang 56 Menit'),
(96, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-19', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '16:34:08', '16:34:45', '00:00:37', 'Waktu Kerja Kurang 8 jam 29 Menit'),
(97, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-19', '17320604553284119566767555935611.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:54:30', NULL, NULL, NULL),
(98, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-20', '17320606414085592010893408381759.jpg', '17320914975246875345349051337759.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '07:57:33', '16:33:20', '08:35:47', 'Waktu Kerja Sudah cukup'),
(99, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-20', 'image.jpg', NULL, -8.58800000, NULL, 116.11700000, NULL, '08:00:51', NULL, NULL, NULL),
(100, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-20', '17320608468901619767191065194114.jpg', '17320917900782390108272980649124.jpg', -8.58700000, -8.58800000, 116.11600000, 116.11600000, '08:00:56', '16:36:53', '08:35:57', 'Waktu Kerja Sudah cukup'),
(101, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-11-20', '17320609112027027258193141912845.jpg', '17320921439958649382817078509109.jpg', -8.58700000, -8.58800000, 116.11600000, 116.11600000, '08:02:22', '16:43:06', '08:40:44', 'Waktu Kerja Sudah cukup'),
(102, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-20', 'IMG_20241120_080827_696.jpg', 'IMG_20241120_084847_643.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:08:48', '16:32:56', '08:24:08', 'Waktu Kerja Kurang 5 Menit'),
(103, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-11-20', 'IMG_20241120_080845_624.webp', 'IMG20241120163825.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:10:18', '16:44:49', '08:34:31', 'Waktu Kerja Sudah cukup'),
(104, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-20', 'IMG-20241120-WA0002.jpg', '17320918328507386966781824779450.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:10:37', '16:37:34', '08:26:57', 'Waktu Kerja Kurang 3 Menit'),
(105, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-20', '1000195066.jpg', '1000195064.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:10:45', '16:35:14', '08:24:29', 'Waktu Kerja Kurang 5 Menit'),
(106, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-20', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:14:40', '16:33:01', '08:18:21', 'Waktu Kerja Kurang 11 Menit'),
(107, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-11-20', '17320616758625435134507347836917.jpg', '17320922699307577419474329240420.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:14:47', '16:44:47', '08:30:00', 'Waktu Kerja Sudah cukup'),
(108, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-21', '17321472093438435274626494023693.jpg', '17321781063348344033905867389071.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:00:25', '16:35:28', '08:35:03', 'Waktu Kerja Sudah cukup'),
(109, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-11-21', '17321472315954239887921919731098.jpg', '17321782142607943379338367655736.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:00:46', '16:37:22', '08:36:36', 'Waktu Kerja Sudah cukup'),
(110, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-21', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:00:48', '16:43:28', '08:42:40', 'Waktu Kerja Sudah cukup'),
(111, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-21', 'IMG-20241121-WA0001.jpg', 'IMG-20241121-WA0027.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:01:02', '16:35:18', '08:34:16', 'Waktu Kerja Sudah cukup'),
(112, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-21', 'IMG_20241121_080055_795.jpg', 'IMG_20241121_080055_795.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:01:13', '16:31:12', '08:29:59', 'Waktu Kerja Kurang 0 Menit'),
(113, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-11-21', '17321472667383988864420254677141.jpg', 'IMG20241121163950.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:01:30', '16:42:51', '08:41:21', 'Waktu Kerja Sudah cukup'),
(114, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-21', '17321471744931780065895437006030.jpg', 'IMG_20241108_154638_119.webp', -8.58800000, -8.58800000, 116.11700000, 116.11600000, '07:59:42', '16:29:33', '08:29:51', 'Waktu Kerja Kurang 0 Menit'),
(115, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-11-21', '17321473685015086089095454594584.jpg', '17321785572288852649759097120719.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:03:06', '16:42:50', '08:39:44', 'Waktu Kerja Sudah cukup'),
(116, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-21', '1000195064.jpg', '1000192681.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:09', '16:35:46', '08:30:37', 'Waktu Kerja Sudah cukup'),
(117, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-21', '17321473616438297783115432194878.jpg', '17321779628885907520938680690151.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:02:56', '16:33:05', '08:30:09', 'Waktu Kerja Sudah cukup'),
(118, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-21', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:06:08', '16:42:11', '08:36:03', 'Waktu Kerja Sudah cukup'),
(119, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-11-21', '17321476487625162535525341206584.jpg', '1732178313779903505552048427129.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:07:39', '16:38:42', '08:31:03', 'Waktu Kerja Sudah cukup'),
(120, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-22', '1000195066.jpg', '1000195065.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:09:15', '16:04:37', '07:55:22', 'Waktu Kerja Kurang 34 Menit'),
(121, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-22', 'image.jpg', 'image.jpg', -8.58800000, -8.58700000, 116.11600000, 116.11300000, '08:37:14', '17:05:48', '08:28:34', 'Waktu Kerja Kurang 1 Menit'),
(122, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-22', '173223580718848212122789876225.jpg', '17322628190822210076072210472366.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:37:29', '16:07:15', '07:29:46', 'Waktu Kerja Kurang 1 jam 0 Menit'),
(123, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-11-22', '17322359157154973467995389147781.jpg', '1732263253806821942665178581485.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:39:04', '16:15:03', '07:35:59', 'Waktu Kerja Kurang 54 Menit'),
(124, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-22', 'IMG_20241122_083952_663.jpg', 'IMG_20241122_083952_663.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:39:59', '16:10:23', '07:30:24', 'Waktu Kerja Kurang 59 Menit'),
(125, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-11-22', 'IMG20241122083824.jpg', 'IMG20241122161146.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:40:11', '16:14:11', '07:34:00', 'Waktu Kerja Kurang 56 Menit'),
(126, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-22', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:40:34', '16:02:38', '07:22:04', 'Waktu Kerja Kurang 1 jam 7 Menit'),
(127, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-22', '17322360345037067553455330946403.jpg', '17322628955261490512593455442476.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:40:53', '16:08:33', '07:27:40', 'Waktu Kerja Kurang 1 jam 2 Menit'),
(128, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-11-22', '17322363198834383041938107184006.jpg', '17322625898827733093677997720931.jpg', -8.58600000, -8.58800000, 116.11700000, 116.11600000, '08:45:42', '16:03:30', '07:17:48', 'Waktu Kerja Kurang 1 jam 12 Menit'),
(129, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-22', '17322361863561627653187551751805.jpg', '17322628758301337079496457871876.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:43:17', '16:08:09', '07:24:52', 'Waktu Kerja Kurang 1 jam 5 Menit'),
(130, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-11-22', '17322363999582194422311915205707.jpg', '17322626587404668865181378396711.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:46:51', '16:04:26', '07:17:35', 'Waktu Kerja Kurang 1 jam 12 Menit'),
(131, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-22', '1000197882.jpg', '17322628263407193093077546450171.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:54:17', '16:07:24', '07:13:07', 'Waktu Kerja Kurang 1 jam 16 Menit'),
(132, 10, 'bagas adinata', 'hadir', 'Masuk', '2024-11-22', 'WhatsApp Image 2024-11-20 at 11.12.52.jpeg', NULL, -8.58800000, NULL, 116.11600000, NULL, '13:53:58', NULL, NULL, NULL),
(133, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-24', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:47:53', NULL, NULL, NULL),
(134, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-24', '17324925106326080714528382106331.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:55:40', NULL, NULL, NULL),
(135, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-11-24', 'IMG20241125075136.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:55:54', NULL, NULL, NULL),
(136, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-11-24', '17324926107556077675699317905157.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:57:18', NULL, NULL, NULL),
(137, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-11-24', '17324927097907758684744680281623.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:58:48', NULL, NULL, NULL),
(138, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-25', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:00:54', '16:36:51', '08:35:57', 'Waktu Kerja Sudah cukup'),
(139, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-25', '17324928545831256211038618033437.jpg', '17325235744748704373142694353146.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:01:08', '16:33:39', '08:32:31', 'Waktu Kerja Sudah cukup'),
(140, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-25', '1000195066.jpg', '1000198745.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:04:36', '16:34:14', '08:29:38', 'Waktu Kerja Kurang 0 Menit'),
(141, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-25', 'IMG_20241125_080523_028.jpg', 'IMG_20241125_163217_671.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:32', '16:32:40', '08:27:08', 'Waktu Kerja Kurang 2 Menit'),
(142, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-25', '17324936058695545520086910854889.jpg', '17325237725205968478428243258391.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:13:33', '16:36:27', '08:22:54', 'Waktu Kerja Kurang 7 Menit'),
(143, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-11-25', '1732493661856353665020603559723.jpg', '1732524008550313032627622233701.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:14:33', '16:40:16', '08:25:43', 'Waktu Kerja Kurang 4 Menit'),
(144, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-25', '17324937139861620330849081671886.jpg', '17325235694386428863759956450290.jpg', -8.60800000, -8.58800000, 116.14400000, 116.11600000, '08:15:27', '16:33:06', '08:17:39', 'Waktu Kerja Kurang 12 Menit'),
(145, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-11-25', '17325236196458868452203033257361.jpg', '1732523647654127924314892831924.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '16:33:50', '16:34:25', '00:00:35', 'Waktu Kerja Kurang 8 jam 29 Menit'),
(146, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-11-25', '17325247880763873776869830640804.jpg', '17325248162967961314200540374428.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '16:53:16', '16:53:43', '00:00:27', 'Waktu Kerja Kurang 8 jam 29 Menit'),
(147, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-11-25', '17325248947496958213776366507583.jpg', '17325249098918636079727194556249.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '16:55:02', '16:55:17', '00:00:15', 'Waktu Kerja Kurang 8 jam 29 Menit'),
(148, 23, 'Nurullayyinah', 'hadir', 'Masuk', '2024-11-26', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:00:27', '16:33:52', '08:33:25', 'Waktu Kerja Sudah cukup'),
(149, 17, 'Dela febrianti', 'izin', 'Masuk', '2024-11-26', 'IMG-20241126-WA0001.jpg', 'IMG-20241126-WA0001.jpg', -8.60200000, -8.60200000, 116.12000000, 116.12000000, '08:01:23', '16:52:38', '08:51:15', 'Waktu Kerja Sudah cukup'),
(150, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-11-26', 'IMG_20241126_080422_226.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:04:57', NULL, NULL, NULL),
(151, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-11-26', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:05:30', NULL, NULL, NULL),
(152, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-26', '1000197882.jpg', '1000199129.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:38', '16:32:51', '08:27:13', 'Waktu Kerja Kurang 2 Menit'),
(153, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-26', '1000196710.jpg', '1000196710.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:06:21', '16:34:50', '08:28:29', 'Waktu Kerja Kurang 1 Menit'),
(154, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-11-26', 'IMG_20241126_083202.JPG', NULL, -8.49100000, NULL, 116.67600000, NULL, '08:32:37', NULL, NULL, NULL),
(155, 16, 'Nurul ramadanniah ', 'izin', 'Masuk', '2024-11-26', 'Screenshot_20241125-155726.png', NULL, -8.49100000, NULL, 116.67600000, NULL, '08:33:23', NULL, NULL, NULL),
(156, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-26', '17325815466776765569009858068644.jpg', NULL, -8.61000000, NULL, 116.14300000, NULL, '08:39:17', NULL, NULL, NULL),
(157, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-27', 'IMG-20241126-WA0001.jpg', NULL, -8.60200000, NULL, 116.12000000, NULL, '08:57:09', NULL, NULL, NULL),
(158, 18, 'Fathin Furaidah', 'izin', 'Masuk', '2024-11-27', 'IMG_20241126_083202.JPG', NULL, -8.73500000, NULL, 117.36700000, NULL, '07:57:21', NULL, NULL, NULL),
(159, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-28', 'IMG-20241126-WA0001.jpg', 'IMG-20241126-WA0001.jpg', -8.60200000, -8.60200000, 116.12000000, 116.12000000, '08:05:59', '17:02:19', '08:56:20', 'Waktu Kerja Sudah cukup'),
(160, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-28', '1000200105.jpg', '1000196710.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:11:53', '16:36:18', '08:24:25', 'Waktu Kerja Kurang 5 Menit'),
(161, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-28', 'IMG_20241108_155011_080.webp', 'IMG_20241108_154638_119.webp', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:13:35', '16:33:03', '08:19:28', 'Waktu Kerja Kurang 10 Menit'),
(162, 22, 'Paskalis Laruh Djoeang', 'izin', 'Masuk', '2024-11-28', 'Screenshot_20241128_100324.jpg', NULL, -8.60200000, NULL, 116.12100000, NULL, '10:09:37', NULL, NULL, NULL),
(163, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-28', '17327651768488531873367921409449.jpg', '1000200279.jpg', -8.58800000, -8.58800000, 116.11700000, 116.11600000, '11:39:52', '16:35:27', '04:55:35', 'Waktu Kerja Kurang 3 jam 34 Menit'),
(164, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-11-29', 'IMG-20241126-WA0001.jpg', 'IMG-20241126-WA0001.jpg', -8.60200000, -8.60200000, 116.12000000, 116.12000000, '08:03:39', '16:41:54', '08:38:15', 'Waktu Kerja Sudah cukup'),
(165, 18, 'Fathin Furaidah', 'izin', 'Masuk', '2024-11-29', 'IMG_20241126_083202.JPG', 'IMG_20241126_083202.JPG', -8.73500000, -8.73500000, 117.36700000, 117.36700000, '08:08:56', '16:13:37', '08:04:41', 'Waktu Kerja Kurang 25 Menit'),
(166, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-11-29', '1000195064.jpg', '1000196710.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:17:32', '16:10:53', '07:53:21', 'Waktu Kerja Kurang 36 Menit'),
(167, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-11-29', '1000200447.jpg', 'IMG_20241108_155011_080.webp', -8.58800000, -8.58600000, 116.11600000, 116.11300000, '08:19:10', '16:06:50', '07:47:40', 'Waktu Kerja Kurang 42 Menit'),
(168, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-11-29', '17328414556446095556287501335150.jpg', '1000200548.jpg', -8.60300000, -8.58800000, 116.13800000, 116.11600000, '08:51:17', '16:08:04', '07:16:47', 'Waktu Kerja Kurang 1 jam 13 Menit'),
(169, 13, 'RATMINI ', 'sakit', 'Masuk', '2024-11-29', 'Screenshot_20241129-102608.jpg', NULL, -8.60400000, NULL, 116.14200000, NULL, '10:27:07', NULL, NULL, NULL),
(170, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-12-01', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:46:29', NULL, NULL, NULL),
(171, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-02', '17330990007006400516046867686873.jpg', NULL, -8.56000000, NULL, 116.13700000, NULL, '08:23:39', NULL, NULL, NULL),
(172, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-12-02', 'IMG_20241108_154638_119.webp', NULL, -8.60300000, NULL, 116.13800000, NULL, '08:23:24', NULL, NULL, NULL),
(173, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-02', '1000194504.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:24:32', NULL, NULL, NULL),
(174, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-12-02', '17330990817295170812475881362565.jpg', NULL, -8.56000000, NULL, 116.13700000, NULL, '08:24:57', NULL, NULL, NULL),
(175, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-12-02', '17330990977925717636237745074063.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:25:10', NULL, NULL, NULL),
(176, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-12-02', '17330990632087271169612958253056.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:25:21', NULL, NULL, NULL),
(177, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-12-02', '17330991935947189396568215854396.jpg', NULL, -8.56000000, NULL, 116.13700000, NULL, '08:26:45', NULL, NULL, NULL),
(178, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-12-02', '17330991901553404673523874271892.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:26:46', NULL, NULL, NULL),
(179, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-12-02', 'IMG_20241202_082649_435.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:27:12', NULL, NULL, NULL),
(180, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-12-02', '17330992804634716565980421662669.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:28:17', NULL, NULL, NULL),
(181, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-12-05', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '16:39:02', '16:40:09', '00:01:07', 'Waktu Kerja Kurang 8 jam 28 Menit'),
(182, 10, 'bagas adinata', 'hadir', 'Masuk', '2024-12-05', '17333991207894207529826039628891.jpg', NULL, -8.57700000, NULL, 116.10900000, NULL, '19:45:37', NULL, NULL, NULL),
(183, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-12-05', '17334410172337129698396323299193.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:23:58', NULL, NULL, NULL),
(184, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-06', '1000196710.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:13:19', NULL, NULL, NULL),
(185, 14, 'Anisha Rizkia fitri ', 'izin', NULL, '2024-12-06', 'image.jpg', NULL, NULL, NULL, NULL, NULL, '08:31:32', NULL, NULL, 'Kontrol kerumah sakit '),
(186, 14, 'Anisha Rizkia fitri ', 'izin', NULL, '2024-12-06', 'image.jpg', NULL, NULL, NULL, NULL, NULL, '08:32:22', NULL, NULL, 'Kontrol kerumah sakit '),
(187, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-12-08', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:55:54', NULL, NULL, NULL),
(188, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-09', '1000194504.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:13:28', NULL, NULL, NULL),
(189, 14, 'Anisha Rizkia fitri ', 'izin', NULL, '2024-12-10', 'image.jpg', NULL, NULL, NULL, NULL, NULL, '16:00:26', NULL, NULL, ''),
(190, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-11', '17338752648662741334687522864340.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:01:30', NULL, NULL, NULL),
(191, 14, 'Anisha Rizkia fitri ', 'sakit', NULL, '2024-12-11', 'image.jpg', NULL, NULL, NULL, NULL, NULL, '11:09:34', NULL, NULL, 'Maaf baru bisa absen ibu/bapak baru keluar dari ruangan operasi'),
(192, 14, 'Anisha Rizkia fitri ', 'sakit', NULL, '2024-12-11', 'image.jpg', NULL, NULL, NULL, NULL, NULL, '11:09:35', NULL, NULL, 'Maaf baru bisa absen ibu/bapak baru keluar dari ruangan operasi'),
(193, 14, 'Anisha Rizkia fitri ', 'sakit', NULL, '2024-12-11', 'image.jpg', NULL, NULL, NULL, NULL, NULL, '17:06:04', NULL, NULL, ''),
(194, 14, 'Anisha Rizkia fitri ', 'sakit', NULL, '2024-12-11', 'IMG-20241211-WA0005.jpg', NULL, NULL, NULL, NULL, NULL, '17:10:16', NULL, NULL, ''),
(195, 14, 'Anisha Rizkia fitri ', 'sakit', NULL, '2024-12-11', 'IMG-20241211-WA0005.jpg', NULL, NULL, NULL, NULL, NULL, '17:11:04', NULL, NULL, ''),
(196, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-12-16', 'IMG_20241216_083250_650.jpg', 'IMG_20241216_083250_650.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:34:03', '16:51:32', '08:17:29', 'Waktu Kerja Kurang 12 Menit'),
(197, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-16', '1000194504.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:34:13', NULL, NULL, NULL),
(198, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-12-16', 'IMG-20241204-WA0007.jpg', 'IMG-20241204-WA0007.jpg', -8.60200000, -8.58800000, 116.13900000, 116.11600000, '08:33:34', '16:51:48', '08:18:14', 'Waktu Kerja Kurang 11 Menit'),
(199, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-12-16', '1734309297037814666960498965857.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:35:17', NULL, NULL, NULL),
(200, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-12-16', '1734309329823822789772515431277.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:36:26', NULL, NULL, NULL),
(201, 10, 'bagas adinata', 'hadir', 'Masuk', '2024-12-16', 'avatar-312603_1920.png', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:57:32', NULL, NULL, NULL),
(202, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-16', '17343142972878768059005041218656.jpg', '17343404120193984848189118457210.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:58:27', '17:14:11', '07:15:44', 'Waktu Kerja Kurang 1 jam 14 Menit'),
(203, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-12-16', '17343199287772247681423544743696.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '11:32:20', NULL, NULL, NULL),
(204, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-12-16', '17343933270589066089834791411606.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:55:41', NULL, NULL, NULL),
(205, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-17', 'IMG_20241217_080117_572.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:01:24', NULL, NULL, NULL),
(206, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-12-17', '1734393891771198401287417042083.jpg', '17344247410155540564495908005881.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:18', '16:39:21', '08:34:03', 'Waktu Kerja Sudah cukup'),
(207, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-12-17', 'IMG_20241217_082548_017.jpg', 'IMG_20241217_082548_017.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:26:03', '16:40:59', '08:14:56', 'Waktu Kerja Kurang 15 Menit'),
(208, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-12-17', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:26:36', NULL, NULL, NULL),
(209, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-12-17', '17343951824715996574321076029873.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:26:34', NULL, NULL, NULL),
(210, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-17', '1000195064.jpg', '1000195066.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:44:49', '16:40:51', '07:56:02', 'Waktu Kerja Kurang 33 Menit'),
(211, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-12-17', 'IMG-20241204-WA0007.jpg', 'IMG-20241204-WA0007.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:45:45', '16:38:35', '07:52:50', 'Waktu Kerja Kurang 37 Menit'),
(212, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-12-18', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:12:54', '07:52:07', '00:20:47', 'Waktu Kerja Kurang 8 jam 9 Menit'),
(213, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-12-18', 'IMG_20241218_083304_825.jpg', 'IMG_20241218_083304_825.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:33:33', '16:43:51', '08:10:18', 'Waktu Kerja Kurang 19 Menit'),
(214, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-12-18', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:35:20', '16:36:35', '08:01:15', 'Waktu Kerja Kurang 28 Menit'),
(215, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-12-18', 'IMG_20241218_083608_497.jpg', '17345110109922860297723556340701.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:36:22', '16:37:01', '08:00:39', 'Waktu Kerja Kurang 29 Menit'),
(216, 26, 'epson l3110', 'hadir', 'Masuk', '2024-12-18', '1000222053.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:53:10', NULL, NULL, NULL),
(217, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-18', '17344832193017086254539205027013.jpg', 'IMG_20241218_164102_810.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:53:52', '16:42:34', '07:48:42', 'Waktu Kerja Kurang 41 Menit'),
(218, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-12-18', 'IMG-20241204-WA0007.jpg', 'IMG-20241204-WA0007.jpg', -8.60100000, -8.58800000, 116.12900000, 116.11600000, '08:53:50', '16:37:05', '07:43:15', 'Waktu Kerja Kurang 46 Menit'),
(219, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-18', '1000196710.jpg', '1000196710.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:54:33', '16:38:53', '07:44:20', 'Waktu Kerja Kurang 45 Menit'),
(220, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-12-18', '17344833129745910783118194897911.jpg', '20241218_164223.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:55:49', '16:47:52', '07:52:03', 'Waktu Kerja Kurang 37 Menit'),
(221, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-12-18', '17344834754533295367983157196043.jpg', '17345112406149158795555328776082.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:58:29', '16:41:05', '07:42:36', 'Waktu Kerja Kurang 47 Menit'),
(222, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-12-18', '17344837191645026000449838222804.jpg', '17345113929601096370854505037293.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:02:17', '16:43:27', '07:41:10', 'Waktu Kerja Kurang 48 Menit'),
(223, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-12-18', '17344863901402278790913006479028.jpg', '17345110921263190904186726091314.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:46:59', '16:38:21', '06:51:22', 'Waktu Kerja Kurang 1 jam 38 Menit'),
(224, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-12-19', '17345665496703390579281377700275.jpg', '17345977149192523884538636156501.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:02:49', '16:42:15', '08:39:26', 'Waktu Kerja Sudah cukup'),
(225, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-12-19', '17345666432102840812261978096459.jpg', '1000210422.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:04:15', '16:42:32', '08:38:17', 'Waktu Kerja Sudah cukup'),
(226, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-12-19', 'IMG-20241219-WA0001.jpg', '17345983701345518050842806161290.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:04:26', '16:53:19', '08:48:53', 'Waktu Kerja Sudah cukup'),
(227, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-19', '17345666834969214147371415328148.jpg', '17345983583311963235748844212220.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:04:53', '16:53:14', '08:48:21', 'Waktu Kerja Sudah cukup'),
(228, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-19', '1000210129.jpg', '1000210129.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:12', '16:35:49', '08:30:37', 'Waktu Kerja Sudah cukup'),
(229, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-12-19', '1000210130.jpg', '1734597417110474255284446802973.jpg', -8.58800000, -8.60700000, 116.11600000, 116.14400000, '08:06:59', '16:37:03', '08:30:04', 'Waktu Kerja Sudah cukup'),
(230, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-12-19', '17345673593074784815899828242254.jpg', '17345974574232491884342575635844.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:16:11', '16:38:02', '08:21:51', 'Waktu Kerja Kurang 8 Menit'),
(231, 13, 'RATMINI ', 'izin', NULL, '2024-12-19', 'Screenshot_20241219-082951.jpg', NULL, NULL, NULL, NULL, NULL, '08:30:42', NULL, NULL, 'Izin masuk setengah hari ,karena mau bimbingan ke kampus '),
(232, 12, 'Ida Yanti', 'izin', NULL, '2024-12-19', 'Screenshot_2024-12-19-09-49-27-08_6012fa4d4ddec268fc5c7112cbb265e7.jpg', NULL, NULL, NULL, NULL, NULL, '09:51:34', NULL, NULL, 'izin setengah hari untuk konsultasi dengan kaprodi terkait penarikan dan laporan akhir'),
(233, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-12-19', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:58:10', NULL, NULL, NULL),
(234, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-20', '1000210704.jpg', '1000210862.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:53:17', '16:01:55', '07:08:38', 'Waktu Kerja Kurang 1 jam 21 Menit'),
(235, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-12-20', '1000210705.jpg', 'IMG_20241108_155011_080.webp', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:54:43', '16:01:00', '07:06:17', 'Waktu Kerja Kurang 1 jam 23 Menit'),
(236, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-12-20', 'IMG_20241220_085537_807.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:55:40', NULL, NULL, NULL),
(237, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-20', '17346563773874878267262846452852.jpg', '17346851194186990613337939795792.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:59:57', '16:58:46', '07:58:49', 'Waktu Kerja Kurang 31 Menit'),
(238, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-12-20', 'IMG20241220090646.jpg', '17346822332348165849285534120001.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:10:02', '16:10:45', '07:00:43', 'Waktu Kerja Kurang 1 jam 29 Menit'),
(239, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-12-20', '1734657077813755529423865244922.jpg', '17346823980488303000104928512693.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:11:43', '16:13:41', '07:01:58', 'Waktu Kerja Kurang 1 jam 28 Menit'),
(240, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-12-20', '17346571170333153568429079594213.jpg', '17346855409917467986312170557631.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:12:19', '16:05:56', '07:53:37', 'Waktu Kerja Kurang 36 Menit'),
(241, 14, 'Anisha Rizkia fitri ', 'izin', NULL, '2024-12-20', '17346572786321738941769255068939.jpg', NULL, NULL, NULL, NULL, NULL, '08:14:51', NULL, NULL, 'Mohon maaf ibu/bapak izin masuk telat jam. 9 karena melayat ada kelurga yang meninggal '),
(242, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-12-20', '17346573385136824084483966080779.jpg', '17346853968705154608091271912053.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:15:49', '16:03:32', '07:47:43', 'Waktu Kerja Kurang 42 Menit'),
(243, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-12-23', 'Screenshot_2024-12-23-08-03-28-54_6012fa4d4ddec268fc5c7112cbb265e7.jpg', NULL, -8.60300000, NULL, 116.13800000, NULL, '08:05:41', NULL, NULL, NULL),
(244, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-12-23', '1734913945881294182300203512759.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:33:00', NULL, NULL, NULL),
(245, 15, 'Rifa Ratna Savitri ', 'hadir', 'Masuk', '2024-12-23', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:34:09', NULL, NULL, NULL),
(246, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-12-23', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:35:12', NULL, NULL, NULL),
(247, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-12-23', 'IMG_20241218_083304_825.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:39:00', NULL, NULL, NULL),
(248, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-23', '1000200105.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:40:00', NULL, NULL, NULL),
(249, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-12-23', '17349143273621258694862606496655.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:39:04', NULL, NULL, NULL),
(250, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-12-23', '17349144070207424227150826502527.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:40:16', NULL, NULL, NULL),
(251, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-12-23', '17349144653518098832107591240982.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:41:36', NULL, NULL, NULL),
(252, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-12-23', '17349147303518137060368035296443.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:45:46', NULL, NULL, NULL),
(253, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-12-24', 'Screenshot_2024-12-24-07-52-36-44_6012fa4d4ddec268fc5c7112cbb265e7.jpg', 'IMG_20240923_152611_914.webp', -8.60300000, -8.58800000, 116.13800000, 116.11600000, '09:33:33', '16:45:02', '07:11:29', 'Waktu Kerja Kurang 1 jam 18 Menit'),
(254, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-24', '17350049639053097820642999579.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '09:49:43', NULL, NULL, NULL),
(255, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-12-24', 'IMG-20241224-WA0002.jpg', '17350291274624117753954910593864.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:51:55', '16:32:20', '06:40:25', 'Waktu Kerja Kurang 1 jam 49 Menit'),
(256, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-24', '1000212792.jpg', '1000212792.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '16:45:17', '16:45:34', '00:00:17', 'Waktu Kerja Kurang 8 jam 29 Menit'),
(257, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-12-26', '17352560769457400695079831539959.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:35:21', NULL, NULL, NULL),
(258, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-12-26', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:57:45', NULL, NULL, NULL),
(259, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-27', '1000213810.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:03:12', NULL, NULL, NULL),
(260, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-12-27', '1735257924940.jpg', '17352865625276230603068270133791.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:48', '16:02:51', '07:57:03', 'Waktu Kerja Kurang 32 Menit');
INSERT INTO `absensi` (`id`, `user_id`, `nama`, `status`, `keterangan`, `tanggal`, `foto`, `foto_keluar`, `latitude`, `latitude_keluar`, `longitude`, `longitude_keluar`, `waktu_masuk`, `waktu_keluar`, `durasi`, `kesimpulan`) VALUES
(261, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2024-12-27', 'IMG_8792.jpeg', 'IMG_8795.jpeg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:12:33', '16:17:40', '08:05:07', 'Waktu Kerja Kurang 24 Menit'),
(262, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-12-27', '1000213820.jpg', 'IMG-20241227-WA0018.jpeg', -8.58800000, -8.59200000, 116.11600000, 116.12000000, '08:20:23', '16:50:37', '08:30:14', 'Waktu Kerja Sudah cukup'),
(263, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-12-27', 'IMG_20241227_090115_524.jpg', '17352894606579206352145391871382.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:01:35', '16:51:16', '07:49:41', 'Waktu Kerja Kurang 40 Menit'),
(264, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-12-27', '17352613575752487157294135393142.jpg', '17352897584114437946743390941375.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:02:53', '16:56:25', '07:53:32', 'Waktu Kerja Kurang 36 Menit'),
(265, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-12-27', '1735261469157428855524502486320.jpg', '17352895188378016928593433073220.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '09:04:46', '16:52:27', '07:47:41', 'Waktu Kerja Kurang 42 Menit'),
(266, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-27', '1735265380654845833439954115202.jpg', '17352894140888435561440795376259.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '10:09:50', '16:50:30', '06:40:40', 'Waktu Kerja Kurang 1 jam 49 Menit'),
(267, 17, 'Dela febrianti', 'hadir', 'Masuk', '2024-12-29', '173551655945852052266420267347.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:56:27', NULL, NULL, NULL),
(268, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-30', '17355168468935970434457731868196.jpg', 'IMG_20241230_163300_842.jpg', -8.56000000, -8.58800000, 116.13600000, 116.11600000, '08:01:03', '16:35:58', '08:34:55', 'Waktu Kerja Sudah cukup'),
(269, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2024-12-30', 'IMG_8837.jpeg', 'IMG_8840.jpeg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:03:27', '16:52:10', '08:48:43', 'Waktu Kerja Sudah cukup'),
(270, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-12-30', '17355169744621309807899818469184.jpg', '17355477108904144802140661118458.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:03:07', '16:35:32', '08:32:25', 'Waktu Kerja Sudah cukup'),
(271, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2024-12-30', '17355170851642450184901563883328.jpg', '17355482217418868986998010844680.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:04:55', '16:43:54', '08:38:59', 'Waktu Kerja Sudah cukup'),
(272, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-30', '1000212329.png', '1000212329.png', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:06:09', '16:33:37', '08:27:28', 'Waktu Kerja Kurang 2 Menit'),
(273, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-12-30', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:08:15', '16:32:30', '08:24:15', 'Waktu Kerja Kurang 5 Menit'),
(274, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-12-30', 'IMG_20240923_152611_914.webp', '1000216124.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:07:46', '16:32:38', '08:24:52', 'Waktu Kerja Kurang 5 Menit'),
(275, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-12-30', 'IMG_20241230_080910_415.jpg', 'IMG_20241230_080910_415.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:09:36', '16:32:50', '08:23:14', 'Waktu Kerja Kurang 6 Menit'),
(276, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2024-12-30', '17355174431535925659254493683391.jpg', '17355480789484180424365318729979.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:11:19', '16:41:29', '08:30:10', 'Waktu Kerja Sudah cukup'),
(277, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-12-30', '1000215730.jpg', '17355477479301117970071073170211.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:15:42', '16:36:08', '08:20:26', 'Waktu Kerja Kurang 9 Menit'),
(278, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2024-12-31', '1735603416697668979421014761361.jpg', '17356347899317689957955705851456.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:03:48', '16:46:42', '08:42:54', 'Waktu Kerja Sudah cukup'),
(279, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2024-12-31', '1000216441.jpg', '1000216441.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:33', '16:36:17', '08:30:44', 'Waktu Kerja Sudah cukup'),
(280, 13, 'RATMINI ', 'hadir', 'Masuk', '2024-12-31', 'IMG_20241231_080528_836.jpg', 'IMG_20241231_080528_836.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:06:00', '16:36:03', '08:30:03', 'Waktu Kerja Sudah cukup'),
(281, 19, 'Ageng pranata', 'hadir', 'Masuk', '2024-12-31', '1000216442.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:07:00', NULL, NULL, NULL),
(282, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2024-12-31', 'IMG_8846.jpeg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:07:28', NULL, NULL, NULL),
(283, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2024-12-31', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:14:08', '16:35:53', '08:21:45', 'Waktu Kerja Kurang 8 Menit'),
(284, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2024-12-31', '1735604251212467337110906264038.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:17:49', NULL, NULL, NULL),
(285, 12, 'Ida Yanti', 'hadir', 'Masuk', '2024-12-31', 'IMG_20241108_155011_080.webp', 'IMG_20241108_154638_119.webp', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:27:23', '16:42:37', '08:15:14', 'Waktu Kerja Kurang 14 Menit'),
(286, 13, 'RATMINI ', 'hadir', 'Masuk', '2025-01-02', 'IMG_20250102_080152_288.jpg', 'IMG_20250102_080152_288.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:02:14', '16:35:31', '08:33:17', 'Waktu Kerja Sudah cukup'),
(287, 11, 'Hendon Pratiwi ', 'hadir', 'Masuk', '2025-01-02', '1000216441.jpg', '1000217994.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:13', '16:35:45', '08:30:32', 'Waktu Kerja Sudah cukup'),
(288, 19, 'Ageng pranata', 'hadir', 'Masuk', '2025-01-02', 'IMG_20250102_080527_716.jpg', '1000217997.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:05:41', '16:35:00', '08:29:19', 'Waktu Kerja Kurang 0 Menit'),
(289, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2025-01-02', '17357766523311822233172968443075.jpg', '17358073935877136463411770264736.jpg', -8.56100000, -8.58800000, 116.14000000, 116.11600000, '08:11:21', '16:43:30', '08:32:09', 'Waktu Kerja Sudah cukup'),
(290, 21, 'sintia rahma tania', 'hadir', 'Masuk', '2025-01-02', '17357766764965381150973734013303.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:11:35', NULL, NULL, NULL),
(291, 18, 'Fathin Furaidah', 'hadir', 'Masuk', '2025-01-02', '17357767712562023153610666197371.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:13:29', NULL, NULL, NULL),
(292, 17, 'Dela febrianti', 'hadir', 'Masuk', '2025-01-02', '17357768114311121167181705673926.jpg', '17358070675414463447735097768367.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:13:52', '16:38:15', '08:24:23', 'Waktu Kerja Kurang 5 Menit'),
(293, 12, 'Ida Yanti', 'hadir', 'Masuk', '2025-01-02', 'Screenshot_2025-01-02-08-18-58-92_6012fa4d4ddec268fc5c7112cbb265e7.jpg', 'IMG_20241108_155011_080.webp', -8.60300000, -8.58800000, 116.13800000, 116.11600000, '08:20:13', '16:44:13', '08:24:00', 'Waktu Kerja Kurang 6 Menit'),
(294, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2025-01-02', 'image.jpg', 'image.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:57:08', '16:35:53', '07:38:45', 'Waktu Kerja Kurang 51 Menit'),
(295, 22, 'Paskalis Laruh Djoeang', 'hadir', 'Masuk', '2025-01-02', '17357794803701174889975155838564.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:58:08', NULL, NULL, NULL),
(296, 12, 'Ida Yanti', 'hadir', 'Masuk', '2025-01-03', 'Screenshot_2025-01-03-09-03-56-04_6012fa4d4ddec268fc5c7112cbb265e7.jpg', 'IMG_20241108_155011_080.webp', -8.60300000, -8.58800000, 116.13800000, 116.11600000, '09:05:35', '16:34:36', '07:29:01', 'Waktu Kerja Kurang 1 jam 0 Menit'),
(297, 16, 'Nurul ramadanniah ', 'hadir', 'Masuk', '2025-01-03', '17358697573134540129079625899763.jpg', '17358919748791237620517877500979.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '10:03:00', '16:13:26', '06:10:26', 'Waktu Kerja Kurang 2 jam 19 Menit'),
(298, 17, 'Dela febrianti', 'hadir', 'Masuk', '2025-01-03', '17358698876378142036640184332397.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '10:05:07', NULL, NULL, NULL),
(299, 17, 'Dela febrianti', 'hadir', 'Masuk', '2025-01-05', '17361213650186857549744890768135.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:56:24', NULL, NULL, NULL),
(300, 14, 'Anisha Rizkia fitri ', 'hadir', 'Masuk', '2025-01-06', 'image.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:09:53', NULL, NULL, NULL),
(301, 12, 'Ida Yanti', 'hadir', 'Masuk', '2025-01-06', 'Screenshot_2025-01-06-08-08-12-30_6012fa4d4ddec268fc5c7112cbb265e7.jpg', 'Screenshot_2025-01-06-08-08-12-30_6012fa4d4ddec268fc5c7112cbb265e7.jpg', -8.60900000, -8.60700000, 116.14400000, 116.14400000, '08:09:52', '16:38:22', '08:28:30', 'Waktu Kerja Kurang 1 Menit'),
(302, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2025-01-06', 'IMG_9006.jpeg', 'IMG_9006.jpeg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:17:31', '07:55:27', '00:22:04', 'Waktu Kerja Kurang 8 jam 7 Menit'),
(303, 13, 'RATMINI ', 'hadir', 'Masuk', '2025-01-06', 'IMG_20250102_080152_288.jpg', 'IMG_20250102_080152_288.jpg', -8.62300000, -8.60900000, 116.16800000, 116.14400000, '08:48:11', '16:38:05', '07:49:54', 'Waktu Kerja Kurang 40 Menit'),
(304, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2025-01-07', 'IMG_9020.jpeg', 'IMG_9025.jpeg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:12:32', '16:33:29', '08:20:57', 'Waktu Kerja Kurang 9 Menit'),
(305, 12, 'Ida Yanti', 'hadir', 'Masuk', '2025-01-07', 'IMG_20241108_154638_119.webp', NULL, -8.58800000, NULL, 116.11600000, NULL, '09:33:54', NULL, NULL, NULL),
(306, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2025-01-08', 'IMG_9038.jpeg', 'IMG_9045.jpeg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:45:45', '16:37:36', '07:51:51', 'Waktu Kerja Kurang 38 Menit'),
(307, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2025-01-09', 'IMG_9049.jpeg', 'IMG_9053.jpeg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '08:09:00', '16:43:21', '08:34:21', 'Waktu Kerja Sudah cukup'),
(308, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2025-01-10', 'IMG_9056.jpeg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:44:22', NULL, NULL, NULL),
(309, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2025-01-13', 'IMG_9123.jpeg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:11:04', NULL, NULL, NULL),
(310, 311, 'Muhammad Rafi', 'hadir', 'Masuk', '2025-01-16', 'IMG_20250103_112518.jpg', 'TimePhoto_20250116_163626.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '16:13:49', '16:36:59', '00:23:10', 'Waktu Kerja Kurang 8 jam 6 Menit'),
(311, 312, 'Budurunnafis Ulul Azmi', 'hadir', 'Masuk', '2025-01-16', 'WIN_20250116_15_23_04_Pro.jpg', 'WIN_20250116_15_32_11_Pro.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '15:23:51', '15:32:29', '00:08:38', 'Waktu Kerja Kurang 8 jam 21 Menit'),
(312, 310, 'Anindita Ghina Putri', 'hadir', 'Masuk', '2025-01-16', 'IMG_7898.png', 'IMG_7908.png', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '16:26:36', '07:44:12', '08:42:24', 'Waktu Kerja Sudah cukup'),
(313, 313, 'Baiq Rizkia Amalia ', 'hadir', 'Masuk', '2025-01-16', '17370168850016772301888576786850.jpg', '17370703784034057343260109255462.jpg', -8.58800000, -8.58800000, 116.11600000, 116.11600000, '16:41:30', '07:33:07', '09:08:23', 'Waktu Kerja Sudah cukup'),
(314, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2025-01-17', 'IMG_9289.jpeg', NULL, -8.58800000, NULL, 116.11600000, NULL, '10:50:58', NULL, NULL, NULL),
(315, 311, 'Muhammad Rafi', 'hadir', 'Masuk', '2025-01-19', 'TimePhoto_20250120_074845.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '07:50:29', NULL, NULL, NULL),
(316, 27, 'Ni Putu Ayu Nila Anggreni ', 'hadir', 'Masuk', '2025-01-20', 'IMG_9420.jpeg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:03:36', NULL, NULL, NULL),
(317, 310, 'Anindita Ghina Putri', 'hadir', 'Masuk', '2025-01-20', 'IMG_8030.png', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:04:40', NULL, NULL, NULL),
(318, 313, 'Baiq Rizkia Amalia ', 'hadir', 'Masuk', '2025-01-20', '17373315358593363605522114282972.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:05:43', NULL, NULL, NULL),
(319, 312, 'Budurunnafis Ulul Azmi', 'hadir', 'Masuk', '2025-01-20', '17373324575991367535619186091799.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:21:09', NULL, NULL, NULL),
(320, 316, 'Widiya Nasa Sapitri', 'hadir', 'Masuk', '2025-01-20', '17373329105284943390753929313622.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:28:47', NULL, NULL, NULL),
(321, 314, 'Ashri Rizki Hidayati', 'hadir', 'Masuk', '2025-01-20', '17373335990416104478560172816239.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:40:12', NULL, NULL, NULL),
(322, 315, 'Ni Putu Wulan Kusuma Dewi', 'hadir', 'Masuk', '2025-01-20', '17373335983442020681051838454672.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:40:14', NULL, NULL, NULL),
(323, 318, 'Irbah dzakiyatus sholehah', 'hadir', 'Masuk', '2025-01-20', '1000810793.heic', NULL, -8.59500000, NULL, 116.11500000, NULL, '07:40:40', NULL, NULL, NULL),
(324, 317, 'Ni Wayan Ari Kurnia Dewi', 'hadir', 'Masuk', '2025-01-20', '17373339771429217673519028623036.jpg', NULL, -8.58800000, NULL, 116.11600000, NULL, '08:46:32', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `no_hp`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '082145554182', '$2y$10$sf6l7C5oFRmA4bQLGQ9jD.1QU1Y.iDUa0.vrP/.EnwzAqC47SmMHy');

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
  `selected_option` text DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_kuis`
--

INSERT INTO `hasil_kuis` (`id`, `nama`, `jenis_pertanyaan`, `question_text`, `selected_option`, `is_correct`, `created_at`) VALUES
(66, 'test-infokom', 'pilihan_ganda', '', 'Bagaimana cara masyarakat melaporkan produk ilegal kepada BPOM?', 0, '2024-12-16 07:23:02'),
(67, 'epson l3110', 'pilihan_ganda', '', 'Apa tujuan pengawasan BPOM terhadap obat dan makanan?', 0, '2024-12-16 07:27:59'),
(68, 'epson l3110', 'pilihan_ganda', 'Apa tujuan pengawasan BPOM terhadap obat dan makanan?', 'B', 1, '2024-12-16 07:27:59'),
(69, 'epson l3110', 'pilihan_ganda', 'Apa arti label \"BPOM RI MD\" pada kemasan makanan?', 'B', 1, '2024-12-16 07:27:59'),
(70, 'epson l3110', 'pilihan_ganda', 'Apa nama aplikasi BPOM yang digunakan masyarakat untuk memeriksa legalitas produk?', 'B', 1, '2024-12-16 07:27:59'),
(71, 'epson l3110', 'pilihan_ganda', 'Manakah produk berikut yang menjadi tanggung jawab BPOM untuk diawasi?', 'B', 1, '2024-12-16 07:27:59'),
(72, 'epson l3110', 'pilihan_ganda', 'Berapa digit nomor registrasi BPOM yang tercantum pada kemasan produk pangan olahan?', 'D', 1, '2024-12-16 07:27:59'),
(73, 'epson l3110', 'pilihan_ganda', 'Bagaimana cara masyarakat melaporkan produk ilegal kepada BPOM?', 'A', 1, '2024-12-16 07:27:59'),
(74, 'epson l3110', 'pilihan_ganda', 'Apa kepanjangan dari BPOM?', 'B', 1, '2024-12-16 07:27:59'),
(75, 'epson l3110', 'pilihan_ganda', 'Salah satu kegiatan utama BPOM adalah pemberantasan produk ilegal melalui:', 'D', 1, '2024-12-16 07:27:59'),
(76, 'epson l3110', 'pilihan_ganda', 'Berikut ini yang bukan termasuk tugas BPOM adalah:', 'A', 1, '2024-12-16 07:27:59'),
(77, 'epson l3110', 'pilihan_ganda', 'Dalam pengawasan BPOM, istilah \"produk illegal\" merujuk pada:', 'D', 1, '2024-12-16 07:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `kode_unik` varchar(50) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(27, 'Infokom', 'Apa kepanjangan dari BPOM?', 'Badan Pemeriksa Obat dan Makanan', 'Badan Pengawas Obat dan Makanan', 'Badan Penjamin Obat dan Makanan', 'Badan Pendistribusi Obat dan Makanan', 'B', 'pilihan_ganda'),
(28, 'Infokom', 'Manakah produk berikut yang menjadi tanggung jawab BPOM untuk diawasi?', 'Minyak bumi', 'Kosmetik', 'Alat elektronik', 'Pakaian', 'B', 'pilihan_ganda'),
(29, 'Infokom', 'Apa tujuan pengawasan BPOM terhadap obat dan makanan?', 'Meningkatkan harga jual produk', 'Melindungi kesehatan masyarakat', 'Mengimpor lebih banyak produk asing', 'Mengurangi ekspor produk lokal', 'B', 'pilihan_ganda'),
(30, 'Infokom', 'Apa nama aplikasi BPOM yang digunakan masyarakat untuk memeriksa legalitas produk?', 'SiMonev', 'BPOM Mobile', 'BPOM Check', 'BPOM Online', 'B', 'pilihan_ganda'),
(31, 'Infokom', 'Bagaimana cara masyarakat melaporkan produk ilegal kepada BPOM?', 'Melalui aplikasi atau layanan call center BPOM', 'Dengan mengunjungi kantor polisi', 'Menghubungi Kementerian Kesehatan', 'Membuat laporan ke pabrik produk', 'A', 'pilihan_ganda'),
(32, 'Infokom', 'Apa arti label \"BPOM RI MD\" pada kemasan makanan?', 'Produk makanan telah didistribusikan', 'Produk makanan berasal dari dalam negeri', 'Produk makanan dalam tahap uji coba', 'Produk makanan berasal dari luar negeri', 'B', 'pilihan_ganda'),
(33, 'Infokom', 'Dalam pengawasan BPOM, istilah \"produk illegal\" merujuk pada:', 'Produk yang telah kedaluwarsa', ' Produk buatan luar negeri', 'Produk dengan harga murah', ' Produk tanpa izin edar', 'D', 'pilihan_ganda'),
(34, 'Infokom', 'Berikut ini yang bukan termasuk tugas BPOM adalah:', 'Memberikan sertifikasi halal', ' Memberikan izin edar untuk obat', 'Mengawasi peredaran kosmetik', 'Melakukan edukasi kepada masyarakat', 'A', 'pilihan_ganda'),
(35, 'Infokom', 'Berapa digit nomor registrasi BPOM yang tercantum pada kemasan produk pangan olahan?', '8', '9', '12', '15', 'D', 'pilihan_ganda'),
(36, 'Infokom', 'Salah satu kegiatan utama BPOM adalah pemberantasan produk ilegal melalui:', 'Operasi pasar', 'Edukasi konsumen', 'Penyuluhan produk', 'Operasi gabungan dengan aparat hukum', 'D', 'pilihan_ganda'),
(37, 'Kimia Kosmetik', 'Dalam produk kosmetik, emulsifier berfungsi untuk:', 'Memberikan aroma pada produk', 'Menjaga kestabilan campuran minyak dan air', 'Membuat produk lebih kental', 'Meningkatkan daya serap kulit', 'B', 'pilihan_ganda'),
(38, 'Kimia Kosmetik', 'Senyawa mana yang tidak boleh digunakan dalam kosmetik karena berbahaya bagi kesehatan?', 'Titanium dioksida', 'Hydroquinone ', 'Sodium lauryl sulfate', 'Gliserin', 'B', 'pilihan_ganda'),
(40, 'Kimia Kosmetik', 'Produk pembersih wajah yang ideal untuk kulit memiliki pH sekitar:', '2-3', '4-5', '5-6', '10-11', 'C', 'pilihan_ganda'),
(41, 'Kimia Kosmetik', 'Jenis ikatan yang terbentuk antara atom natrium (Na) dan klorin (Cl) dalam pembentukan NaCl adalah:', 'Ikatan kovalen', 'Ikatan ionik', 'Ikatan logam', 'Ikatan hidrogen', 'B', 'pilihan_ganda');

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
  `status_kunjungan` varchar(255) DEFAULT NULL,
  `kode_unik` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kunjungan`
--

INSERT INTO `kunjungan` (`id`, `nama`, `no_hp`, `instansi`, `keperluan`, `jumlah_peserta`, `segmen_peserta`, `tanggal`, `jam`, `surat_masuk`, `surat_balasan`, `status_kunjungan`, `kode_unik`) VALUES
(5, 'bagas adinata', '087750292514', 'jaghajangangagas', 'Universitas Mataram', 24, 'Mahasiswa', '2024-11-11', '11:00:00', './Asset/Document/', NULL, '', NULL),
(6, 'bagas adinata', '087750292514', 'jaghajangangagas', 'Universitas Mataram', 26, 'Mahasiswa', '2024-11-12', '11:00:00', './Asset/Document/surat_pengajuan_kunjungan bagas adinata.pdf', NULL, '', NULL),
(7, 'bagas adinata', '087750292514', 'jaghajangangagas', 'Universitas Mataram', 28, 'Mahasiswa', '2024-11-12', '12:00:00', './Asset/Document/surat_pengajuan_kunjungan+bagas+adinata.pdf', NULL, '', NULL);

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
(65, 10, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(66, 25, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl'),
(67, 26, 'Selamat Pengajuan PKL di BPOM Mataram Sukses<br>Mohon menunggu maksimal 2 hari kerja, jika selama 2 hari belum ada balasan, Mohon menghubungi admin', 'pkl');

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
(3, 'Kimia Obat', 'Membantu Pekerjaan di Lab Kimia Obat', 'Farmasi, Kimia', 2),
(4, 'Kimia Kosmetik', 'Membantu Pekerjaan di Lab Kimia Kosmetik', 'Farmasi, Kimia', 4),
(5, 'Kimia OTSK', 'Membantu Pekerjaan di Lab Kimia OTSK', 'Farmasi, Kimia', 2),
(6, 'sertifikasi', 'apapun', 'Informatika', 2);

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
  `status` varchar(25) DEFAULT NULL,
  `kode_unik` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `tanggal`, `nama`, `alamat`, `no_hp`, `subject`, `pesan`, `foto_ktp`, `foto_pengaduan`, `jam`, `status`, `kode_unik`) VALUES
(1, '2024-11-15', 'bagas adinata', 'jalanpendidikan', '087750292514', 'suplemen kesehatan', 'ini untuk coba', 'si inges (2).png', 'si solah (1).png', '15:16:25', NULL, NULL),
(2, '2024-11-18', 'Bagas Adinata', 'Karang Baru Selatan', '087750292514', 'kosmetik', 'Ini untuk uji coba', 'si inges-1.png', NULL, '07:46:27', NULL, NULL),
(3, '2024-11-19', 'Rifa Ratna Savitri', 'BTN Gelang, Sukamulia, Lombok Timur, Nusa Tenggara Barat', '085942851918', 'lainnya', 'Saya sebentar lagi akan berakhir masa magangnya huhu sedih', 'IMG_8526.heic', 'CV ATS [Rifa Ratna Savitri].docx', '08:01:32', NULL, NULL),
(4, '2024-11-19', 'Nurul ramadanniah ', 'Dusun boal bawa ', '081999630575', 'pangan olahan', '-', 'IMG_20241118_185730_731~2.jpg', NULL, '08:02:39', NULL, NULL),
(5, '2024-11-19', 'Ageng Pranata', 'Dusun Medain', '085333923469', 'pangan olahan', 'PKL bulan Desember selesai', '17319743684631496088500530631380.jpg', NULL, '08:02:52', NULL, NULL),
(6, '2024-11-19', 'Nurullayyinah', 'Jalan Catur Warga No. 13', '085339098803', 'lainnya', 'Tidak ada', 'image.jpg', NULL, '08:05:32', NULL, NULL),
(7, '2024-11-19', 'Hendon Pratiwi ', 'Otak dese Ampenan ', '087859973454', 'pangan olahan', '-', '17319750178408051311062727422804.jpg', NULL, '08:12:00', NULL, NULL),
(8, '2024-11-19', 'Ratmini', 'Sekotong ', '081236262948', 'pangan olahan', '_', '17319750372791256906732788071730.jpg', NULL, '08:12:13', NULL, NULL),
(9, '2024-11-19', 'Fathin Furaidah', 'Sumbawa', '085339040671', 'pangan olahan', 'Terkait masih banyak yang menjual kerupuk mengandung boraks dan jajanan yang mengandung formalin', 'IMG_20241119_083354.jpg', NULL, '08:38:34', NULL, NULL),
(10, '2024-11-19', 'Sintia Rahma Tania', 'Sumbawa', '082247144426', 'pangan olahan', 'mie boraks', '17319784521172089602409147349976.jpg', NULL, '09:08:32', NULL, NULL),
(11, '2024-11-22', 'bagas adinata', 'jalanpendidikan', '087750292514', 'suplemen kesehatan', 'bahan uji coba', 'si solah (1).png', NULL, '13:56:07', NULL, NULL),
(12, '2024-12-18', 'Dian Lestari', 'Kel. Brang Biji RT 003 / RW 002', '081336332589', 'kosmetik', 'Produk MK Glow yang masuk public warning dan izin edar BPOMnya ditarik masih beredar di Lombok melalui reseller. Mohon ditindaklanjuti.', 'WhatsApp Image 2024-12-18 at 8.49.36 AM (1).jpeg', 'WhatsApp Image 2024-12-17 at 8.21.07 PM.jpeg', '09:27:24', NULL, NULL);

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
(14, 'Mukhlis Wardin Juaini', 'mukhliswj@gmail.com', '082145554182', 'Universitas Bumigora', 'Teknologi Informasi', NULL, 'Tata Usaha, Kimia Obat, Kimia Kosmetik, Kimia OTSK, Kimia Pangan, inforkom', '2024-08-07 - 2024-08-13', './Asset/Document/surat_pengajuan_Mukhlis Wardin Juaini.pdf', './Asset/Document/proposal_Mukhlis Wardin Juaini.pdf', 'Diterima', './Asset/Document/surat_balasan_Mukhlis Wardin Juaini.pdf', '2024-08-06 03:47:22', 'Kimia OTSK', 'Asset/Document/laporan_Mukhlis Wardin Juainipdf', './Asset/certificates/sertifikat_MUKHLIS WARDIN JUAINI.pdf'),
(15, 'Ayu Ningsih', 'wardin@gmail.com', '085338108858', 'Universitas Bumigora', 'TI', NULL, 'Kimia Kosmetik, Kimia OTSK', '2024-08-01 - 2024-08-31', './Asset/Document/surat_pengajuan_Ayu Ningsih.pdf', './Asset/Document/proposal_Ayu Ningsih.pdf', 'Diterima', './Asset/Document/surat_balasan_Ayu Ningsih.pdf', '2024-08-12 04:39:28', 'Kimia Kosmetik', '', ''),
(16, 'Ayu Ningsih', 'ayu@gmail.com', '08214554182', 'Universitas Bumigora', 'Desain Komunikasi Visual', NULL, 'Inforkom', '2024-09-01 - 2024-09-30', './Asset/Document/surat_pengajuan_ayuni.pdf', './Asset/Document/proposal_ayuni.pdf', 'Diterima', './Asset/Document/surat_balasan_Ayu Ningsih.pdf', '2024-08-23 14:04:22', 'Inforkom', '', ''),
(27, 'bagas adinata', 'bagasadinata321@gmail.com', '1234', '', '123', NULL, 'Tata Usaha', '2024-11-22 - 2024-11-18', './Asset/Document/surat_pengajuan_bagas+adinata.pdf', './Asset/Document/proposal_bagas+adinata.pdf', 'Diterima', './Asset/Document/surat_balasan_bagas adinata.png', '2024-11-13 06:57:22', 'Tata Usaha', NULL, NULL),
(28, 'test-infokom', 'infokom.bbpommataram@gmail.com', '081393719995', 'BPOM', 'Terminal Sweta - Selong', '1500533', 'Infokom', '2025-01-01 - 2025-03-03', './Asset/Document/surat_pengajuan_test-infokom.pdf', './Asset/Document/proposal_test-infokom.pdf', 'Pending', NULL, '2024-12-16 07:07:44', NULL, NULL, NULL),
(29, 'epson l3110', 'epson@epson.com', '080989999', 'BPOM', 'Terminal Sweta - Selong', '1500533', 'Infokom', '2025-03-01 - 2025-12-01', './Asset/Document/surat_pengajuan_epson+l3110.pdf', './Asset/Document/proposal_epson+l3110.pdf', 'Pending', NULL, '2024-12-16 07:27:31', NULL, NULL, NULL);

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
(1, 'logo_admin_20241801142644.png', 'Dragon Store', 'Top Up Game Murah, Joki Mobile Legend dan Layanan Booster Social Media, Instant 24 Jam, Mobile Legends, Diamond Mobile Legends, Free Fire, DM FF,  Mobile, PUBGM, Genshin Impact, CODM, Valorant, Wild Rift', 'Dragon Store Adalah Tempat Top Up Game Murah, Joki Mobile Legends dan Booster Media Yang Aman, Murah dan Terpercaya. Menyediakan Layanan Top Up Games, Joki Mobile Legends, Booster Social Media. Untuk Mempermudah Pembayaran Anda Disini Kami Juga Menyediakan Berbagai Macam Metode Pembayaran', 2, 3, 2, 'https://siapmelayani.bbpommataram.id', 'admin', '2024-01-17 20:55:37');

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
(29, 'slide_20250105152642.jpg', 'HACKED BY RUSHID', 1, '', 1),
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
  `password` text NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `universitas`, `no_hp`, `password`, `status`, `foto`) VALUES
(1, 'Mukhlis Wardin Juaini', 'mukhliswj@gmail.com', NULL, '082145554182', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'done', 'Asset/Gambar/profile_Mukhlis Wardin Juaini.png'),
(2, 'Ayu Ningsih', 'wardin@gmail.com', NULL, '085338108858', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'done', 'Asset/Gambar/profile.png'),
(3, 'Ardha', 'ardha@gmail.com', NULL, '08555555554', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'done', 'Asset/Gambar/profile.png'),
(4, 'mukhlis wj', 'mukhliswardinjuaini@gmail.com', NULL, '082145554185', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', '', 'Asset/Gambar/profile.png'),
(5, 'Ayu Ningsih', 'ayu@gmail.com', NULL, '08214554182', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/20240316_103510.png'),
(6, 'arda', 'arda@gmail.com', NULL, '0888888', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(8, 'nama', 'email@gmail.com', NULL, '12345678', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', '', ''),
(9, 'Bagas Adinata', 'bagas@gmail.com', 'Universitas Mataram', '087750292514', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(10, 'bagas adinata', 'bagasadinata321@gmail.com', 'Universitas Mataram', '1234', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(11, 'Hendon Pratiwi ', 'hindunpratiwi14@gmail.com', 'Universitas Nahdlatul Wathan ', '087859973454', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(12, 'Ida Yanti', 'idayanti1717@gmail.com', 'Universitas Islam Al Azhar ', '083129382025', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(13, 'RATMINI ', 'ieymim41@gmail.com', 'Universitas Islam Al Azhar ', '081236262948', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(14, 'Anisha Rizkia fitri ', 'anisarizkia81@gmail.com', 'Universitas teknologi sumbawa', '081918409267', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(15, 'Rifa Ratna Savitri ', 'savitririfa@gmail.com', 'Universitas Muhammadiyah Malang', '085942851918 ', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(16, 'Nurul ramadanniah ', 'ullosulo@gmail.com', 'Universitas teknologi Sumbawa ', '081999630575', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(17, 'Dela febrianti', 'dellafebrianti746@gmail.com', 'Universitas Teknologi Sumbawa', '082340095643', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(18, 'Fathin Furaidah', 'fathinfuraidah@gmail.com', 'Universitas Teknologi Sumbawa', '085339040671', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(19, 'Ageng pranata', 'agengpranata116@gmail.com', 'UNW Mataram', '085333923469', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(20, 'Sara Paulina Baransano', 'saraapaulin4@gmail.com', 'Universitas Mataram', '081247923884', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(21, 'sintia rahma tania', 'rahmataniasintia@gmail.com', 'universitas teknologi sumbawa', '082247144426', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(22, 'Paskalis Laruh Djoeang', 'paskaldjoeang@gmail.com', 'Universitas Teknologi Sumbawa', '087779429217', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(23, 'Nurullayyinah', 'nurullayyinahjauhar@gmail.com', 'Universitas Muhammadiyah Malang', '085339098803', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(24, 'asdf', 'asdsff@asdf', 'asdf', '123423423', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(25, 'test-infokom', 'infokom.bbpommataram@gmail.com', 'BPOM', '081393719995', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(26, 'epson l3110', 'epson@epson.com', 'BPOM', '080989999', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(27, 'Ni Putu Ayu Nila Anggreni ', 'niputuayunilaanggreni2004@mail.ugm.ac.id', 'Universitas Gadjah Mada', '087811472653', '$2y$10$MvpFvvvE0gnQKfJGzT6ssO/Rra3IAcaWfbyz2UYuNcDI1he6NBlLW', 'active', 'Asset/Gambar/profile.png'),
(310, 'Anindita Ghina Putri', 'aninditaghina@student.ub.ac.id', 'Universitas Brawijaya', '085887796450', '$2y$10$5V9JbA/v2un./NqzVzWp4egAMVgHpFcf.kWim4/uTJeTEJwOKAEge', 'active', 'Asset/Gambar/profile.png'),
(311, 'Muhammad Rafi', 'rraaffii2408@gmail.com', 'Universitas Mataram', '085337477083', '$2y$10$/sWTRwHQzARjKlOWnHIHZ.9qULO8XvQnr80VVsrJDv4EPLOPwYPNK', 'active', 'Asset/Gambar/profile.png'),
(312, 'Budurunnafis Ulul Azmi', 'budurunnafis@student.ub.ac.id', 'Universitas Brawijaya ', '081239774128', '$2y$10$Wk4YlCin6HBwzVKngEYHuOrgZ5FwgSW8PPsm.T6qC/UW6qqRGpI..', 'active', 'Asset/Gambar/profile.png'),
(313, 'Baiq Rizkia Amalia ', 'baiqrizkiamalia@student.ub.ac.id', 'Universitas Brawijaya ', '087819450684', '$2y$10$IQnyE8BQa3qsaPC5j7iIVOGboqAXVnKv5YpZapHxyV6KXe8FTI2iu', 'active', 'Asset/Gambar/profile.png'),
(314, 'Ashri Rizki Hidayati', 'hidayati.2208511002@unud.ac.id', 'Universitas Udayana', '085930181686', '$2y$10$.NkIvWClzK.Xh86oBSZmeO9IlXrj9juxClYOaE9rbHM/dcJPdgScO', 'active', 'Asset/Gambar/profile.png'),
(315, 'Ni Putu Wulan Kusuma Dewi', 'wulankusuma2004@gmail.com', 'Universitas Udayana', '087855783298', '$2y$10$5D5B57f6.eLYB7CJkveqEuDgM/hqjLgZ.475uY5rkF8NpBWHvp.4K', 'active', 'Asset/Gambar/profile.png'),
(316, 'Widiya Nasa Sapitri', 'widiyanasa20@gmail.com', 'Universitas Udayana', '081931555688', '$2y$10$WQmB.50ftstjP48bquh2zuTOpkJRvzT9PTGvWxvZujMRegAqXgiBK', 'active', 'Asset/Gambar/profile.png'),
(317, 'Ni Wayan Ari Kurnia Dewi', 'arikurniadewi04@gmail.com', 'Universitas Udayana', '088219357525', '$2y$10$y6SbuamBAg7OX1if.TwdSOYqwnhdAKo7p717duDhO0Fvk9S6d2.KS', 'active', 'Asset/Gambar/profile.png'),
(318, 'Irbah dzakiyatus sholehah', 'irbahdzakiya@gmail.com', 'Universitas Airlangga', '085239038804', '$2y$10$SYcm/DjCFfMAUih.yt3kee5gN2xzqn0jbkReTuJ4yDQQezZa1xeUW', 'active', 'Asset/Gambar/profile.png');

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
-- Indexes for table `history`
--
ALTER TABLE `history`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hasil_kuis`
--
ALTER TABLE `hasil_kuis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kuis`
--
ALTER TABLE `kuis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `kunjungan`
--
ALTER TABLE `kunjungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penempatan_pkl`
--
ALTER TABLE `penempatan_pkl`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
