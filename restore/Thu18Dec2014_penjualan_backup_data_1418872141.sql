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

INSERT INTO bukti_piutang VALUES("PAY000000001","PIU000000001","FKT000000003","2014-09-11","70000","60000","60000");
INSERT INTO bukti_piutang VALUES("PAY000000002","PIU000000002","FKT000000007","2014-09-30","40000","20000","20000");
INSERT INTO bukti_piutang VALUES("PAY000000003","PIU000000003","FKT000000008","2014-09-30","40000","40000","40000");
INSERT INTO bukti_piutang VALUES("PAY000000004","PIU000000004","FKT000000010","2014-10-02","40000","30000","10000");
INSERT INTO bukti_piutang VALUES("PAY000000005","PIU000000004","FKT000000010","2014-10-02","40000","20000","5000");
INSERT INTO bukti_piutang VALUES("PAY000000006","PIU000000004","FKT000000010","2014-10-02","40000","15000","5000");



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

INSERT INTO bukti_piutang_sup VALUES("BKT000000001","PIS000000001","PMS000000005","2014-09-11","40000","30000","30000");
INSERT INTO bukti_piutang_sup VALUES("BKT000000002","PIS000000002","PMS000000008","2014-10-02","40000","30000","30000");
INSERT INTO bukti_piutang_sup VALUES("BKT000000003","PIS000000003","PMS000000009","2014-10-02","40000000","35000","5000");
INSERT INTO bukti_piutang_sup VALUES("BKT000000004","PIS000000003","PMS000000009","2014-10-02","40000000","30000","10000");



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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO cash VALUES("1","FKT000000001","2014-07-10","Admin","70000","70000","0","0","0","YA","");
INSERT INTO cash VALUES("2","FKT000000002","2014-09-09","Admin","155000","200000","45000","0","0","YA","");
INSERT INTO cash VALUES("3","FKT000000003","2014-09-11","Admin","70000","0","0","10000","60000","TIDAK","");
INSERT INTO cash VALUES("4","FKT000000004","2014-09-11","Admin","70000","70000","0","0","0","YA","");
INSERT INTO cash VALUES("5","FKT000000005","2014-09-11","Admin","70000","70000","0","0","0","YA","");
INSERT INTO cash VALUES("6","FKT000000006","2014-09-30","Admin","85000","100000","15000","0","0","YA","");
INSERT INTO cash VALUES("7","FKT000000007","2014-09-30","Admin","40000","0","0","20000","20000","TIDAK","");
INSERT INTO cash VALUES("8","FKT000000008","2014-09-30","Admin","40000","0","0","0","40000","TIDAK","");
INSERT INTO cash VALUES("9","FKT000000009","2014-10-02","Admin","70000","70000","0","0","0","YA","");
INSERT INTO cash VALUES("10","FKT000000010","2014-10-02","Admin","40000","0","0","10000","30000","TIDAK","");
INSERT INTO cash VALUES("11","FKT000000011","2014-10-02","Admin","70000","70000","0","0","0","YA","");
INSERT INTO cash VALUES("12","FKT000000012","2014-11-25","Admin","70000","80000","10000","0","0","YA","");



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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

INSERT INTO cash_sup VALUES("1","PMS000000001","2014-07-10","Admin","40000","40000","0","0","0","YA","");
INSERT INTO cash_sup VALUES("2","PMS000000002","2014-07-10","Admin","80000","100000","20000","0","0","YA","");
INSERT INTO cash_sup VALUES("3","PMS000000003","2014-09-09","Admin","35000","38000","3000","0","0","YA","");
INSERT INTO cash_sup VALUES("4","PMS000000004","2014-09-09","Admin","75000","100000","25000","0","0","YA","");
INSERT INTO cash_sup VALUES("5","PMS000000005","2014-09-11","Admin","40000","0","0","10000","30000","TIDAK","");
INSERT INTO cash_sup VALUES("6","PMS000000006","2014-09-11","Admin","40000","50000","10000","0","0","YA","");
INSERT INTO cash_sup VALUES("7","PMS000000007","2014-09-11","Admin","40000","50000","10000","0","0","YA","");
INSERT INTO cash_sup VALUES("8","PMS000000008","2014-10-02","Admin","40000","0","0","10000","30000","TIDAK","");
INSERT INTO cash_sup VALUES("9","PMS000000009","2014-10-02","Admin","40000","0","0","5000","35000","TIDAK","");
INSERT INTO cash_sup VALUES("10","PMS000000010","2014-10-02","Admin","75000","100000","25000","0","0","YA","");
INSERT INTO cash_sup VALUES("11","PMS000000011","2014-10-02","Admin","35000","50000","15000","0","0","YA","");
INSERT INTO cash_sup VALUES("12","PMS000000012","2014-10-02","Admin","40000","40000","0","0","0","YA","");
INSERT INTO cash_sup VALUES("13","PMS000000013","2014-10-02","Admin","40000","40000","0","0","0","YA","");
INSERT INTO cash_sup VALUES("14","PMS000000014","2014-10-02","Admin","40000","100000","60000","0","0","YA","");
INSERT INTO cash_sup VALUES("15","PMS000000015","2014-10-02","Admin","40000","99000","59000","0","0","YA","");
INSERT INTO cash_sup VALUES("16","PMS000000016","2014-10-02","Admin","40000","40000","0","0","0","YA","");



