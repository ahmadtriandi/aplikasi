<?php
//buat konkesi
include "../../koneksi/koneksi.php";
mysqli_select_db("penjualan",$con);

//pencarian nama
echo "<font face=verdana size=2px>Nama yang Anda cari adalah : </font>".$key=$_GET['id_pelanggan'];
$result=mysqli_query($con, "select * from pelanggan where id_pelanggan like '%$key%' or nama_pelanggan like '%$key%' or alamat like '%$key%' or kota like '%$key%' or kode_pos like '%$key%' or no_telp like '%$key%' or tempat_lahir like '%$key%' or tanggal_lahir like '%$key%' order by id_pelanggan"); 
$get_pages=mysqli_num_rows($result);

if ($get_pages){
	?>
		<center><table id='tabel' style='width:900px; font-size:11px;'>
		<tr bgcolor='#063b6d' style="color:#FFFFFF" align='center'>
			<td width='10%'>ID Pelanggan</td>
			<td width='10%'>Nama Pelanggan</td>
			<td width='20%'>Alamat</td>
			<td width='15%'>Kota</td>
			<td width='5%'>Kode Pos</td>
			<td width='15%'>No Telp</td>
			<td width='18%'>Tempat Lahir</td>
			<td width='18%'>Tanggal Lahir</td>
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
echo"<td>".$tampil['id_pelanggan']."</td>";
echo"<td>$tampil[nama_pelanggan]</td>";
echo"<td>$tampil[alamat]</td>";
echo"<td>$tampil[kota]</td>";
echo"<td>$tampil[kode_pos]</td>";
echo"<td>$tampil[no_telp]</td>";
echo"<td>$tampil[tempat_lahir]</td>";
echo"<td>$tampil[tanggal_lahir]</td>";
echo"<td><a href=?modul=pelanggan&aksi=editpelanggan&no=$tampil[id_pelanggan]>Edit</td>";
echo"<td width='5%'><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=pelanggan&aksi=hapus&id=$tampil[id_pelanggan]'>Hapus</td>";
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