<?php
if((!isset($_SESSION['user'])) || ($_SESSION['level']!="Admin")) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
echo "<center>";
Echo '
<form action="modul/laporan/lap_keuangan.php" target="_blank" method="POST" name="postform"> ';
echo "
Dari Tanggal : 
<input type='text' name='dari' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.dari);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.dari);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a>
</br>Sampai Tanggal :<input type='text' name='sampai' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.sampai);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.sampai);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a></br></br><input type='submit' value='Cetak' style='background-color:#006699; color:#fff; line-height:30px;cursor:pointer;border:hidden;'/></form>";
break;
}

}
?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>