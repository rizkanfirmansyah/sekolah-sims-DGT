<?php
session_start();
?>

<script src="js/pindah.js"></script>

<script>
    function submitForm(tipe)
    {
		if(tipe == 'preview') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#orderstatus_header").attr('action', 'app/orderstatus_rpt.php')
			   .attr('target', '_BLANK');
			$("#orderstatus_header").submit();
		}
		
		/*if(tipe == 'find') {
			$("#laborder_dl").attr('action', '')
				.attr('target', '_self');
			$("#laborder_dl").submit();
		}*/
		
		if(tipe == 'excel') {
			$("#orderstatus_header").attr('action', 'app/orderstatus_xls.php')
			   .attr('target', '_BLANK');
			$("#orderstatus_header").submit();
		}
		
  		return false;	 
    }
		
</script>

<?php

$slipno		= $_REQUEST['slipno'];
$fromdate	= $_REQUEST['fromdate'];
$todate		= $_REQUEST['todate'];
$periodid	= $_REQUEST['periodid'];
$tpe		= $_REQUEST['tpe'];
$labid		= $_REQUEST['labid'];
$sts		= $_REQUEST['sts'];
$clientid	= $_REQUEST['clientid'];

$nowdate		= date("d-m-Y");
$nowyear		= date("Y");
$nowmonthyear	= date("m-Y");
$nowfirst		= date("d-m-Y", strtotime("01-".$nowmonthyear) );

/*
if($fromdate == "") {
	$fromdate = $nowfirst;
} 	

if($todate == "") {
	$todate = $nowdate;
} */				

if($periodid == "") {
	$periodid = $nowyear;
}
				
?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Lap. Order Status</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="orderstatus_header" id="orderstatus_header" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Periode</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="periodid" id="periodid" style="width:auto; height:20px; font-size:12px; padding:0px; " />
													<?php period_combo_select($periodid); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Kategori</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="tpe" id="tpe" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<?php type_combo_select($tpe); ?>
												</select>
											</td>
											
										</tr>
										<tr>
											<td>No. Order</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="slipno" id="slipno" style="width:auto; height:10px; font-size: 12px" value="<?php echo $slipno ?>" ></td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Laboratorium</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="labid" id="labid" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php lab_combo_select($labid); ?>
												</select>
											</td>											
											
										</tr>
										<tr>
											<td>Status</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="sts" id="sts" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<?php status_combo_select($sts); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Tanggal Order</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="fromdate" class='datepick' id="fromdate" style="width:70px; height:10px; font-size:12px " value="<?php echo $fromdate ?>">&nbsp;s/d&nbsp;<input type="text" name="todate" class='datepick' id="todate" style="width:70px; height:10px; font-size:12px " value="<?php echo $todate ?>">
											</td>
											
										</tr>
										<tr>
											<td>Pelanggan</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="clientid" id="clientid" style="width:auto; height:10px; font-size: 12px" value="<?php echo $clientid ?>"></td>
											
											
										</tr>
										
										<tr>
											<td colspan="3">&nbsp;</td>
										</tr>
										
										<tr>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Preview" onclick="submitForm('preview')" >
											</td>
											
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Excel" onclick="submitForm('excel')" >
											</td>
										</tr>
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					
			</div>

		</div>
	</div>
</div>