<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta name="viewport" content="width=device-width" charset="utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css"/>
<title>BEST CELL</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="javascript/autocomplete/jquery.autocomplete.css" />
<script type="text/javascript" src="javascript/autocomplete/jquery.js"></script>
<script type="text/javascript" src="javascript/autocomplete/jquery.autocomplete.js"></script>
<script language="javascript" src="modul/pencarian/caritransaksi.js"></script>
<script language="javascript" src="modul/pencarian/caripelanggan.js"></script>
<script language="javascript" src="modul/pencarian/cariproduk.js"></script>
<script language="javascript" src="modul/pencarian/cariretur.js"></script>
<script language="javascript" src="modul/pencarian/cariretursup.js"></script>
<script language="javascript" src="modul/penjualan/ajax.js"></script>
<script language="javascript" src="modul/pembelian/ajax.js"></script>
<script type="text/javascript">
  function numberFormat(nr) {
  //remove the existing
  var regex = /,/g;
  nr        = nr.replace(regex,'');

  //split it into 2 parts
  var x   = nr.split(',');
  var p1  = x[0];
  var p2  = x.length > 1 ? ',' + x[1] : '';
  
  //match group of 3 numbers (0-9) and add ',' between them
  regex   = /(\d+)(\d{3})/;
  while(regex.test(p1)) {
    p1 = p1.replace(regex, '$1' + ',' + '$2');
  }

  //join the 2 parts and return the formatted number
  return p1 + p2;
        }
</script>

<script type="text/javascript">
  function showUser(str)
  {
  if (str=="")
    {
    document.getElementById("tampilkan").innerHTML="";
    return;
    } 
  if (window.XMLHttpRequest)
    {
    xmlhttp=new XMLHttpRequest();
    }
  else
    {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
      document.getElementById("tampilkan").innerHTML=xmlhttp.responseText;
      }
    }
  xmlhttp.open("GET","modul/penjualan/proses.php?q="+str,true);
  xmlhttp.send();
  }
</script>

<script>
 $(document).ready(function(){
  $("#pelanggan").autocomplete("modul/penjualan/tampilpelanggan.php", {
        selectFirst: true
  });
 });
</script>
<script>
 $(document).ready(function(){
  $("#supplier").autocomplete("modul/pembelian/tampilsupplier.php", {
        selectFirst: true
  });
 });
</script>
<script>
 $(document).ready(function(){
  $("#id_barang").autocomplete("modul/penjualan/tampiltransaksi.php", {
        selectFirst: true
  });
 });
</script>
<script>
 $(document).ready(function(){
  $("#kode_barang").autocomplete("modul/penjualan/autocomplete.php", {
        selectFirst: true
  });
 });
</script>
<script>
 $(document).ready(function(){
  $("#kode_buku").autocomplete("modul/produk/autocomplete2.php", {
        selectFirst: true
  });
 });
</script>
</head>
<body>
<center>
<table id="template" align="center"><tr>
<td id="header" style="background:url(images/header.jpg);"></td>
</tr>

<tr><td>

<br> 
<hr style="height:2px;border-width:0;color:gray;background-color:gray"> 
<br>
<?php
include "menu/menu.php";
?>
</td>
</table>
<table id="konten" align="center"><tr><td>


<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$pecah1 = explode("-", $tglsekarang);
$date1 = $pecah1[2];
$month1 = $pecah1[1];
$year1 = $pecah1[0];
$sekarang = GregorianToJD($month1, $date1, $year1);
$valid = "2500-03-07";
$pecah2 = explode("-", $valid);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
$valid2 = GregorianToJD($month2, $date2, $year2);
$selisih = $valid2 - $sekarang;


if($selisih < 0){
  echo "POS System di NON AKTIFKAN, Silahkan hubungi system administrator anda";}
  else{
    include "koneksi/koneksi.php";
    if (isset($_GET["modul"])) {
      switch($_GET["modul"]){
        case "login";
        include "modul/login/input.php";
        break;
        case "anggota";
        include "modul/anggota/anggota.php";
        break;
        case "laporan";
        include "modul/laporan/laporan.php";
        break;
        case "laporanpembelian";
        include "modul/laporanpembelian/laporanpembelian.php";
        break;
        case "laporanharian";
        include "modul/laporanharian/laporanharian.php";
        break;
        case "laporankeluar";
        include "modul/laporankeluar/laporankeluar.php";
        break;
        case "pembelian";
        include "modul/pembelian/pembelian.php";
        break;
        case "penjualan";
        include "modul/penjualan/penjualan.php";
        break;
        case "retur";
        include "modul/retur/retur.php";
        break;
        case "retursup";
        include "modul/retursup/retursup.php";
        break;
        case "produk";
        include "modul/produk/produk.php";
        break;
        case "user";
        include "modul/user/user.php";
        break;
        case "pelanggan";
        include "modul/pelanggan/pelanggan.php";
        break;
        case "supplier";
        include "modul/supplier/supplier.php";
        break;
        case "piutang";
        include "modul/piutang/piutang.php";
        break;
        case "piutangsup";
        include "modul/piutangsup/piutangsup.php";
        break;
        case "buktipiutang";
        include "modul/buktipiutang/buktipiutang.php";
        break;
        case "buktipiutangsup";
        include "modul/buktipiutangsup/buktipiutangsup.php";
        break;
        case "cfmasuk";
        include "modul/cfmasuk/cfmasuk.php";
        break;
        case "cfkeluar";
        include "modul/cfkeluar/cfkeluar.php";
        break;
        case "pencarian";
        include "modul/pencarian/cari.php";
        break;
        case "backup";
        include "modul/backup/backup.php";
        break;
        case "restore";
        include "modul/backup/recovery_data.php";
        break;
        case "login";
        include "login/aksilogin.php";
        break;
      }
    }
    else{ ?>
      <?php if(!isset($_SESSION["user"])) : ?>
        <center><div id="background" style="background-color:#0081D7; width:350px; padding-top:15px; padding-bottom:15px;" >
              <h4><div style="font-family:arial">FORM LOGIN</div></h4>
              <img src="images/login.png" alt="" width="120"/>	
    		      <form action="login/aksilogin.php" method="post">
    			     <table id="login" border="0">
    			       <tr><td><label for="username">Username </td><td>: <input type="text" name="user" id="username"/></td></tr>
    			       <tr><td><label for="password">Password </td><td>: <input type="password" name="password" id="password"/></td></tr>
    			       <tr><td colspan="2"><br><center><input type="reset" value="RESET" style="background-color:#FF3300; color:#fff; line-height:30px;cursor:pointer;border:hidden;"> <input type="submit" value="LOGIN" style="background-color:#789F00; color:#fff; line-height:30px;cursor:pointer;border:hidden;" ></center></td></tr>
    			      </table>
    		      </form></div>
              </center>
      
      <?php else : ?>
        </br></br>Selamat Datang di Aplikasi <b>POS-WEB </b>(Aplikasi Penjualan & Pembelian Barang berbasis Web)</br>
       Untuk memulai proses atau transaksi, Silahkan klik icon atau tombol menu yang tersedia di bagian atas.</br></br></br>
        Anda Login sebagai User: <b><?=$_SESSION['user']?></b> | Level: <b><?= $_SESSION["level"] ?></b> <br> <br> <a href="login/aksilogout.php">Logout</a></br>
      <?php endif; ?>
      <?php
    }
  } ?>
  </div></td></tr></table>
<div id="footer">Copyright <?=date('Y')?> Best Celular</div>

</center>
</body>
</html>';
