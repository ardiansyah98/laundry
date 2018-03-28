-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2018 at 06:47 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` int(3) NOT NULL,
  `kode_cabang` varchar(5) NOT NULL,
  `alamat` varchar(64) NOT NULL,
  `jenis_cabang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `kode_cabang`, `alamat`, `jenis_cabang`) VALUES
(1, 'PK01', 'pondok kelapa', 'kios'),
(2, 'DP01', 'Depok', 'woskhop');

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id_diskon` int(11) NOT NULL,
  `nama_diskon` varchar(100) NOT NULL,
  `potongan_diskon` varchar(20) NOT NULL,
  `awal_diskon` date NOT NULL,
  `akhir_diskon` date NOT NULL,
  `syarat` varchar(100) NOT NULL,
  `kondisi` text NOT NULL,
  `kuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id_diskon`, `nama_diskon`, `potongan_diskon`, `awal_diskon`, `akhir_diskon`, `syarat`, `kondisi`, `kuota`) VALUES
(0, 'none', '0', '0000-00-00', '0000-00-00', '', '', 0),
(1, 'Grand Opening', 'persen/10', '2018-03-01', '2018-03-31', 'id_cabang', '1', 100);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_laundry`
--

CREATE TABLE `jenis_laundry` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_laundry`
--

INSERT INTO `jenis_laundry` (`id`, `nama`, `harga`, `status`) VALUES
(1, 'Paket Cuci Kering', 3000, 1),
(2, 'Paket Cuci Kering + Setrika', 7000, 1),
(3, 'Paket Setrika', 4000, 1),
(4, 'Laundry Express 24 Jam', 10000, 1),
(5, 'Laundry Express 8 Jam', 14000, 1),
(6, 'Laundry Paket 30 Kg', 6700, 1),
(7, 'Laundry Paket 50 Kg', 6500, 1),
(8, 'Laundry Paket 80 Kg', 6300, 1),
(9, 'Laundry Paket 100 Kg', 6200, 1),
(10, 'Blezer', 8000, 1),
(11, 'Blouse', 8000, 1),
(12, 'Blouse Panjang', 10000, 1),
(13, 'Celana Panjang', 12000, 1),
(14, 'Celana Pendek', 7000, 1),
(15, 'Dasi', 5000, 1),
(16, 'Gaun Pengantin', 40000, 1),
(17, 'Gaun Pesta', 20000, 1),
(18, 'Jaket', 12000, 1),
(19, 'Jaket Kulit', 25000, 1),
(20, 'Jaket Panjang/Tebel', 20000, 1),
(21, 'Jas', 20000, 1),
(22, 'Jilbab/Kerudung', 6000, 1),
(23, 'Kebaya', 20000, 1),
(24, 'Kebaya Panjang', 25000, 1),
(25, 'Kemeja Panjang', 10000, 1),
(26, 'Kemeja Pendek', 8000, 1),
(27, 'Kemeja Koko Pakaian Sholat', 8000, 1),
(28, 'Long Dress', 12000, 1),
(29, 'Mukena', 12000, 1),
(30, 'Polo Shirt', 8000, 1),
(31, 'Rok', 8000, 1),
(32, 'Rok Panjang', 8000, 1),
(33, 'Rok Pendek', 6000, 1),
(34, 'Rompi', 10000, 1),
(35, 'Short Dress', 8000, 1),
(36, 'Sweater', 8000, 1),
(37, 'T-shirt', 6000, 1),
(38, 'Baju Pesta Anak', 10000, 1),
(39, 'Batik Kemeja Panjang', 8000, 1),
(40, 'Batik Kemeja Pendek', 6000, 1),
(41, 'Batik Blouse', 8000, 1),
(42, 'Batik Kain Larik', 8000, 1),
(43, 'Bantal Panjang', 12000, 1),
(44, 'Bantal/Guling', 15000, 1),
(45, 'Bed Cover M', 17000, 1),
(46, 'Bed Cover L', 20000, 1),
(47, 'Boneka Besar', 60000, 1),
(48, 'Boneka Jumbo', 80000, 1),
(49, 'Boneka Kecil', 25000, 1),
(50, 'Boneka Sedang', 40000, 1),
(51, 'Gordyn/M2', 6000, 1),
(52, 'Handuk Besar', 10000, 1),
(53, 'Handuk Kecil', 6000, 1),
(54, 'Handuk Sedang', 8000, 1),
(55, 'Karet/M2', 12000, 1),
(56, 'Koper', 30000, 1),
(57, 'Koper Besar', 40000, 1),
(58, 'Sajadah', 12000, 1),
(59, 'Sarung', 8000, 1),
(60, 'Sarung Bantal', 6000, 1),
(61, 'Selimut M', 12000, 1),
(62, 'Selimut L', 15000, 1),
(63, 'Selimut Tebal M', 18000, 1),
(64, 'Selimut Tebal L', 25000, 1),
(65, 'Sepatu', 25000, 1),
(66, 'Sepatu Pantofel/Kulit', 30000, 1),
(67, 'Sprei L', 14000, 1),
(68, 'Sprei M', 12000, 1),
(69, 'Sprei Renda M', 15000, 1),
(70, 'Sprei Renda L', 17000, 1),
(71, 'Taplak Meja', 12000, 1),
(72, 'Taplak Meja/M2', 4000, 1),
(73, 'Tas', 20000, 1),
(74, 'Tas Besar', 30000, 1),
(75, 'Topi', 12000, 1),
(76, 'Tikar Gulung', 25000, 1),
(77, 'Vitras/M2', 6000, 1),
(78, 'Stroller', 50000, 1),
(79, 'Helm', 15000, 1),
(80, 'Kasur Jumbo', 53000, 1),
(81, 'Kasur Besar', 38000, 1),
(82, 'Kasur Kecil', 28000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_transaksi`
--

