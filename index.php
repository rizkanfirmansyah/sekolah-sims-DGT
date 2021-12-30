<?php
session_start();
						
error_reporting(E_ALL & ~E_NOTICE);

ob_start();
//include_once ("app/include/queryfunctions.php");
include("app/include/sambung.php");
include("app/include/functions.php");
include("app/include/function_login.php");

if (($_SESSION["logged"] == 1)) {
	header("Location: main.php");
}

include("login.php");
?>