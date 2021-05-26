<!-- <?php
// $server   ="localhost" ;
// $username ="root";
// $password ="root";
// $database ="dbstock";
// $con= @mysqli_connect("$server","$username","$password")or die ("Server Tidak Ditemukan");
// $db= @mysqli_select_db("$con","$database")or die ("Database Tidak Ditemukan");
?> -->

<?php
$con = mysqli_connect("localhost","root","root","dbstock");

// $db= @mysqli_select_db($con,"posweb1")or die ("Database Tidak Ditemukan");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>