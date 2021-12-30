<!--<script src="js/pindah.js"></script>-->

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='usrid') {
			alert('User ID tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='pwd') {
			alert('Password tidak boleh kosong!');				
		  }
		  
		  
		  return false
		} 
										
	  }		 
	}	
</script>

<?php

$ref = $segmen3;

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>User Reminder</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="usr" id="usr" class="form-horizontal" >
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										//$ref2 = notran(date('y-m-d'), 'frmusr', '', '', ''); //---get no ref
										
										include("app/exec/insert_usr_reminder.php"); 
										
									?>
									
									<?php 
										include("usr_reminder_detail.php");
										
									?>
									
									<table>
										<tr>
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>									
										</tr>
										
										<tr>											
											<td colspan="2">
												<?php if($ref!='') { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
												<?php } ?>
												
												<?php if($ref=='') { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
												<?php } ?>
												
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