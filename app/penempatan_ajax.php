<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

//include '../app/class/class.select.php';
//$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getkelompok":
		$idproses = $_POST["idproses"];	
			
?>		
		<option value=""></option>
		<?php select_kelompokpsb($idproses,$idkelompok); ?>
		
<?php
		
		break;
		
	case "getkelas":
		$idtingkat = $_POST["idtingkat"];	
			
?>		
		<option value=""></option>
		<?php select_kelas($idtingkat, $idkelas); ?>
		
<?php
		
		break;		
				
	default:
	
}
?>