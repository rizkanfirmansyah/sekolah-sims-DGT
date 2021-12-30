<?php
function Login(){
	$dbpdo = DB::create();
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	if($username && $password) {
	
	  $pas = md5(md5(md5(md5(md5(md5(md5($password.$username.strlen($password.$username)*15)))))));
	  $sql_cek = "select pwd from usr where usrid='$username' and pwd='$pas' and act=1";
	  $hasil_cek = $dbpdo->query($sql_cek);
	  $data_cek = $hasil_cek->fetch(PDO::FETCH_OBJ);
	  
	  if (!empty($data_cek->pwd)) {	  	  		
		  //$conn=@mysql_connect(HOST,USER,PASS) or die ("Whoops");
		  $password = md5(md5(md5(md5(md5(md5(md5($password.$username.strlen($password.$username)*15))))))); 
		  $sql = "select * from usr where usrid='$username' and pwd='$password' and act=1"; 
		  $r = $dbpdo->query($sql);
		  $rr = $r->fetch(PDO::FETCH_OBJ);
		  		  
		  if($rr->usrid != ""){
				//$dbpdo = null; //close connection
				
				$sql="select pwd, usrid, adm, departemen from usr where usrid='$username' and pwd='$password' and act=1";
				$password_r = $dbpdo->query($sql);
				$password_log = $password_r->fetch(PDO::FETCH_OBJ);
				
				$_SESSION["employee"]=$password_log->usrid; // ." ". $password['sname'];
				$_SESSION["loginname"]=$password_log->usrid;
				$_SESSION["userid"]=$password_log->usrid;
				$_SESSION["adm"]=$password_log->adm;
				$password=$password_log->pwd;
				$_SESSION["unit"]=$password_log->departemen;
				
				/*--------get tahun buku yg aktif--------------*/
				$sqltb = "select replid from tahunbuku where aktif=1 limit 1 ";
			    $hasiltb = $dbpdo->query($sqltb);
			    $datatb = $hasiltb->fetch(PDO::FETCH_OBJ);
			    $_SESSION["tahunbuku"]=$datatb->replid;
				
				//******************************************************************
				//*Not the best option but produce the required results - unencrypted password saved to a cookie
				//******************************************************************
				//setcookie("data_login","$username $password",time()+60*300);  // Set the cookie named 'candle_login' with the value of the username (in plain text) and the password (which has been encrypted and serialized.)
				//setcookie("data_login","$username $password");
				$_SESSION["logged"]=1;
											
				//echo $_SESSION["loginname"]; exit;
												
				if($_SESSION["Captcha"]!=$_POST["nilaicaptcha"]){
					//echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid Captcha Code</font></center>";
					$_SESSION["Captcha"]="";
					
					//$msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./main.php\">"; 
					//header("Location: main.php");
					
				} else {
					header("Location: main.php");
					exit;
					
				} 	
				/*echo "<script type='text/javascript'>";
				echo "window.location = 'main.php'";
				echo "</script>";  */
		  }else{
				//$passed=@mysql_connect(HOST,USER,PASS);		
				$passed = new PDO("mysql:host=$host;dbname=$mydb, $userdb, $passdb");													
		  }
			
			//@mysql_select_db(DB);
			if (!$passed) {				
				/*if($_SESSION["Captcha"] == "")	{	
					echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid Captcha Code</font></center>"; 
				} else { */
					echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid User Name or Password</font></center>";
				//}    
				$_SESSION["logged"]=0;
				$_SESSION["userid"]="";
			
			/*} else if($_SESSION["Captcha"]!=$_POST["nilaicaptcha"]){
				echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid Captcha Code</font></center>";     
				$_SESSION["logged"]=0;
				$_SESSION["userid"]="";
			*/					
			}else{
				$sql="select pwd, usrid, adm, departemen from usr where usrid='$username' and pwd='$password' and act=1";
				$password_r = $dbpdo->query($sql);
				$password_log = $password_r->fetch(PDO::FETCH_OBJ);
				
				$_SESSION["employee"]=$password_log->usrid; // ." ". $password['sname'];
				$_SESSION["loginname"]=$password_log->usrid;
				$_SESSION["userid"]=$password_log->usrid;
				$_SESSION["adm"]=$password_log->adm;
				$password=$password_log->pwd;		
				$_SESSION["unit"]=$password_log->departemen;
				
				/*--------get tahun buku yg aktif--------------*/
				$sqltb = "select replid from tahunbuku where aktif=1 limit 1 ";
			    $hasiltb = $dbpdo->query($sqltb);
			    $datatb = $hasiltb->fetch(PDO::FETCH_OBJ);
			    $_SESSION["tahunbuku"]=$datatb->replid;
			    
				//******************************************************************
				//*Not the best option but produce the required results - unencrypted password saved to a cookie
				//******************************************************************
				//setcookie("data_login","$username $password",time()+60*300);  // Set the cookie named 'candle_login' with the value of the username (in plain text) and the password (which has been encrypted and serialized.)
				//setcookie("data_login","$username $password");
				$_SESSION["logged"]=1;
								
				$msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./main.php\">"; //put index.php	
				
			}
		} else {
			echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid User Name or Password</font></center>";     
			$_SESSION["logged"]=0;
			$_SESSION["userid"]="";
		}
		
	}else{
		echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Enter your UserName and Password <br />to login on to the system</font></center>";
		$_SESSION["logged"]=0;
	}
	
	if($msg) echo $msg; 
}
?>