DROP TABLE IF EXISTS cashflow;

CREATE TABLE `cashflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(12) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jenis_transaksi` varchar(30) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `ket` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO cashflow VALUES("1","BKT000000004","2014-10-02","Pengeluaran Piutang Supplier","10000","-");
INSERT INTO cashflow VALUES("2","PAY000000006","2014-10-02","Pemasukan Pembayaran Piutang","5000","-");
INSERT INTO cashflow VALUES("3","PMS000000016","2014-10-02","Pengeluaran","40000","-");
INSERT INTO cashflow VALUES("4","FKT000000011","2014-10-02","Pemasukan","70000","-");
INSERT INTO cashflow VALUES("5","FKT000000012","2014-11-25","Pemasukan","70000","-");



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
INSERT INTO login VALUES("kasir","96e79218965eb72c92a549dd5a330112","Kasir","Kasir","","","","","","0000-00-00");



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

INSERT INTO pelanggan VALUES("CS0001","Customer","Disini","Disitu","0000","008","dimana-mana","0000-00-00");
INSERT INTO pelanggan VALUES("CS0002","Yenny Soeindra","","","","","","0000-00-00");



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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO pembelian VALUES("1","PMS000000001","SUP0002","2014-07-10","GAC03","0","1","40000");
INSERT INTO pembelian VALUES("2","PMS000000002","SUP0001","2014-07-10","GAC03","0","1","40000");
INSERT INTO pembelian VALUES("3","PMS000000002","SUP0001","2014-07-10","T11","0","1","40000");
INSERT INTO pembelian VALUES("4","PMS000000003","SUP0004","2014-09-09","K12","0","1","35000");
INSERT INTO pembelian VALUES("5","PMS000000004","SUP0002","2014-09-09","T11","0","1","40000");
INSERT INTO pembelian VALUES("6","PMS000000004","SUP0002","2014-09-09","K12","0","1","35000");
INSERT INTO pembelian VALUES("7","PMS000000005","SUP0002","2014-09-11","GAC03","0","1","40000");
INSERT INTO pembelian VALUES("8","PMS000000006","SUP0001","2014-09-11","GAC03","0","1","40000");
INSERT INTO pembelian VALUES("9","PMS000000007","SUP0002","2014-09-11","T11","0","1","40000");
INSERT INTO pembelian VALUES("10","PMS000000008","SUP0002","2014-10-02","GAC03","0","1","40000");
INSERT INTO pembelian VALUES("11","PMS000000009","SUP0002","2014-10-02","GAC03","0","1","40000");
INSERT INTO pembelian VALUES("12","PMS000000010","SUP0001","2014-10-02","GAC03","0","1","40000");
INSERT INTO pembelian VALUES("13","PMS000000010","SUP0001","2014-10-02","K12","0","1","35000");
INSERT INTO pembelian VALUES("14","PMS000000011","SUP0001","2014-10-02","K12","0","1","35000");
INSERT INTO pembelian VALUES("15","PMS000000012","SUP0002","2014-10-02","GAC03","0","1","40000");
INSERT INTO pembelian VALUES("16","PMS000000013","SUP0001","2014-10-02","T11","0","1","40000");
INSERT INTO pembelian VALUES("17","PMS000000014","SUP0004","2014-10-02","GAC03","0","1","40000");
INSERT INTO pembelian VALUES("18","PMS000000015","SUP0001","2014-10-02","GAC03","0","1","40000");
INSERT INTO pembelian VALUES("19","PMS000000016","SUP0001","2014-10-02","GAC03","0","1","40000");



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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO penjualan VALUES("1","FKT000000001","CS0001","2014-07-10","GAC03","0","1","70000");
INSERT INTO penjualan VALUES("2","FKT000000002","CS0001","2014-09-09","K12","0","1","40000");
INSERT INTO penjualan VALUES("3","FKT000000002","CS0001","2014-09-09","T11","0","1","45000");
INSERT INTO penjualan VALUES("4","FKT000000002","CS0001","2014-09-09","GAC03","0","1","70000");
INSERT INTO penjualan VALUES("5","FKT000000003","CS0001","2014-09-11","GAC03","0","1","70000");
INSERT INTO penjualan VALUES("6","FKT000000004","CS0001","2014-09-11","GAC03","0","1","70000");
INSERT INTO penjualan VALUES("7","FKT000000005","CS0001","2014-09-11","GAC03","0","1","70000");
INSERT INTO penjualan VALUES("8","FKT000000006","CS0001","2014-09-30","T11","0","1","45000");
INSERT INTO penjualan VALUES("9","FKT000000006","CS0001","2014-09-30","K12","0","1","40000");
INSERT INTO penjualan VALUES("12","FKT000000007","CS0001","2014-09-30","K12","0","1","40000");
INSERT INTO penjualan VALUES("13","FKT000000008","CS0001","2014-09-30","K12","0","1","40000");
INSERT INTO penjualan VALUES("14","FKT000000009","CS0001","2014-10-02","GAC03","0","1","70000");
INSERT INTO penjualan VALUES("15","FKT000000010","CS0001","2014-10-02","K12","0","1","40000");
INSERT INTO penjualan VALUES("16","FKT000000011","CS0001","2014-10-02","GAC03","0","1","70000");
INSERT INTO penjualan VALUES("17","FKT000000012","CS0001","2014-11-25","GAC03","0","1","70000");
INSERT INTO penjualan VALUES("18","FKT000000013","CS0001","2014-11-25","T11","0","1","45000");



