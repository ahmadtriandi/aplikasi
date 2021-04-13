<?php
if(!isset($_SESSION['user'])) {
echo '<script>setTimeout(\'location.href="index.php"\' ,0);</script>';
}else{
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
$sqlCount = "select count(no_bukti_piutang) from bukti_piutang";
$rsCount = mysqli_fetch_array(mysqli_query($con, $sqlCount));
$banyakData = $rsCount[0];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$mulai_dari = $limit * ($page - 1);
$sql_limit = "select * from bukti_piutang order by no_bukti_piutang DESC limit $mulai_dari, $limit";
$query=mysqli_query($con, $sql_limit);;
echo"<h2>Bukti Pembayaran Piutang</h2>";
echo"<center><table id='tabel' style='width:800px; font-size:11px;'>
<tr bgcolor='#666666' style=\"color:#FFFFFF\" align='center' height='25px'>
<td width='10%'>No. Bukti Piutang</td>
<td width='10%'>No. Transaksi</td>
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
echo"<td>$tampil[no_bukti_piutang]</td>";
echo"<td>$tampil[no_transaksi]</td>";
echo"<td>$tampil[tgl_bayar]</td>";
echo"<td>Rp".number_format($tampil['total_bayar'],2,',',',')."</td>";
echo"<td>Rp".number_format($tampil['sisa'],2,',',',')."</td>";
echo"<td>Rp".number_format($tampil['bayar'],2,',',',')."</td>";
$sisahutang = $tampil['sisa']-$tampil['bayar'];
echo"<td>Rp".number_format($sisahutang,2,',',',')."</td>";
echo'<td align="center"><a href=\'javascript:window.open("modul/buktipiutang/cetakfaktur.php?&bayar='.$tampil['bayar'].'&sisahutang='.$sisahutang.'&no_bkt='.$tampil['no_bukti_piutang'].'&no_faktur='.$tampil['no_transaksi'].'", "WinC",
"width=1000,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,resizable=yes,copyhistory=no")\'><img src="images/kwitansi.png" width="24px" title="Cetak"></a>
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
 echo '  [<a href="index.php?modul=pelanggan&aksi=tampil&page='.$i.'">'.$i.'</a>]  ';
 }else{
 echo "[<span style='color:green'>$i</span>] ";
 }
}
break;

//INTERFACE TAMBAH
case "tambahpelanggan":
echo"<h2>Tambah Data pelanggan</h2>";
echo "<center><table id='tabeledit'><form action='?modul=pelanggan&aksi=input' name='postform' method=POST>
	<tr><td>Kode Pelanggan : </td><td>
<input type='text' name='id_pelanggan' size='40' maxlength='30'></td></tr>
<tr><td>Nama Pelanggan : </td><td>
<input type=text name='nama_pelanggan'  size='40' maxlength='80'></td></tr>
<tr><td>Alamat : </td><td>
<input size='40' type='text' name='alamat' />
</td></tr>
<tr><td>Kota : </td><td>
<input size='40' type='text' name='kota' />
</td></tr>
<tr><td>Kode Pos : </td><td>
<input size='40' type=text name='kode_pos' maxlength='8'></td></tr>
<tr><td>Nomor Telepon : </td><td>
<input size='40' type=text name='no_telp' maxlength='20'></td></tr>
<tr><td>Tempat Lahir : </td><td>
<input size='40' type=text name='tempat_lahir' maxlength='20'></td></tr>
<tr><td>Tanggal Lahir : </td><td><input size='35' type='text' name='tanggal_lahir' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_lahir);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_lahir);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a></td></tr>
	<tr><td colspan=2 align=center><input type=submit value='Save'>
			<input type=button onclick=self.history.back()  value='Batal'>
	</td></tr></form></table></center>";
break;

//INTERFACE EDITUSER
case "editpelanggan":
echo"<h2>Edit Data pelanggan</h2>";
$db="select * from pelanggan where id_pelanggan='$_GET[no]'";
$qri=mysqli_query($con, $db);
$row=mysqli_fetch_array($qri);
echo"<form action='?modul=pelanggan&aksi=update&id_pelanggan=$row[id_pelanggan]' name='postform2' method=POST>";
echo"<center><table id='tabeledit'>";
echo"<tr><td>Kode Pelanggan : </td><td><input style='background-color:#eeeeff'; readonly='1' type=text name='id_pelanggan' value='$row[id_pelanggan]'></td></tr>";
echo"<tr><td>Nama Pelanggan : </td><td><input type=text name='nama_pelanggan' value='$row[nama_pelanggan]'></td></tr>";
echo"<tr><td>Alamat : </td><td><input type=text name='alamat' value='$row[alamat]'></td></tr>";
echo"<tr><td>Kota : </td><td><input type=text name='kota' value='$row[kota]'></td></tr>";
echo"<tr><td>Kode Pos : </td><td><input type=text name='kode_pos' value='$row[kode_pos]'></td></tr>";
echo"<tr><td>Nomor Telepon : </td><td><input type=text name='no_telp' value='$row[no_telp]'></td></tr>";
echo"<tr><td>Tempat Lahir : </td><td><input type=text name='tempat_lahir' value='$row[tempat_lahir]'></td></tr>";
echo"<tr><td>Tanggal Lahir : </td><td><input type=text name='tanggal_lahir' value='$row[tanggal_lahir]'></td></tr>";
echo"<tr><td colspan=2 align=center><input type=submit name='save'  value='UpDate'>
	<input type=button onclick=self.history.back()  value='Batal'></td></tr>";
