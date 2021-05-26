<?php
include "../../koneksi/koneksi.php";

$dari=$_POST['dari'];
$sampai=$_POST['sampai'];
$format=$_POST['format'];

$sql_limit = "select * from penjualan,produk where (penjualan.kode_barang = produk.id_barang) and (penjualan.tanggal_transaksi between '".$dari."' and '".$sampai."')";
$sql_xls = "select penjualan.kode_barang, produk.nama_barang, produk.harga_beli, penjualan.potongan, penjualan.qty, produk.harga_beli * penjualan.qty as total_modal,
produk.harga_jual, penjualan.total_harga, penjualan.total_harga - (produk.harga_beli * penjualan.qty) as untung  from penjualan,produk where (penjualan.kode_barang = produk.id_barang) and (penjualan.tanggal_transaksi between '".$dari."' and '".$sampai."')";

if($format=="PDF")
{
?>
<html>
<head>
<title>LAPORAN PENJUALAN</title>
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
$query=mysqli_query($con, $sql_limit);
echo"<center>

<h3>Laporan Penjualan Barang</h3>
<table style='width:700px; font-size:10pt; font-family:arial' border = '0'>
<tr><td width=20%>Tanggal</td><td> : $_POST[dari]</td></tr>
<tr><td width=20%>Sampai Tanggal</td><td> : $_POST[sampai]</td></tr>
</table>
<table id='tabel' style='width:700px; font-size:10pt;' border='1'>
<tr align='center'>

<td width='12%'>Kode Barang</td>
<td width='12%'>Tanggal</td>
<td width='15%'>Nama Barang</td>
<td width='10%'>Harga Beli</td>
<td width='10%'>Potongan</td>
<td width='5%'>Qty</td>
<td width='14%'>Total Modal</td>
<td width='10%'>Harga Jual</td>
<td width='14%'>Total Jual</td>
<td width='10%'>Laba</td>";
$no=1;
$baris=1;
$totaluntung=0;
$totalharga=0;
$totalmodal=0;
while($tampil=mysqli_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[kode_barang]</td>";
$tampilkan = mysqli_fetch_array(mysqli_query($con, "select harga_beli from produk where id_barang='$tampil[kode_barang]'"));
$tampilkan2 = mysqli_fetch_array(mysqli_query($con, "select total_harga,potongan,qty,hargajuall,tanggal_transaksi from penjualan where no_transaksi='$tampil[no_transaksi]'"));
if ($tampil['kode_barang']=="SRV"){
$untung = $tampilkan2[total_harga];
}else{
$untung = (($tampilkan2['hargajuall']*$tampilkan2['qty']) - ($tampilkan['harga_beli']*$tampilkan2['qty']))-($tampilkan2['potongan']*$tampilkan2['qty']);
}

echo"<td>$tampilkan2[tanggal_transaksi]</td>";
echo"<td>$tampil[nama_barang]</td>";
echo"<td align='right'>".number_format($tampilkan['harga_beli'],0,',','.')."</td>";
echo"<td align='right'>$tampilkan2[potongan] /brg</td>";
echo"<td>$tampilkan2[qty]</td>";
$totomol = $tampilkan['harga_beli']*$tampilkan2['qty'];
echo"<td align='right'>".number_format($totomol,0,',','.')." </td>";
echo"<td align='right'>".number_format($tampilkan2['hargajuall'],0,',','.')." </td>";
echo"<td align='right'>".number_format($tampilkan2['total_harga'],0,',','.')." </td>";
echo"<td align='right'>".number_format($untung,0,',','.')." </td>";
error_reporting(0);
$totaluntung+=$untung;
$totalharga+=$tampilkan2['hargajuall'];
$totalmodal+=$totomol;
}
echo"</tr>";
echo"</table>";
echo"<table border='0' style='width:700px; font-size:10pt;'>";
echo"<tr><td colspan align='right'><b>Total Modal  : Rp ".number_format($totalmodal,0,',','.')."</b></u></td></tr>";
echo"<tr><td colspan align='right'><b>Total Penjualan : Rp ".number_format($totalharga,0,',','.')."</b></u></td></tr>";
echo"<tr><td colspan align='right'><b>Total Keuntungan : Rp ".number_format($totaluntung,0,',','.')."</b></u></td></tr>";
echo"</table>";
echo "</center></body>";
?>

</html>

<?php
}

else
{
$Use_Title = 1;
$now_date = date('d-m-Y H:i');
$title = "LAPORAN PENJUALAN";

//execute query
$result = mysqli_query($con, $sql_xls);

$w=2;
if (isset($w) && ($w==1))
{
	$file_type = "msword";
	$file_ending = "doc";
}else {
	$file_type = "vnd.ms-excel";
	$file_ending = "xls";
}


header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=laporan-penjualan.$file_ending");
header("Pragma: no-cache");
header("Expires: 0");

/*	Start of Formatting for Word or Excel	*/

if (isset($w) && ($w==1)) //check for $w again
{
	/*	FORMATTING FOR WORD DOCUMENTS ('.doc')   */
	//create title with timestamp:
	if ($Use_Title == 1)
	{
		echo("$title\n\n");
	}
	//define separator (defines columns in excel & tabs in word)
	$sep = "\n"; //new line character

	while($row = mysqli_fetch_row($result))
	{
		//set_time_limit(60); // HaRa
		$schema_insert = "";
		for($j=0; $j<mysqli_num_fields($result);$j++)
		{
		//define field names
		$field_name = mysqli_field_name($result,$j);
		//will show name of fields
		$schema_insert .= "$field_name:\t";
			if(!isset($row[$j])) {
				$schema_insert .= "NULL".$sep;
				}
			elseif ($row[$j] != "") {
				$schema_insert .= "$row[$j]".$sep;
				}
			else {
				$schema_insert .= "".$sep;
				}
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert .= "\t";
		print(trim($schema_insert));
		//end of each mysqli row
		//creates line to separate data from each MySQLi table row
		print "\n----------------------------------------------------\n";
	}
}else{
	/*	FORMATTING FOR EXCEL DOCUMENTS ('.xls')   */
	//create title with timestamp:
	if ($Use_Title == 1)
	{
		echo("$title\n");
	}
	//define separator (defines columns in excel & tabs in word)
	$sep = "\t"; //tabbed character

	//start of printing column names as names of MySQLi fields
	for ($i = 0; $i < mysqli_num_fields($result); $i++)
	{
		echo mysqli_field_name($result,$i) . "\t";
	}
	print("\n");
	//end of printing column names

	//start while loop to get data
	while($row = mysqli_fetch_row($result))
	{
		//set_time_limit(60); // HaRa
		$schema_insert = "";
		for($j=0; $j<mysqli_num_fields($result);$j++)
		{
			if(!isset($row[$j]))
				$schema_insert .= "NULL".$sep;
			elseif ($row[$j] != "")
				$schema_insert .= "$row[$j]".$sep;
			else
				$schema_insert .= "".$sep;
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		$schema_insert .= "\t";
		print(trim($schema_insert));
		print "\n";
	}
}

}
?>