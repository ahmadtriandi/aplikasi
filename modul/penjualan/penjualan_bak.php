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
}
else{
	$cekpembayaran=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
	$tampilpembayaran=mysqli_fetch_array($cekpembayaran);
	$cekpmb = "FKT$tampilpembayaran[no]";
	$cekfaktur=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_faktur),9)),9,'0'))) as no_faktur from cash");
	$tampilfaktur=mysqli_fetch_array($cekfaktur);
	$cekfkt = "FKT$tampilfaktur[no_faktur]";

	$query5=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
	$tampil5=mysqli_fetch_array($query5);
	if (empty($tampil5['no'])) {
		$auto = "000000001";
	}else{
		$auto = $tampil5['no'];
	}
	$maks5=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
	$tampil6=mysqli_fetch_array($maks5);
	$sql_limit5 = "select * from penjualan,produk where penjualan.kode_barang = produk.id_barang and penjualan.no_transaksi = 'FKT$tampil6[no]' order by no ASC";
	$query6=mysqli_query($con, $sql_limit5);
	$tampilpelanggan5 = mysqli_query($con, "select DISTINCT penjualan.id_pelanggan,pelanggan.nama_pelanggan from penjualan,pelanggan where pelanggan.id_pelanggan = penjualan.id_pelanggan and penjualan.no_transaksi = 'FKT$tampil6[no]'");
	$tampilpelanggan6=mysqli_fetch_array($tampilpelanggan5);

	switch ($_GET['aksi'])
	{
//memeriksa pembayaran (jika sudah dilakukan maka akan masuk ke transaksi baru)
//endmemeriksa
//INTERFACE TABLE BROWSER
		case "tampil";
/* memeriksa pembayaran (jika sudah dilakukan maka akan masuk ke transaksi baru)
$cekpembayaran=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampilpembayaran=mysqli_fetch_array($cekpembayaran);
$cekpmb = "FKT$tampilpembayaran[no]";
$cekfaktur=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_faktur),9)),9,'0'))) as no_faktur from cash");
$tampilfaktur=mysqli_fetch_array($cekfaktur);
$cekfkt = "FKT$tampilfaktur[no_faktur]";
*/
		if ($cekpmb == $cekfkt) {
			 echo '<script>setTimeout(\'location.href="?modul=penjualan&aksi=baru"\' ,0);</script>';
 		}else{

			date_default_timezone_set('Asia/Jakarta');
			$tanggal= mktime(date("m"),date("d"),date("Y"));
			$tglsekarang = date("Y-m-d", $tanggal);
			$query=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
			$tampil=mysqli_fetch_array($query);
			if (empty($tampil['no'])) {
				$auto = "000000001";
				echo '<script>setTimeout(\'location.href="?modul=penjualan&aksi=baru"\' ,0);</script>';
			}else{
				$auto = $tampil['no'];
			}
			$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
			$tampil=mysqli_fetch_array($maks);
			$sql_limit = "select * from penjualan,produk where penjualan.kode_barang = produk.id_barang and penjualan.no_transaksi = 'FKT$tampil[no]' order by no ASC";
			$query=mysqli_query($con, $sql_limit);
			$tampilpelanggan = mysqli_query($con, "select DISTINCT penjualan.id_pelanggan,pelanggan.nama_pelanggan from penjualan,pelanggan where pelanggan.id_pelanggan = penjualan.id_pelanggan and penjualan.no_transaksi = 'FKT$tampil[no]'");
			$tampilpelanggan2=mysqli_fetch_array($tampilpelanggan);
			?>

			<h2>Data Transaksi Penjualan Terakhir</h2>
			<!-- <input type='submit' value='Transaksi Baru' onclick='location.href=\"index.php?modul=penjualan&aksi=baru\"'/></br></br> -->
			<center><form action='?modul=penjualan&aksi=input' name='postform' method=POST>
			<table style='width:900px' id='tabeledit'>
			<tr>
				<td>No Invoice</td>
				<td>: <input size='10' type='hidden' name='no_transaksi' value='FKT<?=$auto; ?>' maxlength='30'><b>FKT<?=$auto; ?></b></td>
				<td>Tanggal</td>
				<td>: <input size='10' type='hidden' value='<?=$tglsekarang; ?>' name='tanggal_transaksi' maxlength='80'><b><?=$tglsekarang; ?></b></td>
			</tr>
			<tr>
				<td>Pelanggan</td>
				<td>: <input size='35' type='hidden' name='pelanggan' id='pelanggan' value='<?=$tampilpelanggan2[id_pelanggan]?>-<?=$tampilpelanggan2[nama_pelanggan]; ?>'/><b><?=$tampilpelanggan2[id_pelanggan];?>-<?=$tampilpelanggan2[nama_pelanggan]; ?></b></td>
				<td></td>
				<td></td>
			</tr>
			</table><br>
	

			<table id='tabel' style='width:900px; font-size:11px'>
			<tr bgcolor='#663399' style=\"color:#FFFFFF\" align='center' height='25px'>
			<td width='10%'>Kode Barang</td>
			<td width='20%'>Nama Barang</td>
			<td width='15%'>Harga Jual</td>
			<td width='5%'>Potongan</td>
			<td width='13%'>Qty</td>

			<td width='15%'>Total Harga</td>
			<td width='3%'>Batal</td>

			<?php
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
				?>
				<td><?=$tampil[kode_barang] ?></td>
				<td><?=$tampil[nama_barang] ?></td>
				<td>Rp.<?=number_format($tampil['harga_jual'],2,',','.')?>.</td>

				<td>Rp.<?=number_format($tampil['potongan'],2,',','.')?>.</td>
				<td><?=$tampil[qty] ?></td>

				<?php
				$tampilrupiah=number_format($tampil['total_harga'],2,',','.');
//if($tampil['kode_barang']=="SRV"){
//echo"<td>Rp$tampilrupiah</td>";
//}else{
//echo"<td>-</td>";
//}
				echo"<td>Rp$tampilrupiah</td>";
				echo"<td width='5%' align='center'><a onclick=\"return confirm('Anda Yakin Membatalkan Pembelian $tampil[nama_barang]?')\" href='?modul=penjualan&aksi=hapus&id=$tampil[no]&brg=$tampil[kode_barang]'><img src='images/delete128px.png' width='24px' title='Batal'></td>";
				$no++;
				$baris++;}
				echo"</tr>";
				echo "
				<tr>
				<td>";
				echo '<input type="text" size="13" name="id_barang" id="id_barang" size="25" onload="bukutamu(id_barang.value)" onclick="bukutamu(id_barang.value)" onkeyup="bukutamu(id_barang.value)" />';
				echo "</td>
				<td colspan=2><div id='pencarian'></div></td>
				<td><input name='potongan' onkeyup=\"this.value = numberFormat(this.value);\" value='0' size='5' type='text'/>
				<td><input name='qty' value='1' size='1' type='text'/><input type='submit' value='enter'>
				<script language=\"Javascript\">
				document.postform.id_barang.focus()
				</script>
				</form></td></td><td><input name='srv' size='5' hidden value='0' type='text'/></td></tr>";
				$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
				$tampil=mysqli_fetch_array($maks);
				$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from penjualan where no_transaksi = 'FKT$tampil[no]'");
				$tampilkan=mysqli_fetch_array($kuery);
				echo"<tr><td colspan = '5'><center><b>Total Yang Harus Di Bayar Adalah</b></center></td><td>Rp".number_format($tampilkan['total_harga'],2,',','.')."</td>";
				echo"</table></center><br>";
				echo "<script>
				function popup(form) {
				setTimeout('location.href=\"?modul=penjualan&aksi=baru\"' ,0);
					window.open('', 'formpopup', 'menubar=yes,scrollbars=yes,resizable=yes,width=800,height=600');
					form.target = 'formpopup';
				}
				</script>";
				$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)+1),9,'0'))) as no from penjualan");
				$tampil=mysqli_fetch_array($maks);
				echo"<form action='modul/penjualan/faktur.php' target=\"popUp\" onsubmit=\"popup(this);\" method=POST><span style='font-size:20pt'>Bayar : <select name='jenisbayar' style='font-size:20pt'><option value='Kontan'>Kontan</option><option value='DP'>DP</option></select>Rp</span><input style='font-size:20pt' type='text' name='bayar' onkeyup=\"this.value = numberFormat(this.value);\" maxlength='20'><span style='font-size:20pt'>,00</span></br>
				<input size='35' type='hidden' name='pelanggan' id='pelanggan' value='$tampilpelanggan6[id_pelanggan]'/>
				<input size='35' type='hidden' name='no_transaksi' id='no_transaksi' value='FKT$tampil[no]'/>
				<input size='35' type='hidden' name='level' id='level' value='$_SESSION[level]'/>
				Keterangan Pembayaran : <input style='width:400px' maxlength='200' type='text' id='ket' name='ket'/></br><br>
				<input type='submit' value='Proses Bayar'/ style='background-color:#FF3300; color:#fff; line-height:30px;cursor:pointer;border:hidden;'/></form>";
}
break;

