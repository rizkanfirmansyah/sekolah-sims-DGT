<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

//include '../app/class/class.select.php';
//$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getkelas":
		$idtingkat = $_POST["idtingkat"];	
			
?>		
		<option value=""></option>
		<?php select_kelas($idtingkat, ""); ?>
		
<?php
	
	case "getkelas2":
		$idtingkat2 = $_POST["idtingkat2"];	
			
?>		
		<option value=""></option>
		<?php select_kelas($idtingkat2, ""); ?>
		
<?php	
		break;
		
	case "gettingkat":
		$departemen = $_POST["departemen"];	
			
?>		
		<option value=""></option>
		<?php select_tingkat_unit($departemen, $siswa->idtingkat); ?>
		
<?php	
		break;
		
	case "getsemester":
		$departemen = $_POST["departemen"];	
			
?>		
		<?php select_semester($departemen, $idsemester); ?>
		
<?php	
		break;
			
	default:
	
}
?>