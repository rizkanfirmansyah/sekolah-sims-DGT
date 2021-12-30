<?php
session_start();
?>

<script src="js/pindah.js"></script>

<script>
    function submitForm(tipe)
    {
		if(tipe == 'preview') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#clnprd_header").attr('action', 'app/clnprd_rpt.php')
			   .attr('target', '_BLANK');
			$("#clnprd_header").submit();
		}
		
		/*if(tipe == 'find') {
			$("#laborder_dl").attr('action', '')
				.attr('target', '_self');
			$("#laborder_dl").submit();
		}*/
		
		if(tipe == 'excel') {
			$("#clnprd_header").attr('action', 'app/clnprd_xls.php')
			   .attr('target', '_BLANK');
			$("#clnprd_header").submit();
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
							<h3>Laporan Jumlah Pelanggan per Periode (Tera Ulang)</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="clnprd_header" id="clnprd_header" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Periode</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="tahun" id="tahun" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php tahun_select($tahun); ?>
												</select>
												s/d
												<select name="tahun2" id="tahun2" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php tahun_select($tahun2); ?>
												</select>
											</td>
																						
											
										</tr>
										
										
										<tr>
											<td>Jumlah Tera (Kali)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="jmltera" id="jmltera" style="width:70px; height:10px; font-size:12px " value="<?php echo $jmltera ?>">
											</td>
											
										</tr>
										
										<tr>
											<td>Tipe</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="tipe" id="tipe" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<?php tipe_tera_select($bulan); ?>
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