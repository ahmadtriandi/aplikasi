<html>
<head>
<title>Retur Pembayaran</title>
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


$sql_limit = "select * from penjualan where no_transaksi = '$_GET[no_faktur]'";
$query=mysqli_query($con, $sql_limit);
$tampil=mysqli_fetch_array($query);


//************************************//
$sql_limit = "select * from penjualan,produk where penjualan.kode_barang = produk.id_barang and penjualan.no_transaksi = '$_GET[no_faktur]'";
$query=mysqli_query($con, $sql_limit);
$row = mysqli_fetch_array(mysqli_query($con, "select tanggal_transaksi from penjualan where no_transaksi = '$_GET[no_faktur]'"));
$row2 = mysqli_fetch_array(mysqli_query($con, "select nama_pelanggan from penjualan,pelanggan where penjualan.id_pelanggan = pelanggan.id_pelanggan and penjualan.no_transaksi = '$_GET[no_faktur]'"));
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
<b>CV Anugerah Jaya 07 Mandiri, Perumahan Griya Aji Pesona Blok B1.No.12A Desa Getasan </br>
Blok Makam Dawa Rt./rw 02 Kec. Depok Kab. Cirebon. Hp. 085316228038 / 087728726461<b>
<table style='width:700px; font-size:10pt; font-family:arial' border = '0'>
<tr><td align='left' style='padding-left:500px'>Tanggal, $tgl $bulan $thn</td></tr>
</table>
<h3>Invoice Retur Barang</h3>
<table style='width:700px; font-size:10pt; font-family:arial' border = '0'>
<tr><td align='left' style='padding-left:500px'>Kepada Yth, </br>$row2[nama_pelanggan]</td></tr>
<tr><td align='left'>No Invoice: $_GET[no_faktur]</td></tr>
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
$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from penjualan where no_transaksi = '$_GET[no_faktur]'");
$tampilkan=mysqli_fetch_array($kuery);
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Total Yang Harus Di Bayar Adalah : </b></div></td><td style='text-align:right'>Rp".number_format($tampilkan['total_harga'],2,',','.')."</td></tr>";
echo "<tr><td colspan = '6'><div style='text-align:right'><b>Terbilang :</b>".ucwords(Terbilang($tampilkan['total_harga']))." Rupiah</div></td></tr>";
$kuery2=mysqli_fetch_array(mysqli_query($con, "select cash,kembali,dp,sisa from cash where no_faktur = '$_GET[no_faktur]'"));
/*echo"<tr><td colspan = '5'><div style='text-align:right'><b>Cash : </b></div></td><td style='text-align:right'>Rp".number_format($kuery2['cash'],2,',','.')."</td></tr>";
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Kembalian : </b></div></td><td style='text-align:right'>Rp".number_format($kuery2['kembali'],2,',','.')."</td></tr>";
echo"<tr><td colspan = '5'><div style='text-align:right'><b>DP : </b></div></td><td style='text-align:right'>Rp".number_format($kuery2['dp'],2,',','.')."</td></tr>";
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Sisa : </b></div></td><td style='text-align:right'>Rp".number_format($kuery2['sisa'],2,',','.')."</td></tr>";*/
$sqlket = mysqli_fetch_array(mysqli_query($con, "select * from cash where no_faktur = '$_GET[no_faktur]'"));
echo"</table></br>";
echo"<table style='width:700px; font-size:10pt;'>";
$kuery2=mysqli_query($con, "select kasir from cash where no_faktur = '$_GET[no_faktur]'");
$tampilkan2=mysqli_fetch_array($kuery2);
echo"<tr><td align='center'>Diterima Oleh,</br></br></br></br><u>(_____________)</u></td>
<td style='border:1px solid black; -moz-border-radius : 10px;
    -webkit-border-radius : 10px;
	 -webkit-box-shadow: 3px 2px 6px rgba(0,0,0,0.0);
  -moz-box-shadow: 3px 2px 6px rgba(0,0,0,0.7);
  box-shadow: 3px 2px 10px rgba(0,0,0,0.7); background: #fcfcfc; 
 background: linear-gradient(#fcfcfc, #bfc2de); padding:5px; text-align:left; width:30%'><i>$sqlket[ket]</i></td>
<td align='center'>TTD,</br></br></br></br><u>(_______________)</u></td></tr>";
echo"</table>";
echo "</center></body>";
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