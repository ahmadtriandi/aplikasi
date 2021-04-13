<?php
session_start();
include("../koneksi/koneksi.php");



 // ambil nilai form 
$user = htmlentities(strip_tags(trim($_POST["user"])));
$password = htmlentities(strip_tags(trim($_POST["password"])));

// filter dengan mysqli_real_escape_string
$username = mysqli_real_escape_string($con,$user);
$password = mysqli_real_escape_string($con,$password);
 // generate hashing 
    $password_md5 = md5($password);

$query = "SELECT *FROM login WHERE user = '$user' AND password = '$password_md5'";
$login = mysqli_query($con,$query);

$query2 = "SELECT *FROM login WHERE user = '$user' AND password = '$password_md5'";
$login2 = mysqli_query($con,$query);





// // origin
// $login = mysqli_query("select * from login where user = '" . $_POST['user'] . "' and password = '".md5($_POST['password'])."'",$con);
// $login2 = mysqli_query("select * from login where user = '" . $_POST['user'] . "' and password = '".md5($_POST['password'])."'",$con);

$rowcount = mysqli_num_rows($login);
$rowcount2 = mysqli_fetch_array($login2);
if ($rowcount == 1) {
$_SESSION["user"] = $user;
$_SESSION["password"] = $password;
$_SESSION["level"] = $rowcount2["level"];
header("Location: ../index.php");
}
else
{
echo '<html>
<head>
<link href="style/style.css" rel="stylesheet" type="text/css"/>
<title>LOGIN GAGAL !!!</title>
</head>
<body>
<center>';
echo "<img src=\"../images/error.png\" width=\"100px\"/><h2>Login Gagal ..!!</h2>Cek user dan Password Anda..!!</br></br>
<input type=\"submit\" onclick=self.history.back() value=\"Kembali\">";
echo'
</center>	
</body>
</html>';
}
?>