DROP TABLE IF EXISTS piutang;

CREATE TABLE `piutang` (
  `no_piutang` varchar(12) NOT NULL,
  `no_transaksi` varchar(12) NOT NULL,
  `tgl` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO piutang VALUES("PIU000000001","FKT000000003","2014-09-11","70000","10000","0");
INSERT INTO piutang VALUES("PIU000000002","FKT000000007","2014-09-30","40000","20000","0");
INSERT INTO piutang VALUES("PIU000000003","FKT000000008","2014-09-30","40000","0","0");
INSERT INTO piutang VALUES("PIU000000004","FKT000000010","2014-10-02","40000","10000","10000");



DROP TABLE IF EXISTS piutang_sup;

CREATE TABLE `piutang_sup` (
  `no_piutang_sup` varchar(12) NOT NULL,
  `no_transaksi_sup` varchar(12) NOT NULL,
  `tgl` date NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO piutang_sup VALUES("PIS000000001","PMS000000005","2014-09-11","40000","10000","0");
INSERT INTO piutang_sup VALUES("PIS000000002","PMS000000008","2014-10-02","40000","10000","0");
INSERT INTO piutang_sup VALUES("PIS000000003","PMS000000009","2014-10-02","40000","5000","20000");



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

INSERT INTO produk VALUES("GAC03","Avian","Cat Tembok","Kaleng","Cat","23","40000","70000");
INSERT INTO produk VALUES("K12","SINAR DUNIA","KERTAS HVS","RIM","KERTAS","34","35000","40000");
INSERT INTO produk VALUES("P11","Snowman","Pulpen","Kotak","Pulpen","47","10000","30000");
INSERT INTO produk VALUES("T11","MERK HIGH","TONER","TIDAK TAU","TONER","59","40000","45000");
INSERT INTO produk VALUES("T12","Dataprint","Tinta","Kotak","Tinta","42","40000","60000");



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO retur VALUES("1","1","FKT000000001","CS0001","2014-07-10","GAC03","0","1","70000");



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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO retur_sup VALUES("1","1","PMS000000001","SUP0002","2014-07-10","GAC03","0","1","40000");
INSERT INTO retur_sup VALUES("2","2","PMS000000002","SUP0001","2014-07-10","GAC03","0","1","40000");
INSERT INTO retur_sup VALUES("3","3","PMS000000002","SUP0001","2014-07-10","T11","0","1","40000");
INSERT INTO retur_sup VALUES("4","4","PMS000000003","SUP0004","2014-09-09","K12","0","1","35000");



DROP TABLE IF EXISTS supplier;

CREATE TABLE `supplier` (
  `id_supplier` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(30) NOT NULL,
  PRIMARY KEY (`id_supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO supplier VALUES("SUP0001","PT Aritha Muda","Jl Pemuda Semarang","02132949355");
INSERT INTO supplier VALUES("SUP0002","PT MULIA KENCANA","JL Soebrantas No 35","021383483");