//HAPUS
case "hapus":
/*memeriksa pembayaran (jika sudah dilakukan maka akan masuk ke transaksi baru)
$cekpembayaran=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampilpembayaran=mysqli_fetch_array($cekpembayaran);
$cekpmb = "FKT$tampilpembayaran[no]";
$cekfaktur=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_faktur),9)),9,'0'))) as no_faktur from cash");
$tampilfaktur=mysqli_fetch_array($cekfaktur);
$cekfkt = "FKT$tampilfaktur[no_faktur]";
*/
if ($cekpmb == $cekfkt){
 echo '<script>alert(\'Transaksi Pembayaran pada No Transaksi "'.$cekfkt.'" Sudah Dilakukan !!\nTekan OK/Enter Untuk Menuju Transaksi Baru \')
 setTimeout(\'location.href="?modul=penjualan&aksi=baru"\' ,0);</script>';
 }else{
$cekstok = mysqli_query($con, "select qty from penjualan where no = '$_GET[id]'");
$tampilstok = mysqli_fetch_array($cekstok);
$cekstok2 = mysqli_query($con, "select stock from produk where id_barang = '$_GET[brg]'");
$tampilstok2 = mysqli_fetch_array($cekstok2);
//if ($_GET['brg']=="SRV"){
//$stoksekarang = "10";
//}
//else{
$stoksekarang = $tampilstok['qty'] + $tampilstok2['stock'];
//}

mysqli_query($con, "update produk set stock = $stoksekarang where id_barang = '$_GET[brg]'");
mysqli_query($con, "DELETE FROM penjualan WHERE no ='$_GET[id]'");

	echo '<script>alert(\'Pembelian Telah Dibatalkan\')
	setTimeout(\'location.href="?modul=penjualan&aksi=tampil"\' ,0);</script>';
	}
break;

//INPUT
case "input":

$potongan = str_replace(",", '', $_POST['potongan']);
$querycek=mysqli_query($con, "select * from produk where id_barang = '$_POST[id_barang]'");
$tampilcek=mysqli_fetch_array($querycek);
$querycekstok=mysqli_query($con, "select stock from produk where id_barang = '$_POST[id_barang]'");
$tampilcekstok=mysqli_fetch_array($querycekstok);
if (empty($_POST['id_barang']) or empty($_POST['qty']))
{
echo '<script>alert(\'GAGAL MENYIMPAN..!!\nSalah Satu Data Pembelian Barang Tidak Terisi .. !! \')
	setTimeout(\'location.href="?modul=penjualan&aksi=tampil"\' ,0);</script>';
}
elseif (empty($tampilcekstok['stock'])){
echo '<script>alert(\'Barang Dengan Kode Yang Anda Masukkan Tidak Ada\')
	setTimeout(\'location.href="?modul=penjualan&aksi=tampil"\' ,0);</script>';
}
elseif ($tampilcekstok['stock']-$_POST['qty']<0){
echo '<script>alert(\'Stok Barang Tidak Cukup ! ! \nStok Barang Ini '.$tampilcekstok['stock'].'\')
	setTimeout(\'location.href="?modul=penjualan&aksi=tampil"\' ,0);</script>';
}
Else
{	
if ($_POST['no_transaksi'] == $cekfkt) {
echo '<script>alert(\'Transaksi Pembayaran pada No Transaksi "'.$cekfkt.'" Sudah Dilakukan !!\nTekan OK/Enter Untuk Menuju Transaksi Baru \')
 setTimeout(\'location.href="?modul=penjualan&aksi=baru"\' ,0);</script>';
 }else{	
$db="select harga_jual from produk where id_barang='$_POST[id_barang]'";
$qri=mysqli_query($con, $db);
$row=mysqli_fetch_array($qri);
//if ($_POST['id_barang']=="SRV"){
//$totalharga = $_POST['srv'];
//}else{
$totalharga = $_POST['qty'] * ($row['harga_jual']-$potongan);
//}
$pecahpelanggan = explode("-", $_POST['pelanggan']);
$pelanggan = $pecahpelanggan[0];
 mysqli_query($con, "INSERT INTO penjualan VALUES(NULL,'$_POST[no_transaksi]','$pelanggan','$_POST[tanggal_transaksi]','$_POST[id_barang]',$potongan,$_POST[qty],$totalharga)");
$cekstok = mysqli_query($con, "select stock from produk where id_barang = '$_POST[id_barang]'");
$tampilstok = mysqli_fetch_array($cekstok);
if ($_POST['id_barang'] == 'SRV'){
$stoksekarang = "10";
}else{
$stoksekarang = $tampilstok['stock'] - $_POST['qty'];
}
mysqli_query($con, "update produk set stock = $stoksekarang where id_barang = '$_POST[id_barang]'");
echo '<script>setTimeout(\'location.href="?modul=penjualan&aksi=tampil"\' ,0);</script>';
								}
								}

break;

//UPDATE USER
case "update":
mysqli_query($con, "UPDATE produk SET id_barang='$_POST[id_barang]',
                                brand ='$_POST[brand]',
                                nama_barang='$_POST[nama_barang]',
                               satuan=$_POST[satuan],
			kategori ='$_POST[kategori]',
			stock =$_POST[stock],
			harga_beli =$_POST[harga_beli],
			harga_jual =$_POST[harga_jual]
where id_barang='$_GET[id_barang]'");
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=produk&aksi=tampil"\' ,0);</script>';
break;

case "baru";
//----
if ($cekpmb != $cekfkt) {
 echo '<script>setTimeout(\'location.href="?modul=penjualan&aksi=tampil"\' ,0);</script>';
 }else{
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$query=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)+1),9,'0'))) as no from penjualan");
$tampil=mysqli_fetch_array($query);
if (empty($tampil['no'])) {
$auto = "000000001";
}else{
$auto = $tampil['no'];
}
$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)+1),9,'0'))) as no from penjualan");
$tampil=mysqli_fetch_array($maks);
$sql_limit = "select * from penjualan where no_transaksi = 'FKT$tampil[no]'";
var_dump($sql_limit);
$query=mysqli_query($con, $sql_limit);
echo"<h2>Transaksi Penjualan Baru</h2>";
echo"<center>";
echo "<form action='?modul=penjualan&aksi=input' name='postform' method=POST>
<table style='width:900px' id='tabeledit'>
<tr>
	<td>No Invoice</td>
	<td>: <input size='10' type='hidden' name='no_transaksi' value='FKT$auto' maxlength='30'><b>FKT$auto</b></td>
	<td>Tanggal</td>
	<td>: <input size='10' type='hidden' value='$tglsekarang' name='tanggal_transaksi' maxlength='80'><b>$tglsekarang</b></td>
