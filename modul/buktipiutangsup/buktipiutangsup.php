<?php
if(!isset($_SESSION['user'])) {
echo '<script>setTimeout(\'location.href="index.php"\' ,0);</script>';
}else{
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
$sqlCount = "select count(no_bukti_piutang_sup) from bukti_piutang_sup";
$rsCount = mysqli_fetch_array(mysqli_query($con, $sqlCount));
$banyakData = $rsCount[0];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$mulai_dari = $limit * ($page - 1);
$sql_limit = "select * from bukti_piutang_sup order by no_bukti_piutang_sup DESC limit $mulai_dari, $limit";
$query=mysqli_query($con, $sql_limit);;
echo"<h2>Bukti Pembayaran Hutang ke Supplier</h2>";
echo"<center><table id='tabel' style='width:800px; font-size:11px;'>
<tr bgcolor='#666666' style=\"color:#FFFFFF\" align='center' height='25px'>
<td width='10%'>No Bukti Piutang</td>
<td width='10%'>No Transaksi</td>
<td width='10%'>Tanggal Bayar</td>
<td width='10%'>Total Bayar</td>
<td width='10%'>Sisa Hutang</td>
<td width='10%'>Bayar</td>
<td width='10%'>Sisa</td>
<td width='10%'>Print Bukti</td>";

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
echo"<td>$tampil[no_bukti_piutang_sup]</td>";
echo"<td>$tampil[no_transaksi_sup]</td>";
echo"<td>$tampil[tgl_bayar]</td>";
echo"<td>Rp".number_format($tampil['total_bayar'],2,',',',')."</td>";
echo"<td>Rp".number_format($tampil['sisa'],2,',',',')."</td>";
echo"<td>Rp".number_format($tampil['bayar'],2,',',',')."</td>";
$sisahutang = $tampil['sisa']-$tampil['bayar'];
echo"<td>Rp".number_format($sisahutang,2,',',',')."</td>";
echo'<td align="center"><a href=\'javascript:window.open("modul/buktipiutangsup/cetakfaktur.php?&bayar='.$tampil['bayar'].'&sisahutang='.$sisahutang.'&no_bkt='.$tampil['no_bukti_piutang_sup'].'&no_faktur='.$tampil['no_transaksi_sup'].'", "WinC",
"width=1000,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,resizable=yes,copyhistory=no")\'><img src="images/kwitansi.png" width="24px" title="Cetak"</a>
<div id="printerDiv" style="display:none"></div>
<script>
   function printPage()
   {
      var div = document.getElementById("printerDiv");
      div.innerHTML = \'<iframe src="../../modul/buktipiutang/cetakfaktur.php?no_faktur="FKT000000001" onload="this.contentWindow.print();"></iframe>\';
   }
</script>
</td>';
$no++;
$baris++;}
echo"</tr>";
echo"</table></center>";
$banyakHalaman = ceil($banyakData / $limit);
echo '</br><div id="page" style="font-size:14px">Halaman: ';
for($i = 1; $i <= $banyakHalaman; $i++){
 if($page != $i){
 echo '  [<a href="index.php?modul=buktipiutangsup&aksi=tampil&page='.$i.'">'.$i.'</a>]  ';
 }else{
 echo "[<span style='color:green'>$i</span>] ";
 }
}
break;

}

}
?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>