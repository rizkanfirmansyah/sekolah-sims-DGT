<script src="js/pindah.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='Yar') {
			alert('Tahun tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='HldDte') {
			alert('Tanggal tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='HldDcr') {
			alert('Nama Hari Libur tidak boleh kosong!');				
		  }
		  		  
		  return false
		} 
										
	  }		 
	}	
</script>

<script>
    function submitForm(tipe)
    {
		/*if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#delord_view").attr('action', 'app/delord_print.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
		if(tipe == 'find') {
			$("#laborder").attr('action', '')
				.attr('target', '_self');
			$("#laborder").submit();
		}
		
		if(tipe == 'list') {
			$("#holiday").attr('action', "main.php?menu=app&act=holiday_view")
				.attr('target', '_self');
			$("#holiday").submit();
		}
		
		/*if(tipe == 'excel') {
			$("#delord_view").attr('action', 'app/delord_xls.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
  		return false;	 
    }
		
</script>
<script type="text/javascript" src="jsdynamic/jquery.min.js"></script>
<?php

$slipno		= $_POST['slipno'];
$fromdate	= $_POST['fromdate'];
$todate		= $_POST['todate'];
$periodid	= $_POST['periodid'];
$tpe		= $_POST['tpe'];
$labid		= $_POST['labid'];
$sts		= $_POST['sts'];
$clientid	= $_POST['clientid'];


$ref = $_GET['search'];
				

?>

<!-------autocomplete function-------------------------------->
<script type="text/javascript" src="app/js_auto/jquery.js"></script>

<script type="text/javascript" src="app/js_auto/auto_client.js"></script>
<link type="text/css" href="app/js_auto/auto_client.css" rel="stylesheet" />

<script type="text/javascript" src="app/js_auto/auto_kauttp.js"></script>
<link type="text/css" href="app/js_auto/auto_kauttp.css" rel="stylesheet" />

<!-------end function----------------------------------------->

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Hari Libur Nasional</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="holiday" id="holiday" class="form-horizontal" onSubmit="return cekinput('Yar,HldDte,HldDcr');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Save') { $ref = ''; }
										//-----------------------------------------------/\
										
										include("app/exec/insert_holiday.php"); 
										
										$Yar		= date("Y");
										$HldDte		= date("d-m-Y");
										
										if ($ref != "") {
											$sql=$select->list_holiday($Yar);			
											$row_holiday=odbc_fetch_object($sql);
											
											$Yar = date("Y", strtotime($row_holiday->Yar));																$HldDte = date("d-m-Y", strtotime($row_holiday->HldDte));
											$HldDcr	= $row_holiday->HldDcr;
											
										}	
										
									?>
									<table border="0">
										<tr>
											<td>Tahun *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="Yar" id="Yar" style="width:auto; height:16px;" value="<?php echo $Yar ?>"></td>											
										</tr>
										
										<tr>
											<td>Tanggal *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="HldDte" class='datepick' id="HldDte" style="width:70px; height:16px; " value="<?php echo $HldDte ?>"></td>											
										</tr>
										<tr>
											<td rowspan="2">Nama Hari Libur *)</td>
											<td rowspan="2">&nbsp;&nbsp;</td>
											<td rowspan="2">
												<textarea name="HldDcr" id="HldDcr" rows="auto"><?php echo $row_holiday->HldDcr ?></textarea>
											</td>
											
										</tr>
										
										
										<tr>											
											<td colspan="7">
												&nbsp;
											</td>
													
										</tr>
										
										<tr>											
											<td colspan="7">
												<?php if($ref!='') { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
												<?php } ?>
												
												<?php if($ref=='') { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Save" />
												<?php } ?>
													
												&nbsp;
												<input type="submit" name="submit" id="submit" class="btn btn-danger" value="Hapus" />
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='main.php?menu=app&act=holiday_view'" />
												
											</td>
													
										</tr>
										
										
										
									</table>
									
								</div>								
							
						</div>	
						
						</form>
						
					</div>
					
			</div>

		</div>
	</div>
</div>