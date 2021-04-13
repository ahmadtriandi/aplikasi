<?php
session_start();
//buat konkesi
include "../../koneksi/koneksi.php";


//pencarian nama
echo "<font face=verdana size=2px>Nama yang Anda cari adalah : </font>".$key=$_GET['id_produk'];
$result=mysqli_query($con, "select * from produk where id_barang like '%$key%' or brand like '%$key%' or nama_barang like '%$key%' or kategori like '%$key%' order by id_barang"); 
$get_pages=mysqli_num_rows($result);
if ($get_pages){
	?>
		<center><table id='tabel' style='width:900px; font-size:11px;'>
		<tr bgcolor='#063b6d' style="color:#FFFFFF" align='center'>
			<td width='10%'>Kode Barang</td>
			<td width='10%'>Brand</td>
			<td width='20%'>Nama Barang</td>
			<td width='5%'>Satuan</td>
			<td width='15%'>Kategori</td>
			<td width='5%'>Stock</td>
			<td width='15%'>Harga Jual</td>
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
echo"<td>".$tampil['id_barang']."</td>";
echo"<td>$tampil[brand]</td>";
echo"<td>$tampil[nama_barang]</td>";
echo"<td>$tampil[satuan]</td>";
echo"<td>$tampil[kategori]</td>";
echo"<td>$tampil[stock]</td>";
echo"<td>Rp".number_format($tampil['harga_jual'],2,',','.')."</td>";
if ($_SESSION['level'] == "Admin"){
echo"<td width='5%'><a href=?modul=produk&aksi=editproduk&no=$tampil[id_barang]>Edit</td>";
echo"<td width='5%'><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=penjualan&aksi=hapus&id=$tampil[id_barang]'>Hapus</td>";
}
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