-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 04, 2014 at 04:50 
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `BDA-Jaya-Akuntansi`
--
CREATE DATABASE IF NOT EXISTS `BDA-Jaya-Akuntansi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `BDA-Jaya-Akuntansi`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` text NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `angsuran_piutang`
--

CREATE TABLE IF NOT EXISTS `angsuran_piutang` (
  `id_angsuran` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_transaksi` bigint(20) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `oleh` int(11) NOT NULL,
  `rp` bigint(20) NOT NULL,
  PRIMARY KEY (`id_angsuran`),
  KEY `id_transaksi` (`id_transaksi`,`oleh`),
  KEY `oleh` (`oleh`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `no_seri` varchar(12) NOT NULL,
  `kategori` int(11) NOT NULL,
  `oleh` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `harga_beli` bigint(20) NOT NULL,
  `harga_jual` bigint(20) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `kategori` (`kategori`,`oleh`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `no_seri`, `kategori`, `oleh`, `tanggal`, `harga_beli`, `harga_jual`, `stok`) VALUES
(2, 'Sarung Hari Raya Edisi Garuda', '112345', 2, 1, '2014-11-04 13:29:14', 135000, 136350, 52);

-- --------------------------------------------------------

--
-- Table structure for table `gudang_activity`
--

CREATE TABLE IF NOT EXISTS `gudang_activity` (
  `id_activity` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(11) NOT NULL,
  `id_barang` bigint(20) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_pemasok` int(11) NOT NULL,
  `activity` varchar(200) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_activity`),
  KEY `id_pegawai` (`id_pegawai`,`id_barang`,`id_kategori`,`id_pemasok`),
  KEY `id_barang` (`id_barang`),
  KEY `id_pemasok` (`id_pemasok`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gudang_activity`
--

INSERT INTO `gudang_activity` (`id_activity`, `id_pegawai`, `id_barang`, `id_kategori`, `id_pemasok`, `activity`, `tgl`) VALUES
(1, 1, 2, 2, 1, 'Tambah barang baru dengan nomor seri 112345 dari PT. Gadjah Duduk', '2014-11-04 13:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `kasir_activity`
--

CREATE TABLE IF NOT EXISTS `kasir_activity` (
  `id_activity` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pegawai` int(11) NOT NULL,
  `id_transaksi` bigint(20) NOT NULL,
  `catatan` varchar(500) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_activity`),
  KEY `id_pegawai` (`id_pegawai`,`id_transaksi`),
  KEY `id_transaksi` (`id_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kasir_activity`
--

INSERT INTO `kasir_activity` (`id_activity`, `id_pegawai`, `id_transaksi`, `catatan`, `tgl`) VALUES
(1, 2, 2, 'membuat transaksi baru dengan id : 2', '2014-11-04 13:26:12'),
(2, 2, 3, 'membuat transaksi baru dengan id : 3', '2014-11-04 13:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE IF NOT EXISTS `kategori_barang` (
  `id_kat_barang` int(11) NOT NULL AUTO_INCREMENT,
  `des_kat_barang` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kat_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kat_barang`, `des_kat_barang`) VALUES
(2, 'Pakaian Muslim Laki-laki'),
(3, 'Pakaian Muslim Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pemasukan`
--

CREATE TABLE IF NOT EXISTS `kategori_pemasukan` (
  `id_kat_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `des_kat_masuk` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kat_masuk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kategori_pemasukan`
--

INSERT INTO `kategori_pemasukan` (`id_kat_masuk`, `des_kat_masuk`) VALUES
(2, 'Penjualan Barang');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_pengeluaran`
--

CREATE TABLE IF NOT EXISTS `kategori_pengeluaran` (
  `id_kat_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `des_kat_keluar` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kat_keluar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kategori_pengeluaran`
--

INSERT INTO `kategori_pengeluaran` (`id_kat_keluar`, `des_kat_keluar`) VALUES
(6, 'Pembelian Barang');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `bagian` enum('kasir','gudang') NOT NULL,
  `telp` varchar(12) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `login_log` datetime NOT NULL,
  PRIMARY KEY (`id_pegawai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `bagian`, `telp`, `alamat`, `username`, `password`, `login_log`) VALUES
(1, 'Yusuf Akhsan Hidayat', 'gudang', '085645777298', 'Lele 2th Road, Maguwoharjo, Sleman, DIY', 'yussan', 'ac43724f16e9241d990427ab7c8f4228', '2014-11-04 19:55:48'),
(2, 'Merti Dina Nisa', 'kasir', '08134567890', 'Lele 2th Road, Maguwoharjo, Sleman, DIY', 'dina', 'ac43724f16e9241d990427ab7c8f4228', '2014-11-04 20:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE IF NOT EXISTS `pemasok` (
  `id_pemasok` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  PRIMARY KEY (`id_pemasok`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nama`, `alamat`) VALUES
(1, 'PT. Gadjah Duduk', 'Surabaya, Jawa Timur, Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE IF NOT EXISTS `pemasukan` (
  `id_pemasukan` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `oleh` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `rp` bigint(20) NOT NULL,
  `kategori` int(11) NOT NULL,
  `id_transaksi` bigint(20) NOT NULL,
  `id_barang` bigint(20) DEFAULT NULL,
  `id_pemasok` int(11) DEFAULT NULL,
  `status` enum('hutang','lunas') NOT NULL,
  PRIMARY KEY (`id_pemasukan`),
  KEY `oleh` (`oleh`,`kategori`,`id_barang`,`id_pemasok`),
  KEY `kategori` (`kategori`),
  KEY `id_barang` (`id_barang`),
  KEY `id_transaksi` (`id_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `tanggal`, `oleh`, `keterangan`, `rp`, `kategori`, `id_transaksi`, `id_barang`, `id_pemasok`, `status`) VALUES
(1, '2014-11-04 13:26:12', 2, 'Penjualan dengan id transaksi : 2', 136350, 2, 2, NULL, NULL, 'lunas'),
(2, '2014-11-04 13:29:14', 2, 'Penjualan dengan id transaksi : 3', 136350, 2, 3, NULL, NULL, 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `id_pengeluaran` bigint(20) NOT NULL AUTO_INCREMENT,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `oleh` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `rp` bigint(20) NOT NULL,
  `kategori` int(11) NOT NULL,
  `id_barang` bigint(20) DEFAULT NULL,
  `id_pemasok` int(11) DEFAULT NULL,
  `status` enum('piutang','lunas') NOT NULL,
  PRIMARY KEY (`id_pengeluaran`),
  KEY `oleh` (`oleh`,`kategori`,`id_barang`,`id_pemasok`),
  KEY `kategori` (`kategori`),
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tanggal`, `oleh`, `keterangan`, `rp`, `kategori`, `id_barang`, `id_pemasok`, `status`) VALUES
(1, '2014-11-04 13:16:55', 1, 'Tambah Barang Sarung Hari Raya Edisi Garuda ke Gudang', 7425000, 6, 2, 1, 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` bigint(20) NOT NULL AUTO_INCREMENT,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_bayar` bigint(20) NOT NULL,
  `bayar` bigint(20) NOT NULL,
  `kembali` bigint(20) NOT NULL,
  `status` enum('lunas','piutang') NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tgl_transaksi`, `total_bayar`, `bayar`, `kembali`, `status`) VALUES
(2, '2014-11-04 13:26:12', 136350, 150000, 13650, 'lunas'),
(3, '2014-11-04 13:29:14', 136350, 200000, 63650, 'lunas');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_item`
--

CREATE TABLE IF NOT EXISTS `transaksi_item` (
  `id_transaksi` bigint(20) NOT NULL,
  `id_barang` bigint(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  KEY `id_transaksi` (`id_transaksi`,`id_barang`),
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_item`
--

INSERT INTO `transaksi_item` (`id_transaksi`, `id_barang`, `jumlah`, `subtotal`) VALUES
(2, 2, 1, 136350),
(3, 2, 1, 136350);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `angsuran_piutang`
--
ALTER TABLE `angsuran_piutang`
  ADD CONSTRAINT `angsuran_piutang_ibfk_2` FOREIGN KEY (`oleh`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `angsuran_piutang_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori_barang` (`id_kat_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gudang_activity`
--
ALTER TABLE `gudang_activity`
  ADD CONSTRAINT `gudang_activity_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gudang_activity_ibfk_2` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id_pemasok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gudang_activity_ibfk_3` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kasir_activity`
--
ALTER TABLE `kasir_activity`
  ADD CONSTRAINT `kasir_activity_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kasir_activity_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori_pemasukan` (`id_kat_masuk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemasukan_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori_pengeluaran` (`id_kat_keluar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_item`
--
ALTER TABLE `transaksi_item`
  ADD CONSTRAINT `transaksi_item_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_item_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
