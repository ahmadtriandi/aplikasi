<?php

date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$pecah1 = explode("-", $tglsekarang);
$date1 = $pecah1[2];
$month1 = $pecah1[1];
$year1 = $pecah1[0];
$sekarang = GregorianToJD($month1, $date1, $year1);
$valid = "2013-08-23";
$pecah2 = explode("-", $valid);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
$valid2 = GregorianToJD($month2, $date2, $year2);
$selisih = $valid2 - $sekarang;
if(!isset($_SESSION['user'])) {
echo '<script>setTimeout(\'location.href="index.php"\' ,0);</script>';
}else{
$cekpembayaran=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)),9,'0'))) as no from pembelian");
$tampilpembayaran=mysqli_fetch_array($cekpembayaran);
$cekpmb = "PMS$tampilpembayaran[no]";
$cekfaktur=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_faktur_sup),9)),9,'0'))) as no_faktur_sup from cash_sup");
$tampilfaktur=mysqli_fetch_array($cekfaktur);
$cekfkt = "PMS$tampilfaktur[no_faktur_sup]";


$query5=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)),9,'0'))) as no from pembelian");
$tampil5=mysqli_fetch_array($query5);
if (empty($tampil5['no'])) {
$auto = "000000001";
}else{
$auto = $tampil5['no'];
}
$maks5=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)),9,'0'))) as no from pembelian");
$tampil6=mysqli_fetch_array($maks5);
$sql_limit5 = "SELECT * from pembelian,produk where pembelian.kode_barang = produk.id_barang and pembelian.no_transaksi = 'PMS$tampil6[no]' order by no ASC";
$query6=mysqli_query($con, $sql_limit5);
$tampilpelanggan5 = mysqli_query($con, "SELECT DISTINCT pembelian.id_supplier,supplier.nama from pembelian,supplier where supplier.id_supplier = pembelian.id_supplier and pembelian.no_transaksi_sup = 'PMS$tampil6[no]'");
$tampilpelanggan6=mysqli_fetch_array($tampilpelanggan5);

switch ($_GET['aksi'])
{

case "tampil";

if ($cekpmb == $cekfkt) {
 echo '<script>setTimeout(\'location.href="?modul=pembelian&aksi=baru"\' ,0);</script>';
 }else{

date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$query=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)),9,'0'))) as no from pembelian");
$tampil=mysqli_fetch_array($query);
if (empty($tampil['no'])) {
$auto = "000000001";
echo '<script>setTimeout(\'location.href="?modul=pembelian&aksi=baru"\' ,0);</script>';
}else{
$auto = $tampil['no'];
}
$maks=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)),9,'0'))) as no from pembelian");
$tampil=mysqli_fetch_array($maks);
$sql_limit = "SELECT * from pembelian,produk where pembelian.kode_barang = produk.id_barang and pembelian.no_transaksi_sup = 'PMS$tampil[no]' order by no ASC";
$query=mysqli_query($con, $sql_limit);
$tampilpelanggan = mysqli_query($con, "SELECT DISTINCT pembelian.id_supplier,supplier.nama from pembelian,supplier where supplier.id_supplier = pembelian.id_supplier and pembelian.no_transaksi_sup = 'PMS$tampil[no]'");
$tampilpelanggan2=mysqli_fetch_array($tampilpelanggan);
echo"<h2>Data Transaksi Pembelian Terakhir</h2>";
echo "<center><form action='?modul=pembelian&aksi=input' name='postform' method=POST>
<table style='width:900px' id='tabeledit'>
<tr>
	<td>No. Invoice</td>
	<td>: <input size='10' type='hidden' name='no_transaksi_sup' value='PMS$auto' maxlength='30'><b>PMS$auto</b></td>
	<td>Tanggal</td>
	<td>: <input size='10' type='hidden' value='$tglsekarang' name='tanggal_transaksi' maxlength='80'><b>$tglsekarang</b></td>
</tr>
<tr>
	<td>Supplier</td>
	<td>: <input size='35' type='hidden' name='supplier' id='supplier' value='$tampilpelanggan2[id_supplier]-$tampilpelanggan2[nama]'/><b>$tampilpelanggan2[id_supplier]-$tampilpelanggan2[nama]</b></td>
	<td></td>
	<td></td>
</tr>
</table><br>";
	

