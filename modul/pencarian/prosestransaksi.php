<?php
//buat konkesi
include "../../koneksi/koneksi.php";


//pencarian nama
$key=$_GET['no_transaksi'];
echo "</br>";
$result=mysqli_query($con, "select * from cash where (no_faktur like '%$key%') order by no_faktur DESC"); 
$get_pages=mysqli_num_rows($result);

if ($get_pages){
	?>
		<center><table id='tabel' style='width:800px; font-size:11px;'>
		<tr bgcolor='#063b6d' style="color:#FFFFFF" align='center'>
			<td width='10%'>No Invoice</td>
			<td width='20%'>Tanggal Invoice</td>
			<td width='10%'>Total Bayar</td>
			<td width='15%'>Cash</td>
			<td width='15%'>Kembali</td>
			<td width='15%'>DP</td>
			<td width='15%'>Sisa</td>
			<td width='15%'>CASH (YA) / DP (TIDAK)</td>
		</tr>
	<?php

	$no=1;
$baris=1;
	while ($tampil=mysqli_fetch_array($result)){
	if($baris%2==0)
{
echo "<tr bgcolor=\"#e4e3e8\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}
echo"<td>".$tampil['no_faktur']."</td>";
echo"<td>".$tampil['tanggal_faktur']."</td>";
echo"<td>Rp".number_format($tampil['total_bayar'],2,',','.')."</td>";
echo"<td>Rp".number_format($tampil['cash'],2,',','.')."</td>";
echo"<td>Rp".number_format($tampil['kembali'],2,',','.')."</td>";
echo"<td>Rp".number_format($tampil['dp'],2,',','.')."</td>";
echo"<td>Rp".number_format($tampil['sisa'],2,',','.')."</td>";
echo"<td>$tampil[lunas]</td>";
echo'<td><a href=\'javascript:window.open("modul/penjualan/cetakfaktur.php?no_faktur='.$tampil['no_faktur'].'", "WinC",
"width=1000,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,resizable=yes,copyhistory=no")\'>Print</a>
<div id="printerDiv" style="display:none"></div>
<script>
   function printPage()
   {
      var div = document.getElementById("printerDiv");
      div.innerHTML = \'<iframe src="../../modul/penjualan/cetakfaktur.php?no_faktur="FKT000000001" onload="this.contentWindow.print();"></iframe>\';
   }
</script>
</td>';
echo'<td><a href=\'javascript:window.open("modul/penjualan/cetaksuratjalan.php?no_faktur='.$tampil['no_faktur'].'", "WinC",
"width=1000,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,resizable=yes,copyhistory=no")\'>Cetak Surat Jalan</a>
<div id="printerDiv" style="display:none"></div>
<script>
   function printPage()
   {
      var div = document.getElementById("printerDiv");
      div.innerHTML = \'<iframe src="../../modul/penjualan/cetaksuratjalan.php?no_faktur="FKT000000001" onload="this.contentWindow.print();"></iframe>\';
   }
</script>
</td>';
$no++;
$baris++;}
echo"</tr>";
echo"</table></center>";
	
	
	?></TABLE>
		<?php
}else{
	?><br /><b>Belum ada data!!</b><?php
}
?>