<?php
error_reporting(0);
echo '<div id="menu">';
?>

<?php if(!isset($_SESSION["user"])) : ?>
	<ul><li><a href="index.php"><img src="images/home.png" alt="" width="50px"></br><center>Home</center></a></li>
	</ul>

<?php elseif($_SESSION["level"] == "Kasir") : ?>
	<ul><li><a href="index.php"><img src="images/home.png" alt="" width="50px"></br><center>Home</center></a></li>
    	<li><a href="index.php?modul=pelanggan&aksi=tampil"><img src="images/customer.png" width="50px"></br><center>Pelanggan</center></a></li>
		<li><a href="index.php?modul=penjualan&aksi=tampil"><img src="images/penjualan2.png" width="50px"></br><center>Transaksi</center></a></li>
		<li><a href="index.php?modul=retur&aksi=tampil"><img src="images/repeat.png" width="50px"></br><center>Retur</center></a></li>
		<li><a href="index.php?modul=pencarian&aksi=tampil"><img src="images/search.png" width="50px"></br><center>Pencarian</center></a></li>
		<li><a href="login/aksilogout.php"><img src="images/logoff.png" width="50px"/></br><center>Logout</center></a></li>
	</ul>

		<?php elseif($_SESSION["level"] == "Admin"): ?>
			<ul><li><a href="index.php"><img src="images/home.png" alt="" width="50px"></br><center>Home</center></a></li>
				<li><a href="#"><img src="images/data.png" width="50px"></br><center>Master</center></a>
					<ul>
        				<li><a href="index.php?modul=supplier&aksi=tampil">Data Supplier</a></li> 
						<li><a href="index.php?modul=pelanggan&aksi=tampil">Data Pelanggan</a></li>
						<li><a href="index.php?modul=produk&aksi=tampil">Data Produk</a></li>
						<li><a href="index.php?modul=user&aksi=tampil">Data Pengguna</a></li>
  	   				</ul>
				</li>

<!--<li><a href="index.php?modul=produk&aksi=tampil"><img src="images/stok.png" width="50px"></br><center>Ubah Stok</center></a></li>-->
		
				<li><a href="#"><img src="images/pembelian2.png" width="50px"></br><center>Pembelian</center></a>
					<ul>
						<li><a href="index.php?modul=pembelian&aksi=tampil">Transaksi Pembelian</a></li>
						<li><a href="index.php?modul=retursup&aksi=tampil">Retur Pembelian</a></li>
  	   				</ul>
				</li>
		
				<li><a href="#"><img src="images/penjualan2.png" width="50px"></br><center>Penjualan</center></a>
					<ul>
						<li><a href="index.php?modul=penjualan&aksi=tampil">Transaksi Penjualan</a></li>
						<li><a href="index.php?modul=retur&aksi=tampil">Retur Penjualan</a></li>
					</ul>
				</li>
		
				<li><a href="#"><img src="images/credit_cards.png" width="50px"></br><center>Hutang</center></a>
					<ul>
						<li><a href="index.php?modul=piutangsup&aksi=tampil">Hutang Supplier</a></li>
						<li><a href="index.php?modul=buktipiutangsup&aksi=tampil">Bukti Pembayaran Hutang</a></li>
					</ul>
				</li>
		
				<li><a href="#"><img src="images/dollar_coin.png" width="50px"></br><center>Piutang</center></a>
					<ul>
						<li><a href="index.php?modul=piutang&aksi=tampil">Piutang Pelanggan</a></li>
						<li><a href="index.php?modul=buktipiutang&aksi=tampil">Bukti Pembayaran Piutang</a></li>
					</ul>
				</li>
		
				<li><a href="#"><img src="images/cashflow.png" width="50px"></br><center>Cash Flow</center></a>
					<ul>
						<li><a href="index.php?modul=cfmasuk&aksi=tampil">Pemasukan</a></li>
						<li><a href="index.php?modul=cfkeluar&aksi=tampil">Pengeluaran</a></li>
					</ul>
				</li>
				<li><a href="index.php?modul=pencarian&aksi=tampil"><img src="images/search.png" width="50px"></br><center>Pencarian</center></a></li>
    			<li><a href="#"><img src="images/laporan.png" width="50px"></br><center>Laporan</center></a>
    				<ul>
        				<!--<li><a href="index.php?modul=laporan&aksi=tampil">Rekap Invoice Penjualan</a></li> -->
						<li><a href="index.php?modul=laporanpembelian&aksi=tampil">Laporan Pembelian</a></li> 
						<li><a href="index.php?modul=laporanharian&aksi=tampil">Laporan Penjualan</a></li>
						<li><a href="index.php?modul=laporankeluar&aksi=tampil">Laporan Barang Keluar</a></li>
  	   				</ul>
				<li><a href="#"><img src="images/database.png" width="50px"></br><center>Database</center></a>
    				<ul>
        				<li><a href="index.php?modul=backup">Backup Database</a></li> 
						<li><a href="index.php?modul=restore">Restore Database</a></li>
  	   				</ul>
				<li><a href="login/aksilogout.php"><img src="images/logoff.png" width="49px"/></br><center>Logout</center></a></li>
			</ul>
<?php endif; ?>

 
</div>


</div>
</center></div>