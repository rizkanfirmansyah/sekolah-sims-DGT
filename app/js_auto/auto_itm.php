<?php
include_once ("../include/queryfunctions.php");
include_once ("../include/functions.php");
include_once ("../../app/class/class.functions.php");

$functions = new functions;

$no = $_REQUEST['no'];

	if(isset($_POST['queryString'])) {
		$queryString = $_POST['queryString'];
		
		if(strlen($queryString) >0) {
			
			$sql="select aa.*, 1 Qty from ( select NamaBarang ItmDcr, IdBarang ItmCde, Kapasitas, IdLab, TrfUmum, TrfDidik, TrfVeri, 'izin' Type, Satuan From Barang where year(createdDate)>=2012
                   Union All
                   select NamaBarang ItmDcr, Ref ItmCde, '' Kapasitas, IdLab, 0 TrfUmum, 0 TrfDidik, 0 TrfVeri, 'range' Type, Satuan From Barang_Range) aa
                   Where  aa.ItmCde like '%$queryString%' or aa.ItmDcr like '%$queryString%' order by aa.ItmDcr";
			$query = odbc_exec(condb, $sql);
			if($query) {
			echo '<ul>';
				while ($result2 = odbc_fetch_array($query)) {
					
					$hasil = $functions->Formula_Tera($result2[ItmCde], 0, 0);
					
					echo '<li onClick="fillx_'.$no.'(\''.addslashes($result2[ItmDcr]).'\'); fillx2_'.$no.'(\''.addslashes($result2[ItmCde]).'\'); fillx3_'.$no.'(\''.addslashes($result2[Qty]).'\'); fillx5_'.$no.'(\''.addslashes($result2[Satuan]).'\'); fillx6_'.$no.'(\''.addslashes($hasil).'\'); fillx7_'.$no.'(\''.addslashes($hasil).'\'); fillx9_'.$no.'(\''.addslashes($result2[IdLab]).'\'); fillx10_'.$no.'(\''.addslashes($result2[Type]).'\');  ">'.$result2[ItmDcr].'&nbsp;&nbsp;('.$result2[ItmCde].')</li>';
					//echo '<li onClick="fillx_'.$no.'(\''.addslashes($result2[ItmDcr]).'\'); fillx2_'.$no.'(\''.addslashes($result2[ItmCde]).'\'); fillx3_'.$no.'(\''.addslashes($result2[Qty]).'\'); fillx4_'.$no.'(\''.addslashes($result2[Kapasitas]).'\'); fillx5_'.$no.'(\''.addslashes($result2[Satuan]).'\'); ">'.$result2[ItmDcr].'&nbsp;&nbsp;('.$result2[ItmCde].')</li>';
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