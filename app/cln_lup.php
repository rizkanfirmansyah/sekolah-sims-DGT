<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");

include 'class/class.select.php';
$select=new select;
?>
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

<form name="frm" id="frm" method="post" action="delord_vhc_lup.php">
<script langauge="javascript">
	function post_value(j){
	var aa= document.getElementById('frm');
	
	var zz= "vhccde" + j
	opener.document.delord.vhccde.value = aa.elements[zz].value;
	
	var xx= "sts" + j
	opener.document.delord.vhctpe.value = aa.elements[xx].value;
	
	var zz= "vdrnme" + j
	opener.document.delord.subconnme.value = aa.elements[zz].value;
	
	var bb= "tipe" + j
	opener.document.delord.tpe.value = aa.elements[bb].value;

	self.close();
	}
</script>

<section id="main" class="column">
	<article class="module width_full" style="border:#FF0000 0px solid; width:inherit; background-color:#f9f9fa;">
		<div class="module_content" >
			<fieldset>				
				<table class="tablesorter" style="width:550px; padding-top:20px; font-size:12px;" id="dt1">
					<thead>
					  <tr>
						<th>No Polisi <i class="fa fa-sort"></i></th>
						<th>Kode <i class="fa fa-sort"></i></th>
						<th>Tipe <i class="fa fa-sort"></i></th>
						<th>GPS <i class="fa fa-sort"></i></th>
						<th>Pilih</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						$j = 0;
						$sql=$select->list_vhc_lup('');
						while($row_vhc=fetch_object($sql)){
						
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
						<td><?php echo $row_vhc->vhccde ?></td>
						<td><?php echo $row_vhc->kode ?></td>
						<td><?php echo $row_vhc->tipe ?></td>
						<td><?php echo $row_vhc->gps ?></td>
						
						<input type="hidden" name="vhccde<?php echo $j; ?>" value="<?php echo $row_vhc->vhccde; ?>">
						<input type="hidden" name="sts<?php echo $j; ?>" value="<?php echo $row_vhc->sts; ?>"> 
						<input type="hidden" name="vdrnme<?php echo $j; ?>" value="<?php echo $row_vhc->vdrnme; ?>">
						<input type="hidden" name="tipe<?php echo $j; ?>" value="<?php echo $row_vhc->tipe; ?>"> 
						<td align="center"><input type="image" src="../images/icn_edit.png" value="" onClick="post_value(<?php echo $j; ?>);"></td>					
					  </tr>
					<?php
						}
					?>
					
					</tbody>
				  </table>
			</fieldset>
		</div>
	</article>			
</section>
</form>
	