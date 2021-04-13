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
     P.break{page-break-after: always}
</style>
</head>
<body onload="javascript:alert('Tekan Control + P Untuk Mencetak . . !');" style='font-family:arial; font-size:10pt;'>
<?php
include "../../koneksi/koneksi.php";
$tmp=mysqli_query($con, "select * from cash where (tanggal_faktur between '$_POST[dari]' and '$_POST[sampai]') order by no_faktur DESC");
Echo "<center>
<h3>Laporan Penjualan</h3>
Dari tanggal $_POST[dari] sampai tanggal $_POST[sampai]</br></br></center>";
while($tmp1=mysqli_fetch_array($tmp)){ 
$sql_limit = "select * from penjualan,produk where penjualan.kode_barang = produk.id_barang and penjualan.no_transaksi = '$tmp1[no_faktur]'";
$query=mysqli_query($con, $sql_limit);
$row = mysqli_fetch_array(mysqli_query($con, "select tanggal_transaksi from penjualan where no_transaksi = '$tmp1[no_faktur]'"));
$row2 = mysqli_fetch_array(mysqli_query($con, "select nama_pelanggan from penjualan,pelanggan where penjualan.id_pelanggan = pelanggan.id_pelanggan and penjualan.no_transaksi = '$tmp1[no_faktur]'"));
echo"<center>
<table style='width:700px; font-size:10pt; font-family:arial' border = '0'>
<tr><td width=20%>No Transaksi</td><td> : $tmp1[no_faktur]</td>
<td width=20%>Tanggal Transaksi</td><td> : $tmp1[tanggal_faktur]</td></tr>
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
$kuery=mysqli_query($con, "select SUM(total_bayar) as total_harga from cash where no_faktur = '$tmp1[no_faktur]'");
$tampilkan=mysqli_fetch_array($kuery);
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Total Yang Harus Dibayar :   </b></div></td><td width='10%' style='text-align:right'>Rp".number_format($tampilkan['total_harga'],2,',','.')."</td></tr>";
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Cash : </b></div></td><td style='text-align:right'>Rp".number_format($tmp1['cash'],2,',','.')."</td></tr>";
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Kembalian : </b></div></td><td style='text-align:right'>Rp".number_format($tmp1['kembali'],2,',','.')."</td></tr>";
//error_reporting(0);
echo"<tr><td colspan = '5'><div style='text-align:right'><b>DP : </b></div></td><td style='text-align:right'>Rp".number_format($tmp1['dp'],2,',','.')."</td></tr>";
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Sisa : </b></div></td><td style='text-align:right'>Rp".number_format($tmp1['sisa'],2,',','.')."</td></tr>";
//error_reporting(0);
echo"</table></center></br>";
}
$tot=mysqli_query($con, "select SUM(total_bayar) as total_bayar from cash where (tanggal_faktur between '$_POST[dari]' and '$_POST[sampai]') and (lunas ='YA')");
$tampilkantot=mysqli_fetch_array($tot);
echo"</br><center><b>Total Penjualan Kontan : Rp".number_format($tampilkantot['total_bayar'],2,',','.')."</b></center></br>";
$tot2=mysqli_query($con, "select SUM(dp) as dp from cash where (tanggal_faktur between '$_POST[dari]' and '$_POST[sampai]') and (lunas ='TIDAK')");
$tampilkantot2=mysqli_fetch_array($tot2);
echo "<center><b>Total Penjualan Belum Lunas : Rp".number_format($tampilkantot2['dp'],2,',','.')."</b></center></br>";
$tot3=mysqli_query($con, "select SUM(sisa) as sisa from cash where (tanggal_faktur between '$_POST[dari]' and '$_POST[sampai]') and (lunas ='TIDAK')");
$tampilkantot3=mysqli_fetch_array($tot3);
echo "<center><b>Total Piutang : Rp".number_format($tampilkantot3['sisa'],2,',','.')."</b></center></body>";

?>

</html>