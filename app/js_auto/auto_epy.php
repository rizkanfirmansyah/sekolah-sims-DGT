<?php
include_once ("../include/queryfunctions.php");
include_once ("../include/functions.php");

$no = $_REQUEST['no'];

	if(isset($_POST['queryString'])) {
		$queryString = $_POST['queryString'];
		
		if(strlen($queryString) >0) {
			
			$sql="select a.NIP EpyCde, a.NamaKaryawan EpyDcr, a.Pangkat, a.Golongan, a.Jabatan, b.SubDitNme SubDit from Karyawan a left join KaryawanSubDit b on a.SubDitCde=b.SubDitCde Where a.NIP like '%$queryString%' or a.NamaKaryawan like '%$queryString%' order by a.NamaKaryawan";
			$query = odbc_exec(condb, $sql);
			if($query) {
			echo '<ul>';
				while ($result2 = odbc_fetch_array($query)) {
					echo '<li onClick="fill_'.$no.'(\''.addslashes($result2[EpyDcr]).'\'); fill2_'.$no.'(\''.addslashes($result2[EpyCde]).'\'); fill3_'.$no.'(\''.addslashes($result2[Pangkat]).'\'); fill4_'.$no.'(\''.addslashes($result2[Golongan]).'\'); fill5_'.$no.'(\''.addslashes($result2[Jabatan]).'\'); fill6_'.$no.'(\''.addslashes($result2[SubDit]).'\'); ">'.$result2[EpyDcr].'&nbsp;&nbsp;'.$result2[EpyCde].'</li>';
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