echo"<table id='tabel' style='width:900px; font-size:11px'>
<tr bgcolor='#009933' style=\"color:#FFFFFF\" align='center' height='25px'>";
echo "<td width='10%'>Kode Barang</td>
<td width='20%'>Nama Barang</td>
<td width='15%'>Harga Beli</td>

<td width='13%'>Qty</td>

<td width='15%'>Total Harga</td>
<td width='3%'>Batal</td>";
$no=1;
$baris=1;
while($tampil=mysqli_fetch_array($query)){ 
if($baris%2==0)
{
echo "<tr bgcolor=\"#e4e3e8\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}
//echo"<td>$tampil[no_transaksi]</td>";
//echo"<td>$tampil[tanggal_transaksi]</td>";
echo"<td>$tampil[kode_barang]</td>";
echo"<td>$tampil[nama_barang]</td>";
echo"<td>Rp".number_format($tampil['harga_beli'],2,',','.')."</td>";
echo"<td>$tampil[qty]</td>";
$tampilrupiah=number_format($tampil['total_harga'],2,',','.');
//if($tampil['kode_barang']=="SRV"){
//echo"<td>Rp$tampilrupiah</td>";
//}else{
//echo"<td>-</td>";
//}
echo"<td>Rp$tampilrupiah</td>";
echo"<td width='3%' align='center'><a onclick=\"return confirm('Anda Yakin Membatalkan Pembelian $tampil[nama_barang]?')\" href='?modul=pembelian&aksi=hapus&id=$tampil[no]&brg=$tampil[kode_barang]'><img src='images/delete128px.png' width='24px' title='Batal'></td>";
$no++;
$baris++;}
echo"</tr>";
echo "
<tr>
<td>";
echo '<input type="text" size="13" name="id_barang" id="id_barang" size="25" onload="tampilkanbarang(id_barang.value)" onclick="tampilkanbarang(id_barang.value)" onkeyup="tampilkanbarang(id_barang.value)" />';
echo "</td>
<td colspan=2><div id='pencarian'></div></td>

<td><input name='potongan' onkeyup=\"this.value = numberFormat(this.value);\" value='0' size='5' type='hidden'/><input name='qty' value='1' size='1' type='text'/><input type='submit' value='enter'>
<script language=\"Javascript\">
document.postform.id_barang.focus()
</script>
</form></td></td><td><input name='srv' size='5' hidden value='0' type='text'/></td></tr>";
$maks=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)),9,'0'))) as no from pembelian");
$tampil=mysqli_fetch_array($maks);
$kuery=mysqli_query($con, "SELECT SUM(total_harga) as total_harga from pembelian where no_transaksi_sup = 'PMS$tampil[no]'");
$tampilkan=mysqli_fetch_array($kuery);
echo"<tr><td colspan = '4'><center><b>Total Yang Harus Di Bayar Adalah</b></center></td><td>Rp".number_format($tampilkan['total_harga'],2,',','.')."</td>";
echo"</table></center>";
echo "<script>
function popup(form) {
setTimeout('location.href=\"?modul=pembelian&aksi=baru\"' ,0);
    window.open('', 'formpopup', 'menubar=yes,scrollbars=yes,resizable=yes,width=800,height=600');
    form.target = 'formpopup';
}
</script>";
$maks=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)+1),9,'0'))) as no from pembelian");
$tampil=mysqli_fetch_array($maks);
echo"<form action='modul/pembelian/faktur.php' target=\"popUp\" onsubmit=\"popup(this);\" method=POST><span style='font-size:20pt'>Bayar : <select name='jenisbayar' style='font-size:20pt'><option value='Kontan'>Kontan</option><option value='DP'>Hutang</option></select>Rp</span><input style='font-size:20pt' type='text' name='bayar' onkeyup=\"this.value = numberFormat(this.value);\" maxlength='20'><span style='font-size:20pt'>,00</span></br>
<input size='35' type='hidden' name='supplier' id='supplier' value='$tampilpelanggan6[id_supplier]'/>
<input size='35' type='hidden' name='no_transaksi_sup' id='no_transaksi_sup' value='PMS$tampil[no]'/>
<input size='35' type='hidden' name='level' id='level' value='$_SESSION[level]'/>
Keterangan Pembayaran : <input style='width:400px' maxlength='200' type='text' id='ket' name='ket'/></br></br>
<input type='submit' value='Proses Bayar'/ style='background-color:#FF3300; color:#fff; line-height:30px;cursor:pointer;border:hidden;'></form>";
}
break;

