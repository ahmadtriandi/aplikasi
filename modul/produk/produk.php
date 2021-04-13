<?php
if((!isset($_SESSION['user'])) || ($_SESSION['level']!="Admin")) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
$sqlCount = "select count(id_barang) from produk";
$rsCount = mysqli_fetch_array(mysqli_query($con, $sqlCount));
$banyakData = $rsCount[0];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$mulai_dari = $limit * ($page - 1);
$sql_limit = "select * from produk order by id_barang limit $mulai_dari, $limit";
$query=mysqli_query($con, $sql_limit);;
echo"<h2>Data Produk</h2>";
echo"<input type=button style='background-color:#006699; color:#fff; line-height:30px;cursor:pointer;border:hidden;' value='Tambah Data Produk' onclick=location.href='?modul=produk&aksi=tambahproduk'></br></br>";
echo"<center><table id='tabel' style='width:1050px; font-size:11px;'>
<tr bgcolor='#333333' style=\"color:#FFFFFF\" align='center' height='25px'>
<td width='10%'>Kode Produk</td>
<td width='13%'>Brand</td>
<td width='20%'>Nama Barang</td>
<td width='7%'>Satuan</td>
<td width='18%'>Kategori</td>
<td width='10%'>Stock</td>
<td width='10%'>Harga Beli</td>
<td width='10%'>Harga Jual</td>
<td width='10%' colspan='2'>Aksi</td>
<td width='10%'>Kode Barcode</td>";
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
echo"<td>$tampil[id_barang]</td>";
echo"<td>$tampil[brand]</td>";
echo"<td>$tampil[nama_barang]</td>";
echo"<td>$tampil[satuan]</td>";
echo"<td>$tampil[kategori]</td>";
echo"<td>$tampil[stock]</td>";
echo"<td>$tampil[harga_beli]</td>";
echo"<td>$tampil[harga_jual]</td>";
echo"<td><a href=?modul=produk&aksi=editproduk&no=$tampil[id_barang]><img src='images/edit128px.png' width='24px' title='Edit'</td>";
echo"<td><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=produk&aksi=hapus&id=$tampil[id_barang]'><img src='images/delete128px.png' width='24px' title='Hapus'></td>";
echo"<td><img src='modul/produk/barcode.php?encode=CODE128&bdata=$tampil[id_barang]&height=50&scale=1.5&bgcolor=%23FFFFFF&color=%23000000&file=&type=png'/></td>";
$no++;
$baris++;}
echo"</tr>";
echo"</table></center>";
$banyakHalaman = ceil($banyakData / $limit);
echo '</br><div id="page" style="font-size:14px">Halaman: ';
for($i = 1; $i <= $banyakHalaman; $i++){
 if($page != $i){
 echo '  [<a href="index.php?modul=produk&aksi=tampil&page='.$i.'">'.$i.'</a>]  ';
 }else{
 echo "[<span style='color:green'>$i</span>] ";
 }
}
break;

//INTERFACE TAMBAH
case "tambahproduk": 
	echo"<h2>Tambah Data produk</h2>";
	echo"<center><table id='tabeledit'><form action='?modul=produk&aksi=input' name='postform' method=POST>
			<tr><td><label for='id_barang1'> Kode Barang : </label></td><td>
		<input type='text' id='id_barang1' name='id_barang' size='40' maxlength='30'></td></tr>
		<tr><td><label for='brand'>Brand : </label></td><td>
		<input type=text id='brand' name='brand'  size='40' maxlength='80'></td></tr>
		<tr><td><label for='nama_barang'>Nama Barang : </label</td><td>
		<input size='40' type='text' id='nama_barang' name='nama_barang' />
		</td></tr>
		<tr><td><label for='satuan'>Satuan : </label></td><td>
		<input size='40' type='text' id='satuan' name='satuan' />
		</td></tr>
		<tr><td><label for='kategori'>Kategori : </label></td><td>
		<select 	name='kategori' id='kategori'>
		<option value='HP'>HP</option>
		<option value='Aksesoris'>Aksesoris</option>
		</select>
		</td></tr>
		<tr><td><label for='stock'>Stock : </label></td><td>
		<input size='40' value='0' type=text id='stock' name='stock' maxlength='4'></td></tr>
		<tr><td><label for='harga_beli'>Harga Beli : </label></td><td>
		<input size='40' type=text id='harga_beli' name='harga_beli' onkeyup=\"this.value = numberFormat(this.value);\" maxlength='20'></td></tr>
		<tr><td><label for='harga_jual'>Harga Jual : </label></td><td>
		<input size='40' type=text id='harga_jual'name='harga_jual' onkeyup=\"this.value = numberFormat(this.value);\" maxlength='20'></td></tr>
			<tr><td colspan=2 align=center><input type=submit value='Save'>
					<input type=button onclick=self.history.back()  value='Batal'>
			</td></tr></form></table></center>";
		break;


