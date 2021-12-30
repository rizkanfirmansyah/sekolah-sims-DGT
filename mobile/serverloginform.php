<?php
$vUsername = $_POST['Username'];
$vPassword = $_POST['Password'];
 
if($vUsername == "user" && $vPassword == "123456"){
	echo ' Username dan Pasword Cocok Broooo';
}else{
	echo 'error bro';
}
?>