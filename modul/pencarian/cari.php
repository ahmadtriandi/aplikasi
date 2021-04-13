	<?php
if(!isset($_SESSION['user'])) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//TAMPIL CARI
case "tampil";
echo '<h3>Pencarian Data</h3>';
echo '<style>
#belakang:hover
{
background-color:silver;
border : 0px solid white;
    -moz-border-radius : 25px;
    -webkit-border-radius : 25px;
	-moz-box-shadow: 0 0 2px 2px #9b7e7e;
-webkit-box-shadow: 0 0 2px 2px#9b7e7e;
box-shadow: 0 0 2px 2px #9b7e7e;
width:110px;
}
</style>';
echo '<a href="?modul=pencarian&aksi=transaksi" title="Pencarian Data Transaksi"><img id="belakang" src="images/penjualan.png" width="100px"/></a>';
echo '<a href="?modul=pencarian&aksi=pelanggan" title="Pencarian Data Pelanggan"><img id="belakang" src="images/customer.png" width="100px"/></a>';
echo '<a href="?modul=pencarian&aksi=produk" title="Pencarian Data Produk"><img id="belakang" src="images/produk.png" width="100px"/></a>';
break;
//TAMPIL TRANSAKSI
case "transaksi";
echo '<h3>Pencarian Data Transaksi</h3>
</br><form>
		<font face="verdana" size="2">Pilih No Transaksi : </font><select name="no_transaksi" onchange="tampil2(no_transaksi.value)">
		<option value="">Pilih</option>
		<option value="">Semua Faktur</option>';
		$tmpq = mysqli_query($con, "select no_faktur from cash order by no_faktur DESC");
		while($tmpfkt=mysqli_fetch_array($tmpq)){
		
		echo "<option value='$tmpfkt[no_faktur]'>$tmpfkt[no_faktur]</option>";
		}
		echo '
		</select>
	<br />
	<div id="pencariantransaksi"></div>';
break;
case "retur";
echo '<h3>Lihat Data Retur</h3>
</br><form>
		<font face="verdana" size="2">Pilih No Transaksi : </font><select name="no_transaksi" onchange="tampil(no_transaksi.value)">
		<option value="-">Pilih</option>';

		$tmpq = mysqli_query($con, "select DISTINCT no_transaksi from retur order by no_transaksi DESC");
		while($tmpfkt=mysqli_fetch_array($tmpq)){
		
		echo "<option value='$tmpfkt[no_transaksi]'>$tmpfkt[no_transaksi]</option>";
		}
		echo '
		</select>
	<br />
	<div id="pencarianretur"></div>';
break;
case "retursup";
echo '<h3>Lihat Data Retur Ke Supplier</h3>
</br><form>
		<font face="verdana" size="2">Pilih No Transaksi : </font><select name="no_transaksi_sup" onchange="tampilkansup(no_transaksi_sup.value)">
		<option value="-">Pilih</option>';

		$tmpq = mysqli_query($con, "select DISTINCT no_transaksi_sup from retur_sup order by no_transaksi_sup DESC");
		while($tmpfkt=mysqli_fetch_array($tmpq)){
		
		echo "<option value='$tmpfkt[no_transaksi_sup]'>$tmpfkt[no_transaksi_sup]</option>";
		}
		echo '
		</select>
	<br />
	<div id="pencarianretursup"></div>';
break;
case "pelanggan";
echo '<h3>Pencarian Data Pelanggan</h3><form>
		<font face="verdana" size="2">Ketikkan Data Pelanggan Yang Ingin Di Cari : </font><input type="text" name="id_pelanggan" id="id_pelanggan" size="25" onkeyup="tampilpelanggan(id_pelanggan.value)" />
	
	<br />
	<div id="pencarianpelanggan"></div>';
break;
case "produk";
echo '<h3>Pencarian Data Produk</h3><form>
		<font face="verdana" size="2">Ketikkan Data Produk Yang Ingin Di Cari : </font><input type="text" name="id_produk" id="id_produk" size="25" onkeyup="tampilbarang(id_produk.value)" />
	
	<br />
	<div id="pencarianbarang"></div>';
break;
}
}

echo '<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>';

?>
