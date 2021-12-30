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
			
			$sql="select NIP EpyCde, NamaKaryawan EpyDcr from Karyawan Where NIP like '%$queryString%' or NamaKaryawan like '%$queryString%' order by NamaKaryawan";
			$query = odbc_exec(condb, $sql);
			if($query) {
			echo '<ul>';
				while ($result2 = odbc_fetch_array($query)) {
					echo '<li onClick="fillka(\''.addslashes($result2[EpyDcr]).'\'); fillka2(\''.addslashes($result2[EpyCde]).'\');">'.$result2[EpyDcr].'&nbsp;&nbsp;'.$result2[EpyCde].'</li>';
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