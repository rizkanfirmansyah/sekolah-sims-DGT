<?php
session_start();
?>

<script src="js/pindah.js"></script>

<script>
    function submitForm(tipe)
    {
		if(tipe == 'preview') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#pnbp_dl_header").attr('action', 'app/pnbp_dl_rpt.php')
			   .attr('target', '_BLANK');
			$("#pnbp_dl_header").submit();
		}
		
		/*if(tipe == 'find') {
			$("#laborder_dl").attr('action', '')
				.attr('target', '_self');
			$("#laborder_dl").submit();
		}*/
		
		if(tipe == 'excel') {
			$("#pnbp_dl_header").attr('action', 'app/pnbp_dl_xls.php')
			   .attr('target', '_BLANK');
			$("#pnbp_dl_header").submit();
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
							<h3>Laporan PNBP Dinas Luar</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="pnbp_dl_header" id="pnbp_dl_header" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Balai</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="balai" id="balai" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<?php balai_select($balai); ?>
												</select>
											</td>
											
											
										</tr>
										
										
										<tr>
											<td>Periode</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="periodid" id="periodid" style="width:auto; height:20px; font-size:12px; padding:0px; " />
													<?php periode_select($periodid); ?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td>Tanggal Order</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="fromdate" class='datepick' id="fromdate" style="width:70px; height:10px; font-size:12px " value="<?php echo $fromdate ?>">&nbsp;s/d&nbsp;<input type="text" name="todate" class='datepick' id="todate" style="width:70px; height:10px; font-size:12px " value="<?php echo $todate ?>">
											</td>	
										</tr>
										
										<tr>
											<td>Bulan</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="bulan" id="bulan" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php bulan_select($bulan); ?>
												</select>
											</td>	
										</tr>
										
										<tr>
											<td>Tahun</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="tahun" id="tahun" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php tahun_select($tahun); ?>
												</select>
											</td>
																						
											
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