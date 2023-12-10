-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 03:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`) VALUES
(1, 'AHMAD RAJA', 'admin', '88888888');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alt` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alt`, `nama`) VALUES
(8, 'A1'),
(9, 'A2'),
(10, 'A3'),
(11, 'A4'),
(12, 'A5'),
(13, 'A6'),
(14, 'A7'),
(15, 'A8'),
(16, 'A9'),
(17, 'A10'),
(18, 'A11'),
(19, 'A12'),
(20, 'A13'),
(21, 'A14'),
(22, 'A15'),
(23, 'A16'),
(24, 'A17'),
(25, 'A18'),
(26, 'A19'),
(27, 'A20');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(350) NOT NULL,
  `bobot` double NOT NULL,
  `jenis_kriteria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `jenis_kriteria`) VALUES
(26, 'Hasil Wawancara', 0.25, 'Benefit'),
(27, 'IPK', 0.15, 'Benefit'),
(29, 'Kepemilikan KIP', 0.1, 'Benefit'),
(30, 'Kepemilikan KKS', 0.1, 'Benefit'),
(31, 'Penghasilan Ayah', 0.1, 'Cost'),
(32, 'Penghasilan Ibu', 0.1, 'Cost'),
(33, 'Kepemilikan rumah', 0.05, 'Cost'),
(34, 'Daya listrik', 0.05, 'Cost'),
(35, 'Luas tanah', 0.05, 'Cost'),
(36, 'Sumber air', 0.05, 'Cost');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `np` int(11) NOT NULL,
  `nk` int(11) NOT NULL,
  `na` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `nisn`, `np`, `nk`, `na`) VALUES
(5, '09123', 80, 70, 70),
(6, '091235', 80, 70, 60);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_nilai`
--

CREATE TABLE `tabel_nilai` (
  `id_nilai` int(11) NOT NULL,
  `alternatif_id` int(11) DEFAULT NULL,
  `kriteria_id` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alt`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- Indexes for table `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `alternatif_id` (`alternatif_id`),
  ADD KEY `kriteria_id` (`kriteria_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabel_nilai`
--
ALTER TABLE `tabel_nilai`
  ADD CONSTRAINT `tabel_nilai_ibfk_1` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatif` (`id_alt`),
  ADD CONSTRAINT `tabel_nilai_ibfk_2` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
