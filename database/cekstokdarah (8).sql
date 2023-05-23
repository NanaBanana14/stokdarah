-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 08:20 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cekstokdarah`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_darah_keluar`
--

CREATE TABLE `data_darah_keluar` (
  `idkeluar` int(10) NOT NULL,
  `id_stok` int(10) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_darah_masuk`
--

CREATE TABLE `data_darah_masuk` (
  `idmasuk` int(10) NOT NULL,
  `id_stok` int(10) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `pendonor` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_stok_darah`
--

CREATE TABLE `detail_stok_darah` (
  `id_detailstok` int(11) NOT NULL,
  `id_stok` int(11) NOT NULL,
  `kadaluarsa` varchar(50) NOT NULL,
  `suhu` varchar(50) NOT NULL,
  `keterangan_stok` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_stok_darah`
--

INSERT INTO `detail_stok_darah` (`id_detailstok`, `id_stok`, `kadaluarsa`, `suhu`, `keterangan_stok`) VALUES
(9, 22, '36 hari', '30 °C', 'Sel darah merah, trombosit, dan plasma. HB > 35gr/');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_detail_darah`
--

CREATE TABLE `informasi_detail_darah` (
  `id_darah` int(10) NOT NULL,
  `id_stok` int(11) NOT NULL,
  `goldar` varchar(50) NOT NULL,
  `rhesus` varchar(50) NOT NULL,
  `produk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi_detail_darah`
--

INSERT INTO `informasi_detail_darah` (`id_darah`, `id_stok`, `goldar`, `rhesus`, `produk`) VALUES
(56, 22, 'A', '+', 'WE');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_user` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_user`, `username`, `email`, `password`) VALUES
(3, 'peri_hewan', 'ikatriyana@gmail.com', '123'),
(4, 'peri_kunang', 'jelita13@gmail.com', '1313'),
(5, 'peri_darah', 'aliza1111@gmail.com', '1212'),
(20, 'nana_here', 'nanahere@gmail.com', '234');

-- --------------------------------------------------------

--
-- Table structure for table `stok_darah`
--

CREATE TABLE `stok_darah` (
  `id_stok` int(10) NOT NULL,
  `darah` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `stok` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_darah`
--

INSERT INTO `stok_darah` (`id_stok`, `darah`, `keterangan`, `stok`) VALUES
(22, 'A001', 'Tersedia', '640'),
(23, 'A002', 'Tersedia', '135'),
(24, 'B001', 'Tersedia', '200'),
(25, 'B002', 'Tersedia', '260'),
(26, 'AB001', 'Tersedia', '160');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_darah_keluar`
--
ALTER TABLE `data_darah_keluar`
  ADD PRIMARY KEY (`idkeluar`),
  ADD KEY `id_stok` (`id_stok`);

--
-- Indexes for table `data_darah_masuk`
--
ALTER TABLE `data_darah_masuk`
  ADD PRIMARY KEY (`idmasuk`),
  ADD KEY `id_stok` (`id_stok`);

--
-- Indexes for table `detail_stok_darah`
--
ALTER TABLE `detail_stok_darah`
  ADD PRIMARY KEY (`id_detailstok`),
  ADD KEY `id_stok` (`id_stok`);

--
-- Indexes for table `informasi_detail_darah`
--
ALTER TABLE `informasi_detail_darah`
  ADD PRIMARY KEY (`id_darah`),
  ADD KEY `id_stok` (`id_stok`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `stok_darah`
--
ALTER TABLE `stok_darah`
  ADD PRIMARY KEY (`id_stok`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_darah_keluar`
--
ALTER TABLE `data_darah_keluar`
  MODIFY `idkeluar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `data_darah_masuk`
--
ALTER TABLE `data_darah_masuk`
  MODIFY `idmasuk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `detail_stok_darah`
--
ALTER TABLE `detail_stok_darah`
  MODIFY `id_detailstok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `informasi_detail_darah`
--
ALTER TABLE `informasi_detail_darah`
  MODIFY `id_darah` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stok_darah`
--
ALTER TABLE `stok_darah`
  MODIFY `id_stok` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_darah_keluar`
--
ALTER TABLE `data_darah_keluar`
  ADD CONSTRAINT `data_darah_keluar_ibfk_1` FOREIGN KEY (`id_stok`) REFERENCES `stok_darah` (`id_stok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_darah_masuk`
--
ALTER TABLE `data_darah_masuk`
  ADD CONSTRAINT `data_darah_masuk_ibfk_1` FOREIGN KEY (`id_stok`) REFERENCES `stok_darah` (`id_stok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_stok_darah`
--
ALTER TABLE `detail_stok_darah`
  ADD CONSTRAINT `detail_stok_darah_ibfk_1` FOREIGN KEY (`id_stok`) REFERENCES `stok_darah` (`id_stok`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `informasi_detail_darah`
--
ALTER TABLE `informasi_detail_darah`
  ADD CONSTRAINT `informasi_detail_darah_ibfk_1` FOREIGN KEY (`id_stok`) REFERENCES `stok_darah` (`id_stok`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