//HAPUS
case "hapus":

if ($cekpmb == $cekfkt){
 echo '<script>alert(\'Transaksi Pembelian pada No Transaksi "'.$cekfkt.'" Sudah Dilakukan !!\nTekan OK/Enter Untuk Menuju Transaksi Baru \')
 setTimeout(\'location.href="?modul=pembelian&aksi=baru"\' ,0);</script>';
 }else{
$cekstok = mysqli_query($con, "SELECT qty from pembelian where no = '$_GET[id]'");
$tampilstok = mysqli_fetch_array($cekstok);
$cekstok2 = mysqli_query($con, "SELECT stock from produk where id_barang = '$_GET[brg]'");
$tampilstok2 = mysqli_fetch_array($cekstok2);
//if ($_GET['brg']=="SRV"){
//$stoksekarang = "10";
//}
//else{
$stoksekarang = $tampilstok2['stock'] - $tampilstok['qty'];
//}

mysqli_query($con, "UPDATE produk set stock = $stoksekarang where id_barang = '$_GET[brg]'");
mysqli_query($con, "DELETE FROM pembelian WHERE no ='$_GET[id]'");

	echo '<script>alert(\'Pembelian Telah Dibatalkan\')
	setTimeout(\'location.href="?modul=pembelian&aksi=tampil"\' ,0);</script>';
	}
break;

//INPUT
case "input":

$potongan = str_replace(",", '', $_POST['potongan']);
$querycek=mysqli_query($con, "SELECT * from produk where id_barang = '$_POST[id_barang]'");
$tampilcek=mysqli_fetch_array($querycek);
$querycekstok=mysqli_query($con, "SELECT stock from produk where id_barang = '$_POST[id_barang]'");
$tampilcekstok=mysqli_fetch_array($querycekstok);
if (empty($_POST['id_barang']) or empty($_POST['qty']))
{
echo '<script>alert(\'GAGAL MENYIMPAN..!!\nSalah Satu Data Pembelian Barang Tidak Terisi .. !! \')
	setTimeout(\'location.href="?modul=pembelian&aksi=tampil"\' ,0);</script>';
}
// elseif (empty($tampilcekstok['stock'])){
// echo '<script>alert(\'Barang Dengan Kode Yang Anda Masukkan Tidak Ada\')
// 	setTimeout(\'location.href="?modul=pembelian&aksi=tampil"\' ,0);</script>';
// }
// elseif ($tampilcekstok['stock']-$_POST['qty']<0){
// echo '<script>alert(\'Stok Barang Tidak Cukup ! ! \nStok Barang Ini '.$tampilcekstok['stock'].'\')
// 	setTimeout(\'location.href="?modul=pembelian&aksi=tampil"\' ,0);</script>';
// }
Else
{
//HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH	
if ($_POST['no_transaksi_sup'] == $cekfkt) {
echo '<script>alert(\'Transaksi Pembelian pada No Transaksi "'.$cekfkt.'" Sudah Dilakukan !!\nTekan OK/Enter Untuk Menuju Transaksi Baru \')
 setTimeout(\'location.href="?modul=pembelian&aksi=baru"\' ,0);</script>';
 }elseif(empty($_POST['supplier'])){
 echo '<script>alert(\'GAGAL..!!! Supplier Belum Diisi !\')
 setTimeout(\'location.href="?modul=pembelian&aksi=baru"\' ,0);</script>';
 }else{	
$db="SELECT harga_beli from produk where id_barang='$_POST[id_barang]'";
$qri=mysqli_query($con, $db);
$row=mysqli_fetch_array($qri);
//if ($_POST['id_barang']=="SRV"){
//$totalharga = $_POST['srv'];
//}else{
$totalharga = $_POST['qty'] * ($row['harga_beli']-$potongan);
//}
$pecahpelanggan = explode("-", $_POST['supplier']);
$pelanggan = $pecahpelanggan[0];
 mysqli_query($con, "INSERT INTO pembelian VALUES(NULL,'$_POST[no_transaksi_sup]','$pelanggan','$_POST[tanggal_transaksi]','$_POST[id_barang]',$potongan,$_POST[qty],$totalharga)");
$cekstok = mysqli_query($con, "SELECT stock from produk where id_barang = '$_POST[id_barang]'");
$tampilstok = mysqli_fetch_array($cekstok);
if ($_POST['id_barang'] == 'SRV'){
$stoksekarang = "10";
}else{
$stoksekarang = $tampilstok['stock'] + $_POST['qty'];
}
mysqli_query($con, "UPDATE produk set stock = $stoksekarang where id_barang = '$_POST[id_barang]'");
echo '<script>setTimeout(\'location.href="?modul=pembelian&aksi=tampil"\' ,0);</script>';
								}
								}

break;

//UPDATE USER
/*case "update":
mysql_query("UPDATE produk SET id_barang='$_POST[id_barang]',
                                brand ='$_POST[brand]',
                                nama_barang='$_POST[nama_barang]',
                               satuan=$_POST[satuan],
			kategori ='$_POST[kategori]',
			stock =$_POST[stock],
			harga_beli =$_POST[harga_beli],
			harga_beli =$_POST[harga_beli]
where id_barang='$_GET[id_barang]'");
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=produk&aksi=tampil"\' ,0);</script>';
break;*/

case "baru";
if ($cekpmb != $cekfkt) {
 echo '<script>setTimeout(\'location.href="?modul=pembelian&aksi=tampil"\' ,0);</script>';
 }else{
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$query=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)+1),9,'0'))) as no from pembelian");
$tampil=mysqli_fetch_array($query);
if (empty($tampil['no'])) {
$auto = "000000001";
}else{
$auto = $tampil['no'];
}
$maks=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)+1),9,'0'))) as no from pembelian");
$tampil=mysqli_fetch_array($maks);
$sql_limit = "SELECT * from pembelian where no_transaksi_sup = 'PMS$tampil[no]'";
$query=mysqli_query($con, $sql_limit);
echo"<h2>Transaksi Pembelian Baru</h2>";
echo"<center>";
echo "<form action='?modul=pembelian&aksi=input' name='postform' method=POST>
<table style='width:900px' id='tabeledit'>
<tr>
	<td>No. Invoice</td>
	<td>: <input size='10' type='hidden' name='no_transaksi_sup' value='PMS$auto' maxlength='30'><b>PMS$auto</b></td>
	<td>Tanggal</td>
	<td>: <input size='10' type='hidden' value='$tglsekarang' name='tanggal_transaksi' maxlength='80'><b>$tglsekarang</b></td>
