-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2017 at 08:39 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `posweb1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti_piutang`
--

CREATE TABLE IF NOT EXISTS `bukti_piutang` (
  `no_bukti_piutang` varchar(12) NOT NULL,
  `no_piutang` varchar(12) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bukti_piutang`
--


-- --------------------------------------------------------

--
-- Table structure for table `bukti_piutang_sup`
--

CREATE TABLE IF NOT EXISTS `bukti_piutang_sup` (
  `no_bukti_piutang_sup` varchar(12) NOT NULL,
  `no_piutang_sup` varchar(12) NOT NULL,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bukti_piutang_sup`
--


-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE IF NOT EXISTS `cash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(12) NOT NULL,
  `tanggal_faktur` date NOT NULL,
  `kasir` varchar(20) NOT NULL,
  `total_bayar` int(20) NOT NULL,
  `cash` int(20) NOT NULL,
  `kembali` int(20) NOT NULL,
  `dp` int(20) NOT NULL,
  `sisa` int(20) NOT NULL,
  `lunas` varchar(10) NOT NULL,
  `ket` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_faktur` (`no_faktur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `no_faktur`, `tanggal_faktur`, `kasir`, `total_bayar`, `cash`, `kembali`, `dp`, `sisa`, `lunas`, `ket`) VALUES
(11, 'FKT000000001', '2017-07-15', 'Admin', 5350000, 5350000, 0, 0, 0, 'YA', '');

-- --------------------------------------------------------

--
-- Table structure for table `cashflow`
--

CREATE TABLE IF NOT EXISTS `cashflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(12) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jenis_transaksi` varchar(30) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `ket` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `cashflow`
--

INSERT INTO `cashflow` (`id`, `no_faktur`, `tanggal_transaksi`, `jenis_transaksi`, `jumlah`, `ket`) VALUES
(14, 'FKT000000001', '2017-07-15', 'Pemasukan', 5350000, '-'),
(13, 'PMS000000002', '2017-07-15', 'Pengeluaran', 4800000, '-'),
(12, 'PMS000000001', '2017-07-15', 'Pengeluaran', 80000000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `cash_sup`
--

CREATE TABLE IF NOT EXISTS `cash_sup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur_sup` varchar(12) NOT NULL,
  `tanggal_faktur` date NOT NULL,
  `kasir` varchar(20) NOT NULL,
  `total_bayar` int(20) NOT NULL,
  `cash` int(20) NOT NULL,
  `kembali` int(20) NOT NULL,
  `dp` int(20) NOT NULL,
  `sisa` int(20) NOT NULL,
  `lunas` varchar(10) NOT NULL,
  `ket` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_faktur_sup` (`no_faktur_sup`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cash_sup`
--

INSERT INTO `cash_sup` (`id`, `no_faktur_sup`, `tanggal_faktur`, `kasir`, `total_bayar`, `cash`, `kembali`, `dp`, `sisa`, `lunas`, `ket`) VALUES
(1, 'PMS000000001', '2017-07-15', 'Admin', 80000000, 80000000, 0, 0, 0, 'YA', ''),
(2, 'PMS000000002', '2017-07-15', 'Admin', 4800000, 4800000, 0, 0, 0, 'YA', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `user` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(20) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `kode_pos` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `password`, `nama`, `level`, `alamat`, `kota`, `kode_pos`, `no_telp`, `tempat_lahir`, `tanggal_lahir`) VALUES
('admin', '521042f9011ef5b868c0dce578021ae9', 'Administrator', 'Admin', 'Jl Beringin Indah', 'Surabaya', '23283', '085736573645', 'Surabaya', '1980-05-19'),
('demo', 'e10adc3949ba59abbe56e057f20f883e', 'Demo', 'Admin', '', '', '', '', '', '0000-00-00'),
('kasir', 'e10adc3949ba59abbe56e057f20f883e', 'Kasir 1', 'Kasir', '', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(40) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `kode_pos` varchar(40) NOT NULL,
  `no_telp` varchar(40) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  UNIQUE KEY `id_pelanggan` (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `kota`, `kode_pos`, `no_telp`, `tempat_lahir`, `tanggal_lahir`) VALUES
('CS0001', 'Pelanggan Umum', '', '', '', '', '', '0000-00-00'),
('CS0002', 'Toko Abadi Jaya', '', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `id_supplier` varchar(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `potongan` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`no`, `no_transaksi_sup`, `id_supplier`, `tanggal_transaksi`, `kode_barang`, `potongan`, `qty`, `total_harga`) VALUES
(1, 'PMS000000001', 'SUP0001', '2017-07-15', 'ASU001', 0, 15, 36000000),
(2, 'PMS000000001', 'SUP0001', '2017-07-15', 'SAM001', 0, 20, 44000000),
(3, 'PMS000000002', 'SUP0002', '2017-07-15', 'ASU001', 0, 2, 4800000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(12) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `potongan` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no`, `no_transaksi`, `id_pelanggan`, `tanggal_transaksi`, `kode_barang`, `potongan`, `qty`, `total_harga`) VALUES
(13, 'FKT000000001', 'CS0001', '2017-07-15', 'ASU001', 0, 1, 2750000),
(14, 'FKT000000001', 'CS0001', '2017-07-15', 'SAM001', 0, 1, 2600000);

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE IF NOT EXISTS `piutang` (
  `no_piutang` varchar(12) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
  `tgl` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang`
--


-- --------------------------------------------------------

--
-- Table structure for table `piutang_sup`
--

CREATE TABLE IF NOT EXISTS `piutang_sup` (
  `no_piutang_sup` varchar(12) NOT NULL,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `tgl` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang_sup`
--


-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_barang` varchar(10) NOT NULL,
  `brand` varchar(40) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `kategori` varchar(40) NOT NULL,
  `stock` int(5) NOT NULL,
  `harga_beli` int(20) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  UNIQUE KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_barang`, `brand`, `nama_barang`, `satuan`, `kategori`, `stock`, `harga_beli`, `harga_jual`) VALUES
('ADV001', 'ADVAN', 'ADVAN M301', 'unit', 'Tablet', 26, 750000, 950000),
('APP001', 'APPLE', 'IPHONE 5', 'unit', 'Smartphone', 43, 4500000, 5500000),
('ASU001', 'ASUS', 'ASUS SELFIE', 'unit', 'Smartphone', 34, 2400000, 2750000),
('SAM001', 'SAMSUNG', 'SAMSUNG J5', 'unit', 'Smartphone', 44, 2200000, 2600000);

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE IF NOT EXISTS `retur` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `unique` int(11) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `potongan` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `retur`
--


-- --------------------------------------------------------

--
-- Table structure for table `retur_sup`
--

CREATE TABLE IF NOT EXISTS `retur_sup` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `unique_sup` int(11) NOT NULL,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `id_supplier` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `potongan` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `retur_sup`
--


-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(30) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `telp`) VALUES
('SUP0002', 'CV. BINTANG UTAMA', 'Bandung', ''),
('SUP0001', 'PT. ANUGRAH JAYA', 'Jakarta', '');
