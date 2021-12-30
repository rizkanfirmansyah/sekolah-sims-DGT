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

<!--
<script>
    function submitForm(tipe)
    {
    	
		/*if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#delord_view").attr('action', 'app/delord_print.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
		/*
		if(tipe == 'find') {
			$("#usr").attr('action', '')
				.attr('target', '_self');
			$("#usr").submit();
		}
		
		if(tipe == 'list') {
			$("#dinasluar").attr('action', "main.php?menu=app&act=dinasluar_view")
				.attr('target', '_self');
			$("#dinasluar").submit();
		} */
		
		/*if(tipe == 'excel') {
			$("#delord_view").attr('action', 'app/delord_xls.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
  		return false;	 
    }
		
</script>-->

<!--<script type="text/javascript" src="jsdynamic/jquery.min.js"></script>-->

<?php

/*
$slipno		= $_POST['slipno'];
$fromdate	= $_POST['fromdate'];
$todate		= $_POST['todate'];
$periodid	= $_POST['periodid'];
$tpe		= $_POST['tpe'];
$labid		= $_POST['labid'];
$sts		= $_POST['sts'];
$clientid	= $_POST['clientid']; */

$ref = $segmen3;

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>User</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="usr" id="usr" class="form-horizontal" onSubmit="return cekinput('usrid,pwd');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										//$ref2 = notran(date('y-m-d'), 'frmusr', '', '', ''); //---get no ref
										
										include("app/exec/insert_usr.php"); 
										
										$admin = "";
										$active = "checked";
										$departemen = "";
										
										if ($ref != "") {
											$sql=$select->list_usr($ref);			
											$usr_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$departemen = $usr_data->departemen;
											
											if ($usr_data->adm == 1) {
												$admin = "checked";
											} else {
												$admin = "";
											}
											
											if ($usr_data->act == 1) {
												$active = "checked";
											} else {
												$active = "";
											}
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >
										<input type="hidden" id="old_usrid" name="old_usrid" value="<?php echo $usr_data->usrid ?>" >
						
										<tr>
											<td>User ID *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="usrid" id="usrid" style="width:250px; height:16px; " value="<?php echo $usr_data->usrid ?>"></td>
											
																						
											<td>&nbsp;&nbsp;</td>	
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>	
										</tr>
									
										<tr>
											<td>Password *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="password" name="pwd" id="pwd" style="width:250px; height:16px; " value="<?php echo $usr_data->pwdori ?>"></td>
											
																						
											<td>&nbsp;&nbsp;</td>	
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
																			
										</tr>
										
										<tr>
											<td>Administrator</td>
											<td>&nbsp;&nbsp;</td>	
											<td>:</td>
											<td><input type="checkbox" name="adm" id="adm" style="width:70px; height:16px; " value="1" <?php echo $admin ?> ></td>
											
																					
											<td>&nbsp;&nbsp;</td>	
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>	
										</tr>
										
										
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="departemen" id="departemen" class='cho' style="width:min-width:10px; height:27px; " />
													<option value="">...</option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
																	
										</tr>
										
										<tr>
											<td>Aktif</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="checkbox" name="active" id="active" style="width:70px; height:16px; " value="1" <?php echo $active ?> ></td>
											
																						
											<td>&nbsp;&nbsp;</td>	
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>	
										</tr>
										
										
										
										<tr>
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>										
										</tr>
										
										<tr>											
											<td colspan="7">
												<?php if($ref!='') { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
												<?php } ?>
												
												<?php if($ref=='') { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
												<?php } ?>
													
												&nbsp;
												<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('usr_view') ?>'" />
												
											</td>
													
										</tr>
										
										<tr>
											<td colspan="7">&nbsp;&nbsp;</td>									
										</tr>
										
									</table>
									
									<?php 
										if($ref == "") {
											include("usr_detail.php");
										} else {
											include("usr_detail_update.php");
										}
									?>
									
									<table>
										<tr>
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>										
										</tr>
										
										<tr>											
											<td colspan="7">
												<?php if($ref!='') { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
												<?php } ?>
												
												<?php if($ref=='') { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
												<?php } ?>
													
												&nbsp;
												<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('usr_view') ?>'" />
												
											</td>
													
										</tr>
									</table>
									
								</div>								
							
						</div>	
						
								
										
						
						
						</form>
						
						<!--------------end Detail------------------ -->
					</div>
					
			</div>

		</div>
	</div>
</div>