</tr>
<tr>
	<td>Supplier</td>
	<td colspan='4'>: <input size='35' type='text' name='supplier' id='supplier' /><i><span style='font-size:8pt'> Isi dengan mengetikkan kode supplier, Lalu pilih kode yang muncul</span></i></td>
	
</tr>
</table><br>";
echo"<table id='tabel' style='width:900px; font-size:11px;'>
<tr bgcolor='#009933' style=\"color:#FFFFFF\" align='center' height='25px'>";
echo "<td width='10%'>Kode Barang</td>
<td width='20%'>Nama Barang</td>
<td width='15%'>Harga Beli</td>
<td width='13%'>Qty</td>
<td width='15%'>Total Harga</td>";
$no=1;
$baris=1;
/*
while($tampil=mysql_fetch_array($query)){ 
if($baris%2==0)
{
echo "<tr bgcolor=\"#e4e3e8\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}
echo"<td>$tampil[kode_barang]</td>";
echo"<td>$tampil[qty]</td>";
$tampilrupiah=number_format($tampil['total_harga'],2,',','.');
echo"<td>Rp$tampilrupia</td>";
echo"<td width='5%'><a href=?modul=pembelian&aksi=editpenjualan&no=$tampil[no_transaksi]>Edit</td>";
echo"<td width='5%'><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=pembelian&aksi=hapus&id=$tampil[no]&brg=$tampil[kode_barang]'>Hapus</td>";
$no++;
$baris++;}
echo"</tr>";
*/
echo "
<tr>
<td>";
echo '<input type="text" size="13" name="id_barang" id="id_barang" size="25" onload="tampilkanbarang(id_barang.value)" onclick="tampilkanbarang(id_barang.value)" onkeyup="tampilkanbarang(id_barang.value)" />';
echo "</td>
<td colspan=2><div id='pencarian'></div></td>

