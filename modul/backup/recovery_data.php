<center>
<form enctype="multipart/form-data" action="?modul=restore" method="post">
	<p align="center"><em>Aplikasi ini digunakan untuk <strong><a href="index.php">backup</a></strong> dan <strong><a href="recovery_data.php">restore</a></strong> semua data yang ada didalam database &quot;<strong>POS WEB</strong>&quot;.</em></p>
	<table align="center">
	<tr><td>File Backup Database (*.sql) <input type="file" name="datafile" size="30" id="gambar" /></td></tr>
	<tr><td align="center">
	 <div id="formsubmitbutton"><br />
	 <?php
	 if ($_SESSION["user"]!="demo")
	 {
	 echo '
	<input type="submit" style="background-color:#FF6600; color:#fff; line-height:30px;cursor:pointer;border:hidden;" onclick="ButtonClicked()" name="restore" value="Restore Database" />';
	}
	else
	{
	echo '
	<input type="submit" style="background-color:#FF6600; color:#fff; line-height:30px;cursor:pointer;border:hidden;" onclick="ButtonClicked()" name="restore" value="RESTORE DATABASE (disabled)" disabled/>';
	}
	?>
	
	</div>
	<div id="buttonreplacement" style="margin-left:30px; display:none;">
<img src="images/loading.gif" alt="loading...">
</div></td>
	</tr>
	</table>
</form>
</center>
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
if(isset($_POST['restore'])){
include "koneksi/koneksi.php";
	
	$nama_file=$_FILES['datafile']['name'];
	$ukuran=$_FILES['datafile']['size'];
	
	//periksa jika data yang dimasukan belum lengkap
	if ($nama_file=="")
	{
		echo "Fatal Error";
	}else{
		//definisikan variabel file dan alamat file
		$uploaddir='./restore/';
		$alamatfile=$uploaddir.$nama_file;

		//periksa jika proses upload berjalan sukses
		if (move_uploaded_file($_FILES['datafile']['tmp_name'],$alamatfile))
		{
			
			$filename = './restore/'.$nama_file.'';
			
			// Temporary variable, used to store current query
			$templine = '';
			// Read in entire file
			$lines = file($filename);
			// Loop through each line
			foreach ($lines as $line)
			{
			set_time_limit(0);
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
			 
				// Add this line to the current segment
				$templine .= $line;
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';')
				{
					// Perform the query
					mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
					// Reset temp variable to empty
					$templine = '';
				}
			}
			echo "<center>Berhasil Restore Database, silahkan di cek.</center>";
		
		}else{
			//jika gagal
			echo "Proses upload gagal, kode error = " . $_FILES['location']['error'];
		}	
	}

}else{
	unset($_POST['restore']);
}
?>