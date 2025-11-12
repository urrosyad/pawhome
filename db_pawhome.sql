-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 07:53 PM
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
-- Database: `db_pawhome`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_adopsikucing`
--

CREATE TABLE `tb_adopsikucing` (
  `idAdopsi` int(11) NOT NULL,
  `idKucing` int(11) NOT NULL,
  `idAdopter` int(11) NOT NULL,
  `tanggalAdopsi` datetime DEFAULT current_timestamp(),
  `alasanAdopsi` text DEFAULT NULL,
  `totalBayar` decimal(10,2) DEFAULT 0.00,
  `statusPembayaran` enum('menunggu','lunas','gagal') DEFAULT 'menunggu',
  `tanggalBayar` datetime DEFAULT NULL,
  `statusAdopsi` enum('menunggu','disetujui','ditolak','selesai') DEFAULT 'menunggu',
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_masterkucing`
--

CREATE TABLE `tb_masterkucing` (
  `idKucing` int(11) NOT NULL,
  `idPemilik` int(11) DEFAULT NULL,
  `namaKucing` varchar(100) NOT NULL,
  `jenisKucing` varchar(100) DEFAULT NULL,
  `genderKucing` enum('Jantan','Betina') NOT NULL,
  `umurKucing` varchar(50) DEFAULT NULL,
  `deskripsiKucing` text DEFAULT NULL,
  `makananFav` varchar(100) DEFAULT NULL,
  `mainanFav` varchar(100) DEFAULT NULL,
  `fotoKucing` varchar(255) DEFAULT NULL,
  `biayaAdopsi` decimal(10,2) DEFAULT 0.00,
  `statusKucing` enum('tersedia','diadopsi','dalam proses') DEFAULT 'tersedia',
  `createdDate` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penitipankucing`
--

CREATE TABLE `tb_penitipankucing` (
  `idPenitipan` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idKucing` int(11) NOT NULL,
  `tanggalPenyerahan` datetime DEFAULT current_timestamp(),
  `alasanPenyerahan` text DEFAULT NULL,
  `makananfav` varchar(100) DEFAULT NULL,
  `mainanfav` varchar(100) DEFAULT NULL,
  `statusPenerimaan` enum('menunggu','disetujui','ditolak') DEFAULT 'menunggu',
  `catatanAdmin` text DEFAULT NULL,
  `statusPembayaran` enum('menunggu','lunas','gratis') DEFAULT 'gratis',
  `totalBayar` decimal(10,2) DEFAULT 0.00,
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `idTransaksi` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `tipeTransaksi` enum('adopsi','penyerahan') NOT NULL,
  `idReferensi` int(11) NOT NULL,
  `nominal` decimal(10,2) NOT NULL,
  `metodeBayar` enum('transfer','ewallet','cash') DEFAULT 'transfer',
  `statusTransaksi` enum('menunggu','lunas','gagal') DEFAULT 'menunggu',
  `tanggalTransaksi` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `idUser` int(11) NOT NULL,
  `namaUser` varchar(100) NOT NULL,
  `emailUser` varchar(100) NOT NULL,
  `passwordUser` varchar(255) NOT NULL,
  `telpUser` varchar(20) DEFAULT NULL,
  `alamatUser` text DEFAULT NULL,
  `roleUser` enum('admin','user') DEFAULT 'user',
  `profilUser` varchar(255) DEFAULT NULL,
  `createdDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_adopsikucing`
--
ALTER TABLE `tb_adopsikucing`
  ADD PRIMARY KEY (`idAdopsi`),
  ADD KEY `idKucing` (`idKucing`),
  ADD KEY `idAdopter` (`idAdopter`);

--
-- Indexes for table `tb_masterkucing`
--
ALTER TABLE `tb_masterkucing`
  ADD PRIMARY KEY (`idKucing`),
  ADD KEY `idPemilik` (`idPemilik`);

--
-- Indexes for table `tb_penitipankucing`
--
ALTER TABLE `tb_penitipankucing`
  ADD PRIMARY KEY (`idPenitipan`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idKucing` (`idKucing`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`idTransaksi`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `emailUser` (`emailUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_adopsikucing`
--
ALTER TABLE `tb_adopsikucing`
  MODIFY `idAdopsi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_masterkucing`
--
ALTER TABLE `tb_masterkucing`
  MODIFY `idKucing` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_penitipankucing`
--
ALTER TABLE `tb_penitipankucing`
  MODIFY `idPenitipan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `idTransaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_adopsikucing`
--
ALTER TABLE `tb_adopsikucing`
  ADD CONSTRAINT `tb_adopsikucing_ibfk_1` FOREIGN KEY (`idKucing`) REFERENCES `tb_masterkucing` (`idKucing`),
  ADD CONSTRAINT `tb_adopsikucing_ibfk_2` FOREIGN KEY (`idAdopter`) REFERENCES `tb_users` (`idUser`);

--
-- Constraints for table `tb_masterkucing`
--
ALTER TABLE `tb_masterkucing`
  ADD CONSTRAINT `tb_masterkucing_ibfk_1` FOREIGN KEY (`idPemilik`) REFERENCES `tb_users` (`idUser`);

--
-- Constraints for table `tb_penitipankucing`
--
ALTER TABLE `tb_penitipankucing`
  ADD CONSTRAINT `tb_penitipankucing_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tb_users` (`idUser`),
  ADD CONSTRAINT `tb_penitipankucing_ibfk_2` FOREIGN KEY (`idKucing`) REFERENCES `tb_masterkucing` (`idKucing`);

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `tb_users` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
