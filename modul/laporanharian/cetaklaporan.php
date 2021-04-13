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
<body onload="javascript:window.print()">
<?php
include "../../koneksi/koneksi.php";
$sql_limit = "select * from penjualan,produk where (penjualan.kode_barang = produk.id_barang) and (penjualan.tanggal_transaksi between '2012-01-01' and '2012-11-11') order by penjualan.no_transaksi DESC";
$query=mysqli_query($con, $sql_limit);
echo"<center>
<h3>Laporan Penjualan</h3>
Dari tanggal $_POST[dari] sampai tanggal $_POST[sampai]</br></br>
<table id='tabel' style='width:800px' border='1'>
<tr align='center'>
<td width='10%'>No Transaksi</td>
<td width='13%'>Tanggal Transaksi</td>
<td width='20%'>Kode Barang</td>
<td width='20%'>Nama Barang</td>
<td width='7%'>Jumlah</td>
<td width='18%'>Total Harga</td>";
$no=1;
$baris=1;
while($tampil=mysqli_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[no_transaksi]</td>";
echo"<td>$tampil[tanggal_transaksi]</td>";
echo"<td>$tampil[kode_barang]</td>";
echo"<td>$tampil[nama_barang]</td>";
echo"<td>$tampil[qty]</td>";
$tampilrupiah=number_format($tampil['total_harga'],2,',','.');
echo"<td>Rp$tampilrupiah</td>";
}
echo"</tr>";
$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from penjualan");
$tampilkan=mysqli_fetch_array($kuery);
echo"<tr><td colspan = '5'><div style='text-align:right'><b>Total Penjualan : </b></div></td><td>Rp".number_format($tampilkan['total_harga'],2,',','.')."</td></tr>";
echo"</table></center></br>";
?>
</body>
</html>