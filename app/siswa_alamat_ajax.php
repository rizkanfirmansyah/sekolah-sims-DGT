<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

//include '../app/class/class.select.php';
//$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getkota":
		$provinsi_kode = $_POST["provinsi_kode"];	
			
?>		
			<select name="kota_kode" id="kota_kode" style="width:auto; height:27px; " onChange="loadHTMLPost2('app/siswa_alamat_ajax.php','kecamatan','getkecamatan','kota_kode')" />												
					<option value=""></option>
					<?php select_kota($provinsi_kode, ""); ?>
			</select>
		
<?php
		break;
		
	case "getkecamatan":
		$kota_kode = $_POST["kota_kode"];	
			
?>				
			<select name="kecamatan_kode" id="kecamatan_kode" style="width:auto; height:27px; " onChange="loadHTMLPost2('app/siswa_alamat_ajax.php','kelurahan','getkelurahan','kecamatan_kode')" />										
					<option value=""></option>
					<?php select_kecamatan($kota_kode, ""); ?>
			</select>
		
<?php	
		break;
		
	case "getkelurahan":
		$kecamatan_kode = $_POST["kecamatan_kode"];	
			
?>				
			<select name="desa_kode" id="desa_kode" style="width:auto; height:27px; " />												<option value=""></option>
					<?php select_desa($kecamatan_kode, ""); ?>
			</select>
		
<?php	

		break;
			
	default:
	
}
?>