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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO cash VALUES("1","FKT000000001","2013-08-27","Admin","130000","150000","20000","0","0","YA","Pembayaran Via Mandiri 22320*****");
INSERT INTO cash VALUES("2","FKT000000002","2013-08-27","Admin","400000","500000","100000","0","0","YA","Pembayaran Via Mandiri 22320*****");
INSERT INTO cash VALUES("3","FKT000000003","2013-09-02","Admin","220000","1000000","780000","0","0","YA","");



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

INSERT INTO login VALUES("admin","96e79218965eb72c92a549dd5a330112","Administrator","Admin","Jl Beringin Indah","Surabaya","23283","085736573645","Surabaya","1990-11-26");
INSERT INTO login VALUES("arif","e10adc3949ba59abbe56e057f20f883e","Arif Prasetyo","Admin","Jl Tangkuban Perahu","Tanjung Pinang","239238","343983498","Pekanbaru","1994-08-24");
INSERT INTO login VALUES("kasir","96e79218965eb72c92a549dd5a330112","Kasir","Kasir","","","","","","0000-00-00");
INSERT INTO login VALUES("randi","e10adc3949ba59abbe56e057f20f883e","Randi Ahmad","Admin","Jl H Arif","Surabaya","34939","034838743","Pekanbaru","2013-08-27");
INSERT INTO login VALUES("reno","e10adc3949ba59abbe56e057f20f883e","Reno","Admin","Jl H Arif","Surabaya","23928","0239398343","Pekanbaru","1991-08-08");



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

INSERT INTO pelanggan VALUES("CS0001","Pelanggan","","","","","","0000-00-00");
INSERT INTO pelanggan VALUES("CS0002","Khairul Umam","","","","","","0000-00-00");



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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO penjualan VALUES("1","FKT000000001","CS0001","2013-08-27","P11","0","3","90000");
INSERT INTO penjualan VALUES("2","FKT000000001","CS0001","2013-08-27","K12","0","1","40000");
INSERT INTO penjualan VALUES("3","FKT000000002","CS0001","2013-08-27","K12","0","10","400000");
INSERT INTO penjualan VALUES("4","FKT000000003","CS0001","2013-09-02","K12","0","1","40000");
INSERT INTO penjualan VALUES("5","FKT000000003","CS0001","2013-09-02","T12","0","1","60000");
INSERT INTO penjualan VALUES("6","FKT000000003","CS0001","2013-09-02","K12","0","1","40000");
INSERT INTO penjualan VALUES("7","FKT000000003","CS0001","2013-09-02","K12","0","1","40000");
INSERT INTO penjualan VALUES("8","FKT000000003","CS0001","2013-09-02","K12","0","1","40000");



DROP TABLE IF EXISTS piutang;

CREATE TABLE `piutang` (
  `no_piutang` varchar(12) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
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

INSERT INTO produk VALUES("K12","SINAR DUNIA","KERTAS HVS","RIM","KERTAS","50","35000","40000");
INSERT INTO produk VALUES("P11","Snowman","Pulpen","Kotak","Pulpen","47","10000","30000");
INSERT INTO produk VALUES("T11","MERK HIGH","TONER","TIDAK TAU","TONER","68","40000","45000");
INSERT INTO produk VALUES("T12","Dataprint","Tinta","Kotak","Tinta","39","40000","60000");



