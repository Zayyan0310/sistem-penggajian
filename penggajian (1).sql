-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2025 at 01:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penggajian`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_gaji`
--

CREATE TABLE `data_gaji` (
  `id_gaji` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `bulantahun` varchar(6) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tj_transport` int(11) NOT NULL,
  `uang_makan` int(11) NOT NULL,
  `jumlah_lembur` int(11) NOT NULL,
  `tarif_lembur` decimal(10,2) NOT NULL,
  `alpha` int(11) NOT NULL,
  `potongan_alpha` decimal(15,2) NOT NULL,
  `bpjs` decimal(15,2) NOT NULL,
  `jkm` int(11) NOT NULL,
  `jkk` int(11) NOT NULL,
  `total_potongan` decimal(15,2) NOT NULL,
  `gaji_bersih` decimal(15,2) NOT NULL,
  `status_gaji` varchar(255) DEFAULT 'Belum Dikirim',
  `pph21` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_gaji`
--

INSERT INTO `data_gaji` (`id_gaji`, `id_pegawai`, `bulantahun`, `gaji_pokok`, `tj_transport`, `uang_makan`, `jumlah_lembur`, `tarif_lembur`, `alpha`, `potongan_alpha`, `bpjs`, `jkm`, `jkk`, `total_potongan`, `gaji_bersih`, `status_gaji`, `pph21`, `created_at`) VALUES
(1, 5, '012025', 9000000, 750000, 1000000, 3, '52023.00', 0, '0.00', '450000.00', 27000, 156600, '0.00', '11943557.00', 'Sudah Dikirim', '403888.00', '2025-06-21 09:30:49'),
(2, 9, '012025', 26300000, 700000, 600000, 1, '152023.00', 0, '0.00', '1315000.00', 78900, 457619, '0.00', '33155968.00', 'Sudah Dikirim', '3552425.00', '2025-06-21 09:30:49'),
(3, 10, '012025', 15300000, 700000, 600000, 1, '88439.00', 0, '0.00', '765000.00', 45900, 266220, '0.00', '19186803.00', 'Sudah Dikirim', '1421244.00', '2025-06-21 09:30:49'),
(4, 11, '012025', 9000000, 700000, 600000, 1, '52023.00', 0, '0.00', '450000.00', 27000, 156600, '0.00', '11315191.00', 'Sudah Dikirim', '329568.00', '2025-06-21 09:30:49'),
(5, 12, '012025', 35300000, 700000, 600000, 1, '204046.00', 0, '0.00', '1765000.00', 105900, 614220, '0.00', '45182540.00', 'Sudah Dikirim', '5893374.00', '2025-06-21 09:30:49'),
(6, 13, '012025', 9000000, 700000, 600000, 1, '52023.00', 0, '0.00', '450000.00', 27000, 156600, '0.00', '11315191.00', 'Sudah Dikirim', '329568.00', '2025-06-21 09:30:49'),
(7, 14, '012025', 36507530, 700000, 600000, 1, '211026.00', 2, '3174567.00', '1825376.00', 109522, 635231, '3174567.00', '43502421.00', 'Sudah Dikirim', '6088302.00', '2025-06-21 09:30:49'),
(8, 15, '012025', 12296984, 700000, 600000, 1, '71080.00', 2, '1069302.00', '614849.00', 36890, 213967, '1069302.00', '14336495.00', 'Sudah Dikirim', '872026.00', '2025-06-21 09:30:49'),
(9, 16, '012025', 26300000, 700000, 600000, 1, '152023.00', 0, '0.00', '1315000.00', 78900, 457619, '0.00', '33155968.00', 'Sudah Dikirim', '3552425.00', '2025-06-21 09:30:50'),
(10, 17, '012025', 13507530, 700000, 600000, 1, '78078.00', 1, '587283.00', '675376.00', 40522, 235031, '587283.00', '16199446.00', 'Sudah Dikirim', '950192.00', '2025-06-21 09:30:50'),
(11, 18, '012025', 9785000, 700000, 600000, 1, '56560.00', 0, '0.00', '489250.00', 29355, 170259, '0.00', '12303640.00', 'Sudah Dikirim', '473216.00', '2025-06-21 09:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `uang_makan` int(11) NOT NULL,
  `tj_transport` int(11) NOT NULL,
  `bpjs` decimal(15,2) NOT NULL,
  `tarif_lembur` decimal(10,2) DEFAULT NULL,
  `jkm` int(11) DEFAULT NULL,
  `jkk` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`, `gaji_pokok`, `uang_makan`, `tj_transport`, `bpjs`, `tarif_lembur`, `jkm`, `jkk`, `total`) VALUES
(9, 'Manager', 9000000, 1000000, 750000, '450000.00', '52023.00', 27000, 156600, 11383600),
(17, 'F&A Manager', 26300000, 600000, 700000, '1315000.00', '152023.00', 78900, 457619, 29451520),
(18, 'SPV Accounting', 15300000, 600000, 700000, '765000.00', '88439.00', 45900, 266220, 17677120),
(19, 'Staff Finance', 9000000, 600000, 700000, '450000.00', '52023.00', 27000, 156600, 10933600),
(20, 'Operational Manager', 35300000, 600000, 700000, '1765000.00', '204046.00', 105900, 614220, 39085120),
(21, 'Crewing Staff', 9000000, 600000, 700000, '450000.00', '52023.00', 27000, 156600, 10933600),
(22, 'Commercial & Planning Manager', 36507530, 600000, 700000, '1825376.00', '211026.00', 109522, 635231, 40377660),
(23, 'OPS & MKT Support', 12296984, 600000, 700000, '614849.00', '71080.00', 36890, 213967, 14462691),
(24, 'GA Manager', 26300000, 600000, 700000, '1315000.00', '152023.00', 78900, 457619, 29451520),
(25, 'GA Procutment', 13507530, 600000, 700000, '675376.00', '78078.00', 40522, 235031, 15758460),
(26, 'Staff GA', 9785000, 600000, 700000, '489250.00', '56560.00', 29355, 170259, 11773864),
(28, 'dosen', 6000000, 1000000, 200000, '300000.00', '34682.00', 18000, 104400, 7622400),
(29, 'Operator', 4000000, 1000000, 600000, '200000.00', '23121.00', 12000, 69600, 5881600);

-- --------------------------------------------------------

--
-- Table structure for table `data_kehadiran`
--

CREATE TABLE `data_kehadiran` (
  `id_kehadiran` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `bulantahun` varchar(20) NOT NULL,
  `hadir` int(11) NOT NULL,
  `sakit` int(11) NOT NULL,
  `izin` int(11) NOT NULL,
  `alpha` int(11) NOT NULL,
  `holiday` int(11) NOT NULL,
  `bt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_kehadiran`
--

INSERT INTO `data_kehadiran` (`id_kehadiran`, `id_pegawai`, `bulantahun`, `hadir`, `sakit`, `izin`, `alpha`, `holiday`, `bt`) VALUES
(1, 15, '012025', 18, 0, 0, 2, 0, 3),
(2, 10, '012025', 23, 0, 0, 0, 0, 0),
(3, 5, '012025', 23, 0, 0, 0, 0, 0),
(4, 18, '012025', 23, 0, 0, 0, 0, 0),
(5, 12, '012025', 20, 0, 0, 0, 0, 3),
(6, 16, '012025', 23, 0, 0, 0, 0, 0),
(7, 9, '012025', 23, 0, 0, 0, 0, 0),
(8, 11, '012025', 23, 0, 0, 0, 0, 0),
(9, 13, '012025', 20, 0, 0, 0, 0, 3),
(10, 14, '012025', 18, 0, 0, 2, 0, 3),
(11, 17, '012025', 22, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_lembur`
--

CREATE TABLE `data_lembur` (
  `id_lembur` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `bulantahun` varchar(6) NOT NULL,
  `jumlah_jam` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_lembur`
--

INSERT INTO `data_lembur` (`id_lembur`, `id_pegawai`, `bulantahun`, `jumlah_jam`) VALUES
(1, 5, '012025', 3),
(2, 9, '012025', 1),
(3, 10, '012025', 1),
(4, 11, '012025', 1),
(5, 12, '012025', 1),
(6, 13, '012025', 1),
(7, 14, '012025', 1),
(8, 15, '012025', 1),
(9, 16, '012025', 1),
(10, 17, '012025', 1),
(11, 18, '012025', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_pajak`
--

CREATE TABLE `data_pajak` (
  `id_pajak` int(11) NOT NULL,
  `jenis_TER` varchar(10) DEFAULT NULL,
  `deskripsi_TER` varchar(100) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `range_awal` int(11) DEFAULT NULL,
  `range_akhir` int(11) DEFAULT NULL,
  `tarif_TER` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pajak`
--

INSERT INTO `data_pajak` (`id_pajak`, `jenis_TER`, `deskripsi_TER`, `keterangan`, `range_awal`, `range_akhir`, `tarif_TER`) VALUES
(1, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 0, 5400000, '0.00'),
(2, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 5400001, 5650000, '0.25'),
(3, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 5650001, 5950000, '0.50'),
(4, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 5950001, 6300000, '0.75'),
(5, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 6300001, 6750000, '1.00'),
(6, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 6750001, 7500000, '1.25'),
(7, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 7500001, 8550000, '1.50'),
(8, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 8550001, 9650000, '1.75'),
(9, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 9650001, 10050000, '2.00'),
(10, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 10050001, 10350000, '2.25'),
(11, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 10350001, 10700000, '2.50'),
(12, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 10700001, 11050000, '3.00'),
(13, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 11050001, 11600000, '3.50'),
(14, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 11600001, 12500000, '4.00'),
(15, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 12500001, 13750000, '5.00'),
(16, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 13750001, 15100000, '6.00'),
(17, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 15100001, 16950000, '7.00'),
(18, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 16950001, 19750000, '8.00'),
(19, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 19750001, 24150000, '9.00'),
(20, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 24150001, 26450000, '10.00'),
(21, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 26450001, 28000000, '11.00'),
(22, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 28000001, 30050000, '12.00'),
(23, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 30050001, 32400000, '13.00'),
(24, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 32400001, 35400000, '14.00'),
(25, 'TER A', 'TK0, TK1, K0', 'Tidak Kawin (0-1 tanggungan) atau Kawin (0 tanggungan)', 35400001, 39100000, '15.00'),
(26, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 0, 6200000, '0.00'),
(27, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 6200001, 6500000, '0.25'),
(28, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 6500001, 6850000, '0.50'),
(29, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 6850001, 7300000, '0.75'),
(30, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 7300001, 9200000, '1.00'),
(31, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 9200001, 10750000, '1.50'),
(32, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 10750001, 11250000, '2.00'),
(33, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 11250001, 11600000, '2.50'),
(34, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 11600001, 12600000, '3.00'),
(35, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 12600001, 13600000, '4.00'),
(36, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 13600001, 14950000, '5.00'),
(37, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 14950001, 16400000, '6.00'),
(38, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 16400001, 18450000, '7.00'),
(39, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 18450001, 21850000, '8.00'),
(40, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 21850001, 26000000, '9.00'),
(41, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 26000001, 27700000, '10.00'),
(42, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 27700001, 29350000, '11.00'),
(43, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 29350001, 31450000, '12.00'),
(44, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 31450001, 33950000, '13.00'),
(45, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 33950001, 37100000, '14.00'),
(46, 'TER B', 'TK2, TK3, K1, K2', 'Tidak Kawin (2-3 tanggungan) atau Kawin (1-2 tanggungan)', 37100001, 41100000, '15.00'),
(47, 'TER C', 'K3', 'Kawin (3 tanggungan)', 0, 6600000, '0.00'),
(48, 'TER C', 'K3', 'Kawin (3 tanggungan)', 6600001, 6950000, '0.25'),
(49, 'TER C', 'K3', 'Kawin (3 tanggungan)', 6950001, 7350000, '0.50'),
(50, 'TER C', 'K3', 'Kawin (3 tanggungan)', 7350001, 7800000, '0.75'),
(51, 'TER C', 'K3', 'Kawin (3 tanggungan)', 7800001, 8850000, '1.00'),
(52, 'TER C', 'K3', 'Kawin (3 tanggungan)', 7800001, 8850000, '1.00'),
(53, 'TER C', 'K3', 'Kawin (3 tanggungan)', 8850001, 9800000, '1.25'),
(54, 'TER C', 'K3', 'Kawin (3 tanggungan)', 9800001, 10950000, '1.50'),
(55, 'TER C', 'K3', 'Kawin (3 tanggungan)', 10950001, 11200000, '1.75'),
(56, 'TER C', 'K3', 'Kawin (3 tanggungan)', 11200001, 12050000, '2.00'),
(57, 'TER C', 'K3', 'Kawin (3 tanggungan)', 12050001, 12950000, '3.00'),
(58, 'TER C', 'K3', 'Kawin (3 tanggungan)', 12950001, 14150000, '4.00'),
(59, 'TER C', 'K3', 'Kawin (3 tanggungan)', 14150001, 15550000, '5.00'),
(60, 'TER C', 'K3', 'Kawin (3 tanggungan)', 15550001, 17050000, '6.00'),
(61, 'TER C', 'K3', 'Kawin (3 tanggungan)', 17050001, 19500000, '7.00'),
(62, 'TER C', 'K3', 'Kawin (3 tanggungan)', 19500001, 22700000, '8.00'),
(63, 'TER C', 'K3', 'Kawin (3 tanggungan)', 22700001, 26600000, '9.00'),
(64, 'TER C', 'K3', 'Kawin (3 tanggungan)', 26600001, 28100000, '10.00'),
(65, 'TER C', 'K3', 'Kawin (3 tanggungan)', 28100001, 30100000, '11.00'),
(66, 'TER C', 'K3', 'Kawin (3 tanggungan)', 30100001, 32600000, '12.00'),
(67, 'TER C', 'K3', 'Kawin (3 tanggungan)', 32600001, 35400000, '13.00'),
(68, 'TER C', 'K3', 'Kawin (3 tanggungan)', 35400001, 38900000, '14.00'),
(69, 'TER C', 'K3', 'Kawin (3 tanggungan)', 38900001, 43000000, '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_akses` int(11) DEFAULT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` int(15) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `norekening` varchar(50) NOT NULL,
  `namabank` varchar(50) NOT NULL,
  `jenis_TER` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`id_pegawai`, `nama_pegawai`, `id_jabatan`, `id_akses`, `jenis_kelamin`, `tanggal_masuk`, `status`, `alamat`, `no_hp`, `nik`, `email`, `username`, `password`, `photo`, `norekening`, `namabank`, `jenis_TER`) VALUES
(5, 'Budi Santoso', 9, 1, 'Laki-laki', '2022-01-15', 'Tetap', 'Jl. Mawar No. 5', 2147483647, '3174091009870001', 'budi@perusahaan.com', 'budi', '202cb962ac59075b964b07152d234b70', 'budi.jpg', '1234567890', 'BCA', NULL),
(9, 'Naomi CA Siahaan', 17, 2, 'Perempuan', '2019-01-07', 'Karyawan Tetap', 'Setiabudi, JL Rasuna Said No. 30', 2147483647, '12345678910', 'naomisiahaan@gmail.com', 'naomi', 'e10adc3949ba59abbe56e057f20f883e', '', '350123423', 'BCA', 'TER A'),
(10, 'Asti Hapsari', 18, 2, 'Perempuan', '2019-08-05', 'Karyawan Tetap', 'Jatiasih, JL Swantantra No. 125', 2147483647, '11121314151', 'astihapsari.ptmj@gmail.com', 'asti', 'e10adc3949ba59abbe56e057f20f883e', '', '5700119833', 'BCA', 'TER A'),
(11, 'Niken Kusumawardani', 19, 2, 'Perempuan', '2025-02-05', 'Karyawan Tetap', 'Tebet, JL Letjen Haryono No. 10', 2147483647, '61718192021', 'nikenkusumawardani.ptmj@gmail.com', 'niken', 'e10adc3949ba59abbe56e057f20f883e', '', '7330290841', 'BCA', 'TER A'),
(12, 'Herwisnhu Broto', 20, 2, 'Laki-Laki', '2024-09-23', 'Karyawan Tetap', 'Harapan Indah, JL Pejuang No. 1', 2147483647, '22232425262', 'herwisnhu.broto@gmail.com', 'herwisnhu', 'e10adc3949ba59abbe56e057f20f883e', '', '1250014710263', 'Mandiri', 'TER C'),
(13, 'Pratiwi Pramono', 21, 2, 'Perempuan', '2025-01-06', 'Karyawan Tetap', 'Bekasi Timur, JL KH.Masturu No. 36', 2147483647, '72829303132', 'pratiwi.ptmj@gmail.com', 'pratiwi', 'e10adc3949ba59abbe56e057f20f883e', '', '1090020746327', 'Mandiri', 'TER A'),
(14, 'Priyono', 22, 2, 'Laki-Laki', '2024-04-06', 'Karyawan Tetap', 'Cawang, JL Dewi Sartika No. 110', 2147483647, '33343536373', 'priyono.ptmj@gmail.com', 'priyono', 'e10adc3949ba59abbe56e057f20f883e', '', '3110823877', 'Permata', 'TER C'),
(15, 'Adistia Amelia', 23, 2, 'Perempuan', '2020-01-06', 'Karyawan Tetap', 'Cibubur, JL Raya Bigor No. 115', 2147483647, '83940414243', 'adistia.mj@gmail.com', 'adistia', 'e10adc3949ba59abbe56e057f20f883e', '', '1240009709941', 'Mandiri', 'TER A'),
(16, 'Kartika Sari Kolompoy', 24, 3, 'Perempuan', '2019-09-09', 'Karyawan Tetap', 'Cikurnir, JL Magaharayu No. 15', 2147483647, '44454647484', 'kartikasari.ptmj@gmail.com', 'kartika', 'e10adc3949ba59abbe56e057f20f883e', '', '100913128749', 'BWS', 'TER A'),
(17, 'Rifki Iskamarulloh', 25, 2, 'Laki-Laki', '2020-05-11', 'Karyawan Tetap', 'Depok, JL Sawangan No. 56', 2147483647, '95051525354', 'rifki53.mj@gmail.com', 'rifki', 'e10adc3949ba59abbe56e057f20f883e', '', '1270007186248', 'Mandiri', 'TER B'),
(18, 'Hermawati', 26, 2, 'Perempuan', '2013-01-15', 'Karyawan Tetap', 'Bintaro, JL Bintaro Raya No. 48', 2147483647, '55565758596', 'Mjhermawati@gmail.com', 'hermawati', 'e10adc3949ba59abbe56e057f20f883e', '', '700007234649', 'Mandiri', 'TER A');

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id_akses` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id_akses`, `keterangan`) VALUES
(1, 'Staff'),
(2, 'Pegawai'),
(3, 'HRD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_gaji`
--
ALTER TABLE `data_gaji`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD PRIMARY KEY (`id_kehadiran`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `data_lembur`
--
ALTER TABLE `data_lembur`
  ADD PRIMARY KEY (`id_lembur`),
  ADD KEY `data_lembur_ibfk_1` (`id_pegawai`);

--
-- Indexes for table `data_pajak`
--
ALTER TABLE `data_pajak`
  ADD PRIMARY KEY (`id_pajak`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_akses` (`id_akses`);

--
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_gaji`
--
ALTER TABLE `data_gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  MODIFY `id_kehadiran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_lembur`
--
ALTER TABLE `data_lembur`
  MODIFY `id_lembur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_pajak`
--
ALTER TABLE `data_pajak`
  MODIFY `id_pajak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_gaji`
--
ALTER TABLE `data_gaji`
  ADD CONSTRAINT `data_gaji_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`);

--
-- Constraints for table `data_kehadiran`
--
ALTER TABLE `data_kehadiran`
  ADD CONSTRAINT `data_kehadiran_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`) ON DELETE CASCADE;

--
-- Constraints for table `data_lembur`
--
ALTER TABLE `data_lembur`
  ADD CONSTRAINT `data_lembur_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`) ON DELETE CASCADE;

--
-- Constraints for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD CONSTRAINT `data_pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `data_jabatan` (`id_jabatan`),
  ADD CONSTRAINT `data_pegawai_ibfk_2` FOREIGN KEY (`id_akses`) REFERENCES `hak_akses` (`id_akses`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
