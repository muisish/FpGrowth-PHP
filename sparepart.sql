-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2016 at 01:02 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sparepart`
--

-- --------------------------------------------------------

--
-- Table structure for table `bench_lift`
--

CREATE TABLE IF NOT EXISTS `bench_lift` (
  `item` text NOT NULL,
  `count` varchar(100) NOT NULL,
  `support` varchar(100) NOT NULL,
  `confidence` varchar(100) NOT NULL,
  `itemconsequent` varchar(100) NOT NULL,
  `benchmark` varchar(100) NOT NULL,
  `liftratio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bench_lift`
--

INSERT INTO `bench_lift` (`item`, `count`, `support`, `confidence`, `itemconsequent`, `benchmark`, `liftratio`) VALUES
('Oli Mesin Matic & Saringan Udara => Oli Garden', '6', '90', '0.67', '6', '0.6', '1.12'),
('Oli Mesin Matic & Saringan Udara => Roller', '6', '90', '0.67', '7', '0.7', '0.96'),
('Oli Mesin Matic & Oli Garden', '6', '90', '0.67', '7', '0.7', '0.96'),
('Kampas Rem & Oli Mesin Matic', '5', '50', '1.00', '9', '0.9', '1.11'),
('Roller & Oli Mesin Matic', '6', '60', '1.00', '9', '0.9', '1.11'),
('Oli Mesin & Oli Mesin Matic', '7', '80', '0.88', '9', '0.9', '0.98'),
('Saringan Udara & Oli Mesin Matic', '9', '90', '1.00', '9', '0.9', '1.11');

-- --------------------------------------------------------

--
-- Table structure for table `flist_temp`
--

CREATE TABLE IF NOT EXISTS `flist_temp` (
  `id_flist` int(11) NOT NULL,
  `hasil_flist` varchar(100) NOT NULL,
  `na` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `flist_temp`
--

INSERT INTO `flist_temp` (`id_flist`, `hasil_flist`, `na`) VALUES
(1, '1', '9'),
(1, '3', '8'),
(1, '13', '5'),
(1, '4', '9'),
(1, '2', '7'),
(1, '5', '6'),
(1, '6', '3'),
(1, '10', '4');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_temp`
--