echo"</table></center>";
break;

//HAPUS
case "hapus":
mysqli_query($con, "DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]'");
	echo '<script>setTimeout(\'location.href="?modul=pelanggan&aksi=tampil"\' ,0);</script>';
break;

//INPUT
case "input":
$querycek=mysqli_query($con, "select * from pelanggan where id_pelanggan = '$_POST[id_pelanggan]'");
$tampilcek=mysqli_fetch_array($querycek);
if (empty($_POST['id_pelanggan']) or empty($_POST['nama_pelanggan']))
{
echo"<p>Salahsatu Textbox tidak terisi<input type='button' onclick=self.history.back() value='back'/>";

}
elseif ($tampilcek['id_pelanggan'] == $_POST['id_pelanggan']){
echo '<script>alert(\'Data Sudah Ada . . / Sudah Terisi ! !\')
	setTimeout(\'location.href="?modul=pelanggan&aksi=tampil"\' ,0);</script>';
}
Else
{		
/*$qry	= mysqli_query($con, "SELECT MAX(CONCAT(LPAD((RIGHT((id_pelanggan),8)+1),8,'0')))FROM pelanggan");
$qry2	= mysqli_query($con, "SELECT MIN(CONCAT(LPAD((RIGHT((id_pelanggan),8)),8,'0')))FROM pelanggan");	
$kode= mysqli_fetch_array($qry);
$kode2= mysqli_fetch_array($qry2);
$singkatanggota = substr($_POST['no_anggota'],0,4);
if ($kode2[0]!="00000001"){
$kodeauto = "00000001";
}
else{
$kodeauto = $kode[0];
}   */
  mysqli_query($con, "INSERT INTO pelanggan VALUES('$_POST[id_pelanggan]','$_POST[nama_pelanggan]','$_POST[alamat]','$_POST[kota]','$_POST[kode_pos]','$_POST[no_telp]','$_POST[tempat_lahir]','$_POST[tanggal_lahir]')"); 	  
echo 'Data Berhasil Dimasukkan Dengan Data Sebagai Berikut :</br></br>';
$query=mysqli_query($con, "select * from pelanggan where id_pelanggan = '$_POST[id_pelanggan]'");
while($tampil=mysqli_fetch_array($query)){ 
echo"<center><table border='0' style='width:300px; font-size:11px;' align='center'>
<tr><td width='50%'>No pelanggan</td><td> : $tampil[id_pelanggan]</td></tr>
<tr><td>nama_pelanggan</td><td> : $tampil[nama_pelanggan]</td></tr>
<tr><td>alamat</td><td> : $tampil[alamat]</td></tr>
<tr><td>kota</td><td> : $tampil[kota]</td></tr>
<tr><td>kode_pos</td><td> : $tampil[kode_pos]</td></tr>
<tr><td>TElp</td><td> : $tampil[no_telp]</td></tr>
<tr><td>Tempat Lahir</td><td> : $tampil[tempat_lahir]</td></tr>
<tr><td>Tanggal Lahir</td><td> : $tampil[tanggal_lahir]</td></tr>
</table></br></br><a href='index.php?modul=pelanggan&aksi=tampil'><b>Kembali</b></a></center>";
}
								}
break;

//UPDATE USER
case "update":
mysqli_query($con, "UPDATE pelanggan SET id_pelanggan='$_POST[id_pelanggan]',
                                nama_pelanggan ='$_POST[nama_pelanggan]',
                               alamat='$_POST[alamat]',
			kota ='$_POST[kota]',
			kode_pos ='$_POST[kode_pos]',
			no_telp ='$_POST[no_telp]',
			tempat_lahir ='$_POST[tempat_lahir]'
			tanggal_lahir ='$_POST[tanggal_lahir]'
where id_pelanggan='$_GET[id_pelanggan]'");
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=pelanggan&aksi=tampil"\' ,0);</script>';
break;
}

}
?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>