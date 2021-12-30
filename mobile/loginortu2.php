<?php
include_once ("../app/include/sambung.php");

$vUsername = $_POST['Username'];
$vPassword = $_POST['Password'];

$dbpdo = DB::create();
$sqlstr = "select replid, pinortu from siswa where pinortu='$vUsername' limit 1";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$rows = $sql->rowCount();
//$datasiswa = $sql->fetch(PDO::FETCH_OBJ);
 
if( $rows > 0){
	echo ' pinortu';
}else{
	echo 'error bro';
}
?>