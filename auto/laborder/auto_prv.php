<?php   
	include("../../app/include/sambung.php");
	
	$no = $_GET["no"];
	
	if(isset($_POST['queryString'])) {
		$queryString = $_POST['queryString'];
		
		if(strlen($queryString) >0) {	
			$query=odbc_exec(condb, "select ProCde, ProNme from Pro where (Procde like '$queryString%' or ProNme like '%$queryString%') order by ProNme ");
			
			if($query) {
			echo '<ul>';
				while ($result = odbc_fetch_object($query) ) {
					echo '<li onClick="fill_'.$no.'(\''.addslashes($result->ProNme).'\'); fill2_'.$no.'(\''.addslashes($result->ProCde).'\'); ">'.$result->ProCde.'&nbsp;&nbsp;'.$result->ProNme. '</li>';
				}
			echo '</ul>';
				
			} else {
				echo 'OOPS we had a problem :(';
			}
		} else {
			// do nothing
		}
	} else {
		echo 'There should be no direct access to this script!';
	}
	
?>