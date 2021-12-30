<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

//include '../app/class/class.select.php';
//$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "gettingkat":
		$departemen = $_POST["departemen"];
		
?>		
		<option value=""></option>
		<?php select_tingkat_unit($departemen, $idtingkat); ?>
		

<?php	
		break;
		
	case "getsemester":
		$idtingkat = $_POST["idtingkat"];	
		$departemen = $_POST["departemen"];
		
?>		
		<option value=""></option>
		<?php select_semester($departemen, $rpp_data->idsemester); ?>
		

<?php	
		break;
	
	case "getpelajaran":
		$departemen = $_POST["departemen"];
			
?>		
		<option value=""></option>
		<?php select_pelajaran($departemen, $rpp_data->idpelajaran); ?>
		

<?php	

		break;
        				
	default:
	
}
?>