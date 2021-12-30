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
		
case "getlevel":
		$departemen = $_POST["departemen"];
			
?>		
		<select name="idtingkat" id="idtingkat" style="width:auto;  height:20px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/rpt_penerimaan_ajax.php','idkelas','getkelas','idtingkat')" >
			<option value=""></option>
			<?php select_tingkat_unit($departemen, ""); ?>
		</select>
				
<?php
		
		break;		
			
	default:
	
}
?>