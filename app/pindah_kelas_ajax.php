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
		
		break;
	
		case "getkelas2":
		$idtingkat2 = $_POST["idtingkat2"];	
			
?>		
		<option value=""></option>
		<?php select_kelas($idtingkat2, ""); ?>
		
<?php
		
		break;
				
	default:
	
}
?>