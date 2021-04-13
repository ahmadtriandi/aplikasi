<?php
//buat konkesi
include "../../koneksi/koneksi.php";

//pencarian nama
$key=$_GET['id_barang'];
$result=mysqli_query($con, "SELECT nama_barang,harga_beli from produk where id_barang = '$key'"); 
$get_pages=mysqli_num_rows($result);

if ($get_pages){
	?>
		
	<?php

	while ($row=mysqli_fetch_array($result)){
		$id_bt=$row['nama_barang'];
		?>
			<input type='text' size='23' name='nama_barang' value='<?php echo $id_bt; ?>'/ disabled>
			<input type='text' size='10' name='harga_jual' value='<?php echo $row['harga_beli']; ?>'/ disabled>
		
		<?php
	}
	
	?>
		<?php
}else{
	?><b><input type='text' size='23' disabled><input type='text' size='10' disabled></b><?php
}
?>