<?php
//include_once ("../app/include/queryfunctions.php");
//include_once ("../app/include/functions.php");

$pilih = $_POST["button"];
switch ($pilih){
	case "setsubcon":
		$vhctpe = $_POST['ItmCde_0'];
		echo 'xxxxxx'.$vhctpe;
		//if ($vhctpe == 'Sub') {
?>		
			<!--<tr id="vhcsub"> 
				<th align="left" width="5" style="padding-left:10px;">Nama Subcon</th> 
				<th align="left" width="1">:</th> 
				<th align="left" width="100"><input size="40" type="text" id="subconnme" name="subconnme" onKeyup="this.value=this.value.toUpperCase()" value="<?php echo $row_delord->subconnme ?>"></th>
			</tr>
			-->	
<?php
		//}
		
		break;
		
	default:
}
?>