CREATE TABLE `log_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `jenis_update` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(3) NOT NULL,
  `id_cabang` int(3) NOT NULL,
  `kode_paket` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(32) NOT NULL,
  `tlp_pelanggan` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `status_pembayaran_paket` enum('Belum','Sudah','','') NOT NULL DEFAULT 'Belum',
  `status_pengambilan_paket` enum('Belum','Sudah','','') NOT NULL DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `id_cabang`, `kode_paket`, `nama_pelanggan`, `tlp_pelanggan`, `harga`, `tgl_masuk`, `status_pembayaran_paket`, `status_pengambilan_paket`) VALUES
(1, 1, 'PK0118032846', 'Ardiansyah', '085810140868', 16200, '2018-03-28', 'Belum', 'Belum'),
(2, 1, 'PK0118032806', 'Suci', '085282185143', 58500, '2018-03-28', 'Belum', 'Belum'),
(3, 1, 'PK0118032824', 'Rizkiyanto', '0855111888', 2700, '2018-03-28', 'Belum', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_paket` int(3) NOT NULL,
  `jenis_laundry` int(11) NOT NULL,
  `berat` int(3) NOT NULL,
  `diskon` int(11) NOT NULL,
  `id_user` int(3) NOT NULL,
  `id_cabang` int(3) NOT NULL,
  `status_cucian` enum('Diterima','Proses','Selesai','Diambil') NOT NULL,
  `tgl_diterima` datetime NOT NULL,
  `tgl_diambil` datetime DEFAULT NULL,
  `status_pembayaran` enum('Belum','Sudah') NOT NULL DEFAULT 'Belum',
  `tgl_bayar` datetime DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_paket`, `jenis_laundry`, `berat`, `diskon`, `id_user`, `id_cabang`, `status_cucian`, `tgl_diterima`, `tgl_diambil`, `status_pembayaran`, `tgl_bayar`, `keterangan`) VALUES
(1, 1, 1, 2, 1, 1, 1, 'Diterima', '2018-03-28 00:00:00', NULL, 'Belum', NULL, ''),
(2, 1, 3, 3, 1, 1, 1, 'Diterima', '2018-03-28 00:00:00', NULL, 'Belum', NULL, ''),
(3, 2, 23, 2, 1, 1, 1, 'Diterima', '2018-03-28 00:00:00', NULL, 'Belum', NULL, ''),
(4, 2, 24, 1, 1, 1, 1, 'Diterima', '2018-03-28 00:00:00', NULL, 'Belum', NULL, ''),
(5, 3, 1, 1, 1, 1, 1, 'Diterima', '2018-03-28 00:00:00', NULL, 'Belum', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(3) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` set('1','2','3','4') NOT NULL,
  `id_cabang` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `id_cabang`) VALUES
(1, 'aaaa', 'aaaa', '1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`),
  ADD UNIQUE KEY `kode_cabang` (`kode_cabang`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `jenis_laundry`
--
ALTER TABLE `jenis_laundry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_paket` (`id_paket`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `kode_cabang` (`id_cabang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_cabang` (`id_cabang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabang`
--
ALTER TABLE `cabang`
  MODIFY `id_cabang` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jenis_laundry`
--
ALTER TABLE `jenis_laundry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_transaksi`
--
ALTER TABLE `log_transaksi`
  ADD CONSTRAINT `log_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `paket_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_cabang`) REFERENCES `cabang` (`id_cabang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