<td><input name='potongan' value='0' size='5' type='hidden'/><input name='qty' size='1' value='1' type='text'/><input type='submit' value='enter'>
<script language=\"Javascript\">
document.postform.id_barang.focus()
</script>
</form></td><td><input name='srv' size='5' hidden value='0' type='text'/></td></tr>";
$maks=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)+1),9,'0'))) as no from pembelian");
$tampil=mysqli_fetch_array($maks);
$kuery=mysqli_query($con, "SELECT SUM(total_harga) as total_harga from pembelian where no_transaksi_sup = 'PMS$tampil[no]'");
$tampilkan=mysqli_fetch_array($kuery);
echo"<tr><td colspan = '4'><center><b>Total Yang Harus Di Bayar Adalah</b></center></td><td>Rp".number_format($tampilkan['total_harga'],2,',','.')."</td>";
echo"</table></center>";
echo "<script>
function popup(form) {
setTimeout('location.href=\"?modul=pembelian&aksi=baru\"' ,0);
    window.open('', 'formpopup', 'menubar=yes,scrollbars=yes,resizable=yes,width=800,height=600');
    form.target = 'formpopup';
}
</script>";
$maks=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)+1),9,'0'))) as no from pembelian");
$tampil=mysqli_fetch_array($maks);
echo"<form action='modul/pembelian/faktur.php' target=\"popUp\" onsubmit=\"popup(this);\" method=POST><span style='font-size:20pt'></br>Bayar : <select name='jenisbayar' style='font-size:20pt'><option value='Kontan'>Kontan</option><option value='DP'>Hutang</option></select>Rp</span><input style='font-size:20pt' type='text' name='bayar' onkeyup=\"this.value = numberFormat(this.value);\" maxlength='20'><span style='font-size:20pt'>,00</span></br>
<input size='35' type='hidden' name='supplier' id='supplier' value='$tampilpelanggan6[id_supplier]'/>
<input size='35' type='hidden' name='no_transaksi_sup' id='no_transaksi_sup' value='PMS$tampil[no]'/>
<input size='35' type='hidden' name='level' id='level' value='$_SESSION[level]'/>
Keterangan Pembayaran : <input style='width:400px' maxlength='200' type='text' id='ket' name='ket'/></br></br>
<input type='submit' value='Proses Bayar' style='background-color:#FF3300; color:#fff; line-height:30px;cursor:pointer;border:hidden;'/>
</form>";
//----
}
break;
}
if (isset($_GET['bayar'])){
switch ($_GET['bayar'])
{
//INTERFACE TABLE BROWSER
case "oke";
if ($cekpmb == $cekPMS) {
 echo '<script>alert(\'Gagal Memproses !! \nBarang Yang Beli Belum Di Inputkan\')<script>setTimeout(\'location.href="?modul=pembelian&aksi=baru"\' ,0);</script>';
 }else
 {
$bayar = str_replace(",", '', $_POST['bayar']);
$kuery=mysqli_query($con, "SELECT SUM(total_harga) as total_harga from pembelian where no_transaksi_sup = 'PMS$tampil[no]'");
$tampilkan=mysqli_fetch_array($kuery);
$kembalian = $bayar - $tampilkan['total_harga'];
$sisa= $tampilkan['total_harga'] - $bayar;

$maks=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)),9,'0'))) as no from pembelian");
$tampil=mysqli_fetch_array($maks);
$sql_limit = "SELECT * from pembelian where no_transaksi_sup = 'PMS$tampil[no]'";
$query=mysqli_query($con, $sql_limit);
$tampil=mysqli_fetch_array($query);
if ((substr($kembalian,0,1) == "-") && ($_POST['jenisbayar'] == "Kontan")){
//INPUT CASH
	echo '<script>alert(\'Jumlah Uang Yang Dimasukkan Kurang \nIni Adalah Pembayaran Kontan . . ! ! !\')</script>';
	}
	elseif ((substr($kembalian,0,1) != "-") && ($_POST['jenisbayar'] == "DP")){
	echo '<script>alert(\'Jumlah Uang Yang Dimasukkan Berlebih \nSilahkan Memilih Pembayaran Kontan . . ! ! !\')</script>';
	}
	elseif ($_POST['jenisbayar'] == "DP") {
	$maks2=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)),9,'0'))) as no from pembelian");