</tr>
<tr>
	<td>Pelanggan</td>
	<td>: <input size='35' type='text' name='pelanggan' id='pelanggan' value='CS0001-Pelanggan'/></td>
	<td></td>
	<td></td>
</tr>
</table><br>";
echo"<table id='tabel' style='width:900px; font-size:11px;'>
<tr  bgcolor='#663399' style=\"color:#FFFFFF\" align='center' height='25px'>";
echo "<td width='10%'>Kode Barang</td>
<td width='20%'>Nama Barang</td>
<td width='15%'>Harga Jual</td>
<td width='5%'>Potongan</td>
<td width='13%'>Qty</td>
<td width='15%'>Total Harga</td>";
$no=1;
$baris=1;
// while($tampil=mysqli_fetch_array($query)){ 
// if($baris%2==0)
// {
// echo "<tr bgcolor=\"#e4e3e8\">"; 
// }
// else 
// {
// echo "<tr bgcolor=\"#FFFFFF\">"; 
// }
// echo"<td>$tampil[kode_barang]</td>";
// echo"<td>$tampil[qty]</td>";
// $tampilrupiah=number_format($tampil['total_harga'],2,',','.');
// echo"<td>Rp$tampilrupiah</td>";
// echo"<td width='5%'><a href=?modul=penjualan&aksi=editpenjualan&no=$tampil[no_transaksi]>Edit</td>";
// echo"<td width='5%'><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=penjualan&aksi=hapus&id=$tampil[no]&brg=$tampil[kode_barang]'>Hapus</td>";
// $no++;
// $baris++;}
// echo"</tr>";
echo "
<tr>
<td>";
echo '<input type="text" size="13" name="id_barang" id="id_barang" size="25" onload="bukutamu(id_barang.value)" onclick="bukutamu(id_barang.value)" onkeyup="bukutamu(id_barang.value)" />';
echo "</td>
<td ></td>
<td><input name='hargaJual' value='0' size='5' type='text'/>
<td><input name='potongan' value='0' size='5' type='text'/>
<td><input name='qty' size='1' value='1' type='text'/><input type='submit' value='enter'>
<script language=\"Javascript\">
document.postform.id_barang.focus()
</script>
</form></td><td><input name='srv' size='5' hidden value='0' type='text'/></td></tr>";
$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)+1),9,'0'))) as no from penjualan");
$tampil=mysqli_fetch_array($maks);
$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from penjualan where no_transaksi = 'FKT$tampil[no]'");
$tampilkan=mysqli_fetch_array($kuery);
echo"<tr><td colspan = '5'><center><b>Total Yang Harus Di Bayar Adalah</b></center></td><td>Rp".number_format($tampilkan['total_harga'],2,',','.')."</td>";
echo"</table></center>";
echo "<script>
function popup(form) {
setTimeout('location.href=\"?modul=penjualan&aksi=baru\"' ,0);
    window.open('', 'formpopup', 'menubar=yes,scrollbars=yes,resizable=yes,width=800,height=600');
    form.target = 'formpopup';
}
</script>";
$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)+1),9,'0'))) as no from penjualan");
$tampil=mysqli_fetch_array($maks);
echo"<form action='modul/penjualan/faktur.php' target=\"popUp\" onsubmit=\"popup(this);\" method=POST><span style='font-size:20pt'></br>Bayar : <select name='jenisbayar' style='font-size:20pt'><option value='Kontan'>Kontan</option><option value='DP'>DP</option></select>Rp</span><input style='font-size:20pt' type='text' name='bayar' onkeyup=\"this.value = numberFormat(this.value);\" maxlength='20'><span style='font-size:20pt'>,00</span></br>
<input size='35' type='hidden' name='pelanggan' id='pelanggan' value='$tampilpelanggan6[id_pelanggan]'/>
<input size='35' type='hidden' name='no_transaksi' id='no_transaksi' value='FKT$tampil[no]'/>
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
if ($cekpmb == $cekfkt) {
 echo '<script>alert(\'Gagal Memproses !! \nBarang Yang Beli Belum Di Inputkan\')<script>setTimeout(\'location.href="?modul=penjualan&aksi=baru"\' ,0);</script>';
 }else
 {
$bayar = str_replace(",", '', $_POST['bayar']);
$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from penjualan where no_transaksi = 'FKT$tampil[no]'");
$tampilkan=mysqli_fetch_array($kuery);
$kembalian = $bayar - $tampilkan['total_harga'];
$sisa= $tampilkan['total_harga'] - $bayar;

$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampil=mysqli_fetch_array($maks);
$sql_limit = "select * from penjualan where no_transaksi = 'FKT$tampil[no]'";
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
	$maks2=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampiltrans=mysqli_fetch_array($maks2);
$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from penjualan where no_transaksi = 'FKT$tampiltrans[no]'");
$tampilkan=mysqli_fetch_array($kuery);
$tgl=mysqli_fetch_array(mysqli_query($con, "select DISTINCT tanggal_transaksi from penjualan where no_transaksi = 'FKT$tampiltrans[no]'"));
mysqli_query($con, "INSERT INTO cash VALUES(NULL,'FKT$tampiltrans[no]','$tgl[tanggal_transaksi]','$_SESSION[level]',$tampilkan[total_harga],$bayar,0,$bayar,$sisa,'TIDAK')");
mysqli_query($con, "INSERT INTO cashflow VALUES (NULL,'FKT$tampiltrans[no]','$tgl[tanggal_transaksi]','Pemasukan',$tampilkan[total_harga],'-')");
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
mysqli_query($con, "insert into piutang values('PIU$kodeautohtg','FKT$tampiltrans[no]','$tgl[tanggal_transaksi]',$tampilkan[total_harga],$bayar,$sisa)");
//END
echo "<body onload='javascript:printPage()'/></body>
<div id='printerDiv' style='display:none'></div>";
echo '<script>
   function printPage()
   {
      var div = document.getElementById("printerDiv");
      div.innerHTML = \'<iframe src="modul/penjualan/faktur.php?no_transaksi='.$tampil['no_transaksi'].'&uang_dibayar='.$bayar.'&uang_kembalian=0&sisa='.$sisa.'&dp='.$bayar.'" onload="this.contentWindow.print();"></iframe>\';
	  
   }
</script>';
echo '<script>alert(\'Sistem Akan Mencetak Faktur Pembayaran. Klik OK / Enter \')
	setTimeout(\'location.href="?modul=penjualan&aksi=tampil"\' ,700);</script>';
}else {
//INPUT CASH
$maks2=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampiltrans=mysqli_fetch_array($maks2);
$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from penjualan where no_transaksi = 'FKT$tampiltrans[no]'");
$tampilkan=mysqli_fetch_array($kuery);
$tgl=mysqli_fetch_array(mysqli_query($con, "select DISTINCT tanggal_transaksi from penjualan where no_transaksi = 'FKT$tampiltrans[no]'"));
mysqli_query($con, "INSERT INTO cash VALUES(NULL,'FKT$tampiltrans[no]','$tgl[tanggal_transaksi]','$_SESSION[level]',$tampilkan[total_harga],$bayar,$kembalian,0,0,'YA')");
mysqli_query($con, "INSERT INTO cashflow VALUES (NULL,'FKT$tampiltrans[no]','$tgl[tanggal_transaksi]','Pemasukan',$tampilkan[total_harga],'-')");
//END

echo "<body onload='javascript:printPage()'/> </body>
<div id='printerDiv' style='display:none'></div> ";
echo '<script>
   function printPage()
   {
      var div = document.getElementById("printerDiv");
      div.innerHTML = \'<iframe src="modul/penjualan/faktur.php?no_transaksi='.$tampil['no_transaksi'].'&uang_dibayar='.$bayar.'&uang_kembalian='.$kembalian.'&sisa=0&dp=0" onload="this.contentWindow.print();"></iframe>\';
   }
</script>';
echo '<script>alert(\'Sistem Akan Mencetak Faktur Pembayaran. Klik OK / Enter \')
	setTimeout(\'location.href="?modul=penjualan&aksi=tampil"\' ,500);</script>';
}
} //END Memeriksa Pembayaran

break;

}
}
}

echo '<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>';

?>
