<?php
session_start();
?>

<script src="js/pindah.js"></script>

<script>
    function submitForm(tipe)
    {
		if(tipe == 'preview') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#dinasluarpeg_header").attr('action', 'app/dinasluarpeg_rpt.php')
			   .attr('target', '_BLANK');
			$("#dinasluarpeg_header").submit();
		}
		
		/*if(tipe == 'find') {
			$("#laborder_dl").attr('action', '')
				.attr('target', '_self');
			$("#laborder_dl").submit();
		}*/
		
		if(tipe == 'excel') {
			$("#dinasluarpeg_header").attr('action', 'app/dinasluarpeg_xls.php')
			   .attr('target', '_BLANK');
			$("#dinasluarpeg_header").submit();
		}
		
  		return false;	 
    }
		
</script>

<?php

$fromdate	= $_REQUEST['fromdate'];
$todate		= $_REQUEST['todate'];
$nip		= $_REQUEST['nip'];
$subdit		= $_REQUEST['subdit'];	
			
?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Pelaksanaan Pelayanan Tera dan Tera Ulang di Luar Kantor</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="dinasluarpeg_header" id="dinasluarpeg_header" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Tanggal</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="fromdate" class='datepick' id="fromdate" style="width:70px; height:10px; font-size:12px " value="<?php echo $fromdate ?>">&nbsp;s/d&nbsp;<input type="text" name="todate" class='datepick' id="todate" style="width:70px; height:10px; font-size:12px " value="<?php echo $todate ?>">
											</td>
																						
											
										</tr>
										
										<tr>
											<td>Pegawai</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="nip" id="nip" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php pegawai_select($nip); ?>
												</select>
											</td>	
										</tr>
										
										<tr>
											<td>SubDit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="subdit" id="subdit" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php subdit_select($subdit); ?>
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