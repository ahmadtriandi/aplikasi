
<form action="" method="post" name="postform">
	<div align="center">
	  <p><em>Aplikasi ini digunakan untuk <strong><a href="?modul=backup">backup</a></strong> dan <strong><a href="?modul=restore">restore</a></strong> semua data yang ada didalam database &quot;<strong>POS WEB</strong>&quot;.</em></p>
	  <p>
	  <div id="formsubmitbutton">
	    <input type="submit" style="background-color:#789F00; color:#fff; line-height:30px;cursor:pointer;border:hidden;" name="backup"  onclick="ButtonClicked()" value="Proses Backup" />
		</div>
		<div id="buttonreplacement" style="margin-left:30px; display:none;">
<img src="images/loading.gif" alt="loading...">
</div>
	  </p>
  </div>
</form>
</p>


<script type="text/javascript">
/*
   Replacing Submit Button with 'Loading' Image
   Version 2.0
   December 18, 2012

   Will Bontrager Software, LLC
   http://www.willmaster.com/
   Copyright 2012 Will Bontrager Software, LLC

   This software is provided "AS IS," without 
   any warranty of any kind, without even any 
   implied warranty such as merchantability 
   or fitness for a particular purpose.
   Will Bontrager Software, LLC grants 
   you a royalty free license to use or 
   modify this software provided this 
   notice appears on all copies. 
*/
function ButtonClicked()
{
   document.getElementById("formsubmitbutton").style.display = "none"; // to undisplay
   document.getElementById("buttonreplacement").style.display = ""; // to display
   return true;
}
var FirstLoading = true;
function RestoreSubmitButton()
{
   if( FirstLoading )
   {
      FirstLoading = false;
      return;
   }
   document.getElementById("formsubmitbutton").style.display = ""; // to display
   document.getElementById("buttonreplacement").style.display = "none"; // to undisplay
}
// To disable restoring submit button, disable or delete next line.
document.onfocus = RestoreSubmitButton;
</script>

<?php
if(isset($_POST['backup'])){

	//membuat nama file
	$file=date("DdMY").'_penjualan_backup_data_'.time().'.sql';
	include "koneksi/koneksi.php";
	//panggil fungsi dengan memberi parameter untuk koneksi dan nama file untuk backup
	backup_tables("$server","$username","","$database",$file);
	
	?>
	<p align="center">&nbsp;</p>
	<p align="center"><a style="cursor:pointer" onclick="location.href='backup/<?php echo $file;?>'" title="Download">Backup database telah selesai. <font color="#0066FF">Simpan file database</font></a>
</p>
	<?php
}else{
	unset($_POST['backup']);
}

/*
untuk memanggil nama fungsi :: jika anda ingin membackup semua tabel yang ada didalam database, biarkan tanda BINTANG (*) pada variabel $tables = '*'
jika hanya tabel-table tertentu, masukan nama table dipisahkan dengan tanda KOMA (,) 
*/
function backup_tables($host,$user,$pass,$name,$nama_file,$tables = '*')
{
	//untuk koneksi database
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}else{
		//jika hanya table-table tertentu
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//looping dulu ah
	foreach($tables as $table)
	{
	error_reporting(0);
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		//menyisipkan query drop table untuk nanti hapus table yang lama
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				//menyisipkan query Insert. untuk nanti memasukan data yang lama ketable yang baru dibuat. so toy mode : ON
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					error_reporting(0);//akan menelusuri setiap baris query didalam
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//simpan file di folder yang anda tentukan sendiri. kalo saya sech folder "DATA"
	$nama_file;
	
	$handle = fopen('./backup/'.$nama_file,'w+');
	fwrite($handle,$return);
	fclose($handle);
}
?>

</body>
</html>

