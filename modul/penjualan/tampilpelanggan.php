<?php
 $q=$_GET['q'];
  include "../../koneksi/koneksi.php";
 $my_data=mysqli_real_escape_string($con,$q);
 //$mysqli=mysql_connect('localhost','root','','databasename') or die("Database Error");
 $sql="SELECT id_pelanggan,nama_pelanggan FROM pelanggan WHERE id_pelanggan LIKE '%$my_data%' or nama_pelanggan LIKE '%$my_data%' ORDER BY id_pelanggan";
 $result = mysqli_query($con,$sql) or die(mysql_error());

 if($result)
 {
  while($row=mysqli_fetch_array($result))
  {
   echo $row['id_pelanggan']."-".$row['nama_pelanggan']."\n";
  }
 }
?>