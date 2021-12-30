<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
ob_start();

if (($_SESSION["logged"] == 1)) {
	header("Location: main.php");
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sistem Informasi Manajemen Sekolah</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/jquery.fancybox.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body class='login_body'>
	<div class="wrap">
		<br>
		<h3 style="text-align: center">Sistem Informasi Manajemen Sekolah</h3>
		<br>
		<!--<h4 style="text-align: center">Login</h4>-->
		<form action="index.php"  autocomplete="off" method="post">
		<div class="login">
			<div class="email">
				<label for="user">User ID</label><div class="email-input"><div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span><input type="text" id="username" name="username"></div></div>
			</div>
			<div class="pw">
				<label for="pw">Password</label><div class="pw-input"><div class="input-prepend"><span class="add-on"><i class="icon-lock"></i></span><input type="password" id="password" name="password"></div></div>
			</div>
			<!--
			<div class="remember">
				<label class="checkbox">
					<input type="checkbox" value="1" name="remember"> Remember me on this computer
				</label>
			</div>-->
		</div>
		<div class="submit" align="right" style="margin-right: 20px">
			<!--<button class="btn btn-red5">Login</button>-->
			<input type="submit" class="btn btn-red5" name="login" id="login" value="Login"  />
		</div>
		</form>
		
		<?php								
			if (!empty($_POST["login"])){											
				switch($_POST["login"]){	
					case "Login":
						Login();
						break;
					case "Logout":
						echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#0033CC\"><b>Session successful ended.</b></font></center>";
						//setcookie("data_login","",time()-60);
						//ob_start();
						session_unset();
						session_destroy();
						header("Location: index.php");
						break;	
				}
			} 
		?>	
	</div>
<script src="js/jquery.js"></script>
</body>
</html>