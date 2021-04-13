<html>
<head>
<title>Faktur Pembayaran</title>
<style>
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body style='font-family:arial; font-size:10pt;' onLoad="javascript:window.print()">
<?php
include "../../koneksi/koneksi.php";
//***********************// onload="javascript:window.print()"
$query=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampil=mysqli_fetch_array($query);
$cekpembayaran=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampilpembayaran=mysqli_fetch_array($cekpembayaran);
$cekpmb = "FKT$tampilpembayaran[no]";
$cekfaktur=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_faktur),9)),9,'0'))) as no_faktur from cash");
$tampilfaktur=mysqli_fetch_array($cekfaktur);
$cekfkt = "FKT$tampilfaktur[no_faktur]";
if ($cekpmb == $cekfkt) {
 echo '<script>alert(\'Gagal Memproses !! \nBarang Yang Beli Belum Di Inputkan\')
 setTimeout(\'location.href="?modul=penjualan&aksi=baru"\' ,0);
 window.close();</script>';
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
	echo '<script>alert(\'Jumlah Uang Yang Dimasukkan Kurang \nIni Adalah Pembayaran Kontan . . ! ! !\')
	window.close();</script>';
	}
	elseif ((substr($kembalian,0,1) != "-") && ($_POST['jenisbayar'] == "DP")){
	echo '<script>alert(\'Jumlah Uang Yang Dimasukkan Berlebih \nSilahkan Memilih Pembayaran Kontan . . ! ! !\')
	window.close();</script>';
	}
	elseif ($_POST['jenisbayar'] == "DP") {
	$maks2=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampiltrans=mysqli_fetch_array($maks2);
$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from penjualan where no_transaksi = 'FKT$tampiltrans[no]'");
$tampilkan=mysqli_fetch_array($kuery);
$tgl=mysqli_fetch_array(mysqli_query($con, "select DISTINCT tanggal_transaksi from penjualan where no_transaksi = 'FKT$tampiltrans[no]'"));
mysqli_query($con, "INSERT INTO cash VALUES(NULL,'FKT$tampiltrans[no]','$tgl[tanggal_transaksi]','$_POST[level]',$tampilkan[total_harga],0,0,$bayar,$sisa,'TIDAK','$_POST[ket]')");
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
}else {
//INPUT CASH
$maks2=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampiltrans=mysqli_fetch_array($maks2);
$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from penjualan where no_transaksi = 'FKT$tampiltrans[no]'");
$tampilkan=mysqli_fetch_array($kuery);
$tgl=mysqli_fetch_array(mysqli_query($con, "select DISTINCT tanggal_transaksi from penjualan where no_transaksi = 'FKT$tampiltrans[no]'"));
mysqli_query($con, "INSERT INTO cash VALUES(NULL,'FKT$tampiltrans[no]','$tgl[tanggal_transaksi]','$_POST[level]',$tampilkan[total_harga],$bayar,$kembalian,0,0,'YA','$_POST[ket]')");
mysqli_query($con, "INSERT INTO cashflow VALUES (NULL,'FKT$tampiltrans[no]','$tgl[tanggal_transaksi]','Pemasukan',$tampilkan[total_harga],'-')");
}
}
//************************************//
$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tmpmaks=mysqli_fetch_array($maks);
$sql_limit = "select * from penjualan,produk where penjualan.kode_barang = produk.id_barang and penjualan.no_transaksi = 'FKT$tmpmaks[no]'";
$query=mysqli_query($con, $sql_limit);
$row = mysqli_fetch_array(mysqli_query($con, "select tanggal_transaksi from penjualan where no_transaksi = 'FKT$tmpmaks[no]'"));
$row2 = mysqli_fetch_array(mysqli_query($con, "select nama_pelanggan from penjualan,pelanggan where penjualan.id_pelanggan = pelanggan.id_pelanggan and penjualan.no_transaksi = 'FKT$tmpmaks[no]'"));
$pecah = explode("-",$row['tanggal_transaksi']);
$bln= $pecah[1];
$thn= $pecah[0];
$tgl= $pecah[2];
switch($bln){
case '01':
$bulan = 'Januari';
break;
case '02':
$bulan = 'Februari';
break;
case '03':
$bulan = 'Maret';
break;
case '04':
$bulan = 'April';
break;
case '05':
$bulan = 'Mei';
break;
case '06':
$bulan = 'Juni';
break;
case '07':
$bulan = 'Juli';
break;
case '08':
$bulan = 'Agustus';
break;
case '09':
$bulan = 'September';
break;
case '10':
$bulan = 'Oktober';
break;
case '11':
$bulan = 'November';
break;
case '12':
$bulan = 'Desember';
break;
}
echo"<center>
<b>CV Nama CV, Alamat CV CV Nama CV, Alamat CV CV Nama CV, Alamat CV </br>
CV Nama CV, Alamat CV CV Nama CV, Alamat CV CV Nama CV, Alamat CV CV Nama CV, Alamat CV<b>
<table style='width:700px; font-size:10pt; font-family:arial' border = '0'>
<tr><td align='left' style='padding-left:500px'>Tanggal, $tgl $bulan $thn</td></tr>
</table>
<h3>Invoice</h3>
<table style='width:700px; font-size:10pt; font-family:arial' border = '0'>
<tr><td align='left' style='padding-left:500px'>Kepada Yth, </br>$row2[nama_pelanggan]</td></tr>
<tr><td align='left'>No Invoice: FKT$tmpmaks[no]</td></tr>
</table>
<table id='tabel' style='width:700px; font-size:10pt;' border='1'>
<tr align='center'>
<td width='10%'>Kode Barang</td>
<td width='20%'>Nama Barang</td>
<td width='13%'>Harga</td>
<td width='4%'>Qty</td>
<td width='7%'>Discount</td>
<td width='13%'>Total Harga</td>";
$no=1;
$baris=1;
while($tampil=mysqli_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[kode_barang]</td>";
echo"<td>$tampil[nama_barang]</td>";
echo"<td>Rp".number_format($tampil['harga_jual'],2,',','.')."</td>";
echo"<td>$tampil[qty]</td>";
echo"<td>Rp".number_format($tampil['potongan'],2,',','.')."</td>";
$tampilrupiah=number_format($tampil['total_harga'],2,',','.');
echo"<td style='text-align:right'>Rp$tampilrupiah</td>";
}
echo"</tr>";
$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi),9)),9,'0'))) as no from penjualan");
$tampil=mysqli_fetch_array($maks);
$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from penjualan where no_transaksi = 'FKT$tampil[no]'");
$tampilkan=mysqli_fetch_array($kuery);
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Total Yang Harus Di Bayar Adalah : </b></div></td><td style='text-align:right'>Rp".number_format($tampilkan['total_harga'],2,',','.')."</td></tr>";
echo "<tr><td colspan = '6'><div style='text-align:right'><b>Terbilang :</b>".ucwords(Terbilang($tampilkan['total_harga']))." Rupiah</div></td></tr>";
if ($_POST['jenisbayar'] == "DP"){
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Cash : </b></div></td><td style='text-align:right'>Rp0,00</td></tr>";
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Kembalian : </b></div></td><td style='text-align:right'>Rp0,00</td></tr>";
}else{
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Cash : </b></div></td><td style='text-align:right'>Rp".number_format($bayar,2,',','.')."</td></tr>";
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Kembalian : </b></div></td><td style='text-align:right'>Rp".number_format($kembalian,2,',','.')."</td></tr>";
}
if ($_POST['jenisbayar'] == "DP"){
$dp = $bayar;
}else{
$dp = 0;
}
echo"<tr><td colspan = '5'><div style='text-align:right'><b>DP : </b></div></td><td style='text-align:right'>Rp".number_format($dp,2,',','.')."</td></tr>";
if ($_POST['jenisbayar'] == "DP"){
$wewsisa = $sisa;
}else{
$wewsisa = 0;
}
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Sisa : </b></div></td><td style='text-align:right'>Rp".number_format($wewsisa,2,',','.')."</td></tr>";
//echo"<tr><td colspan = '5'><div style='text-align:right'><b>Cash : </b></div></td><td style='text-align:right'>Rp".number_format($bayar,2,',','.')."</td></tr>";
//echo"<tr><td colspan = '5'><div style='text-align:right'><b>Kembalian : </b></div></td><td style='text-align:right'>Rp".number_format($kembalian,2,',','.')."</td></tr>";
/*if ($_POST['jenisbayar'] == "DP"){
$dp = $bayar;
}else{
$dp = 0;
}*/
//echo"<tr><td colspan = '5'><div style='text-align:right'><b>DP : </b></div></td><td style='text-align:right'>Rp".number_format($dp,2,',','.')."</td></tr>";
$sqlket = mysqli_fetch_array(mysqli_query($con, "select * from cash where no_faktur = 'FKT$tampil[no]'"));
//echo"<tr><td colspan = '5'><div style='text-align:right'><b>Sisa : </b></div></td><td style='text-align:right'>Rp".number_format($sisa,2,',','.')."</td></tr>";
echo"</table></center></br>";
echo"<center><table style='width:700px; font-size:10pt;'>";
$kuery2=mysqli_query($con, "select kasir from cash where no_faktur = 'FKT$tmpmaks[no]'");
$tampilkan2=mysqli_fetch_array($kuery2);
echo"<tr><td align='center'>Diterima Oleh,</br></br></br></br><u>(_____________)</u></td>
<td style='border:1px solid black; -moz-border-radius : 10px;
    -webkit-border-radius : 10px;
	 -webkit-box-shadow: 3px 2px 6px rgba(0,0,0,0.0);
  -moz-box-shadow: 3px 2px 6px rgba(0,0,0,0.7);
  box-shadow: 3px 2px 10px rgba(0,0,0,0.7); background: #fcfcfc; 
 background: linear-gradient(#fcfcfc, #bfc2de); padding:5px; text-align:left; width:30%'><i>$sqlket[ket]</i></td>
<td align='center'>TTD,</br></br></br></br><u>(________________)</u></td></tr>";
echo"</table></center>
</body>";
function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}
?>

</html>