//INTERFACE EDITUSER
case "editproduk":
echo"<h2>Edit Data produk</h2>";
$db="select * from produk where id_barang='$_GET[no]'";
$qri=mysqli_query($con, $db);
$row=mysqli_fetch_array($qri);
echo"<form action='?modul=produk&aksi=update&no_produk=$row[id_barang]' name='postform2' method=POST>";
echo"<center><table id='tabeledit'>";
echo"<tr><td><label for='id_barang'>No Produk : </label></td><td><input style='background-color:#eeeeff'; readonly='1' type=text id='id_barang'name='id_barang' value='$row[id_barang]'></td></tr>";
echo"<tr><td><label for='brand'>Brand : </label></td><td><input type=text id='brand'name='brand' value='$row[brand]'></td></tr>";
echo"<tr><td><label for='nama_barang'>Nama Barang : </label?</td><td><input type=text id='nama_barang' name='nama_barang' value='$row[nama_barang]'></td></tr>";
echo"<tr><td><label for='satuan'>Satuan : </label></td><td><input type=text id='satuan' name='satuan' value='$row[satuan]'></td></tr>";
echo"<tr><td><label for='stock'>Stock : </label></td><td><input type=text id='stock' name='stock' value='$row[stock]'></td></tr>";
echo"<tr><td><label for='kategori'>Kategori : </label></td><td><input type=text id='kategori' name='kategori' value='$row[kategori]'></td></tr>";
echo"<tr><td><label for='harga_beli'>Harga Beli : </label></td><td><input type=text id='harga_beli'name='harga_beli' value='$row[harga_beli]'></td></tr>";
echo"<tr><td><label for='harga-jual'>Harga Jual : </label></td><td><input type=text id='harga_jual'name='harga_jual' value='$row[harga_jual]'></td></tr>";
echo"<tr><td colspan=2 align=center><input type=submit name='save'  value='UpDate'>
	<input type=button onclick=self.history.back()  value='Batal'></td></tr>";
echo"</table></center>";
break; 

//HAPUS
case "hapus":
mysqli_query($con, "DELETE FROM produk WHERE id_barang='$_GET[id]'");
	echo '<script>alert(\'Data Berhasil Dihapus\')
	setTimeout(\'location.href="?modul=produk&aksi=tampil"\' ,0);</script>';
break;

//INPUT
case "input":
$harga_beli = str_replace(",", '', $_POST['harga_beli']);
$harga_jual = str_replace(",", '', $_POST['harga_jual']);
$querycek=mysqli_query($con, "select * from produk where id_barang = '$_POST[id_barang]'");
$tampilcek=mysqli_fetch_array($querycek);
if (empty($_POST['id_barang']) or empty($_POST['brand']) or empty($_POST['nama_barang']) or empty($_POST['satuan']) or empty($_POST['kategori']) or empty($_POST['harga_beli']) or empty($_POST['harga_jual']))
{
echo"<p>Salah satu Textbox tidak terisi<input type='button' onclick=self.history.back() value='back'/>";

}
elseif ($tampilcek['id_barang'] == $_POST['id_barang']){
echo '<script>alert(\'Data Sudah Ada . . / Sudah Terisi ! !\')
	setTimeout(\'location.href="?modul=produk&aksi=tampil"\' ,0);</script>';
}
Else
{		
  $sql = mysqli_query($con, "INSERT INTO produk VALUES('$_POST[id_barang]','$_POST[brand]','$_POST[nama_barang]','$_POST[satuan]','$_POST[kategori]',$_POST[stock],$harga_beli,$harga_jual)"); 	  
  if ($sql){
echo 'Data Berhasil Dimasukkan Dengan Data Sebagai Berikut :</br></br>';
$query=mysqli_query($con, "select * from produk where id_barang = '$_POST[id_barang]'");
while($tampil=mysqli_fetch_array($query)){ 
echo"<center><table border='0' style='width:300px; font-size:11px;' align='center'>
<tr><td width='50%'>No produk</td><td> : $tampil[id_barang]</td></tr>
<tr><td>Brand</td><td> : $tampil[brand]</td></tr>
<tr><td>nama_barang</td><td> : $tampil[nama_barang]</td></tr>
<tr><td>Satuan</td><td> : $tampil[satuan]</td></tr>
<tr><td>Kategori</td><td> : $tampil[kategori]</td></tr>
<tr><td>Stock</td><td> : $tampil[stock]</td></tr>
<tr><td>Harga Beli</td><td> : $tampil[harga_beli]</td></tr>
<tr><td>Harga Jual</td><td> : $tampil[harga_jual]</td></tr>
</table></br></br><a href='index.php?modul=produk&aksi=tampil'><b>Kembali</b></a></center>";
}
}else{
echo 'Data Gagal Dimasukkan. Mohon Periksa Kembali Data Yang Dimasukkan.</br>
Kemungkinan Data Yang dimasukkan tidak benar atau kode barang yang dimasukkan sudah ada Sebelumnya.</br>';
}
								}
break;

//UPDATE USER
case "update":
mysqli_query($con, "UPDATE produk SET id_barang='$_POST[id_barang]',
                                brand ='$_POST[brand]',
                                nama_barang='$_POST[nama_barang]',
                               satuan='$_POST[satuan]',
			kategori ='$_POST[kategori]',
			stock =$_POST[stock],
			harga_beli =$_POST[harga_beli],
			harga_jual =$_POST[harga_jual]
where id_barang='$_GET[no_produk]'");
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=produk&aksi=tampil"\' ,0);</script>';
break;
}

}
?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>