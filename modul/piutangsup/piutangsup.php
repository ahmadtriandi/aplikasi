<?php
if(!isset($_SESSION['user'])) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
$sqlCount = "select count(no_piutang_sup) from piutang_sup";
$rsCount = mysqli_fetch_array(mysqli_query($con, $sqlCount));
$banyakData = $rsCount[0];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$mulai_dari = $limit * ($page - 1);
$sql_limit = "select distinct piutang_sup.no_piutang_sup,piutang_sup.tgl,piutang_sup.no_transaksi_sup,piutang_sup.total_bayar,piutang_sup.bayar,piutang_sup.sisa,supplier.id_supplier,supplier.nama from supplier,piutang_sup,pembelian where (piutang_sup.no_transaksi_sup = pembelian.no_transaksi_sup) and (supplier.id_supplier = pembelian.id_supplier) and (piutang_sup.sisa > 0) order by piutang_sup.no_piutang_sup DESC limit $mulai_dari, $limit";
$query=mysqli_query($con, $sql_limit);;
echo"<h2>Data Hutang dengan Supplier</h2>";
echo"<center><table id='tabel' style='width:900px; font-size:11px;'>
<tr bgcolor='#666666' style=\"color:#FFFFFF\" align='center' height='25px'>
<td width='10%'>No. Hutang </td>
<td width='10%'>Kode Supplier</td>
<td width='13%'>Nama Supplier</td>
<td width='20%'>No. Transaksi</td>
<td width='10%'>Tanggal</td>
<td width='10%'>Harus Bayar</td>
<td width='10%'>Bayar</td>
<td width='10%'>Sisa</td>
<td width='10%'>Bayar</td>";

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
echo"<td>$tampil[no_piutang_sup]</td>";
echo"<td>$tampil[id_supplier]</td>";
echo"<td>$tampil[nama]</td>";
echo"<td>$tampil[no_transaksi_sup]</td>";
echo"<td>$tampil[tgl]</td>";
echo"<td>Rp".number_format($tampil['total_bayar'],2,',',',')."</td>";
echo"<td>Rp".number_format($tampil['bayar'],2,',',',')."</td>";
echo"<td>Rp".number_format($tampil['sisa'],2,',',',')."</td>";
echo"<td align='center'><a href=?modul=piutangsup&aksi=bayarhutang&no=$tampil[no_piutang_sup]><img src='images/checklist.png' width='24px' title='Bayar'</td>";
$no++;
$baris++;}
echo"</tr>";
echo"</table></center>";
$banyakHalaman = ceil($banyakData / $limit);
echo '</br><div id="page" style="font-size:14px">Halaman: ';
for($i = 1; $i <= $banyakHalaman; $i++){
 if($page != $i){
 echo '  [<a href="index.php?modul=piutangsup&aksi=tampil&page='.$i.'">'.$i.'</a>]  ';
 }else{
 echo "[<span style='color:green'>$i</span>] ";
 }
}
break;

//INTERFACE EDITUSER
case "bayarhutang":
echo"<h2>Pembayaran Hutang Ke Supplier</h2>";
$db="select * from piutang_sup,supplier,pembelian where pembelian.no_transaksi_sup = piutang_sup.no_transaksi_sup and pembelian.id_supplier = supplier.id_supplier and no_piutang_sup ='$_GET[no]'";
$qri=mysqli_query($con, $db);
$row=mysqli_fetch_array($qri);
echo"<form action='?modul=piutangsup&aksi=bayar' name='postform2' method=POST>";
echo"<center><table id='tabeledit'>";
echo"<tr><td align=center colspan=2><input style='background-color:#eeeeff; border:0px; text-align:center;' readonly='1' type=text name='no_piutang_sup' value='$row[no_piutang_sup]'></td></tr>";
echo"<tr><td>No Transaksi : </td><td><input style='background-color:#eeeeff'; readonly='1' type=text name='no_transaksi' value='$row[no_transaksi_sup]'></td></tr>";
echo"<tr><td>Nama Supplier : </td><td><input style='background-color:#eeeeff'; readonly='1' type=text name='nama' value='$row[nama]'></td></tr>";
echo"<tr><td>Total Keseluruhan : </td><td><input style='background-color:#eeeeff'; readonly='1' type=hidden name='total_bayar' value='$row[total_bayar]'><input style='background-color:#eeeeff'; readonly='1' type=text name='tmp1' value='Rp".number_format($row['total_bayar'],2,',',',')."'></td></tr>";
echo"<tr><td>Sisa : </td><td><input style='background-color:#eeeeff'; readonly='1' type=hidden name='sisa' value='$row[sisa]'>
<input style='background-color:#eeeeff'; readonly='1' type=text name='tmp2' value='Rp".number_format($row['sisa'],2,',',',')."'></td></tr>";
echo"<tr><td>Bayar : </td><td>Rp<input type=text onkeyup=\"this.value = numberFormat(this.value);\" name='bayar'/>,00</td></tr>";
echo"<tr><td colspan=2 align=center><input type=submit name='save'  value='Bayar'>
	<input type=button onclick=self.history.back()  value='Batal'></td></tr>";
echo"<script language='Javascript'>
document.postform2.bayar.focus()
</script>
</form></table></center>";
break;


//BAYAR HUTANG
case "bayar":
$bayar = str_replace(",", '', $_POST['bayar']);
if ($bayar > $_POST['sisa'])
{
echo '<script>alert(\'Uang Yang Dibayar Melebihi Hutang\')
	setTimeout(\'location.href="?modul=piutang_sup&aksi=tampil"\' ,0);</script>';
}else{
$sql = mysqli_query($con, "update piutang_sup set sisa = $_POST[sisa] - $bayar where no_piutang_sup = '$_POST[no_piutang_sup]'");
if  (!$sql) {
die(mysqli_error());
}else{
$qrybukti	= mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((no_bukti_piutang_sup),9)+1),9,'0')))FROM bukti_piutang_sup");
$qrybukti2	= mysqli_query($con, "SELECT MIN(CONCAT(LPAD((RIGHT((no_bukti_piutang_sup),9)),9,'0')))FROM bukti_piutang_sup");	
$kodebukti= mysqli_fetch_array($qrybukti);
$kodebukti2= mysqli_fetch_array($qrybukti2);
if ($kodebukti2[0]!="000000001"){
$kodeautobukti = "000000001";
}
else{
$kodeautobukti = $kodebukti[0];
}  
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
mysqli_query($con, "insert into bukti_piutang_sup values ('BKT$kodeautobukti','$_POST[no_piutang_sup]','$_POST[no_transaksi]','$tglsekarang',$_POST[total_bayar]000,$_POST[sisa],$bayar)");
mysqli_query($con, "INSERT INTO cashflow VALUES (NULL,'BKT$kodeautobukti','$tglsekarang','Pengeluaran Piutang Supplier',$bayar,'-')");
echo '<script>alert(\'Pembayaran Berhasil Dilakukan\')
	setTimeout(\'location.href="?modul=piutangsup&aksi=tampil"\' ,0);</script>';
	}
	}
break;
}

}
?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>