CREATE TABLE IF NOT EXISTS `hasil_temp` (
  `spesifikasi` text NOT NULL,
  `liftratio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_temp`
--

INSERT INTO `hasil_temp` (`spesifikasi`, `liftratio`) VALUES
('Jika memilih item Oli Mesin Matic dan Saringan Udara maka akan memilih Oli Garden', '1.12'),
('Jika memilih item Oli Mesin Matic dan Saringan Udara maka akan memilih Roller', '0.96'),
('Jika memilih item Oli Mesin Matic maka akan memilih Oli Garden', '0.96'),
('Jika memilih item Kampas Rem maka akan memilih Oli Mesin Matic', '1.11'),
('Jika memilih item Roller maka akan memilih Oli Mesin Matic', '1.11'),
('Jika memilih item Oli Mesin maka akan memilih Oli Mesin Matic', '0.98'),
('Jika memilih item Saringan Udara maka akan memilih Oli Mesin Matic', '1.11');

-- --------------------------------------------------------

--
-- Table structure for table `keterangan`
--

CREATE TABLE IF NOT EXISTS `keterangan` (
  `id_item` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `keterangan`
--

INSERT INTO `keterangan` (`id_item`, `keterangan`) VALUES
('1', 'OliMesinMatic'),
('2', 'OliGarden'),
('3', 'OliMesin'),
('4', 'SaringanUdara'),
('5', 'Roller'),
('6', 'AkiMotor'),
('7', 'Sekring'),
('8', 'Mur'),
('9', 'LampuDepan'),
('10', 'Busi'),
('11', 'SokBelakang'),
('12', 'Sepion'),
('13', 'KampasRem'),
('14', 'AirRadiator'),
('15', 'O-Ring'),
('16', 'SpeedoMeter'),
('17', 'Geer'),
('18', 'Felk'),
('19', 'SokDepan'),
('20', 'Ban');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `no` int(11) NOT NULL,
  `tid` varchar(100) NOT NULL,
  `id_item` varchar(100) NOT NULL,
  `jenis_barang` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no`, `tid`, `id_item`, `jenis_barang`) VALUES
(1, '1', '1', 'Oli Mesin Matic'),
(2, '1', '3', 'Oli Mesin'),
(3, '1', '13', 'Kampas Rem'),
(4, '1', '4', 'Saringan Udara'),
(5, '1', '2', 'Oli Garden'),
(6, '1', '11', 'Sok Belakang'),
(7, '1', '12', 'Spion'),
(8, '1', '14', 'Air Radiator'),
(9, '2', '1', 'Oli Mesin Matic'),
(10, '2', '2', 'Oli Garden'),
(11, '2', '5', 'Roller'),
(12, '2', '4', 'Saringan Udara'),
(13, '2', '6', 'Aki Motor'),
(14, '2', '19', 'Sok Depan'),
(15, '2', '7', 'Sekring'),
(16, '2', '8', 'Mur'),
(17, '2', '9', 'Lampu Depan'),
(18, '2', '10', 'Busi'),
(19, '3', '1', 'Oli Mesin Matic'),
(20, '3', '3', 'Oli Mesin'),
(21, '3', '10', 'Busi'),
(22, '3', '5', 'Roller'),
(23, '3', '14', 'Air Radiator'),
(24, '3', '4', 'Saringan Udara'),
(25, '3', '13', 'Kampas Rem'),
(26, '4', '3', 'Oli Mesin'),
(27, '4', '1', 'Oli Mesin Matic'),
(28, '4', '4', 'Saringan Udara'),
(29, '4', '11', 'Sok Belakang'),
(30, '4', '19', 'Sok Depan'),
(31, '4', '2', 'Oli Garden'),
(32, '4', '13', 'Kampas Rem'),
(33, '5', '3', 'Oli Mesin'),
(34, '5', '1', 'Oli Mesin Matic'),
(35, '5', '5', 'Roller'),
(36, '5', '4', 'Saringan Udara'),
(37, '5', '15', 'O-Ring'),
(38, '5', '17', 'Geer'),
(39, '6', '8', 'Mur'),
(40, '6', '3', 'Oli Mesin'),
(41, '6', '2', 'Oli Garden'),
(43, '6', '7', 'Sekring'),
(44, '6', '18', 'Felk'),
(45, '6', '10', 'Busi'),
(46, '7', '1', 'Oli Mesin Matic'),
(47, '7', '3', 'Oli Mesin'),
(48, '7', '4', 'Saringan Udara'),
(49, '7', '6', 'Aki Motor'),
(50, '7', '15', 'O-Ring'),
(51, '8', '1', 'Oli Mesin Matic'),
(52, '8', '13', 'Kampas Rem'),
(53, '8', '16', 'Speedo Meter'),
(54, '8', '4', 'Saringan Udara'),
(55, '8', '2', 'Oli Garden'),
(56, '8', '12', 'Sepion'),
(57, '8', '5', 'Roller'),
(58, '9', '1', 'Oli Mesin Matic'),
(59, '9', '3', 'Oli Mesin'),
(60, '9', '5', 'Roller'),
(61, '9', '4', 'Saringan Udara'),
(62, '9', '2', 'Oli Garden'),
(63, '9', '10', 'Busi'),
(64, '9', '6', 'Aki Motor'),
(65, '10', '3', 'Oli Mesin'),
(66, '10', '4', 'Saringan Udara'),
(67, '10', '1', 'Oli Mesin Matic'),
(68, '10', '2', 'Oli Garden'),
(69, '10', '5', 'Roller'),
(70, '10', '13', 'Kampas Rem');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `flist_temp`
--
ALTER TABLE `flist_temp`
  ADD PRIMARY KEY (`hasil_flist`);

--
-- Indexes for table `keterangan`
--
ALTER TABLE `keterangan`
  ADD PRIMARY KEY (`id_item`), ADD UNIQUE KEY `kode` (`id_item`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
