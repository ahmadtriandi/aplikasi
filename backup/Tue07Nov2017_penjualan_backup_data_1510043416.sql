DROP TABLE IF EXISTS bukti_piutang;

CREATE TABLE `bukti_piutang` (
  `no_bukti_piutang` varchar(12) NOT NULL,
  `no_piutang` varchar(12) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS bukti_piutang_sup;

CREATE TABLE `bukti_piutang_sup` (
  `no_bukti_piutang_sup` varchar(12) NOT NULL,
  `no_piutang_sup` varchar(12) NOT NULL,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS cash;

CREATE TABLE `cash` (
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO cash VALUES("11","FKT000000001","2017-07-15","Admin","5350000","5350000","0","0","0","YA","");



DROP TABLE IF EXISTS cash_sup;

CREATE TABLE `cash_sup` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO cash_sup VALUES("1","PMS000000001","2017-07-15","Admin","80000000","80000000","0","0","0","YA","");
INSERT INTO cash_sup VALUES("2","PMS000000002","2017-07-15","Admin","4800000","4800000","0","0","0","YA","");



DROP TABLE IF EXISTS cashflow;

CREATE TABLE `cashflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(12) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jenis_transaksi` varchar(30) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `ket` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO cashflow VALUES("14","FKT000000001","2017-07-15","Pemasukan","5350000","-");
INSERT INTO cashflow VALUES("13","PMS000000002","2017-07-15","Pengeluaran","4800000","-");
INSERT INTO cashflow VALUES("12","PMS000000001","2017-07-15","Pengeluaran","80000000","-");



DROP TABLE IF EXISTS login;

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
  `tanggal_lahir` date NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO login VALUES("admin","521042f9011ef5b868c0dce578021ae9","Administrator","Admin","Jl Beringin Indah","Surabaya","23283","085736573645","Surabaya","1980-05-19");
INSERT INTO login VALUES("demo","e10adc3949ba59abbe56e057f20f883e","Demo","Admin","","","","","","0000-00-00");
INSERT INTO login VALUES("kasir","e10adc3949ba59abbe56e057f20f883e","Kasir 1","Kasir","","","","","","0000-00-00");



DROP TABLE IF EXISTS pelanggan;

CREATE TABLE `pelanggan` (
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

INSERT INTO pelanggan VALUES("CS0001","Pelanggan Umum","","","","","","0000-00-00");
INSERT INTO pelanggan VALUES("CS0002","Toko Abadi Jaya","","","","","","0000-00-00");



DROP TABLE IF EXISTS pembelian;

CREATE TABLE `pembelian` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `id_supplier` varchar(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `potongan` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO pembelian VALUES("1","PMS000000001","SUP0001","2017-07-15","ASU001","0","15","36000000");
INSERT INTO pembelian VALUES("2","PMS000000001","SUP0001","2017-07-15","SAM001","0","20","44000000");
INSERT INTO pembelian VALUES("3","PMS000000002","SUP0002","2017-07-15","ASU001","0","2","4800000");



DROP TABLE IF EXISTS penjualan;

CREATE TABLE `penjualan` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(12) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `potongan` int(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` int(20) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO penjualan VALUES("13","FKT000000001","CS0001","2017-07-15","ASU001","0","1","2750000");
INSERT INTO penjualan VALUES("14","FKT000000001","CS0001","2017-07-15","SAM001","0","1","2600000");



DROP TABLE IF EXISTS piutang;

CREATE TABLE `piutang` (
  `no_piutang` varchar(12) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
  `tgl` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS piutang_sup;

CREATE TABLE `piutang_sup` (
  `no_piutang_sup` varchar(12) NOT NULL,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `tgl` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS produk;

CREATE TABLE `produk` (
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

INSERT INTO produk VALUES("ADV001","ADVAN","ADVAN M301","unit","Tablet","26","750000","950000");
INSERT INTO produk VALUES("APP001","APPLE","IPHONE 5","unit","Smartphone","43","4500000","5500000");
INSERT INTO produk VALUES("ASU001","ASUS","ASUS SELFIE","unit","Smartphone","34","2400000","2750000");
INSERT INTO produk VALUES("SAM001","SAMSUNG","SAMSUNG J5","unit","Smartphone","44","2200000","2600000");



DROP TABLE IF EXISTS retur;

CREATE TABLE `retur` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS retur_sup;

CREATE TABLE `retur_sup` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS supplier;

CREATE TABLE `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(30) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO supplier VALUES("SUP0002","CV. BINTANG UTAMA","Bandung","");
INSERT INTO supplier VALUES("SUP0001","PT. ANUGRAH JAYA","Jakarta","");



