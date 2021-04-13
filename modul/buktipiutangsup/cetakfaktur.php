<html>
<head>
<title>Bukti Pembayaran Piutang</title>
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


$sql_limit = "select * from pembelian where no_transaksi_sup = '$_GET[no_faktur]'";
$query=mysqli_query($con, $sql_limit);
$tampil=mysqli_fetch_array($query);


//************************************//
$sql_limit = "select * from pembelian,produk where pembelian.kode_barang = produk.id_barang and pembelian.no_transaksi_sup = '$_GET[no_faktur]'";
$query=mysqli_query($con, $sql_limit);
$row = mysqli_fetch_array(mysqli_query($con, "select tanggal_transaksi from pembelian where no_transaksi_sup = '$_GET[no_faktur]'"));
$row2 = mysqli_fetch_array(mysqli_query($con, "select nama from pembelian,supplier where pembelian.id_supplier = supplier.id_supplier and pembelian.no_transaksi_sup = '$_GET[no_faktur]'"));
echo"<center>
<h3>Bukti Pembayaran Piutang Ke Supplier</h3>
<table style='width:700px; font-size:10pt; font-family:arial' border = '0'>
<tr><td width=20%>No Bukti Piutang</td><td> : $_GET[no_bkt]</td><td>Kepada Yth : $row2[nama]</td></tr>
<tr><td width=20%>No Invoice</td><td> : $_GET[no_faktur]</td><td>Tanggal Invoice</td><td> : $row[tanggal_transaksi]</td></tr>
</table>
<table id='tabel' style='width:700px; font-size:10pt;' border='1'>
<tr align='center'>
<td width='10%'>Kode Barang</td>
<td width='20%'>Nama Barang</td>
<td width='13%'>Harga</td>
<td width='4%'>Qty</td>
<td width='13%'>Total Harga</td>";
$no=1;
$baris=1;
while($tampil=mysqli_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[kode_barang]</td>";
echo"<td>$tampil[nama_barang]</td>";
echo"<td>Rp".number_format($tampil['harga_jual'],2,',','.')."</td>";
echo"<td>$tampil[qty]</td>";
$tampilrupiah=number_format($tampil['total_harga'],2,',','.');
echo"<td style='text-align:right'>Rp$tampilrupiah</td>";
}
echo"</tr>";
$maks=mysqli_query($con, "select MAX(CONCAT(LPAD((RIGHT((no_transaksi_sup),9)),9,'0'))) as no from pembelian");
$tampil=mysqli_fetch_array($maks);
$kuery=mysqli_query($con, "select SUM(total_harga) as total_harga from pembelian where no_transaksi_sup = '$_GET[no_faktur]'");
$tampilkan=mysqli_fetch_array($kuery);
echo"<tr><td colspan = '4'><div style='text-align:right'><b>Total Keseluruhan : </b></div></td><td style='text-align:right'>Rp".number_format($tampilkan['total_harga'],2,',','.')."</td></tr>";
$kuery2=mysqli_fetch_array(mysqli_query($con, "select cash,kembali,dp,sisa from cash where no_faktur = '$_GET[no_faktur]'"));
$sisasebelum = $_GET['bayar'] + $_GET['sisahutang'];
echo"<tr><td colspan = '4'><div style='text-align:right'><b>Sisa Hutang Sebelumnya : </b></div></td><td style='text-align:right'>Rp".number_format($sisasebelum,2,',','.')."</td></tr>";
echo"<tr><td colspan = '4'><div style='text-align:right'><b>Bayar : </b></div></td><td style='text-align:right'>Rp".number_format($_GET['bayar'],2,',','.')."</td></tr>";
echo"<tr><td colspan = '4'><div style='text-align:right'><b>Sisa : </b></div></td><td style='text-align:right'>Rp".number_format($_GET['sisahutang'],2,',','.')."</td></tr>";
echo"</table></center></br>";
echo"<center><table style='width:700px; font-size:10pt;'>";
//$kuery2=mysqli_query($con, "select kasir from cash where no_faktur = '$_GET[no_faktur]'");
//$tampilkan2=mysqli_fetch_array($kuery2);
echo"<tr><td align='center'>Supplier</br></br></br></br><u>(_____________)</u></td><td align='center'>Pihak Toko,</br></br></br></br><u>(____________)</u></td></tr>";
echo"</table></center>
</body>";
?>

</html>