$tampiltrans=mysqli_fetch_array($maks2);
$kuery=mysqli_query($con, "SELECT SUM(total_harga) as total_harga from pembelian where no_transaksi_sup = 'PMS$tampiltrans[no]'");
$tampilkan=mysqli_fetch_array($kuery);
$tgl=mysqli_fetch_array(mysqli_query($con, "SELECT DISTINCT tanggal_transaksi from pembelian where no_transaksi_sup = 'PMS$tampiltrans[no]'"));
mysqli_query($con, "INSERT INTO cash_sup VALUES(NULL,'PMS$tampiltrans[no]','$tgl[tanggal_transaksi]','$_SESSION[level]',$tampilkan[total_harga],$bayar,0,$bayar,$sisa,'TIDAK')");
mysqli_query("INSERT INTO cashflow VALUES (NULL,'PMS$tampiltrans[no]','$tgl[tanggal_transaksi]','Pengeluaran',$tampilkan[total_harga],'-')");
$qryhutang	= mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_piutang),9)+1),9,'0')))FROM piutang");
$qryhutang2	= mysqli_query($con, "SELECT MIN(CONCAT(LPAD((RIGHT((no_piutang),9)),9,'0')))FROM piutang");	
$kodehtg= mysqli_fetch_array($qryhutang);
$kodehtg2= mysqli_fetch_array($qryhutang2);
if ($kodehtg2[0]!="000000001"){
$kodeautohtg = "000000001";
}
else{
$kodeautohtg = $kodehtg[0];
}  
mysqly_query($con, "INSERT into piutang_sup values('PIS$kodeautohtg','PMS$tampiltrans[no]','$tgl[tanggal_transaksi]',$tampilkan[total_harga],$bayar,$sisa)");
//END
echo "<body onload='javascript:printPage()'/></body>
<div id='printerDiv' style='display:none'></div>";
echo '<script>
   function printPage()
   {
      var div = document.getElementById("printerDiv");
      div.innerHTML = \'<iframe src="modul/pembelian/faktur.php?no_transaksi_sup='.$tampil['no_transaksi_sup'].'&uang_dibayar='.$bayar.'&uang_kembalian=0&sisa='.$sisa.'&dp='.$bayar.'" onload="this.contentWindow.print();"></iframe>\';
	  
   }
</script>';
echo '<script>alert(\'Sistem Akan Mencetak Faktur Pembayaran. Klik OK / Enter \')
	setTimeout(\'location.href="?modul=pembelian&aksi=tampil"\' ,700);</script>';
}else {
//INPUT CASH
$maks2=mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)),9,'0'))) as no from pembelian");
$tampiltrans=mysqli_fetch_array($maks2);
$kuery=mysqli_query($con, "SELECT SUM(total_harga) as total_harga from pembelian where no_transaksi_sup = 'PMS$tampiltrans[no]'");
$tampilkan=mysqli_fetch_array($kuery);
$tgl=mysqli_fetch_array(mysqli_query($con, "SELECT DISTINCT tanggal_transaksi from pembelian where no_transaksi_sup = 'PMS$tampiltrans[no]'"));
mysqli_query($con, "INSERT INTO cash_sup VALUES(NULL,'PMS$tampiltrans[no]','$tgl[tanggal_transaksi]','$_SESSION[level]',$tampilkan[total_harga],$bayar,$kembalian,0,0,'YA')");
mysqli_query($con, "INSERT INTO cashflow VALUES (NULL,'PMS$tampiltrans[no]','$tgl[tanggal_transaksi]','Pengeluaran',$tampilkan[total_harga],'-')");
//END

echo "<body onload='javascript:printPage()'/> </body>
<div id='printerDiv' style='display:none'></div> ";
echo '<script>
   function printPage()
   {
      var div = document.getElementById("printerDiv");
      div.innerHTML = \'<iframe src="modul/pembelian/faktur.php?no_transaksi_sup='.$tampil['no_transaksi_sup'].'&uang_dibayar='.$bayar.'&uang_kembalian='.$kembalian.'&sisa=0&dp=0" onload="this.contentWindow.print();"></iframe>\';
   }
</script>';
echo '<script>alert(\'Sistem Akan Mencetak Faktur Pembayaran. Klik OK / Enter \')
	setTimeout(\'location.href="?modul=pembelian&aksi=tampil"\' ,500);</script>';
}
} //END Memeriksa Pembayaran

break;

}
}
}

echo '<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>';

?>
