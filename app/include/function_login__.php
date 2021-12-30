<?php
function Login(){
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	if($username && $password) {
	  $pas = md5($password);
	  $sql_cek = "select pwd from usr where usrid='$username' and pwd='$pas' and act=1";
	  $hasil_cek = mysql_query($sql_cek);
	  $data_cek = mysql_fetch_array($hasil_cek);
	 
	  if (!empty($data_cek['pwd'])) {	  	  		
		  $conn=mysql_connect(HOST,USER,PASS) or die ("Whoops");
		  $password = md5($password); 
		  $sql = "select * from usr where usrid='$username' and pwd='$password' and act=1"; 
		  $r = mysql_query($sql);
		  $rr = mysql_fetch_array($r);
		  		  
		  if($rr['usrid'] != ""){
				mysql_close($conn);
				
				$sql="select pwd, usrid from usr where usrid='$username' and pwd='$password' and act=1";
				$password_r=mkr_query($sql,$conn);
				$password=mysql_fetch_array($password_r);
				
				$_SESSION["employee"]=$password['usrid']; // ." ". $password['sname'];
				$_SESSION["loginname"]=$password['usrid'];
				$_SESSION["userid"]=$password['usrid'];
				$password=$password['pwd'];		
				
				//******************************************************************
				//*Not the best option but produce the required results - unencrypted password saved to a cookie
				//******************************************************************
				//setcookie("data_login","$username $password",time()+60*30);  // Set the cookie named 'candle_login' with the value of the username (in plain text) and the password (which has been encrypted and serialized.)
				setcookie("data_login","$username $password");
				$_SESSION["logged"]=1;
											
				//echo $_SESSION["loginname"]; exit;
												
				header("Location: main.php");
				
				exit;
				/*echo "<script type='text/javascript'>";
				echo "window.location = 'main.php'";
				echo "</script>";  */
		  }else{
				$passed=@mysql_connect(HOST,USER,PASS);															
		  }
			
			mysql_select_db(DB);
			if (!$passed) {				
				echo "<center><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#FF0000\">Invalid User Name or Password</font></center>";     
				$_SESSION["logged"]=0;
				$_SESSION["userid"]="";
								
			}else{
				$sql="select pwd, usrid from usr where usrid='$username' and pwd='$password' and act=1";
				$password=mkr_query($sql,$passed);
				$password=mysql_fetch_array($password);
				$_SESSION["employee"]=$password['usrid']; // ." ". $password['sname'];
				$_SESSION["loginname"]=$password['usrid'];
				$_SESSION["userid"]=$password['usrid'];
				$password=$password['pwd'];		
				
				//******************************************************************
				//*Not the best option but produce the required results - unencrypted password saved to a cookie
				//******************************************************************
				//setcookie("data_login","$username $password",time()+60*30);  // Set the cookie named 'candle_login' with the value of the username (in plain text) and the password (which has been encrypted and serialized.)
				setcookie("data_login","$username $password");
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