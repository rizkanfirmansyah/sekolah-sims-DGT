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
<link rel="stylesheet" href="../../css/bootstrap.css">
<link rel="stylesheet" href="../../css/bootstrap-responsive.css">
<link rel="stylesheet" href="../../css/jquery.fancybox.css">
<link rel="stylesheet" href="../../css//style.css">

<!--<link rel="stylesheet" href="../../css//uniform.default.css">-->
<link rel="stylesheet" href="../../css/green.css">
<link rel="stylesheet" href="../../css/bootstrap.datepicker.css">
<link rel="stylesheet" href="../../css/jquery.cleditor.css">
<link rel="stylesheet" href="../../css/jquery.plupload.queue.css">
<link rel="stylesheet" href="../../css/jquery.tagsinput.css">
<link rel="stylesheet" href="../../css/jquery.ui.plupload.css">
<link rel="stylesheet" href="../../css/chosen.css">
<link rel="stylesheet" href="../../css/chosen.css">

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

<form name="frm" id="frm" method="post" action="dinasluar_cln_lup.php">
<script langauge="javascript">
	function post_value(j){
	var aa= document.getElementById('frm');
	
	var zz= "ClientID" + j
	opener.document.dinasluar.ClnCde.value = aa.elements[zz].value;
	
	var xx= "ClientBame" + j
	opener.document.dinasluar.ClientName.value = aa.elements[xx].value;
	
	
	self.close();
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Filter</h3>
						</div>
						<div class="box-content">
								<div>
									
					<table class='table dataTable table-bordered' style="font-size:12px; padding:0px;">
					<thead>
					  <tr>
						<th>Nama Pelanggan <i class="fa fa-sort"></i></th>
						<th>Kode Pelanggan <i class="fa fa-sort"></i></th>
						<th>Pilih</th>
					  </tr>
					</thead>
					<tbody>
					<?php
						$j = 0;
						$sql=$select->list_cln_lup();
						while($row_vhc=odbc_fetch_object($sql)){
						
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
						<td><?php echo $row_vhc->ClientName ?></td>
						<td><?php echo $row_vhc->ClientID ?></td>
						
						<input type="hidden" name="ClientName<?php echo $j; ?>" value="<?php echo $row_vhc->ClientName; ?>">
						<input type="hidden" name="ClientID<?php echo $j; ?>" value="<?php echo $row_vhc->ClientID; ?>"> 					
						<td align="center"><input type="image" src="../img/icons/essen/32/pencil.png" value="" onClick="post_value(<?php echo $j; ?>);"></td>
					  </tr>
					<?php
						}
					?>
					
					</tbody>
				  </table>
			</div>
							</div>
						</div>
						
				</div>
			</div>

		</div>
	</div>
</div>

</form>


<script src="../js/jquery.js"></script>
<script src="../js/less.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.peity.js"></script>
<script src="../js/jquery.fancybox.js"></script>
<script src="../js/jquery.flot.js"></script>
<script src="../js/jquery.color.js"></script>
<script src="../js/jquery.flot.resize.js"></script>
<script src="../js/custom.js"></script>


<script src="../js/jquery.uniform.min.js"></script>
<script src="../js/bootstrap.timepicker.js"></script>
<script src="../js/bootstrap.datepicker.js"></script>
<script src="../js/chosen.jquery.min.js"></script>
<script src="../js/jquery.fancybox.js"></script>
<script src="../js/plupload/plupload.full.js"></script>
<script src="../js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="../js/jquery.cleditor.min.js"></script>
<script src="../js/jquery.inputmask.min.js"></script>
<script src="../js/jquery.tagsinput.min.js"></script>
<script src="../js/jquery.mousewheel.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/jquery.dataTables.bootstrap.js"></script>
<script src="../js/jquery.textareaCounter.plugin.js"></script>
<script src="../js/ui.spinner.js"></script>
	