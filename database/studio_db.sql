-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2024 at 05:37 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.19

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
  `jenis` enum('ATK','FRAME') NOT NULL,
  `harga` int NOT NULL,
  `diskon` int NOT NULL,
  `stok` int NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `image` text NOT NULL,
  `record` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id_barang`, `nm_barang`, `deskripsi`, `jenis`, `harga`, `diskon`, `stok`, `satuan`, `image`, `record`) VALUES
('BRG-0001', 'Buku Sinar Dunia Paling Laris', 'Buku Sinar Dunia 50 Lembar', 'ATK', 4500, 0, 100, 'Pcs', 'buku-sidu.jpg', '2024-05-22 18:25:59'),
('BRG-0002', 'Pulpen Standard AE7 Super Edan Mantap', 'Pulpen Standard AE7 merek no 1 diindonesia', 'ATK', 1800, 0, 50, 'Pcs', 'pulpen-standard.jpg', '2024-05-22 18:38:46'),
('BRG-0003', 'Frame A4 Hitam', 'Frame hitam ukuran A4', 'FRAME', 40000, 0, 20, 'Pcs', 'frame-a4.jpg', '2024-05-22 18:47:35'),
('BRG-0004', 'Frame Putih A4', 'Frame Putih Ukuran A4', 'FRAME', 45000, 0, 10, 'Pcs', 'BRG-0004.jpg', '2024-07-16 04:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cetak`
--

CREATE TABLE `tbl_cetak` (
  `id_cetak` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `id_ukuran` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `image` text NOT NULL,
  `qty` int NOT NULL,
  `total` int NOT NULL,
  `status` enum('Y','N','P','K') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `record` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cetak`
--

INSERT INTO `tbl_cetak` (`id_cetak`, `id_user`, `id_ukuran`, `image`, `qty`, `total`, `status`, `record`) VALUES
('CTK-0001', 'USR-0003', 'UKR-0002', 'image.jpeg', 5, 5000, 'K', '2024-05-22 19:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` varchar(20) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `pesanan` varchar(20) NOT NULL,
  `qty` int NOT NULL,
  `record` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekening`
--

CREATE TABLE `tbl_rekening` (
  `id_rekening` varchar(20) NOT NULL,
  `no_rekening` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `atas_nama` varchar(25) DEFAULT NULL,
  `record` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_rekening`
--

INSERT INTO `tbl_rekening` (`id_rekening`, `no_rekening`, `nama_bank`, `atas_nama`, `record`) VALUES
('RKN-0001', '1234-5678-9000', 'BCA', 'Toko Melly', '2024-05-24 12:51:01');

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
  `id_user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pesanan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `total` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `metode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `id_rekening` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bukti` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `status` enum('APP','PEN','REJ') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `record` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_user`, `pesanan`, `total`, `metode`, `id_rekening`, `bukti`, `status`, `record`) VALUES
('TRS-2405260001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('TRS-2405262601', 'USR-0002', '[{\"pesanan\":\"BRG-0003\",\"qty\":\"5\"}]', '200.000', 'transfer', 'RKN-0001', 'bukti_tf_1541571851_aaa3d39f_progressive.jpg', 'PEN', '2024-05-26 11:06:43'),
('TRS-2405262627', 'USR-0003', '[{\"pesanan\":\"CTK-0001\",\"qty\":\"5\"},{\"pesanan\":\"BRG-0001\",\"qty\":\"1\"}]', '9.500', 'transfer', 'RKN-0001', 'trusted_bukti_tf_1675081421_a695042b_progressive.jpg', 'PEN', '2024-05-26 11:19:56'),
('TRS-2407160001', 'USR-0003', '[{\"pesanan\":\"BRG-0001\",\"qty\":\"1\"},{\"pesanan\":\"BRG-0002\",\"qty\":\"1\"}]', '6.300', 'transfer', 'RKN-0001', 'tf.jpeg', 'PEN', '2024-07-16 04:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ukuran`
--

CREATE TABLE `tbl_ukuran` (
  `id_ukuran` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ukuran` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga` int NOT NULL,
  `record` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ukuran`
--

INSERT INTO `tbl_ukuran` (`id_ukuran`, `ukuran`, `harga`, `record`) VALUES
('UKR-0001', '2x3', 1000, '2024-05-22 07:05:39'),
('UKR-0002', '3x4', 1000, '2024-05-22 07:06:19'),
('UKR-0003', '4x6', 2000, '2024-05-22 07:06:19'),
('UKR-0004', '2R', 5000, '2024-05-22 07:06:57'),
('UKR-0005', '4R', 7000, '2024-05-22 07:06:57'),
('UKR-0006', '5R', 10000, '2024-05-22 07:07:47'),
('UKR-0007', '6R', 15000, '2024-05-22 07:07:47'),
('UKR-0008', '8R', 20000, '2024-05-22 07:08:27'),
('UKR-0009', '10R', 23000, '2024-05-22 07:08:27'),
('UKR-0010', '12R', 35000, '2024-05-22 07:09:12'),
('UKR-0011', '16R/A3', 50000, '2024-05-22 07:09:12');

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
('USR-0001', 'Admin Master', 'admin@gmail.com', '081234567890', 'admin', '$2y$10$KF8Eg9yrBtjcCmz6v1BuWOrG..lCOpjE7ofbfEg9EItrkTHdqYOMm', 1, 'ON', '2024-05-12 17:16:21'),
('USR-0002', 'Robi Nugraha', 'obiaha@gmail.com', '', 'obiaha', '$2y$10$lg4fXsmGvoO3q4Tx4z6sH.OP8JPV1pfGBZL079LgX5C7Kw5qmLgyC', 2, 'ON', '2024-05-13 06:37:46'),
('USR-0003', 'Handy Akbar', 'handy@gmail.com', '081234567890', 'handy', '$2y$10$lIKB7R2GhUnpbmZ1VwUUy.6TIKrkOfrR3Ouk1GIq6nR5Z8ASbmcQm', 2, 'ON', '2024-05-22 07:18:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tbl_cetak`
--
ALTER TABLE `tbl_cetak`
  ADD PRIMARY KEY (`id_cetak`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

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
-- Indexes for table `tbl_ukuran`
--
ALTER TABLE `tbl_ukuran`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
