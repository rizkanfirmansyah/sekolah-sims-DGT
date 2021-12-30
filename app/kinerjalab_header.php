<?php
session_start();
?>

<script src="js/pindah.js"></script>

<script>
    function submitForm(tipe)
    {
		if(tipe == 'preview') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#kinerjalab_header").attr('action', 'app/kinerjalab_rpt.php')
			   .attr('target', '_BLANK');
			$("#kinerjalab_header").submit();
		}
		
		/*if(tipe == 'find') {
			$("#laborder_dl").attr('action', '')
				.attr('target', '_self');
			$("#laborder_dl").submit();
		}*/
		
		if(tipe == 'excel') {
			$("#kinerjalab_header").attr('action', 'app/kinerjalab_xls.php')
			   .attr('target', '_BLANK');
			$("#kinerjalab_header").submit();
		}
		
  		return false;	 
    }
		
</script>

<?php

$fromdate	= $_REQUEST['fromdate'];
$todate		= $_REQUEST['todate'];
$lab		= $_REQUEST['lab'];
				
?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Kinerja Lab.</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="kinerjalab_header" id="kinerjalab_header" class="form-horizontal">
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
											<td>Lab.</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="lab" id="lab" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php lab_select($lab); ?>
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