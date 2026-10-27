-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 02, 2025 at 05:18 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbencana`
--

-- --------------------------------------------------------

--
-- Table structure for table `alokasi_bangunan_rusak_bencana`
--

CREATE TABLE `alokasi_bangunan_rusak_bencana` (
  `id` int NOT NULL,
  `id_bangunan_rusak_bencana` int NOT NULL,
  `kerugian` double NOT NULL,
  `jenis_kerusakan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alokasi_bantuan`
--

CREATE TABLE `alokasi_bantuan` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `id_bantuan` int NOT NULL,
  `hari_ke` int NOT NULL DEFAULT '1',
  `jumlah` float NOT NULL DEFAULT '0',
  `alokasi` float NOT NULL DEFAULT '0',
  `diterima` float NOT NULL DEFAULT '0',
  `foto_bukti` varchar(255) DEFAULT NULL,
  `id_shelter` int NOT NULL,
  `disetujui` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alokasi_bantuan`
--

INSERT INTO `alokasi_bantuan` (`id`, `id_bencana`, `id_bantuan`, `hari_ke`, `jumlah`, `alokasi`, `diterima`, `foto_bukti`, `id_shelter`, `disetujui`) VALUES
(12, 2, 4, 0, 5767, 0, 17, NULL, 4, 0),
(13, 2, 6, 0, 57, 0, 3, NULL, 4, 0),
(19, 5, 8, 0, 55, 0, 0, NULL, 5, 0),
(20, 5, 9, 0, 276, 0, 0, NULL, 5, 0),
(21, 5, 10, 0, 276, 0, 0, NULL, 5, 0),
(22, 5, 11, 0, 6, 0, 0, NULL, 5, 0),
(23, 5, 12, 0, 6, 0, 0, NULL, 5, 0),
(24, 5, 13, 0, 6, 0, 0, NULL, 5, 0),
(25, 5, 14, 0, 6, 0, 0, NULL, 5, 0),
(26, 5, 15, 0, 12, 0, 0, NULL, 5, 0),
(27, 5, 16, 0, 6, 0, 0, NULL, 5, 0),
(28, 5, 17, 0, 6, 0, 0, NULL, 5, 0),
(29, 5, 18, 0, 6, 0, 0, NULL, 5, 0),
(30, 5, 19, 0, 138, 0, 0, NULL, 5, 0),
(31, 5, 20, 0, 138, 0, 0, NULL, 5, 0),
(32, 5, 21, 0, 138, 0, 0, NULL, 5, 0),
(33, 5, 24, 0, 6, 0, 0, NULL, 5, 0),
(34, 5, 25, 0, 6, 0, 0, NULL, 5, 0),
(35, 5, 26, 0, 6, 0, 0, NULL, 5, 0),
(36, 5, 27, 0, 6, 0, 0, NULL, 5, 0),
(37, 5, 28, 0, 203, 0, 0, NULL, 5, 0),
(38, 5, 29, 0, 73, 0, 0, NULL, 5, 0),
(39, 5, 30, 0, 401, 0, 0, NULL, 5, 0),
(40, 5, 31, 0, 237, 0, 0, NULL, 5, 0),
(41, 5, 32, 0, 237, 0, 0, NULL, 5, 0),
(42, 5, 33, 0, 164, 0, 0, NULL, 5, 0),
(43, 5, 34, 0, 138, 0, 0, NULL, 5, 0),
(44, 5, 35, 0, 432, 0, 0, NULL, 5, 0),
(45, 5, 36, 0, 138, 0, 0, NULL, 5, 0),
(46, 5, 37, 0, 237, 0, 0, NULL, 5, 0),
(47, 5, 38, 0, 237, 0, 0, NULL, 5, 0),
(48, 5, 39, 0, 130, 0, 0, NULL, 5, 0),
(49, 5, 40, 0, 130, 0, 0, NULL, 5, 0),
(50, 5, 41, 0, 130, 0, 0, NULL, 5, 0),
(51, 5, 42, 0, 266, 0, 0, NULL, 5, 0),
(52, 5, 43, 0, 99, 0, 0, NULL, 5, 0),
(53, 5, 44, 0, 198, 0, 0, NULL, 5, 0),
(54, 5, 48, 0, 136, 0, 0, NULL, 5, 0),
(55, 5, 49, 0, 81, 0, 0, NULL, 5, 0),
(56, 5, 50, 0, 50, 0, 0, NULL, 5, 0),
(57, 5, 51, 0, 1659, 0, 0, NULL, 5, 0),
(58, 5, 52, 0, 593, 0, 0, NULL, 5, 0),
(1058, 7, 8, 1, 0.8, 0.7, 0.7, 'bukti_1736404130_8.png', 7, 0),
(1059, 7, 9, 1, 4, 4, 2, 'bukti_1736404130_9.jpg', 7, 0),
(1060, 7, 10, 1, 4, 0, 0, NULL, 7, 0),
(1061, 7, 11, 1, 1, 0, 0, NULL, 7, 0),
(1062, 7, 12, 1, 1, 0, 0, NULL, 7, 0),
(1063, 7, 13, 1, 1, 0, 0, NULL, 7, 0),
(1064, 7, 14, 1, 1, 0, 0, NULL, 7, 0),
(1065, 7, 15, 1, 2, 0, 0, NULL, 7, 0),
(1066, 7, 16, 1, 1, 0, 0, NULL, 7, 0),
(1067, 7, 17, 1, 1, 0, 0, NULL, 7, 0),
(1068, 7, 18, 1, 1, 0, 0, NULL, 7, 0),
(1069, 7, 19, 1, 2, 0, 0, NULL, 7, 0),
(1070, 7, 20, 1, 2, 0, 0, NULL, 7, 0),
(1071, 7, 21, 1, 2, 0, 0, NULL, 7, 0),
(1072, 7, 22, 1, 1, 0, 0, NULL, 7, 0),
(1073, 7, 23, 1, 1, 0, 0, NULL, 7, 0),
(1074, 7, 24, 1, 1, 0, 0, NULL, 7, 0),
(1075, 7, 25, 1, 1, 0, 0, NULL, 7, 0),
(1076, 7, 26, 1, 1, 0, 0, NULL, 7, 0),
(1077, 7, 27, 1, 1, 0, 0, NULL, 7, 0),
(1078, 7, 28, 1, 3, 0, 0, NULL, 7, 0),
(1079, 7, 29, 1, 1, 0, 0, NULL, 7, 0),
(1080, 7, 30, 1, 5, 0, 0, NULL, 7, 0),
(1081, 7, 31, 1, 3, 0, 0, NULL, 7, 0),
(1082, 7, 32, 1, 3, 0, 0, NULL, 7, 0),
(1083, 7, 33, 1, 2, 0, 0, NULL, 7, 0),
(1084, 7, 34, 1, 2, 0, 0, NULL, 7, 0),
(1085, 7, 35, 1, 6, 0, 0, NULL, 7, 0),
(1086, 7, 36, 1, 2, 0, 0, NULL, 7, 0),
(1087, 7, 37, 1, 3, 0, 0, NULL, 7, 0),
(1088, 7, 38, 1, 3, 0, 0, NULL, 7, 0),
(1089, 7, 39, 1, 2, 0, 0, NULL, 7, 0),
(1090, 7, 40, 1, 2, 0, 0, NULL, 7, 0),
(1091, 7, 41, 1, 2, 0, 0, NULL, 7, 0),
(1092, 7, 42, 1, 4, 0, 0, NULL, 7, 0),
(1093, 7, 43, 1, 1, 0, 0, NULL, 7, 0),
(1094, 7, 44, 1, 2, 0, 0, NULL, 7, 0),
(1095, 7, 45, 1, 1, 0, 0, NULL, 7, 0),
(1096, 7, 46, 1, 12, 0, 0, NULL, 7, 0),
(1097, 7, 47, 1, 2, 0, 0, NULL, 7, 0),
(1098, 7, 48, 1, 2, 0, 0, NULL, 7, 0),
(1099, 7, 49, 1, 1, 0, 0, NULL, 7, 0),
(1100, 7, 50, 1, 1, 0, 0, NULL, 7, 0),
(1101, 7, 51, 1, 21, 0, 0, NULL, 7, 0),
(1102, 7, 52, 1, 7.5, 0, 0, NULL, 7, 0),
(1418, 9, 8, 1, 8, 0, 0, NULL, 18, 0),
(1419, 9, 9, 1, 40, 0, 0, NULL, 18, 0),
(1420, 9, 10, 1, 40, 0, 0, NULL, 18, 0),
(1421, 9, 11, 1, 10, 0, 0, NULL, 18, 0),
(1422, 9, 12, 1, 10, 0, 0, NULL, 18, 0),
(1423, 9, 13, 1, 10, 0, 0, NULL, 18, 0),
(1424, 9, 14, 1, 10, 0, 0, NULL, 18, 0),
(1425, 9, 15, 1, 20, 0, 0, NULL, 18, 0),
(1426, 9, 16, 1, 10, 0, 0, NULL, 18, 0),
(1427, 9, 17, 1, 10, 0, 0, NULL, 18, 0),
(1428, 9, 18, 1, 10, 0, 0, NULL, 18, 0),
(1429, 9, 19, 1, 20, 0, 0, NULL, 18, 0),
(1430, 9, 20, 1, 20, 0, 0, NULL, 18, 0),
(1431, 9, 21, 1, 20, 0, 0, NULL, 18, 0),
(1432, 9, 22, 1, 10, 0, 0, NULL, 18, 0),
(1433, 9, 23, 1, 10, 0, 0, NULL, 18, 0),
(1434, 9, 24, 1, 10, 0, 0, NULL, 18, 0),
(1435, 9, 25, 1, 10, 0, 0, NULL, 18, 0),
(1436, 9, 26, 1, 10, 0, 0, NULL, 18, 0),
(1437, 9, 27, 1, 10, 0, 0, NULL, 18, 0),
(1438, 9, 28, 1, 30, 0, 0, NULL, 18, 0),
(1439, 9, 29, 1, 10, 0, 0, NULL, 18, 0),
(1440, 9, 30, 1, 50, 0, 0, NULL, 18, 0),
(1441, 9, 31, 1, 30, 0, 0, NULL, 18, 0),
(1442, 9, 32, 1, 30, 0, 0, NULL, 18, 0),
(1443, 9, 33, 1, 20, 0, 0, NULL, 18, 0),
(1444, 9, 34, 1, 20, 0, 0, NULL, 18, 0),
(1445, 9, 35, 1, 60, 0, 0, NULL, 18, 0),
(1446, 9, 36, 1, 20, 0, 0, NULL, 18, 0),
(1447, 9, 37, 1, 30, 0, 0, NULL, 18, 0),
(1448, 9, 38, 1, 30, 0, 0, NULL, 18, 0),
(1449, 9, 39, 1, 20, 0, 0, NULL, 18, 0),
(1450, 9, 40, 1, 20, 0, 0, NULL, 18, 0),
(1451, 9, 41, 1, 20, 0, 0, NULL, 18, 0),
(1452, 9, 42, 1, 22, 0, 0, NULL, 18, 0),
(1453, 9, 43, 1, 10, 0, 0, NULL, 18, 0),
(1454, 9, 44, 1, 20, 0, 0, NULL, 18, 0),
(1455, 9, 45, 1, 10, 0, 0, NULL, 18, 0),
(1456, 9, 46, 1, 120, 0, 0, NULL, 18, 0),
(1457, 9, 47, 1, 20, 0, 0, NULL, 18, 0),
(1458, 9, 48, 1, 2, 0, 0, NULL, 18, 0),
(1459, 9, 49, 1, 1, 0, 0, NULL, 18, 0),
(1460, 9, 50, 1, 1, 0, 0, NULL, 18, 0),
(1461, 9, 51, 1, 210, 0, 0, NULL, 18, 0),
(1462, 9, 52, 1, 75, 0, 0, NULL, 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `alokasi_bantuan_lainnya`
--

CREATE TABLE `alokasi_bantuan_lainnya` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `id_shelter` int NOT NULL,
  `pengendalian_penyakit` text,
  `kebutuhan_lainnya` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alokasi_bantuan_lainnya`
--

INSERT INTO `alokasi_bantuan_lainnya` (`id`, `id_bencana`, `id_shelter`, `pengendalian_penyakit`, `kebutuhan_lainnya`) VALUES
(11, 2, 4, 'sdfsd7', 'sdfsd7sadsad'),
(12, 2, 4, 'sdfdsf777', 'sdfdsf777'),
(15, 5, 5, 'Ea officiis doloribu', 'Officiis quibusdam a'),
(16, 5, 5, 'Ea officiis doloribu', 'Officiis quibusdam a'),
(17, 5, 5, 'Ea officiis doloribu', 'Officiis quibusdam a'),
(44, 7, 7, '-', '-'),
(52, 9, 18, '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `alokasi_relawan`
--

CREATE TABLE `alokasi_relawan` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `kecakapan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `id_relawan` int NOT NULL,
  `lama` int NOT NULL,
  `id_kecakapan` int NOT NULL,
  `tgl_tambah` date NOT NULL,
  `aktif` int NOT NULL DEFAULT '1',
  `id_shelter` int DEFAULT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alokasi_relawan`
--

INSERT INTO `alokasi_relawan` (`id`, `id_bencana`, `kecakapan`, `id_relawan`, `lama`, `id_kecakapan`, `tgl_tambah`, `aktif`, `id_shelter`, `tanggal_mulai`, `tanggal_selesai`) VALUES
(15, 9, NULL, 14, 14, 2, '0000-00-00', 1, 18, '2025-01-09', '2025-01-23');

-- --------------------------------------------------------

--
-- Table structure for table `alokasi_transportasi`
--

CREATE TABLE `alokasi_transportasi` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `id_transportasi` int NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alokasi_transportasi`
--

INSERT INTO `alokasi_transportasi` (`id`, `id_bencana`, `id_transportasi`, `jumlah`) VALUES
(15, 9, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `bangunan_rusak`
--

CREATE TABLE `bangunan_rusak` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `seng` int NOT NULL,
  `kayu` int NOT NULL,
  `dinding` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bangunan_rusak`
--

INSERT INTO `bangunan_rusak` (`id`, `tanggal`, `seng`, `kayu`, `dinding`) VALUES
(5, '2006-10-19', 12745, 789457, 7897907);

-- --------------------------------------------------------

--
-- Table structure for table `bangunan_rusak_bencana`
--

CREATE TABLE `bangunan_rusak_bencana` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `id_kecamatan` int NOT NULL,
  `id_kelurahan` int NOT NULL,
  `pemilik` varchar(255) DEFAULT NULL,
  `alamat` text,
  `seng` int NOT NULL,
  `kayu` int NOT NULL,
  `dinding` int NOT NULL,
  `jenis_kerusakan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bangunan_rusak_bencana`
--

INSERT INTO `bangunan_rusak_bencana` (`id`, `id_bencana`, `id_kecamatan`, `id_kelurahan`, `pemilik`, `alamat`, `seng`, `kayu`, `dinding`, `jenis_kerusakan`) VALUES
(14, 5, 4, 9, 'Consequuntur neque e', 'Provident necessita', 57, 55, 58, 'Ringan'),
(15, 5, 4, 9, 'Vitae deserunt occae', 'Sit sunt modi est ', 74, 16, 18, 'Ringan'),
(16, 5, 4, 9, 'Possimus voluptatem', 'Sit qui incididunt ', 35, 16, 14, 'Ringan'),
(17, 6, 2, 13, 'Deleniti voluptatem', 'Ipsum odio dolorem c', 76, 20, 83, 'Sangat Berat'),
(18, 6, 2, 13, 'Iusto ex non obcaeca', 'Magna ad pariatur S', 57, 14, 36, 'Ringan'),
(19, 7, 4, 8, 'a', 'a', 1, 1, 1, 'Ringan'),
(20, 7, 4, 8, 'b', 'b', 2, 2, 2, 'Sedang'),
(21, 7, 4, 8, 'c', 'c', 3, 3, 3, 'Berat'),
(22, 7, 4, 8, 'd', 'd', 4, 4, 4, 'Sangat Berat'),
(23, 7, 4, 8, 'd', 'd', 4, 4, 4, 'Sangat Berat'),
(24, 8, 2, 1, '1', '1', 1, 1, 1, 'Ringan'),
(25, 8, 2, 1, '2', '2', 2, 2, 2, 'Ringan'),
(26, 9, 6, 17, '1', '1', 1, 1, 1, 'Ringan'),
(27, 9, 6, 17, '2', '2', 2, 2, 2, 'Sedang'),
(28, 9, 6, 17, '3', '3', 3, 3, 3, 'Berat');

-- --------------------------------------------------------

--
-- Table structure for table `bantuan`
--

CREATE TABLE `bantuan` (
  `id` int NOT NULL,
  `jenis_logistik` varchar(255) DEFAULT NULL,
  `spesifikasi` text,
  `jumlah` float NOT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `jenis_bantuan` varchar(255) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bantuan`
--

INSERT INTO `bantuan` (`id`, `jenis_logistik`, `spesifikasi`, `jumlah`, `satuan`, `jenis_bantuan`, `keterangan`) VALUES
(8, 'Beras', '-', 4921.8, 'kg', 'Bantuan Pangan', '-'),
(9, 'Sarden', '(350kcal)', 19380, 'buah', 'Bantuan Pangan', '-'),
(10, 'Mie', '500 kcal', 19380, 'buah', 'Bantuan Pangan', '-'),
(11, 'Piranci Besar', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(12, 'piranci sedang', '-', 10000, 'buah', 'Bantuan Non Pangan', '-'),
(13, 'baskom', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(14, 'pisau dapur', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(15, 'centong kayu', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(16, 'ember 40 liter', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(17, 'ember 20 liter', '-', 1000, '500', 'Bantuan Non Pangan', '-'),
(18, 'jerigen 20 liter', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(19, 'piring makan', '-', 10000, 'buah', 'Bantuan Non Pangan', '-'),
(20, 'sendok makan', '-', 10000, 'buah', 'Bantuan Non Pangan', '-'),
(21, 'gelas', '-', 10000, 'buah', 'Bantuan Non Pangan', '-'),
(22, 'susu bayi', '-', 1000, 'buah', 'Bantuan Pangan', '-'),
(23, 'botol susu bayi', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(24, 'kompor', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(25, 'jerigen bahan bakar', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(26, 'lampu', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(27, 'alat-alat dan perkakas', '-', 1000, 'buah', 'Bantuan Non Pangan', '-'),
(28, 'kaos', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(29, 'celana', '-', 1000, 'buah', 'Bantuan Sandang', '-'),
(30, 'pakaian dalam', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(31, 'materas', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(32, 'selimut', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(33, 'bantal', '-', 10000, 'buah', 'Bantuan Sandang', '-\r\n'),
(34, 'alas kaki', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(35, 'sabun mandi', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(36, 'sabun cuci', '-', 10000, 'buah', 'Bantuan Sandang', '-\r\n'),
(37, 'sikat gigi', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(38, 'pasta gigi', '0', 10000, 'buah', 'Bantuan Sandang', '-'),
(39, 'jilbab', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(40, 'daster', '-', 10000, 'buah', 'Bantuan Sandang', '-\r\n'),
(41, 'rok', '-', 10000, 'buah', 'Bantuan Sandang', '-\r\n'),
(42, 'pembalut', '-', 10000, 'buah', 'Bantuan Sandang', '-\r\n'),
(43, 'kaos anak-anak', '-', 10000, '-', 'Bantuan Sandang', '-'),
(44, 'celana anak-anak', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(45, 'selimut 100 x 70 cm', '0', 10000, 'buah', 'Bantuan Sandang', '-'),
(46, 'popok cuci', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(47, 'pakaian bayi', '-', 10000, 'buah', 'Bantuan Sandang', '-'),
(48, 'pakaian hamil/menyusui', '-', 832, 'buah', 'Bantuan Sandang', '-'),
(49, 'tongkat cacat', '-', 903, 'buah', 'Bantuan Sandang', '-'),
(50, 'tongkat lansia', '-', 934, 'buah', 'Bantuan Sandang', '-'),
(51, 'air bersih', '-', 10000, 'liter', 'Bantuan Air', '-'),
(52, 'air minum', '-', 10000, 'liter', 'Bantuan Air', '-'),
(53, 'Uang', '-', 1, 'Rupiah', 'Bantuan Non Pangan', '-');

-- --------------------------------------------------------

--
-- Table structure for table `bencana`
--

CREATE TABLE `bencana` (
  `id` int NOT NULL,
  `jenis_bencana` varchar(255) DEFAULT NULL,
  `tanggal_kejadian` date NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `selesai_tanggap_darurat` date DEFAULT NULL,
  `selesai_rekontruksi` date DEFAULT NULL,
  `keterangan` text,
  `status` enum('Tanggap Darurat','Rekonstruksi','Selesai','Tidak Tanggap Darurat') DEFAULT NULL,
  `dokumen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bencana`
--

INSERT INTO `bencana` (`id`, `jenis_bencana`, `tanggal_kejadian`, `lokasi`, `selesai_tanggap_darurat`, `selesai_rekontruksi`, `keterangan`, `status`, `dokumen`) VALUES
(9, 'Gempa Bumi', '2025-01-09', 'asdf', '2025-01-23', '2028-01-09', 'asdf', 'Rekonstruksi', 'assets/uploads/Surat_Izin_DPMPTS.pdf'),
(10, 'Banjir', '2025-01-13', 'ads', '0000-00-00', '0000-00-00', 'asd', 'Tidak Tanggap Darurat', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengungsi`
--

CREATE TABLE `detail_pengungsi` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `id_shelter` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `umur` int NOT NULL,
  `alamat` text,
  `kelompok_rentan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pengungsi`
--

INSERT INTO `detail_pengungsi` (`id`, `id_bencana`, `id_shelter`, `nama`, `jenis_kelamin`, `umur`, `alamat`, `kelompok_rentan`) VALUES
(4, 9, 18, '1', 'Laki-laki', 1, '1', 'Tidak'),
(5, 9, 19, '2', 'Perempuan', 2, '2', 'Ibu Hamil/Menyusui'),
(6, 9, 18, '3', 'Laki-laki', 3, '3', 'Cacat, Lansia'),
(7, 9, 19, '4', 'Laki-laki', 4, '4', 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `gempa`
--

CREATE TABLE `gempa` (
  `id` int NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `lintang` decimal(9,6) DEFAULT NULL,
  `bujur` decimal(9,6) DEFAULT NULL,
  `kedalaman` float DEFAULT NULL,
  `magnitudo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jalan`
--

CREATE TABLE `jalan` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `lokasi` text,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `maps` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jalan`
--

INSERT INTO `jalan` (`id`, `id_bencana`, `nama`, `lokasi`, `foto`, `keterangan`, `maps`) VALUES
(2, 2, 'Optio quia quam quisquam modi labore praesentium.7', 'A nulla omnis est et perferendis reiciendis sunt eligendi.7', '9b42e4880435ce07be39555c987c36cf.jpeg', 'Dicta expedita fugit eaque.7', '-7.7,110.7'),
(4, 2, 'Laboriosam vero aspernatur.', 'Maxime saepe eum.', '869669687295465824ac98547c6e8bd2.jpg', 'Beatae minima eaque quia distinctio ullam debitis.', '-7.6321243,110.0159457'),
(5, 8, 'jalan rusak 1', 'asdf', '97b1aa84bd46c047e424d54c32e9e1df.jpg', 'asfd', '-0.9467512,100.3885248'),
(6, 9, 'jalan rusak', 'asdf', '4232d6098f0c81e3d34c199fbe49b3f5.jpg', '-', '-0.9129037,100.4641375');

-- --------------------------------------------------------

--
-- Table structure for table `kaji_cepat`
--

CREATE TABLE `kaji_cepat` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `laporan_hari_ke` int NOT NULL,
  `keterangan` text,
  `id_wilayah` int NOT NULL,
  `id_kelurahan` int NOT NULL,
  `hilang` int NOT NULL,
  `luka_berat` int NOT NULL,
  `luka_ringan` int NOT NULL,
  `pengungsi` int NOT NULL,
  `meninggal_dunia` int NOT NULL,
  `kerusakan_ringan` int NOT NULL,
  `kerusakan_sedang` int NOT NULL,
  `kerusakan_kuat` int NOT NULL,
  `taksiran_kerugian` bigint NOT NULL,
  `upaya_penanganan_meninggal` text,
  `upaya_penanganan_luka_berat` text,
  `upaya_penanganan_luka_ringan` text,
  `upaya_penanganan_hilang` text,
  `upaya_penanganan_pengungsi` text,
  `upaya_penanganan_kerusakan_bangunan` text,
  `kendala` text,
  `potensi_susulan` text,
  `rencana_aksi` text,
  `kesimpulan` text,
  `rekomendasi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kaji_cepat`
--

INSERT INTO `kaji_cepat` (`id`, `id_bencana`, `laporan_hari_ke`, `keterangan`, `id_wilayah`, `id_kelurahan`, `hilang`, `luka_berat`, `luka_ringan`, `pengungsi`, `meninggal_dunia`, `kerusakan_ringan`, `kerusakan_sedang`, `kerusakan_kuat`, `taksiran_kerugian`, `upaya_penanganan_meninggal`, `upaya_penanganan_luka_berat`, `upaya_penanganan_luka_ringan`, `upaya_penanganan_hilang`, `upaya_penanganan_pengungsi`, `upaya_penanganan_kerusakan_bangunan`, `kendala`, `potensi_susulan`, `rencana_aksi`, `kesimpulan`, `rekomendasi`) VALUES
(1, 2, 747, '0777', 3, 4, 5387, 3677, 6367, 5997, 847, 5707, 347, 2157, 2887, 'Pariatur dolores cupiditate explicabo qui.7', 'Minima veritatis debitis.7', 'Eius quaerat deserunt reprehenderit in ipsam quas autem neque quo.7', 'Hic laboriosam voluptatibus velit.7', 'Velit nobis nemo.7', 'Quidem illo sapiente.7', 'Velit suscipit ab.7', 'Reprehenderit voluptates pariatur dolore.7', 'Ipsa nesciunt in molestiae esse ab.7', 'Doloribus ducimus sint rem in.7', 'Sequi harum perspiciatis eaque ea explicabo eius fuga.7'),
(4, 2, 635, 'Eum commodi voluptatibus cumque.', 4, 8, 493, 426, 464, 376, 342, 626, 288, 298, 496, 'Dicta sit et illo dolorem vel animi ullam eum.', 'Suscipit a qui.', 'Ab libero exercitationem impedit ad voluptatem quae eligendi dolore mollitia.', 'Tempore perspiciatis dicta commodi laboriosam ullam minus hic ratione.', 'Architecto aspernatur minima unde distinctio fuga dicta.', 'Necessitatibus aperiam voluptatum.', 'Iusto libero ducimus molestias fugiat explicabo iusto illum doloremque.', 'Nostrum amet laudantium autem nam harum.', 'Temporibus deserunt amet nihil quibusdam ab eaque ad nostrum optio.', 'Dolorem molestias molestiae eligendi voluptatem omnis.', 'Architecto voluptatum voluptates.');

-- --------------------------------------------------------

--
-- Table structure for table `kaji_cepat_nw`
--

CREATE TABLE `kaji_cepat_nw` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `laporan_hari_ke` int NOT NULL,
  `keterangan` text,
  `upaya_penanganan_meninggal` text,
  `upaya_penanganan_luka_berat` text,
  `upaya_penanganan_luka_ringan` text,
  `upaya_penanganan_hilang` text,
  `upaya_penanganan_pengungsi` text,
  `upaya_penanganan_kerusakan_bangunan` text,
  `kendala` text,
  `potensi_susulan` text,
  `rencana_aksi` text,
  `kesimpulan` text,
  `rekomendasi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kaji_cepat_nw`
--

INSERT INTO `kaji_cepat_nw` (`id`, `id_bencana`, `laporan_hari_ke`, `keterangan`, `upaya_penanganan_meninggal`, `upaya_penanganan_luka_berat`, `upaya_penanganan_luka_ringan`, `upaya_penanganan_hilang`, `upaya_penanganan_pengungsi`, `upaya_penanganan_kerusakan_bangunan`, `kendala`, `potensi_susulan`, `rencana_aksi`, `kesimpulan`, `rekomendasi`) VALUES
(3, 5, 1, 'Non ut minim ut dolo', 'Quis velit non volu', 'Amet non aut eos n', 'Aut qui tempor sint', 'Vero aut aut harum i', 'A repellendus Rerum', 'Sequi nisi sunt temp', 'Sed molestiae quaera', 'Est sunt eum fugiat ', 'Aspernatur sit exerc', 'Blanditiis eligendi ', 'Sed quaerat alias ir'),
(4, 6, 1, 'Beatae beatae deleni', 'Provident dolor eni', 'Modi consequuntur mo', 'Et aspernatur facili', 'Asperiores nihil ips', 'Facilis illum esse ', 'Porro dignissimos pr', 'Ut atque facilis qui', 'Magna recusandae Do', 'Cum autem eveniet m', 'Pariatur Veniam de', 'Vitae fugiat facere '),
(5, 7, 1, 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf'),
(6, 8, 1, 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'aasdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf'),
(7, 9, 1, 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', 'asdf'),
(8, 9, 2, 'qwer', 'asdf', 'asdf', 'asdf', 'asdf', 'sadf', 'asdf', 'asdf', 'sadf', 'asdf', 'asdf', 'asfd'),
(9, 10, 1, 'ads', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `kecakapan`
--

CREATE TABLE `kecakapan` (
  `id` int NOT NULL,
  `kelompok` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kecakapan`
--

INSERT INTO `kecakapan` (`id`, `kelompok`) VALUES
(1, 'Perencanaan'),
(2, 'Pendidikan'),
(3, 'Sistem Informasi Geografis dan Pemetaan'),
(4, 'Pelatihan, Geladi dan Simulasi Bencana'),
(5, 'Kaji Cepat Bencana'),
(6, 'Pencarian dan Penyelamatan (SAR) dan Evakuasi'),
(7, 'Transportasi'),
(8, 'Logistik'),
(9, 'Keamanan Pangan dan Nutrisi'),
(10, 'Dapur Umum'),
(11, 'Pengelolaan Lokasi Pengungsian dan Huntara'),
(12, 'Pengelolaan Posko PB'),
(13, 'Kesehatan/Medis'),
(14, 'Air Bersih, Sanitasi dan Kesehatan Lingkungan'),
(15, 'Keamanan dan Perlindungan'),
(16, 'Gender dan Kelompok Rentan'),
(17, 'Psikososial/Konseling/Penyembuhan Trauma'),
(18, 'Pertukangan dan Perekayasaan'),
(19, 'Pertaniaan, Peternakan dan Penghidupan'),
(20, 'Administrasi'),
(21, 'Pengelolaan Keuangan'),
(22, 'Bahasa Asing'),
(23, 'Informasi dan Komunikasi'),
(24, 'Hubungan Media dan Masyarakat'),
(25, 'Pemantauan, Evaluasi dan Pelaporan'),
(26, 'Promosi dan Mobilisasi Relawan'),
(27, 'Dokter'),
(28, 'Perawat'),
(29, 'Bidan'),
(30, 'Tenaga Kefarmasian'),
(31, 'Tenaga Kesehatan Masyarakat'),
(32, 'Tenaga Kesehatan Lingkungan'),
(33, 'Tenaga Gizi'),
(34, 'Tenaga Kesehatan Jiwa');

-- --------------------------------------------------------

--
-- Table structure for table `kecakapan_relawan`
--

CREATE TABLE `kecakapan_relawan` (
  `id_kecakapan` int NOT NULL,
  `id_relawan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kecakapan_relawan`
--

INSERT INTO `kecakapan_relawan` (`id_kecakapan`, `id_relawan`) VALUES
(5, 12),
(18, 12),
(20, 12),
(23, 12),
(26, 12),
(7, 11),
(8, 11),
(2, 15),
(1, 13),
(5, 13),
(3, 16),
(1, 17),
(2, 14),
(2, 18);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `id_transportasi` int NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `id_bencana`, `id_transportasi`, `jumlah`) VALUES
(2, 2, 5, 5967),
(3, 2, 4, 37);

-- --------------------------------------------------------

--
-- Table structure for table `kerusakan_bangunan`
--

CREATE TABLE `kerusakan_bangunan` (
  `id` int NOT NULL,
  `id_wilayah` int NOT NULL,
  `id_kelurahan` int NOT NULL,
  `id_kaji_cepat_nw` int NOT NULL,
  `kerusakan_ringan` int NOT NULL,
  `kerusakan_sedang` int NOT NULL,
  `kerusakan_kuat` int NOT NULL,
  `taksiran_kerugian` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kerusakan_bangunan`
--

INSERT INTO `kerusakan_bangunan` (`id`, `id_wilayah`, `id_kelurahan`, `id_kaji_cepat_nw`, `kerusakan_ringan`, `kerusakan_sedang`, `kerusakan_kuat`, `taksiran_kerugian`) VALUES
(1, 3, 4, 2, 85, 96, 65, 88),
(2, 3, 6, 2, 325, 54, 45, 45),
(3, 4, 9, 3, 42, 79, 35, 30),
(4, 4, 10, 3, 178, 78, 78, 78),
(5, 4, 10, 3, 87, 78, 58, 8),
(6, 2, 3, 4, 51, 87, 36, 60),
(7, 2, 13, 4, 890, 9, 8, 78),
(8, 2, 1, 5, 1, 1, 1, 1),
(9, 2, 1, 6, 1, 1, 1, 1),
(10, 6, 17, 7, 12, 12, 12, 12),
(11, 6, 16, 8, 12, 12, 12, 12),
(12, 6, 16, 9, 12, 21, 12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `korban_jiwa`
--

CREATE TABLE `korban_jiwa` (
  `id` int NOT NULL,
  `id_wilayah` int NOT NULL,
  `id_kelurahan` int NOT NULL,
  `id_kaji_cepat_nw` int NOT NULL,
  `hilang` int NOT NULL,
  `luka_berat` int NOT NULL,
  `luka_ringan` int NOT NULL,
  `pengungsi` int NOT NULL,
  `meninggal_dunia` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `korban_jiwa`
--

INSERT INTO `korban_jiwa` (`id`, `id_wilayah`, `id_kelurahan`, `id_kaji_cepat_nw`, `hilang`, `luka_berat`, `luka_ringan`, `pengungsi`, `meninggal_dunia`) VALUES
(1, 4, 10, 2, 14, 18, 64, 89, 80),
(2, 4, 11, 2, 345, 234, 53, 254, 54),
(3, 4, 8, 3, 15, 75, 16, 11, 70),
(4, 4, 9, 3, 4, 345, 2345, 54, 56),
(5, 4, 10, 3, 56, 56, 4, 7, 65),
(6, 4, 8, 4, 12, 8, 45, 31, 4),
(7, 4, 9, 4, 345, 65, 45, 34, 34),
(8, 4, 8, 5, 1, 1, 1, 1, 1),
(9, 2, 1, 6, 1, 1, 1, 1, 1),
(10, 5, 14, 7, 12, 12, 12, 12, 12),
(11, 5, 15, 8, 12, 12, 12, 12, 12),
(12, 5, 14, 9, 12, 12, 12, 12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `panduan_bantuan`
--

CREATE TABLE `panduan_bantuan` (
  `id` int NOT NULL,
  `qt` float NOT NULL,
  `id_bantuan` int NOT NULL,
  `kriteria_penerima` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `panduan_bantuan`
--

INSERT INTO `panduan_bantuan` (`id`, `qt`, `id_bantuan`, `kriteria_penerima`) VALUES
(46, 2, 48, 'Ibu Hamil/Menyusui'),
(47, 2, 42, 'Ibu Hamil/Menyusui'),
(70, 7, 51, 'Perempuan'),
(71, 2.5, 52, 'Perempuan'),
(72, 1, 34, 'Perempuan'),
(73, 1, 33, 'Perempuan'),
(74, 0.4, 8, 'Perempuan'),
(75, 2, 40, 'Perempuan'),
(76, 1, 21, 'Perempuan'),
(77, 2, 39, 'Perempuan'),
(78, 2, 28, 'Perempuan'),
(79, 1, 31, 'Perempuan'),
(80, 2, 10, 'Perempuan'),
(81, 2, 30, 'Perempuan'),
(82, 1, 38, 'Perempuan'),
(83, 2, 42, 'Perempuan'),
(84, 1, 19, 'Perempuan'),
(85, 2, 41, 'Perempuan'),
(86, 1, 36, 'Perempuan'),
(87, 4, 35, 'Perempuan'),
(88, 2, 9, 'Perempuan'),
(89, 1, 32, 'Perempuan'),
(90, 1, 20, 'Perempuan'),
(91, 1, 37, 'Perempuan'),
(92, 7, 51, 'Laki-laki'),
(93, 2.5, 52, 'Laki-laki'),
(94, 1, 34, 'Laki-laki'),
(95, 0.4, 8, 'Laki-laki'),
(96, 1, 29, 'Laki-laki'),
(97, 1, 21, 'Laki-laki'),
(98, 1, 28, 'Laki-laki'),
(99, 1, 31, 'Laki-laki'),
(100, 2, 10, 'Laki-laki'),
(101, 1, 30, 'Laki-laki'),
(102, 1, 38, 'Laki-laki'),
(103, 1, 19, 'Laki-laki'),
(104, 1, 36, 'Laki-laki'),
(105, 1, 35, 'Laki-laki'),
(106, 2, 9, 'Laki-laki'),
(107, 1, 32, 'Laki-laki'),
(108, 1, 20, 'Laki-laki'),
(109, 1, 37, 'Laki-laki'),
(110, 1, 27, 'Rumah Tangga'),
(111, 1, 13, 'Rumah Tangga'),
(112, 2, 15, 'Rumah Tangga'),
(113, 1, 17, 'Rumah Tangga'),
(114, 1, 16, 'Rumah Tangga'),
(115, 1, 18, 'Rumah Tangga'),
(116, 1, 25, 'Rumah Tangga'),
(117, 1, 24, 'Rumah Tangga'),
(118, 1, 26, 'Rumah Tangga'),
(119, 1, 11, 'Rumah Tangga'),
(120, 1, 12, 'Rumah Tangga'),
(121, 1, 14, 'Rumah Tangga'),
(125, 1, 23, 'Bayi'),
(126, 2, 47, 'Bayi'),
(127, 12, 46, 'Bayi'),
(128, 1, 45, 'Bayi'),
(129, 1, 22, 'Bayi'),
(130, 7, 51, 'Anak-anak'),
(131, 2.5, 52, 'Anak-anak'),
(132, 1, 33, 'Anak-anak'),
(133, 2, 44, 'Anak-anak'),
(134, 1, 43, 'Anak-anak'),
(135, 1, 31, 'Anak-anak'),
(136, 2, 30, 'Anak-anak'),
(137, 1, 38, 'Anak-anak'),
(138, 1, 35, 'Anak-anak'),
(139, 1, 32, 'Anak-anak'),
(140, 1, 37, 'Anak-anak'),
(141, 1, 49, 'Cacat'),
(142, 1, 50, 'Lansia');

-- --------------------------------------------------------

--
-- Table structure for table `pengungsi`
--

CREATE TABLE `pengungsi` (
  `id` int NOT NULL,
  `id_shelter` int NOT NULL,
  `laki_laki` int NOT NULL,
  `perempuan` int NOT NULL,
  `rumah_tangga` int NOT NULL,
  `anak` int NOT NULL,
  `bayi` int NOT NULL,
  `bumil` int NOT NULL,
  `cacat` int NOT NULL,
  `lansia` int NOT NULL,
  `pengendalian_penyakit` text,
  `kebutuhan_lainnya` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengungsi`
--

INSERT INTO `pengungsi` (`id`, `id_shelter`, `laki_laki`, `perempuan`, `rumah_tangga`, `anak`, `bayi`, `bumil`, `cacat`, `lansia`, `pengendalian_penyakit`, `kebutuhan_lainnya`) VALUES
(1, 3, 27, 877, 137, 967, 637, 737, 977, 657, 'Officiis do lorem od7', 'Velit quam eum labor7'),
(4, 1, 212, 211, 416, 69, 311, 144, 243, 202, 'Quae assumenda recusandae consectetur nesciunt non numquam architecto.', 'Tenetur et itaque.'),
(5, 3, 373, 116, 105, 198, 521, 314, 18, 633, 'Explicabo alias maiores iure dolore illum.', 'Tempore maiores nisi dicta perferendis est vero ipsum.'),
(6, 6, 15, 7, 45, 53, 84, 30, 24, 81, 'Quibusdam consectetu', 'Non vitae voluptate '),
(7, 5, 73, 65, 6, 99, 34, 68, 81, 50, 'Ea officiis doloribu', 'Officiis quibusdam a'),
(8, 7, 1, 1, 1, 1, 1, 1, 1, 1, '-', '-'),
(9, 9, 1000, 1000, 500, 500, 50, 0, 0, 0, '-', '-'),
(10, 10, 500, 250, 100, 100, 20, 0, 0, 0, '-', '-'),
(11, 16, 1, 1, 1, 1, 1, 1, 1, 1, '-', '-'),
(12, 17, 1, 1, 1, 1, 1, 1, 1, 1, '-', '-'),
(15, 18, 500, 250, 250, 50, 10, 1, 1, 1, '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `relawan`
--

CREATE TABLE `relawan` (
  `id` int NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `no_kontak` varchar(255) DEFAULT NULL,
  `institusi` varchar(255) NOT NULL,
  `kecakapan` varchar(255) NOT NULL,
  `pengalaman_kerelawanan` text,
  `pengalaman` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tersedia` int NOT NULL DEFAULT '1',
  `disetujui` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `relawan`
--

INSERT INTO `relawan` (`id`, `nama`, `tgl_lahir`, `jenis_kelamin`, `no_kontak`, `institusi`, `kecakapan`, `pengalaman_kerelawanan`, `pengalaman`, `foto`, `tersedia`, `disetujui`) VALUES
(13, 'Arsitektur Kode', '2005-02-02', 'Perempuan', '621234567866', 'ABC', '', 'tes', '3', 'img_673d1da8e79ce.jpg', 1, 1),
(14, 'Relawan 1', '2025-01-08', 'Laki-laki', '628123465789', 'QWE', '', '-', '14', 'img_677df421d6c69.jpg', 0, 0),
(17, 'Relawan 4', '2024-01-01', 'Laki-laki', '628123456789', 'DFG', '', '-', '2', 'img_677faab72cc0d.jpg', 0, 0),
(18, 'Relawan 3', '2025-01-06', 'Laki-laki', '628123456789', 'ASD', '', '-', '14', 'img_67851ea45158f.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `relawan_banyak`
--

CREATE TABLE `relawan_banyak` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `id_kecakapan_relawan` int NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `relawan_banyak`
--

INSERT INTO `relawan_banyak` (`id`, `id_bencana`, `id_kecakapan_relawan`, `jumlah`) VALUES
(1, 5, 7, 75),
(5, 5, 13, 4),
(6, 5, 3, 77),
(7, 5, 22, 95),
(8, 5, 4, 99),
(9, 5, 19, 8),
(11, 7, 1, 1),
(12, 7, 2, 1),
(93, 9, 27, 1),
(94, 9, 28, 2),
(95, 9, 29, 2),
(96, 9, 30, 1),
(97, 9, 31, 1),
(98, 9, 32, 1),
(99, 9, 33, 1),
(100, 9, 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shelter`
--

CREATE TABLE `shelter` (
  `id` int NOT NULL,
  `id_bencana` int NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_kecamatan` int NOT NULL,
  `id_kelurahan` int NOT NULL,
  `maps` text,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shelter`
--

INSERT INTO `shelter` (`id`, `id_bencana`, `nama`, `id_kecamatan`, `id_kelurahan`, `maps`, `keterangan`) VALUES
(18, 9, 'Shelter A', 5, 14, '-0.9467476,100.3985264', '-'),
(19, 9, 'Shelter B', 6, 17, '-0.9467477,100.3985267', '-'),
(20, 10, 'ABC', 5, 14, '-0.9306112,100.3945984', '-');

-- --------------------------------------------------------

--
-- Table structure for table `status_bencana`
--

CREATE TABLE `status_bencana` (
  `id` int NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status` enum('hijau','kuning','merah') NOT NULL,
  `jumlah_pengungsi` int NOT NULL,
  `jumlah_relawan` int NOT NULL,
  `bangunan_rusak_berat` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `status_bencana`
--

INSERT INTO `status_bencana` (`id`, `lokasi`, `status`, `jumlah_pengungsi`, `jumlah_relawan`, `bangunan_rusak_berat`, `created_at`, `updated_at`) VALUES
(1, 'Kabupaten Agam', 'merah', 3200, 45, 70, '2025-08-05 11:27:56', '2025-08-05 11:27:56'),
(2, 'Padang Pariaman', 'kuning', 700, 20, 15, '2025-08-05 11:27:56', '2025-08-05 11:27:56'),
(3, 'Bukittinggi', 'hijau', 50, 10, 1, '2025-08-05 11:27:56', '2025-08-05 11:27:56');

-- --------------------------------------------------------

--
-- Table structure for table `transportasi`
--

CREATE TABLE `transportasi` (
  `id` int NOT NULL,
  `jenis_kendaraan` varchar(255) DEFAULT NULL,
  `jumlah` int NOT NULL,
  `tersedia` int NOT NULL,
  `kapasitas` int NOT NULL,
  `instansi` varchar(255) DEFAULT NULL,
  `tahun_pengadaan` int NOT NULL,
  `kondisi` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `jumlah_renkon` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transportasi`
--

INSERT INTO `transportasi` (`id`, `jenis_kendaraan`, `jumlah`, `tersedia`, `kapasitas`, `instansi`, `tahun_pengadaan`, `kondisi`, `keterangan`, `jumlah_renkon`) VALUES
(6, 'Mobil Rescue Komandan', 100, 90, 1000, 'BNPB', 2020, 'Baik', '-', 120),
(7, 'Mobil Tangki Air', 100, 100, 2000, 'BPBD', 2021, 'Baik', '-', 120);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$PJfl.NXTyQ3J0.ENTwDWoOWASCjQt/fEMx30P87yN5l6Cm6s5mweS', 'admin'),
(2, 'tim reaksi cepat', '$2y$10$PJfl.NXTyQ3J0.ENTwDWoOWASCjQt/fEMx30P87yN5l6Cm6s5mweS', 'tim reaksi cepat'),
(5, 'tim rekonstruksi', '$2y$10$3hvzIw0xxSrQzqbCtFXpuu610wULxufTaFRnGia8xOmeFNRPSLxKW', 'tim rekonstruksi'),
(6, 'petugas pengungsian', '$2y$10$K1XyOzGchpnULgHoMW9k5uV1EbQT0fVsaM.JqjmjBL5tYJ4NxOClm', 'petugas pengungsian'),
(7, 'bidang kedaruratan', '$2y$10$ZJhk95FSWkKDLcQOQJoUI.CGh69z45RFIvsz8YAwTY53bSuoA4pmS', 'bidang kedaruratan & logistik'),
(8, 'bidang rehabilitasi', '$2y$10$w3DEDSeOMOtQswqo7rvBTOa/cclDv0izuN06UtU2pNyRk6zlnXLoC', 'bidang rehabilitasi & rekontruksi'),
(13, 'kepala bidang', '$2y$10$cODM4Dmf99qdiV70A.IOxugqO/xnTTjvQhsXPGs1H8hIuuoTp3gxy', 'kepala bidang');

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id` int NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `cluster` int DEFAULT NULL,
  `kategori_risiko` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id`, `nama`, `cluster`, `kategori_risiko`) VALUES
(5, 'A', NULL, NULL),
(6, 'B', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wilayah_kelurahan`
--

CREATE TABLE `wilayah_kelurahan` (
  `id` int NOT NULL,
  `id_wilayah` int NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `total_penduduk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `wilayah_kelurahan`
--

INSERT INTO `wilayah_kelurahan` (`id`, `id_wilayah`, `nama`, `total_penduduk`) VALUES
(14, 5, 'A1', 2000),
(15, 5, 'A2', 4000),
(16, 6, 'B1', 5000),
(17, 6, 'B2', 10000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alokasi_bangunan_rusak_bencana`
--
ALTER TABLE `alokasi_bangunan_rusak_bencana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alokasi_bantuan`
--
ALTER TABLE `alokasi_bantuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alokasi_bantuan_lainnya`
--
ALTER TABLE `alokasi_bantuan_lainnya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alokasi_relawan`
--
ALTER TABLE `alokasi_relawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alokasi_transportasi`
--
ALTER TABLE `alokasi_transportasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bangunan_rusak`
--
ALTER TABLE `bangunan_rusak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bangunan_rusak_bencana`
--
ALTER TABLE `bangunan_rusak_bencana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bantuan`
--
ALTER TABLE `bantuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bencana`
--
ALTER TABLE `bencana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pengungsi`
--
ALTER TABLE `detail_pengungsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gempa`
--
ALTER TABLE `gempa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jalan`
--
ALTER TABLE `jalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kaji_cepat`
--
ALTER TABLE `kaji_cepat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kaji_cepat_nw`
--
ALTER TABLE `kaji_cepat_nw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecakapan`
--
ALTER TABLE `kecakapan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kerusakan_bangunan`
--
ALTER TABLE `kerusakan_bangunan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korban_jiwa`
--
ALTER TABLE `korban_jiwa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panduan_bantuan`
--
ALTER TABLE `panduan_bantuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengungsi`
--
ALTER TABLE `pengungsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relawan`
--
ALTER TABLE `relawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relawan_banyak`
--
ALTER TABLE `relawan_banyak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shelter`
--
ALTER TABLE `shelter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_bencana`
--
ALTER TABLE `status_bencana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transportasi`
--
ALTER TABLE `transportasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wilayah_kelurahan`
--
ALTER TABLE `wilayah_kelurahan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alokasi_bangunan_rusak_bencana`
--
ALTER TABLE `alokasi_bangunan_rusak_bencana`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alokasi_bantuan`
--
ALTER TABLE `alokasi_bantuan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1463;

--
-- AUTO_INCREMENT for table `alokasi_bantuan_lainnya`
--
ALTER TABLE `alokasi_bantuan_lainnya`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `alokasi_relawan`
--
ALTER TABLE `alokasi_relawan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `alokasi_transportasi`
--
ALTER TABLE `alokasi_transportasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bangunan_rusak`
--
ALTER TABLE `bangunan_rusak`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bangunan_rusak_bencana`
--
ALTER TABLE `bangunan_rusak_bencana`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `bantuan`
--
ALTER TABLE `bantuan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `bencana`
--
ALTER TABLE `bencana`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_pengungsi`
--
ALTER TABLE `detail_pengungsi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gempa`
--
ALTER TABLE `gempa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jalan`
--
ALTER TABLE `jalan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kaji_cepat`
--
ALTER TABLE `kaji_cepat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kaji_cepat_nw`
--
ALTER TABLE `kaji_cepat_nw`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kecakapan`
--
ALTER TABLE `kecakapan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kerusakan_bangunan`
--
ALTER TABLE `kerusakan_bangunan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `korban_jiwa`
--
ALTER TABLE `korban_jiwa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `panduan_bantuan`
--
ALTER TABLE `panduan_bantuan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `pengungsi`
--
ALTER TABLE `pengungsi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `relawan`
--
ALTER TABLE `relawan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `relawan_banyak`
--
ALTER TABLE `relawan_banyak`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `shelter`
--
ALTER TABLE `shelter`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `status_bencana`
--
ALTER TABLE `status_bencana`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transportasi`
--
ALTER TABLE `transportasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wilayah_kelurahan`
--
ALTER TABLE `wilayah_kelurahan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
