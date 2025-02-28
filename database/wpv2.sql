-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 02:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wpv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nm_lengkap` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nm_lengkap`, `username`, `password`) VALUES
(1, 'Admin', 'admin', 'admin'),
(2, 'Harits Putra Junaidi', 'harits', 'harits123');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_les` int(11) NOT NULL,
  `kode_alternatif` varchar(250) NOT NULL,
  `nm_les` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_les`, `kode_alternatif`, `nm_les`) VALUES
(1, 'A1', 'Combitox'),
(2, 'A2', 'Nurban'),
(6, 'A3', 'Nurelle'),
(8, 'A4', 'Fokker'),
(9, 'A5', 'Rid'),
(10, 'A6', 'Abinsec'),
(11, 'A7', 'Sherpa'),
(12, 'A8', 'Agadi'),
(13, 'A9', 'Marshal'),
(14, 'A10', 'Berantas'),
(19, 'A11', 'Indothane'),
(20, 'A12', 'Rotanil'),
(21, 'A13', 'Benlox'),
(22, 'A14', 'Antracol'),
(23, 'A15', 'Agrithane'),
(24, 'A16', 'Antila'),
(25, 'A17', 'Bestonil'),
(26, 'A18', 'Kresnadan'),
(27, 'A19', 'Kenfuran'),
(28, 'A20', 'Imidor');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(250) NOT NULL,
  `nm_kriteria` varchar(250) NOT NULL,
  `bobot` int(11) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nm_kriteria`, `bobot`, `status`) VALUES
(1, 'C1', 'Harga', 4, 'COST'),
(2, 'C2', 'Ukuran Kemasan', 1, 'BENEFIT'),
(4, 'C3', 'Luas Cakup', 3, 'BENEFIT'),
(6, 'C4', 'Masa Kadarluasa', 2, 'BENEFIT');

-- --------------------------------------------------------

--
-- Table structure for table `perhitungan`
--

CREATE TABLE `perhitungan` (
  `id_nilai` int(11) NOT NULL,
  `id_les` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perhitungan`
--

INSERT INTO `perhitungan` (`id_nilai`, `id_les`, `id_kriteria`, `nilai`) VALUES
(1, 1, 1, '45000'),
(2, 1, 2, '250'),
(4, 1, 4, '5000'),
(13, 1, 6, '3'),
(14, 2, 1, '85000'),
(15, 2, 2, '500'),
(17, 2, 4, '10000'),
(18, 2, 6, '3'),
(19, 6, 1, '80000'),
(20, 6, 2, '500'),
(22, 6, 4, '10000'),
(29, 6, 6, '4'),
(30, 8, 1, '60000'),
(31, 8, 2, '500'),
(33, 8, 4, '10000'),
(34, 8, 6, '3'),
(35, 9, 1, '125000'),
(36, 9, 2, '500'),
(38, 9, 4, '10000'),
(39, 9, 6, '5'),
(40, 10, 1, '105000'),
(41, 10, 2, '250'),
(43, 10, 4, '5000'),
(44, 10, 6, '4'),
(45, 11, 1, '80000'),
(46, 11, 2, '500'),
(48, 11, 4, '10000'),
(49, 11, 6, '2'),
(50, 12, 1, '75000'),
(51, 12, 2, '500'),
(53, 12, 4, '10000'),
(55, 12, 6, '4'),
(56, 13, 1, '85000'),
(57, 13, 2, '500'),
(59, 13, 4, '10000'),
(60, 13, 6, '3'),
(61, 14, 1, '125000'),
(62, 14, 2, '500'),
(64, 14, 4, '10000'),
(65, 14, 6, '2'),
(76, 19, 1, '88000'),
(77, 19, 2, '1000'),
(78, 19, 4, '12000'),
(79, 19, 6, '4'),
(80, 20, 1, '77000'),
(81, 20, 2, '400'),
(82, 20, 4, '7000'),
(83, 20, 6, '3'),
(84, 21, 1, '69000'),
(85, 21, 2, '250'),
(86, 21, 4, '1000'),
(88, 21, 6, '2'),
(89, 22, 1, '59000'),
(90, 22, 2, '500'),
(91, 22, 4, '5000'),
(92, 22, 6, '2'),
(93, 23, 1, '57000'),
(94, 23, 2, '1000'),
(95, 23, 4, '10000'),
(97, 23, 6, '3'),
(98, 24, 1, '76000'),
(99, 24, 2, '1000'),
(100, 24, 4, '10000'),
(101, 24, 6, '3'),
(102, 25, 1, '79000'),
(103, 25, 2, '400'),
(104, 25, 4, '5000'),
(105, 25, 6, '3'),
(106, 26, 1, '55000'),
(107, 26, 2, '500'),
(108, 26, 4, '5000'),
(109, 26, 6, '1.5'),
(110, 27, 1, '35000'),
(111, 27, 2, '1000'),
(112, 27, 4, '5000'),
(113, 27, 6, '2'),
(114, 28, 1, '85000'),
(115, 28, 2, '1000'),
(116, 28, 4, '10000'),
(117, 28, 6, '1');

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
  ADD PRIMARY KEY (`id_les`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `perhitungan`
--
ALTER TABLE `perhitungan`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `LES` (`id_les`),
  ADD KEY `KRITERIA` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_les` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `perhitungan`
--
ALTER TABLE `perhitungan`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perhitungan`
--
ALTER TABLE `perhitungan`
  ADD CONSTRAINT `KRITERIA` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  ADD CONSTRAINT `LES` FOREIGN KEY (`id_les`) REFERENCES `alternatif` (`id_les`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
