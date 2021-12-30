<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='old_usrid') {
			alert('User ID Lama tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='usrid') {
			alert('User ID Baru tidak boleh kosong!');				
		  }
		  if (document.getElementById(arrf[i]).name=='old_pwd') {
			alert('Password Lama tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='pwd') {
			alert('Password Baru tidak boleh kosong!');				
		  }
		  
		  return false
		}
										
	  }		 
	}
		
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Ganti Password</h3>
						</div>
						
						<?php
							/*$ref = $_GET['search'];
							if ($ref != "") {
								$sql=$select->list_usr($ref);
								$row_usr=odbc_fetch_object(condb,$sql); // fetch_object($sql);
							} */
							
							include("app/exec/insert_usr_chg.php"); 
						?>
						<div class="box-content">
							<form action="" method="post" name="gantipassword" id="gantipassword" class="form-horizontal" onSubmit="return cekinput('old_usrid,usrid,old_pwd,pwd');">
								<div>
									<table border="0">
										<tr>
											<td>User ID Lama *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" id="old_usrid"  name="old_usrid" style="width:auto; height:16px;" value="" />
											</td>
										</tr>
										<tr>
											<td>User ID Baru *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" id="usrid" name="usrid" style="width:auto; height:16px;" value="<?php echo $row_usr->usrid ?>">		
											</td>
											
										</tr>
										<tr>
											<td>Password Lama *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="password" id="old_pwd" name="old_pwd" style="width:145px; height:16px; " value="">		
											</td>
										</tr>
										<tr>
											<td>Password Baru *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="password" id="pwd" name="pwd" style="width:145px; height:16px; " value="">		
											</td>										
											
										</tr>
										
										<tr>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
										</tr>
										
										<tr>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Save" />								</td>
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