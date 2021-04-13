<?php
include "../../koneksi/koneksi.php";
//***********************//

$dari=$_POST['dari'];
$sampai=$_POST['sampai'];
$format=$_POST['format'];

$sql_limit = "select * from cashflow where(tanggal_transaksi between '".$dari."' and '".$sampai."') and (jenis_transaksi = 'Pengeluaran Piutang Supplier' or jenis_transaksi = 'Pengeluaran')";

if($format=="PDF")
{
?>

<html>
<head>
<title>LAPORAN PENGELUARAN</title>
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

<h3>Data Pengeluaran Toko</h3>
<table style='width:700px; font-size:10pt; font-family:arial' border = '0'>
<tr><td width=20%>Tanggal</td><td> : $_POST[dari]</td></tr>
<tr><td width=20%>Sampai Tanggal</td><td> : $_POST[sampai]</td></tr>
</table>
<table id='tabel' style='width:700px; font-size:10pt;' border='1'>
<tr align='center'>
<td width='10%'>No Invoice</td>
<td width='20%'>Tanggal Transaksi</td>
<td width='30%'>Jenis Transaksi</td>
<td width='20%'>Jumlah</td>";
$no=1;
$baris=1;
while($tampil=mysqli_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[no_faktur]</td>";
echo"<td>$tampil[tanggal_transaksi]</td>";
echo"<td>$tampil[jenis_transaksi]</td>";
echo"<td>".number_format($tampil['jumlah'],2,',','.')."</td>";
error_reporting(0);
$totalpengeluaran+=$tampil['jumlah'];
}
echo"</tr>";
echo"</table>";
echo"<table border='1' style='width:700px; font-size:10pt;'>";
echo"<tr><td colspan align='right'><b>Total Pemasukan  : Rp".number_format($totalpengeluaran,2,',','.')."</b></u></td></tr>";
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
$title = "LAPORAN PENGELUARAN";

//execute query
$result = mysqli_query($con, $sql_limit);

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
header("Content-Disposition: attachment; filename=laporan-pengeluaran.$file_ending");
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