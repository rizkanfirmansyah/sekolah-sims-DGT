<?php
include_once ("../include/queryfunctions.php");
include_once ("../include/functions.php");

/*
$condb = mysql_connect('localhost','root','');
mysql_select_db('sekolah',$condb);
$result =mysql_query($sql,$condb); */

	if(isset($_POST['queryString'])) {
		$queryString = $_POST['queryString'];
		
		if(strlen($queryString) >0) {
			
			$sql="Select ClientName, ClientID ClnCde from Client Where isnull(ClientName,'')<>'' and (ClientID like '%$queryString%' or ClientName like '%$queryString%') order by ClientName";
			$query = odbc_exec(condb, $sql);
			if($query) {
			echo '<ul>';
				while ($result2 = odbc_fetch_array($query)) {
					echo '<li onClick="fill(\''.addslashes($result2[ClientName]).'\'); fill2(\''.addslashes($result2[ClnCde]).'\');">'.$result2[ClientName].'&nbsp;&nbsp;'.$result2[ClnCde].'</li>';
				}
			echo '</ul>';
				
			} else {
				echo 'OOPS we had a problem :(';
			}
		} else {
			// do nothing
		}
	}
	
?>