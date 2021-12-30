<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

//include '../app/class/class.select.php';
//$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "ceknip":
		$dbpdo = DB::create();
		
		$old_nip	= $_POST["old_nip"];
		$nip 		= $_POST["nip"];	
		
		$sqlstr = "select nip from pegawai where nip<>'$old_nip' and nip='$nip' limit 1 ";		
		$sql 	= $dbpdo->prepare($sqlstr);
		$sql->execute();
		$data 	= $sql->fetch(PDO::FETCH_OBJ); 
		$nip2	= $data->nip;
				
		if($nip2 != '') {
?>		
			<td id="nip_id"><input type="text" name="nip" id="nip" style="width:100px; height:16px;" value="" onblur="loadHTMLPost3('app/pegawai_ajax.php','nip_id','ceknip','old_nip','nip')" >
			<font color="#FF0000" size="-1">NIP sudah digunakan !</font></td>	
<?php	
		} else {
?>
			<td id="nip_id"><input type="text" name="nip" id="nip" style="width:100px; height:16px;" value="<?php echo $nip; ?>" onblur="loadHTMLPost3('app/pegawai_ajax.php','nip_id','ceknip','old_nip','nip')" ></td>
<?php
		}
		break;
			
	default:
	
}
?>