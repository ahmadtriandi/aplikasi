<?php
 $q=$_GET['q'];
  include "../../koneksi/koneksi.php";
 $my_data=mysqli_real_escape_string($con,$q);
 //$mysqli=mysql_connect('localhost','root','','databasename') or die("Database Error");
 $sql="SELECT id_barang FROM produk where id_barang like '%$my_data%' ORDER BY id_barang";
 $result = mysqli_query($con, $sql) or die(mysqli_error());

 if($result)
 {
  while($row=mysqli_fetch_array($result))
  {
   echo $row['id_barang']."\n";
  }
 }
?>