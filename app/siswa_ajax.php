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
		<select name="idtingkat" id="idtingkat" style="width:auto; height:27px; " onClick="loadHTMLPost2('app/siswa_ajax.php','idkelas','getkelas','idtingkat')" />
			<option value=""></option>
			<?php select_tingkat_unit($departemen, $siswa->idtingkat); ?>
		</select>
		&nbsp;&nbsp; Kelas *)
		
			<select name="idkelas" id="idkelas" style="width:auto; height:27px; " />
				<option value=""></option>
				<?php select_kelas($siswa->idtingkat, $siswa->idkelas); ?>
			</select>
		
<?php	
		break;
			
	default:
	
}
?>