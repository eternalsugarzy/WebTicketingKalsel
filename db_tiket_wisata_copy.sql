-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2025 at 06:40 AM
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
-- Database: `db_tiket_wisata_copy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_harga_tiket`
--

CREATE TABLE `tbl_harga_tiket` (
  `id_harga` int NOT NULL AUTO_INCREMENT,
  `id_objek` int NOT NULL,
  `id_jenis_tiket` int NOT NULL,
  `harga` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_harga`),
  KEY `fk_objek_harga` (`id_objek`),
  KEY `fk_jenis_tiket_harga` (`id_jenis_tiket`),
  CONSTRAINT `fk_jenis_tiket_harga` FOREIGN KEY (`id_jenis_tiket`) REFERENCES `tbl_jenis_tiket` (`id_jenis_tiket`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_objek_harga` FOREIGN KEY (`id_objek`) REFERENCES `tbl_objek_wisata` (`id_objek`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_harga_tiket`
--

INSERT INTO `tbl_harga_tiket` (`id_harga`, `id_objek`, `id_jenis_tiket`, `harga`) VALUES
(2, 2, 1, 20000),
(3, 2, 2, 10000),
(4, 1, 1, 10000),
(5, 1, 2, 10000),
(41, 3, 1, 5000),
(42, 3, 2, 3000),
(43, 3, 3, 0),
(44, 5, 1, 10000),
(45, 5, 2, 5000),
(46, 5, 5, 7000),
(47, 6, 1, 5000),
(48, 6, 2, 2000),
(49, 7, 1, 10000),
(50, 7, 2, 5000),
(51, 8, 1, 15000),
(52, 8, 2, 10000),
(53, 9, 1, 20000),
(54, 9, 2, 10000),
(55, 10, 1, 15000),
(56, 10, 2, 10000),
(57, 11, 1, 5000),
(58, 11, 2, 3000),
(59, 12, 1, 25000),
(60, 12, 2, 15000),
(61, 13, 1, 50000),
(62, 13, 2, 30000),
(63, 14, 1, 35000),
(64, 14, 2, 20000),
(65, 14, 5, 25000),
(66, 15, 1, 10000),
(67, 15, 2, 5000),
(68, 16, 1, 5000),
(69, 16, 2, 2000),
(70, 17, 1, 10000),
(71, 17, 2, 5000),
(72, 18, 1, 7000),
(73, 18, 2, 4000),
(74, 19, 1, 15000),
(75, 19, 2, 10000),
(76, 1, 3, 0),
(77, 2, 3, 0),
(78, 5, 3, 0),
(79, 6, 3, 0),
(80, 7, 3, 0),
(81, 8, 3, 0),
(82, 9, 3, 0),
(83, 10, 3, 0),
(84, 11, 3, 0),
(85, 12, 3, 0),
(86, 13, 3, 0),
(87, 14, 3, 0),
(88, 15, 3, 0),
(89, 16, 3, 0),
(90, 17, 3, 0),
(91, 18, 3, 0),
(92, 19, 3, 0),
(93, 2, 5, 3000),
(94, 6, 5, 3000),
(95, 16, 5, 3000),
(96, 17, 5, 7000),
(97, 20, 1, 10000),
(98, 13, 6, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_tiket`
--

--
-- Table structure for table `tbl_jenis_tiket`
--

CREATE TABLE `tbl_jenis_tiket` (
  `id_jenis_tiket` int NOT NULL AUTO_INCREMENT,
  `nama_tiket` varchar(100) NOT NULL,
  PRIMARY KEY (`id_jenis_tiket`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_jenis_tiket`
--

INSERT INTO `tbl_jenis_tiket` (`id_jenis_tiket`, `nama_tiket`) VALUES
(1, 'Tiket Dewasa'),
(2, 'Tiket Anak'),
(3, 'Tiket Gratis'),
(5, 'Tiket Pelajar'),
(6, 'Tiket Tourist'),
(7, 'Tiket Rombongan'),
(8, 'Tiket Khusus');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kabupaten`
--

CREATE TABLE `tbl_kabupaten` (
  `id_kabupaten` int NOT NULL AUTO_INCREMENT,
  `nama_kabupaten` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kabupaten`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_kabupaten`
--

INSERT INTO `tbl_kabupaten` (`id_kabupaten`, `nama_kabupaten`) VALUES
(1, 'Kab. Balanga'),
(2, 'Kab. Banjar'),
(3, 'Kab. Barito Kuala'),
(4, 'Kab. Hulu Sungai Selatan'),
(5, 'Kab. Hulu Sungai Tengah'),
(6, 'Kab. Hulu Sungai Utara'),
(7, 'Kab. Kotabaru'),
(8, 'Kab. Tabalong'),
(9, 'Kab. Tanah Bumbu'),
(10, 'Kab. Tanah Laut'),
(11, 'Kab. Tapin'),
(12, 'Kota Banjarbaru'),
(13, 'Kota Banjarmasin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_objek_wisata`
--

CREATE TABLE `tbl_objek_wisata` (
  `id_objek` int NOT NULL AUTO_INCREMENT,
  `id_kabupaten` int NOT NULL,
  `nama_objek` varchar(150) NOT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_objek`),
  KEY `fk_kabupaten` (`id_kabupaten`),
  CONSTRAINT `fk_kabupaten` FOREIGN KEY (`id_kabupaten`) REFERENCES `tbl_kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_objek_wisata`
--

INSERT INTO `tbl_objek_wisata` (`id_objek`, `id_kabupaten`, `nama_objek`, `deskripsi`, `foto`, `alamat`) VALUES
(1, 10, 'Pantai Takisung', NULL, NULL, 'Jl Raya Takisung, Kec Takisung, Kabupaten Tanah Laut'),
(2, 12, 'Museum Lambung Mangkurat', NULL, NULL, 'Jl. A. Yani No.Km. 36, Loktabat Utara, Kec. Banjarbaru Utara, Kota BanjarBaru'),
(3, 2, 'Pasar Terapung Lok Baintan', NULL, NULL, 'Jl. Desa Lok Baintan, Sungai Tandipah, Kec. Sungai Tabuk'),
(5, 13, 'Menara Pandang Banjarmasin', NULL, NULL, 'Jl. Kapten Tendean, Gadang, Banjarmasin'),
(6, 13, 'Pasar Terapung Siring Tendean', NULL, NULL, 'Jl. Kapten Pierre Tendean, Banjarmasin'),
(7, 12, 'Danau Seran', NULL, NULL, 'Guntung Manggis, Banjarbaru'),
(8, 2, 'Bukit Matang Kaladan', NULL, NULL, 'Aranio, Kec. Aranio, Kab. Banjar'),
(9, 4, 'Air Terjun Haratai (Loksado)', NULL, NULL, 'Loksado, Hulu Sungai Selatan'),
(10, 4, 'Pemandian Air Panas Tanuhi', NULL, NULL, 'Tanuhi, Loksado, Hulu Sungai Selatan'),
(11, 5, 'Pagat Batu Benawa', NULL, NULL, 'Pagat, Batu Benawa, Hulu Sungai Tengah'),
(12, 7, 'Pantai Gedambaan', NULL, NULL, 'Sarang Tiung, Kec. Pulau Laut Utara, Kotabaru'),
(13, 7, 'Pulau Samber Gelap', NULL, NULL, 'Pulau Sebuku, Kotabaru'),
(14, 9, 'Pantai Angsana', NULL, NULL, 'Angsana, Kec. Angsana, Tanah Bumbu'),
(15, 8, 'Air Terjun Lano', NULL, NULL, 'Lano, Kec. Jaro, Tabalong'),
(16, 1, 'Taman Hijau Balangan', NULL, NULL, 'Paringin Selatan, Balangan'),
(17, 11, 'Goa Batu Hapu', NULL, NULL, 'Batu Hapu, Kec. Hatungun, Tapin'),
(18, 3, 'Pulau Kembang', NULL, NULL, 'Pulau Alalak, Barito Kuala'),
(19, 10, 'Pantai Joras', NULL, NULL, 'Joras, Kec. Jorong, Tanah Laut'),
(20, 10, 'Bukit Birah', NULL, NULL, 'Jl Raya Batakan, Kec Kandangan Lama, Tanah Laut');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_objek_wisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_objek_wisata`
--

CREATE TABLE `tbl_objek_wisata` (
  `id_objek` int NOT NULL AUTO_INCREMENT,
  `id_kabupaten` int NOT NULL,
  `nama_objek` varchar(150) NOT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`id_objek`),
  KEY `fk_kabupaten` (`id_kabupaten`),
  CONSTRAINT `fk_kabupaten` FOREIGN KEY (`id_kabupaten`) REFERENCES `tbl_kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_objek_wisata`
--

INSERT INTO `tbl_objek_wisata` (`id_objek`, `id_kabupaten`, `nama_objek`, `deskripsi`, `foto`, `alamat`) VALUES
(1, 10, 'Pantai Takisung', NULL, NULL, 'Jl Raya Takisung, Kec Takisung, Kabupaten Tanah Laut'),
(2, 12, 'Museum Lambung Mangkurat', NULL, NULL, 'Jl. A. Yani No.Km. 36, Loktabat Utara, Kec. Banjarbaru Utara, Kota BanjarBaru'),
(3, 2, 'Pasar Terapung Lok Baintan', NULL, NULL, 'Jl. Desa Lok Baintan, Sungai Tandipah, Kec. Sungai Tabuk'),
(5, 13, 'Menara Pandang Banjarmasin', NULL, NULL, 'Jl. Kapten Tendean, Gadang, Banjarmasin'),
(6, 13, 'Pasar Terapung Siring Tendean', NULL, NULL, 'Jl. Kapten Pierre Tendean, Banjarmasin'),
(7, 12, 'Danau Seran', NULL, NULL, 'Guntung Manggis, Banjarbaru'),
(8, 2, 'Bukit Matang Kaladan', NULL, NULL, 'Aranio, Kec. Aranio, Kab. Banjar'),
(9, 4, 'Air Terjun Haratai (Loksado)', NULL, NULL, 'Loksado, Hulu Sungai Selatan'),
(10, 4, 'Pemandian Air Panas Tanuhi', NULL, NULL, 'Tanuhi, Loksado, Hulu Sungai Selatan'),
(11, 5, 'Pagat Batu Benawa', NULL, NULL, 'Pagat, Batu Benawa, Hulu Sungai Tengah'),
(12, 7, 'Pantai Gedambaan', NULL, NULL, 'Sarang Tiung, Kec. Pulau Laut Utara, Kotabaru'),
(13, 7, 'Pulau Samber Gelap', NULL, NULL, 'Pulau Sebuku, Kotabaru'),
(14, 9, 'Pantai Angsana', NULL, NULL, 'Angsana, Kec. Angsana, Tanah Bumbu'),
(15, 8, 'Air Terjun Lano', NULL, NULL, 'Lano, Kec. Jaro, Tabalong'),
(16, 1, 'Taman Hijau Balangan', NULL, NULL, 'Paringin Selatan, Balangan'),
(17, 11, 'Goa Batu Hapu', NULL, NULL, 'Batu Hapu, Kec. Hatungun, Tapin'),
(18, 3, 'Pulau Kembang', NULL, NULL, 'Pulau Alalak, Barito Kuala'),
(19, 10, 'Pantai Joras', NULL, NULL, 'Joras, Kec. Jorong, Tanah Laut'),
(20, 10, 'Bukit Birah', NULL, NULL, 'Jl Raya Batakan, Kec Kandangan Lama, Tanah Laut');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tiket`
--

-- Table structure for table `tbl_tiket` --

CREATE TABLE `tbl_tiket` (
  `id_tiket` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `kode_tiket` varchar(50) NOT NULL,
  `status_tiket` enum('BELUM_DIPAKAI','SUDAH_DIPAKAI') NOT NULL DEFAULT 'BELUM_DIPAKAI',
  `waktu_validasi` datetime DEFAULT NULL,
  `id_user_petugas` int DEFAULT NULL,
  PRIMARY KEY (`id_tiket`),
  UNIQUE KEY `kode_tiket` (`kode_tiket`),
  KEY `fk_transaksi_tiket` (`id_transaksi`),
  KEY `fk_user_petugas` (`id_user_petugas`),
  CONSTRAINT `fk_transaksi_tiket` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`),
  CONSTRAINT `fk_user_petugas` FOREIGN KEY (`id_user_petugas`) REFERENCES `tbl_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_tiket`
--

INSERT INTO `tbl_tiket` (`id_tiket`, `id_transaksi`, `kode_tiket`, `status_tiket`, `waktu_validasi`, `id_user_petugas`) VALUES
(1, 1, 'TKT-20251111-1762827037', 'BELUM_DIPAKAI', NULL, NULL),
(2, 2, 'TKT-20251111-1762827086', 'BELUM_DIPAKAI', NULL, NULL),
(3, 3, 'TKT-20251111-1762827271', 'BELUM_DIPAKAI', NULL, NULL),
(4, 4, 'TKT-20251111-1762827327', 'BELUM_DIPAKAI', NULL, NULL),
(5, 5, 'TKT-20251111-1762829497', 'BELUM_DIPAKAI', NULL, NULL),
(6, 6, 'TKT-20251111-1762840376', 'SUDAH_DIPAKAI', '2025-11-11 06:53:46', 3),
(7, 7, 'TKT-20251111-1762840796', 'SUDAH_DIPAKAI', '2025-11-11 07:00:19', 3),
(8, 8, 'TKT-20251111-1762843015', 'SUDAH_DIPAKAI', '2025-11-11 07:37:14', 3),
(9, 9, 'TKT-20251112-1762924815', 'SUDAH_DIPAKAI', '2025-11-12 06:20:32', 3),
(10, 10, 'TKT-20251112-1762938653', 'SUDAH_DIPAKAI', '2025-11-12 10:11:48', 7),
(11, 11, 'TKT-20251112-1762938824', 'SUDAH_DIPAKAI', '2025-11-12 10:14:02', 7),
(12, 12, 'TKT-20251113-1763002297', 'SUDAH_DIPAKAI', '2025-11-13 03:53:04', 7),
(13, 13, 'TKT-20251116-1763299544', 'BELUM_DIPAKAI', NULL, NULL),
(14, 14, 'TKT-20251116-1763299592', 'SUDAH_DIPAKAI', '2025-11-16 21:27:10', 3),
(15, 15, 'TKT-20251117-1763312377', 'SUDAH_DIPAKAI', '2025-11-17 01:01:15', 3),
(16, 16, 'TKT-20251117-1763341866', 'SUDAH_DIPAKAI', '2025-11-24 17:25:44', 3),
(17, 17, 'TKT-20251124-1763976448', 'SUDAH_DIPAKAI', '2025-11-24 17:28:05', 3),
(18, 18, 'TKT-20251124-1763977167', 'SUDAH_DIPAKAI', '2025-11-24 17:39:47', 3),
(19, 19, 'TKT-20251126-1764124680', 'SUDAH_DIPAKAI', '2025-11-26 10:38:40', 3),
(20, 20, 'TKT-20251126-1764128144', 'SUDAH_DIPAKAI', '2025-11-26 11:36:07', 3),
(21, 21, 'TKT-20251213-1765557978', 'SUDAH_DIPAKAI', '2025-12-13 00:47:01', 3),
(22, 22, 'TKT-20251229-1767009059', 'BELUM_DIPAKAI', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_user_kasir` int NOT NULL,
  `id_objek` int NOT NULL,
  `waktu_transaksi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_harga` int NOT NULL DEFAULT '0',
  `status_transaksi` enum('Lunas','Pending') NOT NULL DEFAULT 'Lunas',
  PRIMARY KEY (`id_transaksi`),
  KEY `fk_user_kasir` (`id_user_kasir`),
  KEY `fk_objek_transaksi` (`id_objek`),
  CONSTRAINT `fk_objek_transaksi` FOREIGN KEY (`id_objek`) REFERENCES `tbl_objek_wisata` (`id_objek`),
  CONSTRAINT `fk_user_kasir` FOREIGN KEY (`id_user_kasir`) REFERENCES `tbl_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_user_kasir`, `id_objek`, `waktu_transaksi`, `total_harga`, `status_transaksi`) VALUES
(1, 3, 2, '2025-11-11 03:10:37', 20000, 'Lunas'),
(2, 3, 2, '2025-11-11 03:11:26', 100000, 'Lunas'),
(3, 3, 2, '2025-11-11 03:14:31', 20000, 'Lunas'),
(4, 3, 2, '2025-11-11 03:15:27', 20000, 'Lunas'),
(5, 3, 1, '2025-11-11 03:51:37', 20000, 'Lunas'),
(6, 3, 2, '2025-11-11 06:52:56', 70000, 'Lunas'),
(7, 3, 1, '2025-11-11 06:59:56', 30000, 'Lunas'),
(8, 3, 1, '2025-11-11 07:36:55', 20000, 'Lunas'),
(9, 3, 2, '2025-11-12 06:20:15', 30000, 'Lunas'),
(10, 7, 20, '2025-11-12 10:10:53', 50000, 'Lunas'),
(11, 7, 9, '2025-11-12 10:13:44', 0, 'Lunas'),
(12, 7, 7, '2025-11-13 03:51:37', 15000, 'Lunas'),
(13, 3, 15, '2025-11-16 21:25:44', 15000, 'Lunas'),
(14, 3, 20, '2025-11-16 21:26:32', 10000, 'Lunas'),
(15, 3, 5, '2025-11-17 00:59:37', 15000, 'Lunas'),
(16, 3, 20, '2025-11-17 09:11:06', 20000, 'Lunas'),
(17, 3, 8, '2025-11-24 17:27:28', 25000, 'Lunas'),
(18, 3, 15, '2025-11-24 17:39:27', 10000, 'Lunas'),
(19, 3, 17, '2025-11-26 10:38:00', 30000, 'Lunas'),
(20, 3, 7, '2025-11-26 11:35:44', 20000, 'Lunas'),
(21, 3, 15, '2025-12-13 00:46:18', 15000, 'Lunas'),
(22, 3, 7, '2025-12-29 19:50:59', 10000, 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_detail`
--

CREATE TABLE `tbl_transaksi_detail` (
  `id_transaksi_detail` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `id_jenis_tiket` int NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `harga_saat_transaksi` int NOT NULL,
  `status_tiket` enum('Belum','Sudah') DEFAULT 'Belum',
  `waktu_scan` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transaksi_detail`),
  KEY `fk_transaksi` (`id_transaksi`),
  KEY `fk_jenis_tiket` (`id_jenis_tiket`),
  CONSTRAINT `fk_jenis_tiket` FOREIGN KEY (`id_jenis_tiket`) REFERENCES `tbl_jenis_tiket` (`id_jenis_tiket`),
  CONSTRAINT `fk_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_transaksi_detail`
--

INSERT INTO `tbl_transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_jenis_tiket`, `jumlah`, `harga_saat_transaksi`, `status_tiket`, `waktu_scan`) VALUES
(1, 1, 1, 1, 20000, 'Belum', NULL),
(2, 2, 1, 5, 20000, 'Belum', NULL),
(3, 3, 1, 1, 20000, 'Belum', NULL),
(4, 4, 1, 1, 20000, 'Belum', NULL),
(5, 5, 1, 1, 10000, 'Belum', NULL),
(6, 5, 2, 1, 10000, 'Belum', NULL),
(7, 6, 1, 2, 20000, 'Belum', NULL),
(8, 6, 2, 3, 10000, 'Belum', NULL),
(9, 7, 1, 2, 10000, 'Belum', NULL),
(10, 7, 2, 1, 10000, 'Belum', NULL),
(11, 8, 1, 1, 10000, 'Belum', NULL),
(12, 8, 2, 1, 10000, 'Belum', NULL),
(13, 9, 1, 1, 20000, 'Belum', NULL),
(14, 9, 2, 1, 10000, 'Belum', NULL),
(15, 10, 1, 5, 10000, 'Belum', NULL),
(16, 11, 3, 1, 0, 'Belum', NULL),
(17, 12, 1, 1, 10000, 'Belum', NULL),
(18, 12, 2, 1, 5000, 'Belum', NULL),
(19, 13, 1, 1, 10000, 'Belum', NULL),
(20, 13, 2, 1, 5000, 'Belum', NULL),
(21, 14, 1, 1, 10000, 'Belum', NULL),
(22, 15, 1, 1, 10000, 'Belum', NULL),
(23, 15, 2, 1, 5000, 'Belum', NULL),
(24, 16, 1, 2, 10000, 'Belum', NULL),
(25, 17, 1, 1, 15000, 'Belum', NULL),
(26, 17, 2, 1, 10000, 'Belum', NULL),
(27, 18, 2, 2, 5000, 'Belum', NULL),
(28, 19, 1, 2, 10000, 'Belum', NULL),
(29, 19, 2, 2, 5000, 'Belum', NULL),
(30, 20, 1, 1, 10000, 'Belum', NULL),
(31, 20, 2, 2, 5000, 'Belum', NULL),
(32, 21, 1, 1, 10000, 'Belum', NULL),
(33, 21, 2, 1, 5000, 'Belum', NULL),
(34, 22, 1, 1, 10000, 'Belum', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('Admin','Kasir','Petugas') NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_lengkap`, `username`, `password`, `level`) VALUES
(3, 'administrator', 'admin', '$2y$10$TyHsHJoGSsWGIxtRmM08jeBMc9W6qauQ6Hj9/f6WRwGJgUSphNqzW', 'Admin'),
(7, 'Muhammad Irwan Firmanto', 'irwan', '$2y$10$LLuZ8d11T48JRm3i7csiIeR2Y9Xuw34Dqh.wSFvb5Xu/z5fmHiXE6', 'Admin'),
(8, 'Ahmad Said', 'ahmad_said', '$2y$10$nn98ku2c3.Bf.Lpr0L4wauzBjTeiMx2JgthpoSM82YvA4YxBPBaG.', 'Kasir'),
(9, 'Muhammad Saputra', 'putra', '$2y$10$Pg.lN1BhwUhVIScHWR8ulevTtn9j37v6n2kgh36t0jethMoIypQUm', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_harga_tiket`
--
ALTER TABLE `tbl_harga_tiket`
  ADD PRIMARY KEY (`id_harga`),
  ADD KEY `fk_objek_harga` (`id_objek`),
  ADD KEY `fk_jenis_tiket_harga` (`id_jenis_tiket`);

--
-- Indexes for table `tbl_jenis_tiket`
--
ALTER TABLE `tbl_jenis_tiket`
  ADD PRIMARY KEY (`id_jenis_tiket`);

--
-- Indexes for table `tbl_kabupaten`
--
ALTER TABLE `tbl_kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

--
-- Indexes for table `tbl_objek_wisata`
--
ALTER TABLE `tbl_objek_wisata`
  ADD PRIMARY KEY (`id_objek`),
  ADD KEY `fk_kabupaten` (`id_kabupaten`);

--
-- Indexes for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD UNIQUE KEY `kode_tiket` (`kode_tiket`),
  ADD KEY `fk_transaksi_tiket` (`id_transaksi`),
  ADD KEY `fk_user_petugas` (`id_user_petugas`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_user_kasir` (`id_user_kasir`),
  ADD KEY `fk_objek_transaksi` (`id_objek`);

--
-- Indexes for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `fk_transaksi` (`id_transaksi`),
  ADD KEY `fk_jenis_tiket` (`id_jenis_tiket`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_harga_tiket`
--
ALTER TABLE `tbl_harga_tiket`
  MODIFY `id_harga` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `tbl_jenis_tiket`
--
ALTER TABLE `tbl_jenis_tiket`
  MODIFY `id_jenis_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_kabupaten`
--
ALTER TABLE `tbl_kabupaten`
  MODIFY `id_kabupaten` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_objek_wisata`
--
ALTER TABLE `tbl_objek_wisata`
  MODIFY `id_objek` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  MODIFY `id_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  MODIFY `id_transaksi_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_harga_tiket`
--
ALTER TABLE `tbl_harga_tiket`
  ADD CONSTRAINT `fk_jenis_tiket_harga` FOREIGN KEY (`id_jenis_tiket`) REFERENCES `tbl_jenis_tiket` (`id_jenis_tiket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_objek_harga` FOREIGN KEY (`id_objek`) REFERENCES `tbl_objek_wisata` (`id_objek`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_objek_wisata`
--
ALTER TABLE `tbl_objek_wisata`
  ADD CONSTRAINT `fk_kabupaten` FOREIGN KEY (`id_kabupaten`) REFERENCES `tbl_kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_tiket`
--
ALTER TABLE `tbl_tiket`
  ADD CONSTRAINT `fk_transaksi_tiket` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`),
  ADD CONSTRAINT `fk_user_petugas` FOREIGN KEY (`id_user_petugas`) REFERENCES `tbl_user` (`id_user`);

--
-- Constraints for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `fk_objek_transaksi` FOREIGN KEY (`id_objek`) REFERENCES `tbl_objek_wisata` (`id_objek`),
  ADD CONSTRAINT `fk_user_kasir` FOREIGN KEY (`id_user_kasir`) REFERENCES `tbl_user` (`id_user`);

--
-- Constraints for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  ADD CONSTRAINT `fk_jenis_tiket` FOREIGN KEY (`id_jenis_tiket`) REFERENCES `tbl_jenis_tiket` (`id_jenis_tiket`),
  ADD CONSTRAINT `fk_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
