-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2024 at 05:40 PM
-- Server version: 8.0.30
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id_barang` varchar(20) NOT NULL,
  `nm_barang` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `record` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_frame`
--

CREATE TABLE `tbl_frame` (
  `id_frame` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int NOT NULL,
  `record` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemesanan`
--

CREATE TABLE `tbl_pemesanan` (
  `id_pemesanan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `id_frame` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `record` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekening`
--

CREATE TABLE `tbl_rekening` (
  `id_rekening` int NOT NULL,
  `no_rekening` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL,
  `record` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id_role` int NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `record` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id_role`, `keterangan`, `record`) VALUES
(1, 'Admin', '2024-05-12 17:15:05'),
(2, 'Pelanggan', '2024-05-12 17:15:05'),
(3, 'Pegawai', '2024-05-12 17:15:14'),
(4, 'Pemilik', '2024-05-12 17:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` varchar(20) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `id_pesanan` varchar(20) NOT NULL,
  `id_barang` varchar(20) NOT NULL,
  `total` int NOT NULL,
  `metode` text NOT NULL,
  `id_rekening` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `status` enum('APP','PEN','REJ') NOT NULL,
  `record` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `id_role` int NOT NULL,
  `status` enum('ON','OFF','PEN') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `record` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `email`, `no_telp`, `username`, `password`, `id_role`, `status`, `record`) VALUES
('USR-0001', 'Admin Master', 'admin@gmail.com', '081234567890', 'admin', '$2y$10$KF8Eg9yrBtjcCmz6v1BuWOrG..lCOpjE7ofbfEg9EItrkTHdqYOMm', 1, 'ON', '2024-05-12 17:16:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_frame`
--
ALTER TABLE `tbl_frame`
  ADD PRIMARY KEY (`id_frame`);

--
-- Indexes for table `tbl_pemesanan`
--
ALTER TABLE `tbl_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `tbl_rekening`
--
ALTER TABLE `tbl_rekening`
  ADD PRIMARY KEY (`id_rekening`) USING BTREE;

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_rekening`
--
ALTER TABLE `tbl_rekening`
  MODIFY `id_rekening` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
