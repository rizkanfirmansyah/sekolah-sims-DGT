<?php
session_start();

/*if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}*/

include_once("include/sambung.php");
include_once("include/functions.php");

include 'class/class.select.php';
$select=new select;

$lne = $_GET['lne'];

?>

<?php /*
<link rel="stylesheet" href="../css/layout.css" type="text/css" media="screen" />

<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script src="../js/hideshow.js" type="text/javascript"></script>
<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>

<style type="text/css">
  body {
	padding-top: 10px;
  }
</style>

<!-- DataTables Initialization -->
<script type="text/javascript" src="../js/datatables/jquery.dataTables.js"></script>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#dt1').dataTable();
	} );
		 
</script>
<!---------end pagination----------->
*/ ?>

<form name="frm" id="frm" method="post" action="laborder_prv_lup.php">
<script langauge="javascript">
	function post_value(j){
	var aa= document.getElementById('frm');
	
	var zz= "ProCde" + j
	opener.document.laborder.ProCde_<?php echo $lne ?>.value = aa.elements[zz].value;
	opener.document.laborder.ord_ProCde.value = aa.elements[zz].value;
	
	var xx= "ProNme" + j
	opener.document.laborder.ProNme_<?php echo $lne ?>.value = aa.elements[xx].value;
	
	self.close();
	}
</script>


			
				<table style="width:550px; padding-top:20px; font-size:12px;" >
					<thead>
					  <tr>
						<th>Kode</th>
						<th>Nama Provinsi</th>
						<th>Pilih</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						$j = 0;
						$sql=$select->list_prv_lup('');
						while($row_prv=odbc_fetch_object($sql)){
						
						$j++;
						
						if ( $j%2 ==1 ){
					?>
						<tr style="background-color:#CCFFCC; " >
					<?php
						}else{
					?>
						<tr style="background-color:#ffffff; ">
					<?php
						}
					?>
						<td><?php echo $row_prv->ProCde ?></td>
						<td><?php echo $row_prv->ProNme ?></td>
						
						<input type="hidden" name="ProCde<?php echo $j; ?>" value="<?php echo $row_prv->ProCde; ?>">
						<input type="hidden" name="ProNme<?php echo $j; ?>" value="<?php echo $row_prv->ProNme; ?>"> 
						<td align="center"><input type=button value="OK" onclick="post_value(<?php echo $j; ?>);"></td>			
					  </tr>
					<?php
						}
					?>
					
					</tbody>
				  </table>
</form>
	