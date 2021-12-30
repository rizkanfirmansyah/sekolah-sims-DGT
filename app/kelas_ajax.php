<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$pilih = $_POST["button"];
switch ($pilih){
	case "gettingkat":
		$departemen = $_POST["departemen"];	
		
?>		
		<select name="idtingkat" id="idtingkat" style="width:auto; height:27px; " />
			<option value=""></option>
			<?php select_tingkat_unit($departemen, "") ?>
		</select>
		
<?php
		break;
			
	default:
	
}
?>