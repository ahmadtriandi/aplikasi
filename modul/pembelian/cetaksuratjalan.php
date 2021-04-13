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
<body style='font-family:arial; font-size:10pt;' onload="javascript:window.print()">
<?php
include "../../koneksi/koneksi.php";
//***********************//


$sql_limit = "SELECT * from penjualan where no_transaksi = '$_GET[no_faktur]'";
$query=mysqli_query($con, $sql_limit);
$tampil=mysqli_fetch_array($query);


//************************************//
$sql_limit = "SELECT* from penjualan,produk where penjualan.kode_barang = produk.id_barang and penjualan.no_transaksi = '$_GET[no_faktur]'";
$query=mysqli_query($con, $sql_limit);
$row = mysqli_fetch_array(mysqli_query($con, "SELECT tanggal_transaksi from penjualan where no_transaksi = '$_GET[no_faktur]'"));
$row2 = mysqli_fetch_array(mysqli_query($con, "SELECT nama_pelanggan from penjualan,pelanggan where penjualan.id_pelanggan = pelanggan.id_pelanggan and penjualan.no_transaksi = '$_GET[no_faktur]'"));
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
<table style='width:700px; font-size:10pt; font-family:arial' border = '0'>
<tr><td align='left' style='padding-left:500px'>Tanggal, $tgl $bulan $thn</td></tr>
</table>
<h3>Surat Jalan</h3>
<table style='width:700px; font-size:10pt; font-family:arial' border = '0'>
<tr><td align='left' style='padding-left:500px'>Kepada Yth, </br>$row2[nama_pelanggan]</td></tr>
<tr><td align='left'>No Invoice: $_GET[no_faktur]</td></tr>
</table>
<table id='tabel' style='width:700px; font-size:10pt;' border='1'>
<tr align='center'>
<td width='10%'>Kode Barang</td>
<td width='4%'>Qty</td>
<td width='20%'>Nama Barang</td>
";
$no=1;
$baris=1;
while($tampil=mysqli_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[kode_barang]</td>";
echo"<td align='right'>$tampil[qty]</td>";
echo"<td align='center'>$tampil[nama_barang]</td>";
}
$sqlket = mysqli_fetch_array(mysqli_query($con, "SELECT * from cash where no_faktur = '$_GET[no_faktur]'"));
echo"</tr>";
echo"</table></center></br>";
echo"<center><table style='width:700px; font-size:10pt;'>";
$kuery2=mysqli_query($con, "SELECT kasir from cash where no_faktur = '$_GET[no_faktur]'");
$tampilkan2=mysqli_fetch_array($kuery2);
echo"<tr><td align='center'>Diterima Oleh,</br></br></br></br><u>(_____________)</u></td>
<td style='border:1px solid black; -moz-border-radius : 10px;
    -webkit-border-radius : 10px;
	 -webkit-box-shadow: 3px 2px 6px rgba(0,0,0,0.0);
  -moz-box-shadow: 3px 2px 6px rgba(0,0,0,0.7);
  box-shadow: 3px 2px 10px rgba(0,0,0,0.7); background: #fcfcfc; 
 background: linear-gradient(#fcfcfc, #bfc2de); padding:5px; text-align:left; width:30%'><i>$sqlket[ket]</i></td>
<td align='center'>TTD,</br></br></br></br><u>(_______________)</u></td></tr>";
echo"</table></center>
</body>";
?>

</html>