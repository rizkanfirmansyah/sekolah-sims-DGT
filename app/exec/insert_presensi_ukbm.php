<?php
include 'app/class/class.insert.php';
include 'app/class/class.update.php';
include 'app/class/class.delete.php'; 

$insert=new insert;
$update=new update;
$delete=new delete;

$post = $_POST['submit'];

if ($post == "Submit" ) {

	$ref = notran(date('y-m-d'), 'frmpresensi_ukbm', '', '', '');

	$hs=$insert->insert_presensi_ukbm($ref);
		
	if ($hs) {

		notran(date('y-m-d'), 'frmpresensi_ukbm', '1', '', ''); 
?>
		<div class="alert alert-success">Absensi Mapel successfully</div>			
		
<?php					
	}else{
?>
		<div class="alert alert-error">Absensi Mapel Error Save</div>
<?php		
	}	
}

if ($post == "Update" ) {
	
	$hs=$insert->insert_presensi_ukbm($_POST['ref']);
	
	if($hs){			
?>
		<div class="alert alert-success">Update Absensi Mapel successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Absensi Mapel Error Update</div>
<?php		

	}
}

if ($post == "Hapus" ){
	$hs=$delete->delete_presensi_ukbm($_POST['ref']);
	if($hs){			
?>
		<div class="alert alert-success">Delete Absensi Mapel successfully</div>
<?php
	}else{
?>
		<div class="alert alert-error">Absensi Mapel Error Delete</div>
<?php		

	}
}
?>
