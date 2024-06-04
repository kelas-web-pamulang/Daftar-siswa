-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 12:49 PM
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
-- Database: `pendaftaranbeasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_daftar` int(11) NOT NULL,
  `nama_siswa` varchar(225) NOT NULL,
  `nis` int(11) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `id_wali` int(11) NOT NULL,
  `tanggal_tambah` datetime DEFAULT NULL,
  `tanggal_update` datetime DEFAULT NULL,
  `tanggal_hapus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_daftar`, `nama_siswa`, `nis`, `tanggal_daftar`, `status`, `id_wali`, `tanggal_tambah`, `tanggal_update`, `tanggal_hapus`) VALUES
(1, 'Rover', 2, '2024-06-05', 'Lulus', 1, '2024-06-04 16:03:10', '2024-06-04 17:19:41', NULL),
(2, 'Dery', 1, '2024-06-18', 'Murid', 1, '2024-06-04 16:36:21', '2024-06-04 17:19:53', NULL),
(3, 'Imam ', 3, '2024-06-05', 'Murid', 2, '2024-06-04 16:56:11', '2024-06-04 17:20:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(11) NOT NULL,
  `jenjang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `jenjang`) VALUES
(1, 'SD'),
(2, 'SMP'),
(3, 'SMA'),
(4, 'Perguruan Tinggi');

-- --------------------------------------------------------

--
-- Table structure for table `walimurid`
--

CREATE TABLE `walimurid` (
  `id_wali` int(11) NOT NULL,
  `nama_wali` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `walimurid`
--

INSERT INTO `walimurid` (`id_wali`, `nama_wali`) VALUES
(1, 'Ayah'),
(2, 'Ibu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_daftar`),
  ADD KEY `fk_nis` (`nis`),
  ADD KEY `fk_wali` (`id_wali`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `walimurid`
--
ALTER TABLE `walimurid`
  ADD PRIMARY KEY (`id_wali`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_daftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `fk_nis` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wali` FOREIGN KEY (`id_wali`) REFERENCES `walimurid` (`id_wali`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
