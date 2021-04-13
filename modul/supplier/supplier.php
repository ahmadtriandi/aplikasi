<?php
if(!isset($_SESSION["user"])) {
	header("Location: index.php");}
	else{
		switch ($_GET["aksi"]) {
		//INTERFACE TABLE BROWSER
			case "tampil";
			$sqlCount = "select count(id_supplier) from supplier";
			$rsCount = mysqli_fetch_array(mysqli_query($con, $sqlCount));
			$banyakData = $rsCount[0];
			$page = isset($_GET['page']) ? $_GET["page"] : 1;
			$limit = 10;
			$mulai_dari = $limit * ($page - 1);
			$sql_limit = "select * from supplier order by nama limit $mulai_dari, $limit";
			$query=mysqli_query($con, $sql_limit);;

			echo"<h2>Data Supplier</h2>";
			echo"<input type=button style='background-color:#006699; color:#fff; line-height:30px;cursor:pointer;border:hidden;' value='Tambah Data Supplier' onclick=location.href='?modul=supplier&aksi=tambahsupplier'></br></br>";
			echo"<center><table id='tabel' style='width:800px; font-size:11px;'>
			<tr bgcolor='#006699' style=\"color:#FFFFFF\" align='center' height='25px'>
			<td width='15%'>KODE SUPPLIER</td>
			<td width='25%'>NAMA SUPPLIER</td>
			<td width='35%'>ALAMAT</td>
			<td width='15%'>TELEPON</td>
			<td width='10%' colspan='2'>AKSI</td>";

			$no=1;
			$baris=1;
			while($tampil=mysqli_fetch_array($query)) { 
				if($baris%2==0) {
					echo "<tr bgcolor=\"#e4e3e8\" height='20px'>"; 
				}
			else {
				echo "<tr bgcolor=\"#FFFFFF\" height='20px'>"; 
			}
			echo"<td>$tampil[id_supplier]</td>";
			echo"<td>$tampil[nama]</td>";
			echo"<td>$tampil[alamat]</td>";
			echo"<td>$tampil[telp]</td>";
			echo"<td><a href=?modul=supplier&aksi=editsupplier&no=$tampil[id_supplier]><img src='images/edit128px.png' width='24px' title='Edit'></td>";
			echo"<td><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=supplier&aksi=hapus&id=$tampil[id_supplier]'><img src='images/delete128px.png' width='24px' title='Hapus'></td>";
			$no++;
			$baris++;}
			echo"</tr>";
			echo"</table></center>";
			$banyakHalaman = ceil($banyakData / $limit);
			echo '</br><div id="page" style="font-size:14px">Halaman: ';
			for($i = 1; $i <= $banyakHalaman; $i++){
				if($page != $i){
					echo '  [<a href="index.php?modul=supplier&aksi=tampil&page='.$i.'">'.$i.'</a>]  ';
				}
				else {
					echo "[<span style='color:green'>$i</span>] ";
				}
			}
			break;

			//INTERFACE TAMBAH
			case "tambahsupplier":
			echo"<h2>Tambah Data Supplier</h2>";
			echo "<center><table id='tabeledit'><form action='?modul=supplier&aksi=input' name='postform' method=POST>
			<tr><td>Kode Supplier : </td><td>
			<input type='text' name='id_supplier' size='40' maxlength='10'></td></tr>
			<tr><td>Nama Supplier : </td><td>
			<input type=text name='nama'  size='40' maxlength='40'></td></tr>
			<tr><td>Alamat : </td><td>
			<input size='40' type='text' name='alamat' maxlength='100' />
			</td></tr>
			<tr><td>Nomor Telepon : </td><td>
			<input size='40' type=text name='telp' maxlength='30'></td></tr>
				<tr><td colspan=2 align=center><input type=submit value='Save'>
						<input type=button onclick=self.history.back()  value='Batal'>
				</td></tr></form></table></center>";
			break;


			//INTERFACE EDITUSER
			case "editsupplier":
			echo"<h2>Edit Data Supplier</h2>";
			$db="SELECT * from supplier where id_supplier='$_GET[no]'";
			$qri=mysqli_query($con, $db);
			$row=mysqli_fetch_array($qri);
			echo"<form action='?modul=supplier&aksi=update&id_supplier=$row[id_supplier]' name='postform2' method=POST>";
			echo"<center><table id='tabeledit'>";
			echo"<tr><td>Kode Supplier : </td><td><input style='background-color:#eeeeff'; readonly='1' type=text name='id_supplier' value='$row[id_supplier]'></td></tr>";
			echo"<tr><td>Nama Supplier : </td><td><input type=text name='nama' value='$row[nama]'></td></tr>";
			echo"<tr><td>Alamat : </td><td><input type=text name='alamat' value='$row[alamat]'></td></tr>";
			echo"<tr><td>Nomor Telepon : </td><td><input type=text name='telp' value='$row[telp]'></td></tr>";
			echo"<tr><td colspan=2 align=center><input type=submit name='save'  value='UpDate'>
				<input type=button onclick=self.history.back()  value='Batal'></td></tr>";
			echo"</table></center>";
	
			break;

			//HAPUS
			case "hapus":
			mysqli_query($con, "DELETE FROM supplier WHERE id_supplier='$_GET[id]'");
				echo '<script>setTimeout(\'location.href="?modul=supplier&aksi=tampil"\' ,0);</script>';
			break;

			//INPUT
			case "input":
			$querycek=mysqli_query($con, "select * from supplier where id_supplier = '$_POST[id_supplier]'");
			$tampilcek=mysqli_fetch_array($querycek);
			if (empty($_POST['id_supplier']) or empty($_POST['nama'])){
				echo"<p>Salahsatu Textbox tidak terisi<input type='button' onclick=self.history.back() value='back'/>";
			}
			elseif ($tampilcek['id_supplier'] == $_POST['id_supplier']){
				echo '<script>alert(\'Data Dengan ID ini Sudah Ada . . ! !\')
				setTimeout(\'location.href="?modul=supplier&aksi=tampil"\' ,0);</script>';
			}
			else {
				mysqli_query($con, "INSERT INTO supplier VALUES('$_POST[id_supplier]','$_POST[nama]','$_POST[alamat]','$_POST[telp]')");
				echo 'Data Berhasil Dimasukkan Dengan Data Sebagai Berikut :</br></br>';
				$query=mysqli_query($con,"select * from supplier where id_supplier = '$_POST[id_supplier]'");
				while($tampil=mysqli_fetch_array($query)){ 
					echo"<center><table border='0' style='width:300px; font-size:11px;' align='center'>
					<tr><td width='50%'>No Supplier</td><td> : $tampil[id_supplier]</td></tr>
					<tr><td>Nama Supplier</td><td> : $tampil[nama]</td></tr>
					<tr><td>No Telepon</td><td> : $tampil[telp]</td></tr>
					</table></br></br><a href='index.php?modul=supplier&aksi=tampil'><b>Kembali</b></a></center>";
				}
			}
			break;

			//UPDATE USER
			case "update":
			mysqli_query($con, "UPDATE supplier SET id_supplier='$_POST[id_supplier]',
			                                nama ='$_POST[nama]',
			                               alamat='$_POST[alamat]',
						telp ='$_POST[telp]'
			where id_supplier='$_GET[id_supplier]'");
			echo '<script>alert(\'Data Berhasil Diedit\')
				setTimeout(\'location.href="?modul=supplier&aksi=tampil"\' ,0);</script>';
			break;
			}

			}
			?>
			<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
			</iframe>