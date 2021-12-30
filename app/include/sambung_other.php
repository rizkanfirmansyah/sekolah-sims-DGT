<?php //localhost
/*--------database ------*/
/*define("HOST1", "localhost");
define("PORT1", 3306);
define("USER1", "root");
define("PASS1", "");
define("DB1", "sekolahtunas");

$host1=HOST1; 
$userdb1=USER1;
$passdb1=PASS1;
$mydb1=DB1;
$condb1=@mysql_connect($host1,$userdb1,$passdb1);
@mysql_select_db($mydb1,$condb1);*/


$db_host = "localhost";
$db_user = "dianglo3_sekolah";
$db_pass = "1qaZ2wsX";
$db_name = "dianglo3_sekolah";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

/*if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
}else{
	echo 'Koneksi berhasil ^_^';
}
*/
?>