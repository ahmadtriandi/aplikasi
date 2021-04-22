-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Apr 2021 pada 11.34
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti_piutang`
--

CREATE TABLE `bukti_piutang` (
  `no_bukti_piutang` varchar(12) NOT NULL,
  `no_piutang` varchar(12) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bukti_piutang`
--

INSERT INTO `bukti_piutang` (`no_bukti_piutang`, `no_piutang`, `no_transaksi`, `tgl_bayar`, `total_bayar`, `sisa`, `bayar`) VALUES
('PAY000000001', 'PIU000000001', 'FKT000000010', '2021-04-12', 950000, 450000, 200000),
('PAY000000002', 'PIU000000001', 'FKT000000010', '2021-04-12', 950000, 250000, 250000),
('PAY000000003', 'PIU000000002', 'FKT000000018', '2021-04-22', 2880000, 2380000, 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bukti_piutang_sup`
--

CREATE TABLE `bukti_piutang_sup` (
  `no_bukti_piutang_sup` varchar(12) NOT NULL,
  `no_piutang_sup` varchar(12) NOT NULL,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cash`
--

CREATE TABLE `cash` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(12) NOT NULL,
  `tanggal_faktur` date NOT NULL,
  `kasir` varchar(20) NOT NULL,
  `total_bayar` int(20) NOT NULL,
  `cash` int(20) NOT NULL,
  `kembali` int(20) NOT NULL,
  `dp` int(20) NOT NULL,
  `sisa` int(20) NOT NULL,
  `lunas` varchar(10) NOT NULL,
  `ket` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cash`
--

INSERT INTO `cash` (`id`, `no_faktur`, `tanggal_faktur`, `kasir`, `total_bayar`, `cash`, `kembali`, `dp`, `sisa`, `lunas`, `ket`) VALUES
(11, 'FKT000000001', '2017-07-15', 'Admin', 5350000, 5350000, 0, 0, 0, 'YA', ''),
(12, 'FKT000000002', '2021-04-11', 'Admin', 950000, 950000, 0, 0, 0, 'YA', ''),
(13, 'FKT000000003', '2021-04-11', 'Admin', 2750000, 2750000, 0, 0, 0, 'YA', ''),
(14, 'FKT000000004', '2021-04-11', 'Admin', 5500000, 5500000, 0, 0, 0, 'YA', ''),
(15, 'FKT000000005', '2021-04-11', 'Admin', 2600000, 2600000, 0, 0, 0, 'YA', ''),
(16, 'FKT000000006', '2021-04-12', 'Kasir', 1300000, 1300000, 0, 0, 0, 'YA', ''),
(17, 'FKT000000007', '2021-04-12', 'Admin', 950000, 1000000, 50000, 0, 0, 'YA', ''),
(18, 'FKT000000008', '2021-04-12', 'Admin', 5500000, 5550000, 50000, 0, 0, 'YA', ''),
(19, 'FKT000000009', '2021-04-12', 'Kasir', 1300000, 1300000, 0, 0, 0, 'YA', ''),
(20, 'FKT000000010', '2021-04-12', 'Kasir', 950000, 0, 0, 500000, 450000, 'TIDAK', 'sisa nya minggu depan'),
(21, 'FKT000000011', '2021-04-12', 'Admin', 1300000, 1300000, 0, 0, 0, 'YA', ''),
(22, 'FKT000000012', '2021-04-12', 'Admin', 14250000, 14250000, 0, 0, 0, 'YA', ''),
(23, 'FKT000000013', '2021-04-12', 'Admin', 34330000, 34330000, 0, 0, 0, 'YA', ''),
(24, 'FKT000000014', '2021-04-13', 'Kasir', 1300000, 1300000, 0, 0, 0, 'YA', ''),
(25, 'FKT000000015', '2021-04-15', 'Admin', 6450000, 6450000, 0, 0, 0, 'YA', ''),
(26, 'FKT000000016', '2021-04-16', 'Admin', 1300000, 1300000, 0, 0, 0, 'YA', ''),
(27, 'FKT000000017', '2021-04-16', 'Admin', 1300000, 1300000, 0, 0, 0, 'YA', ''),
(28, 'FKT000000018', '2021-04-16', 'Admin', 2880000, 0, 0, 500000, 2380000, 'TIDAK', ''),
(29, 'FKT000000019', '2021-04-19', 'Admin', 2600000, 2600000, 0, 0, 0, 'YA', ''),
(30, 'FKT000000020', '2021-04-19', 'Admin', 5500000, 5500000, 0, 0, 0, 'YA', ''),
(31, 'FKT000000021', '2021-04-19', 'Admin', 130000, 130000, 0, 0, 0, 'YA', ''),
(32, 'FKT000000022', '2021-04-22', 'Admin', 5000000, 5000000, 0, 0, 0, 'YA', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cashflow`
--

CREATE TABLE `cashflow` (
  `id` int(11) NOT NULL,
  `no_faktur` varchar(12) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jenis_transaksi` varchar(30) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `ket` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cashflow`
--

INSERT INTO `cashflow` (`id`, `no_faktur`, `tanggal_transaksi`, `jenis_transaksi`, `jumlah`, `ket`) VALUES
(14, 'FKT000000001', '2017-07-15', 'Pemasukan', 5350000, '-'),
(13, 'PMS000000002', '2017-07-15', 'Pengeluaran', 4800000, '-'),
(12, 'PMS000000001', '2017-07-15', 'Pengeluaran', 80000000, '-'),
(15, 'PMS000000003', '2021-04-11', 'Pengeluaran', 750000, '-'),
(16, 'FKT000000002', '2021-04-11', 'Pemasukan', 950000, '-'),
(17, 'PMS000000004', '2021-04-11', 'Pengeluaran', 4500000, '-'),
(18, 'PMS000000005', '2021-04-11', 'Pengeluaran', 2400000, '-'),
(19, 'FKT000000003', '2021-04-11', 'Pemasukan', 2750000, '-'),
(20, 'FKT000000004', '2021-04-11', 'Pemasukan', 5500000, '-'),
(21, 'FKT000000005', '2021-04-11', 'Pemasukan', 2600000, '-'),
(22, 'PMS000000006', '2021-04-11', 'Pengeluaran', 4500000, '-'),
(23, 'FKT000000006', '2021-04-12', 'Pemasukan', 1300000, '-'),
(24, 'FKT000000007', '2021-04-12', 'Pemasukan', 950000, '-'),
(25, 'FKT000000008', '2021-04-12', 'Pemasukan', 5500000, '-'),
(26, 'PMS000000007', '2021-04-12', 'Pengeluaran', 1200000, '-'),
(27, 'PMS000000008', '2021-04-12', 'Pengeluaran', 1200000, '-'),
(28, 'PMS000000009', '2021-04-12', 'Pengeluaran', 1200000, '-'),
(29, 'PMS000000010', '2021-04-12', 'Pengeluaran', 1200000, '-'),
(30, 'PMS000000011', '2021-04-12', 'Pengeluaran', 1200000, '-'),
(31, 'FKT000000009', '2021-04-12', 'Pemasukan', 1300000, '-'),
(32, 'FKT000000010', '2021-04-12', 'Pemasukan', 950000, '-'),
(33, 'PAY000000001', '2021-04-12', 'Pemasukan Pembayaran Piutang', 200000, '-'),
(34, 'PAY000000002', '2021-04-12', 'Pemasukan Pembayaran Piutang', 250000, '-'),
(35, 'FKT000000011', '2021-04-12', 'Pemasukan', 1300000, '-'),
(36, 'FKT000000012', '2021-04-12', 'Pemasukan', 14250000, '-'),
(37, 'FKT000000013', '2021-04-12', 'Pemasukan', 34330000, '-'),
(38, 'FKT000000014', '2021-04-13', 'Pemasukan', 1300000, '-'),
(39, 'FKT000000015', '2021-04-15', 'Pemasukan', 6450000, '-'),
(40, 'FKT000000016', '2021-04-16', 'Pemasukan', 1300000, '-'),
(41, 'FKT000000017', '2021-04-16', 'Pemasukan', 1300000, '-'),
(42, 'FKT000000018', '2021-04-16', 'Pemasukan', 2880000, '-'),
(43, 'FKT000000019', '2021-04-19', 'Pemasukan', 2600000, '-'),
(44, 'FKT000000020', '2021-04-19', 'Pemasukan', 5500000, '-'),
(45, 'FKT000000021', '2021-04-19', 'Pemasukan', 130000, '-'),
(46, 'PMS000000012', '2021-04-22', 'Pengeluaran', 4000000, '-'),
(47, 'PMS000000013', '2021-04-22', 'Pengeluaran', 3000000, '-'),
(48, 'FKT000000022', '2021-04-22', 'Pemasukan', 5000000, '-'),
(49, 'PAY000000003', '2021-04-22', 'Pemasukan Pembayaran Piutang', 500000, '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cash_sup`
--

CREATE TABLE `cash_sup` (
  `id` int(11) NOT NULL,
  `no_faktur_sup` varchar(12) NOT NULL,
  `tanggal_faktur` date NOT NULL,
  `kasir` varchar(20) NOT NULL,
  `total_bayar` int(20) NOT NULL,
  `cash` int(20) NOT NULL,
  `kembali` int(20) NOT NULL,
  `dp` int(20) NOT NULL,
  `sisa` int(20) NOT NULL,
  `lunas` varchar(10) NOT NULL,
  `ket` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cash_sup`
--

INSERT INTO `cash_sup` (`id`, `no_faktur_sup`, `tanggal_faktur`, `kasir`, `total_bayar`, `cash`, `kembali`, `dp`, `sisa`, `lunas`, `ket`) VALUES
(1, 'PMS000000001', '2017-07-15', 'Admin', 80000000, 80000000, 0, 0, 0, 'YA', ''),
(2, 'PMS000000002', '2017-07-15', 'Admin', 4800000, 4800000, 0, 0, 0, 'YA', ''),
(3, 'PMS000000003', '2021-04-11', 'Admin', 750000, 750000, 0, 0, 0, 'YA', ''),
(4, 'PMS000000004', '2021-04-11', 'Admin', 4500000, 4500000, 0, 0, 0, 'YA', ''),
(5, 'PMS000000005', '2021-04-11', 'Admin', 2400000, 2400000, 0, 0, 0, 'YA', ''),
(6, 'PMS000000006', '2021-04-11', 'Admin', 4500000, 4500000, 0, 0, 0, 'YA', ''),
(7, 'PMS000000007', '2021-04-12', 'Admin', 1200000, 1200000, 0, 0, 0, 'YA', ''),
(8, 'PMS000000008', '2021-04-12', 'Admin', 1200000, 1200000, 0, 0, 0, 'YA', ''),
(9, 'PMS000000009', '2021-04-12', 'Admin', 1200000, 1200000, 0, 0, 0, 'YA', ''),
(10, 'PMS000000010', '2021-04-12', 'Admin', 1200000, 1200000, 0, 0, 0, 'YA', ''),
(11, 'PMS000000011', '2021-04-12', 'Admin', 1200000, 1200000, 0, 0, 0, 'YA', ''),
(12, 'PMS000000012', '2021-04-22', 'Admin', 4000000, 4000000, 0, 0, 0, 'YA', ''),
(13, 'PMS000000013', '2021-04-22', 'Admin', 3000000, 3000000, 0, 0, 0, 'YA', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `user` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(20) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `kode_pos` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`user`, `password`, `nama`, `level`, `alamat`, `kota`, `kode_pos`, `no_telp`, `tempat_lahir`, `tanggal_lahir`) VALUES
('admin', '521042f9011ef5b868c0dce578021ae9', 'Administrator', 'Admin', 'Jl Beringin Indah', 'Surabaya', '23283', '085736573645', 'Surabaya', '1980-05-19'),
('demo', 'e10adc3949ba59abbe56e057f20f883e', 'Demo', 'Admin', '', '', '', '', '', '0000-00-00'),
('ikal', '202cb962ac59075b964b07152d234b70', 'ikal', 'Kasir', 'Jl. Buntu No.49, RT.2/RW.2, Cikarang Kota, Kec. Cikarang Utara, Bekasi, Jawa Bar', 'Kabupaten Bekasi', '17530', '0857-2465-2887', 'jakarta', '2004-04-01'),
('kasir', 'e10adc3949ba59abbe56e057f20f883e', 'Kasir 1', 'Kasir', '', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(40) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `kode_pos` varchar(40) NOT NULL,
  `no_telp` varchar(40) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat`, `kota`, `kode_pos`, `no_telp`, `tempat_lahir`, `tanggal_lahir`) VALUES
('CS0001', 'Pelanggan Umum', '', '', '', '', '', '0000-00-00'),
('CS0002', 'Toko Abadi Jaya', '', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `no` int(11) NOT NULL,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `id_supplier` varchar(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `potongan` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`no`, `no_transaksi_sup`, `id_supplier`, `tanggal_transaksi`, `kode_barang`, `potongan`, `qty`, `total_harga`) VALUES
(1, 'PMS000000001', 'SUP0001', '2017-07-15', 'ASU001', 0, 15, 36000000),
(2, 'PMS000000001', 'SUP0001', '2017-07-15', 'SAM001', 0, 20, 44000000),
(3, 'PMS000000002', 'SUP0002', '2017-07-15', 'ASU001', 0, 2, 4800000),
(4, 'PMS000000003', 'SUP0001', '2021-04-11', 'ADV001', 0, 1, 750000),
(5, 'PMS000000004', 'SUP0001', '2021-04-11', 'APP001', 0, 1, 4500000),
(6, 'PMS000000005', 'SUP0002', '2021-04-11', 'ASU001', 0, 1, 2400000),
(7, 'PMS000000006', 'SUP0002', '2021-04-11', 'APP001', 0, 1, 4500000),
(8, 'PMS000000007', 'SUP0001', '2021-04-12', 'INF0005', 0, 1, 1200000),
(9, 'PMS000000008', 'SUP0001', '2021-04-12', 'INF0005', 0, 1, 1200000),
(10, 'PMS000000009', 'SUP0002', '2021-04-12', 'INF0005', 0, 1, 1200000),
(11, 'PMS000000010', 'SUP0001', '2021-04-12', 'INF0005', 0, 1, 1200000),
(14, 'PMS000000011', 'SUP0001', '2021-04-12', 'INF0005', 0, 1, 1200000),
(16, 'PMS000000012', 'SUP0001', '2021-04-22', 'DEL00123', 0, 1, 4000000),
(17, 'PMS000000013', 'SUP0001', '2021-04-22', 'SAM004', 0, 1, 3000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `no` int(11) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `potongan` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`no`, `no_transaksi`, `id_pelanggan`, `tanggal_transaksi`, `kode_barang`, `potongan`, `qty`, `total_harga`) VALUES
(13, 'FKT000000001', 'CS0001', '2017-07-15', 'ASU001', 0, 1, 2750000),
(14, 'FKT000000001', 'CS0001', '2017-07-15', 'SAM001', 0, 1, 2600000),
(15, 'FKT000000002', 'CS0001', '2021-04-11', 'ADV001', 0, 1, 950000),
(16, 'FKT000000003', 'CS0001', '2021-04-11', 'ASU001', 0, 1, 2750000),
(17, 'FKT000000004', 'CS0001', '2021-04-11', 'APP001', 0, 1, 5500000),
(18, 'FKT000000005', 'CS0001', '2021-04-11', 'SAM001', 0, 1, 2600000),
(19, 'FKT000000006', 'CS0001', '2021-04-12', 'INF0005', 0, 1, 1300000),
(20, 'FKT000000007', 'CS0001', '2021-04-12', 'ADV001', 0, 1, 950000),
(21, 'FKT000000008', 'CS0001', '2021-04-12', 'APP001', 0, 1, 5500000),
(22, 'FKT000000009', 'CS0001', '2021-04-12', 'INF0005', 0, 1, 1300000),
(23, 'FKT000000010', 'CS0001', '2021-04-12', 'ADV001', 0, 1, 950000),
(24, 'FKT000000011', 'CS0001', '2021-04-12', 'APL002', 0, 1, 1300000),
(25, 'FKT000000012', 'CS0001', '2021-04-12', 'ADV001', 0, 1, 950000),
(26, 'FKT000000012', 'CS0001', '2021-04-12', 'APP006', 0, 1, 12000000),
(27, 'FKT000000012', 'CS0001', '2021-04-12', 'APP005', 0, 1, 1300000),
(28, 'FKT000000013', 'CS0001', '2021-04-12', 'ADV001', 0, 1, 950000),
(29, 'FKT000000013', 'CS0001', '2021-04-12', 'APL000111', 0, 1, 130000),
(30, 'FKT000000013', 'CS0001', '2021-04-12', 'APL002', 0, 1, 1300000),
(31, 'FKT000000013', 'CS0001', '2021-04-12', 'APP006', 0, 1, 12000000),
(32, 'FKT000000013', 'CS0001', '2021-04-12', 'APP008', 0, 1, 1300000),
(33, 'FKT000000013', 'CS0001', '2021-04-12', 'APP009', 0, 1, 1300000),
(34, 'FKT000000013', 'CS0001', '2021-04-12', 'APP100', 0, 1, 12000000),
(35, 'FKT000000013', 'CS0001', '2021-04-12', 'SAM001', 0, 1, 2600000),
(36, 'FKT000000013', 'CS0001', '2021-04-12', 'ASU001', 0, 1, 2750000),
(37, 'FKT000000014', 'CS0001', '2021-04-13', 'APL002', 0, 1, 1300000),
(46, 'FKT000000015', 'CS0001', '2021-04-15', 'ADV001', 0, 1, 950000),
(47, 'FKT000000015', 'CS0001', '2021-04-16', 'APP001', 0, 1, 5500000),
(48, 'FKT000000016', 'CS0001', '2021-04-16', 'APP0088', 0, 1, 1300000),
(49, 'FKT000000017', 'CS0001', '2021-04-16', 'APP009', 0, 1, 1300000),
(50, 'FKT000000018', 'CS0001', '2021-04-16', 'APL000111', 0, 1, 130000),
(51, 'FKT000000018', 'CS0001', '2021-04-16', 'ASU001', 0, 1, 2750000),
(52, 'FKT000000019', 'CS0001', '2021-04-19', 'SAM001', 0, 1, 2600000),
(53, 'FKT000000020', 'CS0001', '2021-04-19', 'APP001', 0, 1, 5500000),
(54, 'FKT000000021', 'CS0001', '2021-04-19', 'APL000111', 0, 1, 130000),
(55, 'FKT000000022', 'CS0001', '2021-04-22', 'DEL00123', 0, 1, 5000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `piutang`
--

CREATE TABLE `piutang` (
  `no_piutang` varchar(12) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
  `tgl` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `piutang`
--

INSERT INTO `piutang` (`no_piutang`, `no_transaksi`, `tgl`, `total_bayar`, `bayar`, `sisa`) VALUES
('PIU000000001', 'FKT000000010', '2021-04-12', 950000, 500000, 0),
('PIU000000002', 'FKT000000018', '2021-04-16', 2880000, 500000, 1880000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `piutang_sup`
--

CREATE TABLE `piutang_sup` (
  `no_piutang_sup` varchar(12) NOT NULL,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `tgl` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_barang` varchar(10) NOT NULL,
  `brand` varchar(40) NOT NULL,
  `nama_barang` varchar(40) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `kategori` varchar(40) NOT NULL,
  `stock` int(5) DEFAULT NULL,
  `harga_beli` int(20) NOT NULL,
  `harga_jual` int(20) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_barang`, `brand`, `nama_barang`, `satuan`, `kategori`, `stock`, `harga_beli`, `harga_jual`, `tanggal`) VALUES
('andi', 'andi', 'andi', 'second', 'HP', 0, 4000000, 5000001, '2021-04-20 07:09:07'),
('APP004', 'APPLE', 'Iphone 7', 'Unit', 'HP', 2, 4000000, 5000000, '2021-04-21 06:50:30'),
('ASU002', 'ASUS', 'ASUS ZENFONE 2', 'UNIT', 'HP', 0, 1000000, 2000000, '2021-04-21 04:32:28'),
('ASU003', 'Asus', 'Asus ROG', 'UNIT', 'HP', 0, 10000000, 12000000, '2021-04-21 04:13:20'),
('ASU0051', 'ASUS', 'DELL OPTIPLEX 7020', 'second', 'HP', 0, 4000000, 5000000, '2021-04-20 07:04:57'),
('ASU0052', 'andi', 'asda', 'daa', 'HP', 0, 1200000, 950000, '2021-04-20 07:09:53'),
('DEL001', 'DELL', 'DELL OPTIPLEX 7020', 'second', 'HP', 0, 40000001, 500000, '2021-04-20 07:09:43'),
('DEL0012', 'ASUS', 'DELL OPTIPLEX 7020', 'second', 'HP', 0, 7500001, 9500001, '2021-04-20 07:04:30'),
('DEL00123', 'DELL', 'DELL OPTIPLEX 7020', 'UNIT', 'HP', 0, 4000000, 5000000, '2021-04-22 08:08:29'),
('DEL00124', 'DELL', 'Dell Alienware', 'Unit', 'HP', 1, 10000000, 11000000, '2021-04-21 06:50:15'),
('DEL002', 'DELL', 'DELL OPTIPLEX 5055', 'UNIT', 'HP', 0, 4000000, 5000000, '2021-04-21 04:29:37'),
('DEL003', 'DELL', 'DELL Precisioen 5100', 'Unit', 'HP', 0, 1200000, 1300000, '2021-04-21 04:31:34'),
('SAM002', 'SAMSUNG', 'SAMSUNG A8', 'Unilt', 'HP', 0, 2000000, 3000000, '2021-04-21 04:33:18'),
('SAM004', 'SAMSUNG', 'Samsung A9', 'UNIT', 'HP', 1, 3000000, 3500000, '2021-04-22 07:34:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur`
--

CREATE TABLE `retur` (
  `no` int(11) NOT NULL,
  `unique` int(11) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `potongan` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `retur`
--

INSERT INTO `retur` (`no`, `unique`, `no_transaksi`, `id_pelanggan`, `tanggal_transaksi`, `kode_barang`, `potongan`, `qty`, `total_harga`) VALUES
(1, 37, 'FKT000000014', 'CS0001', '2021-04-13', 'APL002', 0, 1, 1300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_sup`
--

CREATE TABLE `retur_sup` (
  `no` int(11) NOT NULL,
  `unique_sup` int(11) NOT NULL,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `id_supplier` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `potongan` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `telp`) VALUES
('SUP0002', 'CV. BINTANG UTAMA', 'Bandung', ''),
('SUP0001', 'PT. ANUGRAH JAYA', 'Jakarta', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_faktur` (`no_faktur`);

--
-- Indeks untuk tabel `cashflow`
--
ALTER TABLE `cashflow`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cash_sup`
--
ALTER TABLE `cash_sup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_faktur_sup` (`no_faktur_sup`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD UNIQUE KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD UNIQUE KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `retur_sup`
--
ALTER TABLE `retur_sup`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `cashflow`
--
ALTER TABLE `cashflow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `cash_sup`
--
ALTER TABLE `cash_sup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `retur`
--
ALTER TABLE `retur`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `retur_sup`
--
ALTER TABLE `retur_sup`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
